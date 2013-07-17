<?php
namespace Browscap\Input;

/**
 * Browscap.ini parsing final class with caching and update capabilities
 *
 * PHP version 5.3
 *
 * LICENSE:
 *
 * Copyright (c) 2013, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 *
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, 
 *   this list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice, 
 *   this list of conditions and the following disclaimer in the documentation 
 *   and/or other materials provided with the distribution.
 * * Neither the name of the authors nor the names of its contributors may be 
 *   used to endorse or promote products derived from this software without 
 *   specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE 
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF 
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN 
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  Browscap
 * @package   Browscap
 * @author    Jonathan Stoppani <st.jonathan@gmail.com>
 * @copyright 2006-2008 Jonathan Stoppani
 * @version   SVN: $Id: Uaparser.php 543 2013-06-14 19:18:32Z tmu $
 */
use \Browscap\Detector\MatcherInterface;
use \Browscap\Detector\MatcherInterface\DeviceInterface;
use \Browscap\Detector\MatcherInterface\OsInterface;
use \Browscap\Detector\MatcherInterface\BrowserInterface;
use \Browscap\Detector\EngineHandler;
use \Browscap\Detector\Result;
use \Browscap\Detector\Version;

/**
 * Browscap.ini parsing final class with caching and update capabilities
 *
 * @category  Browscap
 * @package   Browscap
 * @author    Jonathan Stoppani <st.jonathan@gmail.com>
 * @copyright Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @license   http://opensource.org/licenses/BSD-3-Clause New BSD License
 */
final class Uaparser extends Core
{
    /**
     * the detected browser
     *
     * @var Stdfinal class
     */
    private $_browser = null;
    
    /**
     * the detected browser engine
     *
     * @var Stdfinal class
     */
    private $_engine = null;
    
    /**
     * the detected platform
     *
     * @var Stdfinal class
     */
    private $_os = null;
    
    /**
     * the detected device
     *
     * @var Stdfinal class
     */
    private $_device = null;
    
    /**
     * the UAParser class
     *
     * @var \UAParser
     */
    private $_uaParser = null;
    
    /**
     * sets the UAParser detector
     *
     * @var \UAParser $parser
     *
     * @return \Browscap\Input\Uaparser
     */
    public function setParser(\UAParser $parser)
    {
        $this->_uaParser = $parser;
        
        return $this;
    }
    
    /**
     * sets the cache used to make the detection faster
     *
     * @param \Zend\Cache\Frontend\Core $cache
     *
     * @return \\Browscap\\Browscap
     */
    public function setCache(\Zend\Cache\Frontend\Core $cache)
    {
        $this->_cache = $cache;
        
        return $this;
    }

    /**
     * sets the the cache prfix
     *
     * @param string $prefix the new prefix
     *
     * @return \\Browscap\\Browscap
     */
    public function setCachePrefix($prefix)
    {
        if (!is_string($prefix)) {
            throw new \UnexpectedValueException(
                'the cache prefix has to be a string'
            );
        }
        
        $this->_cachePrefix = $prefix;
        
        return $this;
    }

    /**
     * Gets the information about the browser by User Agent
     *
     * @return \Browscap\Detector\Result
     */
    public function getBrowser()
    {
        if (!($this->_uaParser instanceof \UAParser)) {
            throw new \UnexpectedValueException(
                'the parser object has to be an instance of \\UAParser'
            );
        }
        
        $parserResult = $this->_uaParser->parse($this->_agent);
        // var_dump($parserResult);exit;
        $result = new Result();
        $result->setCapability('useragent', $this->_agent);
        
        $version = new Version();
        
        $browserName    = $parserResult->ua->family;
        $browserVersion = $parserResult->ua->toVersionString;
        
        switch ($browserName) {
            case 'unknown':
            case 'Other':
                $browserName    = null;
                $browserVersion = null;
                break;
            case 'IE':
                $browserName = 'Internet Explorer';
                break;
            case 'IceWeasel':
                $browserName = 'Iceweasel';
                break;
            case 'GomezA':
                $browserName = 'GomezAgent';
                break;
            case 'Mobile Safari':
                $browserName = 'Safari';
                break;
            case 'Chrome Mobile':
                $browserName = 'Chrome';
                break;
            case 'Googlebot':
                $browserName = 'Google Bot';
                break;
            case 'bingbot':
                $browserName = 'BingBot';
                break;
            case 'Jakarta Commons-HttpClient':
                $browserName = 'Jakarta Commons HttpClient';
                break;
            case 'AdsBot-Google':
                $browserName = 'AdsBot Google';
                break;
            case 'SEOkicks-Robot':
                $browserName = 'SEOkicks Robot';
                break;
            default:
                // nothing to do here
                break;
        }
        
        switch ($browserVersion) {
            case 'unknown':
                $browserVersion = null;
                break;
            default:
                // nothing to do here
                break;
        }
        
        $result->setCapability('mobile_browser', $browserName);
        $result->setCapability(
            'mobile_browser_version', $version->setVersion($browserVersion)
        );
        
        $version = new Version();
        
        $osName    = $parserResult->os->family;
        $osVersion = $parserResult->os->toVersionString;
        
        switch ($osName) {
            case 'Other':
                $osName    = null;
                $osVersion = null;
                break;
            default:
                // nothing to do here
                break;
        }
        
        $result->setCapability('device_os', $osName);
        $result->setCapability(
            'device_os_version',
            $version->setVersion($osVersion)
        );
        
        $device = $parserResult->device->family;
        
        switch ($device) {
            case 'Other':
                $device = null;
                break;
            default:
                // nothing to do here
                break;
        }
        
        $result->setCapability('model_name', $device);
        
        return $result;
    }
    
    /**
     * returns the stored user agent
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getAgent();
    }
}
