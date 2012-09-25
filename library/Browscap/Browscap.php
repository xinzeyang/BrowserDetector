<?php
namespace Browscap;

/**
 * Browscap.ini parsing class with caching and update capabilities
 *
 * PHP version 5
 *
 * LICENSE: This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301 USA
 *
 * @category  CreditCalc
 * @package   Browscap
 * @author    Jonathan Stoppani <st.jonathan@gmail.com>
 * @copyright 2006-2008 Jonathan Stoppani
 * @version    SVN: $Id$
 */

/**
 * Browscap.ini parsing class with caching and update capabilities
 *
 * @category  CreditCalc
 * @package   Browscap
 * @author    Jonathan Stoppani <st.jonathan@gmail.com>
 * @copyright 2007-2010 Unister GmbH
 */
class Browscap extends Core
{
    /**
     * Flag to enable only lowercase indexes in the result.
     * The cache has to be rebuilt in order to apply this option.
     *
     * @var bool
     */
    private $_lowercase = false;

    /**
     * Where to store the value of the included PHP cache file
     *
     * @var array
     */
    private $_userAgents  = array();
    private $_browsers    = array();
    private $_patterns    = array();
    private $_properties  = array();
    private $_config      = null;
    private $_globalCache = null;
    private $_localFile   = null;

    /**
     * Constructor class, checks for the existence of (and loads) the cache and
     * if needed updated the definitions
     *
     * @param array|\Zend\Config\Config       $config
     * @param \Zend\Log\Logger                $log
     * @param array|\Zend\Cache\Frontend\Core $cache
     */
    public function __construct()
    {
        // default data file
        $this->setLocaleFile(__DIR__ . '/data/browscap.ini');
        
        parent::__construct();
    }

    /**
     * Gets the information about the browser by User Agent
     *
     * @param string $userAgent   the user agent string
     * @param bool   $bReturnAsArray whether return an array or an object
     *
     * @return stdClas|array the object containing the browsers details.
     *                       Array if $bReturnAsArray is set to true.
     */
    public function getBrowser($userAgent = null, $forceDetect = false)
    {
        if ('' === $this->_agent 
            && (empty($userAgent) || !is_string($userAgent))
        ) {
            $userAgent = $this->_support->getUserAgent();
        }
        
        if (null !== $userAgent) {
            $this->_agent = $userAgent;
        }
        
        $this->_cleanedAgent = $this->_support->cleanAgent($this->_agent);
        
        if (!$array = $this->_getBrowserFromCache($this->_agent)) {
            $this->_getGlobalCache();
            
            $browser = array();
            if (isset($this->_globalCache['patterns'])
                && is_array($this->_globalCache['patterns'])
            ) {
                foreach ($globalCache['patterns'] as $key => $pattern) {
                    if (preg_match($pattern, $this->_agent)) {
                        $browser = array(
                            'userAgent'   => $userAgent, // Original useragent
                            'usedRegex'   => trim(strtolower($pattern), '@'),
                            'usedPattern' => $this->_globalCache['userAgents'][$key]
                        );

                        $browser += $this->_globalCache['browsers'][$key];

                        break;
                    }
                }
            }

            // Add the keys for each property
            $array = $browser;
            
            if ($this->_cache instanceof \Zend\Cache\Frontend\Core) {
                $cacheId = $this->_getCacheFromAgent($this->_agent);
                
                $this->_cache->save($array, $cacheId);
            }
        }

        return (object) $array;
    }

    /**
     * Gets the information about the browser by User Agent
     *
     * @param string $userAgent   the user agent string
     * @param bool   $bReturnAsArray whether return an array or an object
     *
     * @return void
     */
    private function _getGlobalCache()
    {
        if (null === $this->_globalCache) {
            $cacheGlobalId = $this->_cachePrefix . 'agentsGlobal';
            
            // Load the cache at the first request
            if (!($this->_cache instanceof \Zend\Cache\Frontend\Core) 
                || !$this->_globalCache = $this->_cache->load($cacheGlobalId)
            ) {
                $this->_globalCache = $this->_getBrowserFromGlobalCache();
                
                if ($this->_cache instanceof \Zend\Cache\Frontend\Core) {
                    $this->_cache->save($this->_globalCache, $cacheGlobalId);
                }
            }
        }
    }
    
    public function getAllBrowsers()
    {
        $this->_getGlobalCache();
        
        if (empty($this->_globalCache['browsers'])) {
            return null;
        }
        
        return $this->_globalCache['browsers'];
    }

    /**
     * Gets the information about the browser by User Agent
     *
     * @return array
     */
    private function _getBrowserFromGlobalCache()
    {
        try {
            return $this->_updateCache();
        } catch (Exception $e) {
            $this->_log($e, \Zend\Log\Logger::ERR);

            return array();
        }
    }

    /**
     * sets the name of the local file
     *
     * @param string $file the file name
     *
     * @return void
     */
    public function setLocaleFile($file)
    {
        $this->_localFile = $file;
    }

    /**
     * Parses the ini file and updates the cache files
     *
     * @return array
     */
    private function _updateCache()
    {
        if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
            $browsers = parse_ini_file($this->_localFile, true, INI_SCANNER_RAW);
        } else {
            $browsers = parse_ini_file($this->_localFile, true);
        }
        
        array_shift($browsers);
        
        $this->_properties = array_keys($browsers['DefaultProperties']);
        array_unshift(
            $this->_properties,
            'browser_name',
            'browser_name_regex',
            'browser_name_pattern',
            'Parent'
        );

        $this->_userAgents = array_keys($browsers);
        
        usort(
            $this->_userAgents,
            function($a, $b) {
                $a = strlen($a);
                $b = strlen($b);
                return ($a == $b ? 0 :($a < $b ? 1 : -1));
            }
        );

        $aPropertiesKeys = array_flip($this->_properties);

        foreach ($this->_userAgents as $userAgent) {
            $this->_parseAgents(
                $browsers, $userAgent, $aPropertiesKeys
            );
        }

        // Save the keys lowercased if needed
        if ($this->_lowercase) {
            $this->_properties = array_map('strtolower', $this->_properties);
        }
        
        return array(
            'browsers'   => $this->_browsers,
            'userAgents' => $this->_userAgents,
            'patterns'   => $this->_patterns,
            'properties' => $this->_properties
        );
    }

    /**
     * Parses the user agents
     *
     * @return bool whether the file was correctly written to the disk
     */
    private function _parseAgents(
        $browsers, $sUserAgent, $aPropertiesKeys)
    {
        $browser = array();

        $userAgent = $sUserAgent;
        $parents   = array($userAgent);
        
        while (isset($browsers[$userAgent]['Parent'])) {
            $parents[] = $browsers[$userAgent]['Parent'];
            $userAgent = $browsers[$userAgent]['Parent'];
        }
        unset($userAgent);
        
        $parents     = array_reverse($parents);
        $browserData = array();

        foreach ($parents as $parent) {
            if (!isset($browsers[$parent])) {
                $this->_log(
                    '"' . $parent . '" not found in browsers collection',
                    \Zend\Log\Logger::WARN
                );
                
                continue;
            }
            
            if (!is_array($browsers[$parent])) {
                $this->_log(
                    '"' . $parent . '" found in browsers collection, '
                    . 'but the entry is empty',
                    \Zend\Log\Logger::WARN
                );
                
                continue;
            }
            
            if (isset($browsers[$parent]) && is_array($browsers[$parent])) {
                $browserData = array_merge($browserData, $browsers[$parent]);
            }
        }

        $search  = array('\*', '\?');
        $replace = array('.*', '.');
        $pattern = preg_quote($sUserAgent, '@');

        $this->_patterns[] = '@'
                           . '^'
                           . str_replace($search, $replace, $pattern)
                           . '$'
                           . '@';

        foreach ($browserData as $key => $value) {
            switch ($value) {
                case 'true':
                    $browser[$key] = true;
                    break;
                case 'false':
                    $browser[$key] = false;
                    break;
                default:
                    $browser[$key] = $value;
                    break;
            }
        }
        
        $this->_browsers[] = $browser;
    }
}