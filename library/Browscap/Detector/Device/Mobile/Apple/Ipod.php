<?php
namespace Browscap\Detector\Device\Mobile\Apple;

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
final class Ipod
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
            'wurflKey' => 'apple_ipod_touch_ver5', // not in wurfl
            
            // kind of device
            'device_type' => new DeviceType\MobileDevice(), // not in wurfl
            
            // device
            'model_name'                => 'iPod Touch',
            'model_version'             => null, // not in wurfl
            'manufacturer_name' => new Company\Apple(),
            'brand_name' => new Company\Apple(),
            'model_extra_info'          => null,
            'marketing_name'            => 'iPod Touch',
            'has_qwerty_keyboard'       => true,
            'pointing_method'           => 'touchscreen',
            'device_bits'               => null, // not in wurfl
            'device_cpu'                => null, // not in wurfl
            
            // product info
            'can_assign_phone_number'   => false,
            'ununiqueness_handler'      => null,
            'uaprof'                    => null,
            'uaprof2'                   => null,
            'uaprof3'                   => null,
            'unique'                    => true,
            
            // display
            'physical_screen_width'  => 50,
            'physical_screen_height' => 74,
            'columns'                => 20,
            'rows'                   => 20,
            'max_image_width'        => 320,
            'max_image_height'       => 360,
            'resolution_width'       => 320, // wurflkey: apple_ipod_touch_ver5
            'resolution_height'      => 480, // wurflkey: apple_ipod_touch_ver5
            'dual_orientation'       => true,
            'colors'                 => 65536,
            
            // sms
            'sms_enabled' => false,
            
            // chips
            'nfc_support' => false,
        );
    }
    
    /**
     * checks if this device is able to handle the useragent
     *
     * @return boolean returns TRUE, if this device can handle the useragent
     */
    public function canHandle()
    {
        if (!$this->utils->checkIfContains('iPod')) {
            return false;
        }
        
        return true;
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
     * gets the weight of the handler, which is used for sorting
     *
     * @return integer
     */
    public function getWeight()
    {
        return 381078;
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
            new \Browscap\Detector\Browser\Mobile\Safari(),
            new \Browscap\Detector\Browser\Mobile\Chrome(),
            new \Browscap\Detector\Browser\Mobile\OperaMobile(),
            new \Browscap\Detector\Browser\Mobile\OperaMini(),
            new \Browscap\Detector\Browser\Mobile\OnePassword()
            //new \Browscap\Detector\Os\FreeBsd()
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
        $os = array(
            new \Browscap\Detector\Os\Ios(),
            //new \Browscap\Detector\Os\FreeBsd()
        );
        
        $chain = new \Browscap\Detector\Chain();
        $chain->setDefaultHandler(new \Browscap\Detector\Os\Unknown());
        $chain->setUseragent($this->_useragent);
        $chain->setHandlers($os);
        
        return $chain->detect();
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
        $osVersion = $os->getCapability('device_os_version')->getVersion(
            Version::MAJORONLY
        );
        
        if (6 <= $osVersion) {
            $this->setCapability('resolution_width', 640);
            $this->setCapability('resolution_height', 960);
        }
        
        $osVersion = $os->getCapability('device_os_version')->getVersion(
            Version::MAJORMINOR
        );
        
        $this->setCapability('model_extra_info', $osVersion);
        
        parent::detectDependProperties($browser, $engine, $os);
        
        $engine->setCapability('accept_third_party_cookie', false);
        $engine->setCapability('xhtml_make_phone_call_string', 'none');
        $engine->setCapability('xhtml_send_sms_string', 'none');
        $browser->setCapability('pdf_support', false);
        $engine->setCapability('css_gradient', 'none');
        $engine->setCapability('supports_java_applets', true);
        
        if (6.0 <= (float) $osVersion) {
            $this->setCapability('wurflKey', 'apple_ipod_touch_ver6');
        }
        
        $osVersion = $os->getCapability('device_os_version')->getVersion();
        
        switch ($osVersion) {
            case '4.2.1':
                $this->setCapability('wurflKey', 'apple_ipod_touch_ver4_2_1_subua');
                break;
            case '4.3.5':
                $this->setCapability('wurflKey', 'apple_ipod_touch_ver4_3_5');
                break;
            default:
                // nothing to do here
                break;
        }
        if ('4.2.1' == $osVersion) {
            
        }
        
        return $this;
    }
}