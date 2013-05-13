<?php
namespace Browscap\Detector\Browser\General;

/**
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
 * @copyright Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @license   http://opensource.org/licenses/BSD-3-Clause New BSD License
 * @version   SVN: $Id$
 */

use \Browscap\Detector\BrowserHandler;
use \Browscap\Helper\Utils;
use \Browscap\Detector\MatcherInterface;
use \Browscap\Detector\MatcherInterface\BrowserInterface;
use \Browscap\Detector\EngineHandler;
use \Browscap\Detector\DeviceHandler;
use \Browscap\Detector\OsHandler;
use \Browscap\Detector\Version;

/**
 * @category  Browscap
 * @package   Browscap
 * @copyright Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @license   http://opensource.org/licenses/BSD-3-Clause New BSD License
 * @version   SVN: $Id$
 */
class MicrosoftInternetExplorer
    extends BrowserHandler
    implements MatcherInterface, BrowserInterface
{
    /**
     * the detected browser properties
     *
     * @var array
     */
    protected $_properties = array(
        'wurflKey' => null, // not in wurfl
        
        // kind of device
        'is_bot'             => false,
        'is_transcoder'      => false,
        
        // browser
        'mobile_browser'              => 'Internet Explorer',
        'mobile_browser_version'      => null,
        'mobile_browser_bits'         => null, // not in wurfl
        'mobile_browser_manufacturer' => 'Microsoft', // not in wurfl
        'mobile_browser_modus'        => null, // not in wurfl
        
        // product info
        'can_skip_aligned_link_row' => true,
        'device_claims_web_support' => true,
        
        // pdf
        'pdf_support' => true,
        
        // bugs
        'empty_option_value_support' => true,
        'basic_authentication_support' => true,
        'post_method_support' => true,
        
        // rss
        'rss_support' => false,
    );
    
    private $_patterns = array(
        '/Mozilla\/(4|5)\.0 \(.*MSIE 11\.0.*/' => '11.0',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 10\.0.*/' => '10.0',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 9\.0.*/'  => '9.0',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 8\.0.*/'  => '8.0',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 7\.0.*/'  => '7.0',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 6\.0.*/'  => '6.0',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 5\.5.*/'  => '5.5',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 5\.23.*/' => '5.23',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 5\.22.*/' => '5.22',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 5\.16.*/' => '5.16',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 5\.01.*/' => '5.01',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 5\.0.*/'  => '5.0',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 4\.01.*/' => '4.01',
        '/Mozilla\/(4|5)\.0 \(.*MSIE 4\.0.*/'  => '4.0',
        '/Mozilla\/.*\(.*MSIE 3\..*/'          => '3.0',
        '/Mozilla\/.*\(.*MSIE 2\..*/'          => '2.0',
        '/Mozilla\/.*\(.*MSIE 1\..*/'          => '1.0'
    );
    
    /**
     * Returns true if this handler can handle the given user agent
     *
     * @return bool
     */
    public function canHandle()
    {
        if (!$this->_utils->checkIfContains('Mozilla/')) {
            return false;
        }
        
        if (!$this->_utils->checkIfContains('MSIE')) {
            return false;
        }
        
        $isNotReallyAnIE = array(
            'Gecko',
            'Presto',
            'Webkit',
            'KHTML',
            // using also the Trident rendering engine
            'Crazy Browser',
            'Flock',
            'Galeon',
            'Lunascape',
            'Maxthon',
            'MyIE',
            'Opera',
            'PaleMoon',
            // other Browsers
            'AppleWebKit',
            'Chrome',
            'Linux',
            'MSOffice',
            'Outlook',
            'IEMobile',
            'BlackBerry',
            'WebTV',
            'ArgClrInt',
            'Firefox',
            'MSIECrawler',
            // mobile IE
            'XBLWP7',
            'ZuneWP7',
            'WPDesktop',
            // Fakes
            'Mac; Mac OS '
        );
        
        if ($this->_utils->checkIfContains($isNotReallyAnIE)
            && !$this->_utils->checkIfContains('Bitte Mozilla Firefox verwenden')
        ) {
            return false;
        }
        
        foreach (array_keys($this->_patterns) as $pattern) {
            if (preg_match($pattern, $this->_useragent)) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * detects the browser version from the given user agent
     *
     * @return string
     */
    protected function _detectVersion()
    {
        $detector = new \Browscap\Detector\Version();
        $detector->setUserAgent($this->_useragent);
        $detector->setMode(Version::COMPLETE | Version::IGNORE_MICRO);
        
        $doMatch = preg_match('/MSIE ([\d\.]+)/', $this->_useragent, $matches);
        
        if ($doMatch) {
            $this->setCapability(
                'mobile_browser_version', $detector->setVersion($matches[1])
            );
            
            return $this;
        }
        
        foreach ($this->_patterns as $pattern => $version) {
            if (preg_match($pattern, $this->_useragent)) {
                $this->setCapability(
                    'mobile_browser_version', $detector->setVersion($version)
                );
                
                return $this;
            }
        }
        
        $this->setCapability(
            'mobile_browser_version', $detector->setVersion('')
        );
        
        return $this;
    }
    
    /**
     * gets the weight of the handler, which is used for sorting
     *
     * @return integer
     */
    public function getWeight()
    {
        return 175451664;
    }
    
    /**
     * returns null, if the browser does not have a specific rendering engine
     * returns the Engine Handler otherwise
     *
     * @return null|\Browscap\Os\Handler
     */
    public function detectEngine()
    {
        $handler = new \Browscap\Detector\Engine\Trident();
        $handler->setUseragent($this->_useragent);
        
        return $handler->detect();
    }
    
    /**
     * detects properties who are depending on the browser, the rendering engine
     * or the operating system
     *
     * @return DeviceHandler
     */
    public function detectDependProperties(
        EngineHandler $engine, OsHandler $os, DeviceHandler $device)
    {
        $engineVersion = (int) $engine->getCapability('renderingengine_version')->getVersion(
            Version::MAJORONLY
        );
        
        $browserVersion  = $this->getCapability('mobile_browser_version');
        $detectedVersion = $browserVersion->getVersion(Version::MAJORONLY);
        
        switch ($engineVersion) {
            case 4:
                if ($this->_utils->checkIfContains('Trident/4.0')
                    && 8 > $detectedVersion
                ) {
                    $browserVersion->setVersion('8.0');
                    
                    $this->setCapability(
                        'mobile_browser_modus', 
                        'IE ' . $detectedVersion . ' Compatibility Mode'
                    );
                }
                
                if (8 == $detectedVersion) {
                    $engine->setCapability('image_inlining', true);
                }
                break;
            case 5:
                if (9 > $detectedVersion) {
                    $browserVersion->setVersion('9.0');
                    
                    $this->setCapability(
                        'mobile_browser_modus', 
                        'IE ' . $detectedVersion . ' Compatibility Mode'
                    );
                }
                break;
            case 6:
                if (10 > $detectedVersion) {
                    $browserVersion->setVersion('10.0');
                    
                    $this->setCapability(
                        'mobile_browser_modus', 
                        'IE ' . $detectedVersion . ' Compatibility Mode'
                    );
                }
                break;
            case 7:
                if (11 > $detectedVersion) {
                    $browserVersion->setVersion('11.0');
                    
                    $this->setCapability(
                        'mobile_browser_modus', 
                        'IE ' . $detectedVersion . ' Compatibility Mode'
                    );
                }
                break;
            default:
                //nothing to do
                break;
        }

        if (7 == $detectedVersion) {
            $engine->setCapability('css_spriting', true);
        }
        
        parent::detectDependProperties($engine, $os, $device);
        
        $engineVersion = (float)$engine->getCapability('renderingengine_version')->getVersion(
            Version::MAJORMINOR
        );
        
        if ($engineVersion >= 5.0) {
            $engine->setCapability('image_inlining', true);
            $engine->setCapability('css_spriting', true);
        }
        
        return $this;
    }
}