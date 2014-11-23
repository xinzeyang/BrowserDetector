<?php
/**
 * Copyright (c) 2012-2014, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2012-2014 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace BrowserDetector\Detector\Device\Mobile\Apple;

use BrowserDetector\Detector\BrowserHandler;
use BrowserDetector\Detector\Chain;
use BrowserDetector\Detector\Company;
use BrowserDetector\Detector\DeviceHandler;
use BrowserDetector\Detector\EngineHandler;
use BrowserDetector\Detector\MatcherInterface\DeviceInterface;
use BrowserDetector\Detector\Os\Darwin;
use BrowserDetector\Detector\Os\Ios;
use BrowserDetector\Detector\Os\UnknownOs;
use BrowserDetector\Detector\OsHandler;
use BrowserDetector\Detector\Type\Device as DeviceType;
use BrowserDetector\Detector\Version;

/**
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @copyright 2012-2014 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Ipad
    extends DeviceHandler
    implements DeviceInterface
{
    /**
     * the detected browser properties
     *
     * @var array
     */
    protected $properties = array(
        'wurflKey'                => 'apple_ipad_ver1', // not in wurfl

        // device
        'model_name'              => 'iPad',
        'model_extra_info'        => null,
        'marketing_name'          => 'iPad',
        'has_qwerty_keyboard'     => true,
        'pointing_method'         => 'touchscreen',

        // product info
        'ununiqueness_handler'    => null,
        'uaprof'                  => null,
        'uaprof2'                 => null,
        'uaprof3'                 => null,
        'unique'                  => true,

        // display
        'physical_screen_width'   => 148,
        'physical_screen_height'  => 198,
        'columns'                 => 100,
        'rows'                    => 100,
        'max_image_width'         => 768,
        'max_image_height'        => 1024,
        'resolution_width'        => 1024,
        'resolution_height'       => 768,
        'dual_orientation'        => true,
        'colors'                  => 65536,

        // sms
        'sms_enabled'             => true,

        // chips
        'nfc_support'             => false, // wurflkey: apple_ipad_ver1_sub51
    );

    /**
     * checks if this device is able to handle the useragent
     *
     * @return boolean returns TRUE, if this device can handle the useragent
     */
    public function canHandle()
    {
        if (!$this->utils->checkIfContains('ipad', true)) {
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
        return 16905153;
    }

    /**
     * returns the type of the current device
     *
     * @return \BrowserDetector\Detector\Type\Device\TypeInterface
     */
    public function getDeviceType()
    {
        return new DeviceType\Tablet();
    }

    /**
     * returns the type of the current device
     *
     * @return \BrowserDetector\Detector\Company\CompanyInterface
     */
    public function getManufacturer()
    {
        return new Company\Apple();
    }

    /**
     * returns the type of the current device
     *
     * @return \BrowserDetector\Detector\Company\CompanyInterface
     */
    public function getBrand()
    {
        return new Company\Apple();
    }

    /**
     * returns null, if the device does not have a specific Operating System, returns the OS Handler otherwise
     *
     * @return \BrowserDetector\Detector\OsHandler
     */
    public function detectOs()
    {
        $os = array(
            new Ios(),
            new Darwin()
        );

        $chain = new Chain();
        $chain->setDefaultHandler(new UnknownOs());
        $chain->setUseragent($this->_useragent);
        $chain->setHandlers($os);

        return $chain->detect();
    }

    /**
     * detects properties who are depending on the browser, the rendering engine
     * or the operating system
     *
     * @param \BrowserDetector\Detector\BrowserHandler $browser
     * @param \BrowserDetector\Detector\EngineHandler  $engine
     * @param \BrowserDetector\Detector\OsHandler      $os
     *
     * @return \BrowserDetector\Detector\Device\Mobile\Apple\Ipad
     */
    public function detectDependProperties(
        BrowserHandler $browser, EngineHandler $engine, OsHandler $os
    ) {
        $osVersion = $os->detectVersion()->getVersion(
            Version::MAJORMINOR
        );

        $this->setCapability('model_extra_info', $osVersion);

        parent::detectDependProperties($browser, $engine, $os);

        $engine->setCapability('xhtml_make_phone_call_string', 'none');
        $engine->setCapability('supports_java_applets', true);

        if (3.2 == (float)$osVersion) {
            $this->setCapability('wurflKey', 'apple_ipad_ver1_subua32');
        }

        if (5.0 == (float)$osVersion) {
            $this->setCapability('wurflKey', 'apple_ipad_ver1_sub5');
        }

        if (5.1 == (float)$osVersion) {
            $this->setCapability('wurflKey', 'apple_ipad_ver1_sub51');
        }

        if (6.0 <= (float)$osVersion) {
            $this->setCapability('wurflKey', 'apple_ipad_ver1_sub6');
        }

        $osVersion = $os->detectVersion()->getVersion();

        switch ($osVersion) {
        case '3.1.3':
            // $this->setCapability('wurflKey', 'apple_iphone_ver3_1_3_subenus');
            break;
        case '3.2.2':
            $this->setCapability('wurflKey', 'apple_ipad_ver1_sub321');
            break;
        case '4.2.1':
            $this->setCapability('wurflKey', 'apple_ipad_ver1_sub421');
            break;
        case '4.3.0':
            // $this->setCapability('wurflKey', 'apple_iphone_ver4_3');
            break;
        case '4.3.1':
            // $this->setCapability('wurflKey', 'apple_iphone_ver4_3_1');
            break;
        case '4.3.2':
            $this->setCapability('wurflKey', 'apple_ipad_ver1_sub432');
            break;
        case '4.3.3':
            // $this->setCapability('wurflKey', 'apple_iphone_ver4_3_3');
            break;
        case '4.3.4':
        case '4.3.5':
            $this->setCapability('wurflKey', 'apple_ipad_ver1_sub435');
            break;
        default:
            // nothing to do here
            break;
        }

        return $this;
    }
}
