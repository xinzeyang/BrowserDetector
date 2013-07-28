<?php
namespace Browscap\Detector\Device\Mobile\Acer;

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

use \Browscap\Detector\DeviceHandler;
use \Browscap\Helper\Utils;
use \Browscap\Detector\MatcherInterface;
use \Browscap\Detector\MatcherInterface\DeviceInterface;
use \Browscap\Detector\BrowserHandler;
use \Browscap\Detector\EngineHandler;
use \Browscap\Detector\OsHandler;
use \Browscap\Detector\Version;
use \Browscap\Detector\Company;
use \Browscap\Detector\Type\Device as DeviceType;

/**
 * @category  Browscap
 * @package   Browscap
 * @copyright Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @license   http://opensource.org/licenses/BSD-3-Clause New BSD License
 * @version   SVN: $Id$
 */
final class AcerIconiaA700
    extends DeviceHandler
    implements MatcherInterface, DeviceInterface
{
    /**
     * the detected browser properties
     *
     * @var array
     */
    protected $properties = array();
    
    /**
     * Class Constructor
     *
     * @return DeviceHandler
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->properties = array(
            'wurflKey' => 'acer_iconia_tab_a700_ver1', // not in wurfl
            
            // kind of device
            'device_type' => new DeviceType\Tablet(), // not in wurfl
            
            // device
            'model_name'                => 'A700',
            'model_version'             => null, // not in wurfl
            'manufacturer_name' => new Company\Acer(),
            'brand_name' => new Company\Acer(),
            'model_extra_info'          => null,
            'marketing_name'            => 'Iconia Tab A700',
            'has_qwerty_keyboard'       => true,
            'pointing_method'           => 'touchscreen',
            'device_bits'               => null, // not in wurfl
            'device_cpu'                => null, // not in wurfl
            
            // product info
            'can_assign_phone_number'   => true,
            'ununiqueness_handler'      => null,
            'uaprof'                    => 'http://support.acer.com/UAprofile/Acer_A700_JRO03H_Profile.xml',
            'uaprof2'                   => null,
            'uaprof3'                   => null,
            'unique'                    => true,
            
            // display
            'physical_screen_width'  => 34,
            'physical_screen_height' => 50,
            'columns'                => 28,
            'rows'                   => 30,
            'max_image_width'        => 320,
            'max_image_height'       => 400,
            'resolution_width'       => 1920,
            'resolution_height'      => 1200,
            'dual_orientation'       => true,
            'colors'                 => 4294967296,
            
            // sms
            'sms_enabled' => true, // wurflkey: acer_iconia_tab_a700_ver1_suban41
            
            // chips
            'nfc_support' => true, // wurflkey: acer_iconia_tab_a700_ver1_suban41
        );
    }
    
    /**
     * checks if this device is able to handle the useragent
     *
     * @return boolean returns TRUE, if this device can handle the useragent
     */
    public function canHandle()
    {
        if (!$this->utils->checkIfContains(array('Iconia A700', 'A700'))) {
            return false;
        }
        
        return true;
    }
    
    /**
     * gets the weight of the handler, which is used for sorting
     *
     * @return integer
     */
    public function getWeight()
    {
        return 3;
    }
    
    /**
     * detects properties who are depending on the device version or the user 
     * agent
     *
     * @return DeviceHandler
     */
    protected function _parseProperties()
    {
        if ($this->utils->checkIfContains(array('Build/IMM7'))) {
            $this->setCapability(
                'uaprof',
                'http://support.acer.com/UAprofile/Acer_A700_IML74K_Profile.xml'
            );
        }
        
        return $this;
    }
    
    /**
     * detects the device name from the given user agent
     *
     * @param string $userAgent
     *
     * @return StdClass
     */
    public function detectDevice()
    {
        return $this;
    }
    
    /**
     * returns null, if the device does not have a specific Browser
     * returns the Browser Handler otherwise
     *
     * @return null|\Browscap\Os\Handler
     */
    public function detectBrowser()
    {
        $browsers = array(
            new \Browscap\Detector\Browser\Mobile\Android(),
            new \Browscap\Detector\Browser\Mobile\Chrome(),
            new \Browscap\Detector\Browser\Mobile\Dalvik()
        );
        
        $chain = new \Browscap\Detector\Chain();
        $chain->setUserAgent($this->_useragent);
        $chain->setHandlers($browsers);
        $chain->setDefaultHandler(new \Browscap\Detector\Browser\Unknown());
        
        return $chain->detect();
    }
    
    /**
     * returns null, if the device does not have a specific Operating System
     * returns the OS Handler otherwise
     *
     * @return null|\Browscap\Os\Handler
     */
    public function detectOs()
    {
        $handler = new \Browscap\Detector\Os\Android();
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
        BrowserHandler $browser, EngineHandler $engine, OsHandler $os)
    {
        parent::detectDependProperties($browser, $engine, $os);
        
        // wurflkey: acer_iconia_tab_a700_ver1_suban41
        $engine->setCapability('xhtml_send_mms_string', 'mms:');
        $engine->setCapability('xhtml_send_sms_string', 'sms:');
        $engine->setCapability('bmp', true);
        
        $osVersion = $os->getCapability('device_os_version')->getVersion(
            Version::MAJORMINOR
        );
        
        switch ($browser->getCapability('mobile_browser')) {
            case 'Android Webkit':
                switch ((float) $osVersion) {
                    case 4.1:
                        $this->setCapability('wurflKey', 'acer_iconia_tab_a700_ver1_suban41');
                        break;
                    case 2.1:
                    case 2.2:
                    case 2.3:
                    case 3.1:
                    case 3.2:
                    case 4.0:
                    case 4.2:
                    default:
                        // nothing to do here
                        break;
                }
                break;
            case 'Chrome':
                $engine->setCapability('is_sencha_touch_ok', false);
                
                switch ((float) $osVersion) {
                    case 4.0:
                        $this->setCapability('wurflKey', 'acer_iconia_tab_a700_ver1_subuachrome');
                        break;
                    case 2.1:
                    case 2.2:
                    case 2.3:
                    case 3.1:
                    case 3.2:
                    case 4.1:
                    case 4.2:
                    default:
                        // nothing to do here
                        break;
                }
                break;
            default:
                // nothing to do here
                break;
        }
        
        return $this;
    }
}