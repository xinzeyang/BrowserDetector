<?php
/**
 * Copyright (c) 2012-2015, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
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
 *
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2012-2015 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 *
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace BrowserDetector\Detector\Device\Mobile\BlackBerry;

use BrowserDetector\Detector\Company;
use BrowserDetector\Detector\Device\AbstractDevice;
use BrowserDetector\Detector\Os\RimOs;
use UaDeviceType\MobilePhone;
use UaMatcher\Browser\BrowserInterface;
use UaMatcher\Device\DeviceHasSpecificPlatformInterface;
use UaMatcher\Device\DeviceHasWurflKeyInterface;
use UaMatcher\Engine\EngineInterface;
use UaMatcher\Os\OsInterface;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2015 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class BlackBerry9780 extends AbstractDevice implements DeviceHasWurflKeyInterface, DeviceHasSpecificPlatformInterface
{
    /**
     * the class constructor
     *
     * @param string                   $useragent
     * @param array                    $data
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        $useragent,
        array $data,
        LoggerInterface $logger = null
    ) {
        $this->useragent = $useragent;

        $this->setData(
            [
                'deviceName'        => 'general HiPhone Device',
                'marketingName'     => 'general HiPhone Device',
                'version'           => null,
                'manufacturer'      => (new Company\HiPhone())->name,
                'brand'             => (new Company\HiPhone())->brandname,
                'formFactor'        => null,
                'pointingMethod'    => 'touchscreen',
                'resolutionWidth'   => null,
                'resolutionHeight'  => null,
                'dualOrientation'   => true,
                'colors'            => null,
                'smsSupport'        => true,
                'nfcSupport'        => true,
                'hasQwertyKeyboard' => true,
                'type'              => new Tablet(),
            ]
        );

        $this->logger = $logger;
    }

    /**
     * the detected browser properties
     *
     * @var array
     */
    protected $properties = [
        // device
        'code_name'              => 'BlackBerry 9780',
        'model_extra_info'       => null,
        'marketing_name'         => 'BlackBerry 9780',
        'has_qwerty_keyboard'    => true,
        'pointing_method'        => 'trackpad',
        // product info
        'ununiqueness_handler'   => null,
        'uaprof'                 => 'http://www.blackberry.net/go/mobile/profiles/uaprof/9780_umts/6.0.0.rdf',
        'uaprof2'                => 'http://www.blackberry.net/go/mobile/profiles/uaprof/9780_gprs/6.0.0.rdf',
        'uaprof3'                => 'http://www.blackberry.net/go/mobile/profiles/uaprof/9780_edge/6.0.0.rdf',
        'unique'                 => true,
        // display
        'physical_screen_width'  => 27,
        'physical_screen_height' => 27,
        'columns'                => 48,
        'rows'                   => 24,
        'max_image_width'        => 460,
        'max_image_height'       => 348,
        'resolution_width'       => 480,
        'resolution_height'      => 360,
        'dual_orientation'       => false,
        'colors'                 => 65536,
        // sms
        'sms_enabled'            => true,
        // chips
        'nfc_support'            => true,
    ];

    /**
     * checks if this device is able to handle the useragent
     *
     * @return bool returns TRUE, if this device can handle the useragent
     */
    public function canHandle()
    {
        if (!$this->utils->checkIfContains(['BlackBerry 9780', 'BlackBerry9780', 'BlackBerry 9780'])) {
            return false;
        }

        return true;
    }

    /**
     * gets the weight of the handler, which is used for sorting
     *
     * @return int
     */
    public function getWeight()
    {
        return 3;
    }

    /**
     * returns the type of the current device
     *
     * @return \UaDeviceType\TypeInterface
     */
    public function getDeviceType()
    {
        return new MobilePhone();
    }

    /**
     * returns the type of the current device
     *
     * @return \UaMatcher\Company\CompanyInterface
     */
    public function getManufacturer()
    {
        return new Company(new Company\Rim());
    }

    /**
     * returns the type of the current device
     *
     * @return \UaMatcher\Company\CompanyInterface
     */
    public function getBrand()
    {
        return new Company(new Company\Rim());
    }

    /**
     * returns null, if the device does not have a specific Operating System, returns the OS Handler otherwise
     *
     * @return \BrowserDetector\Detector\Os\RimOs
     */
    public function detectOs()
    {
        return new RimOs($this->useragent, $this->logger);
    }

    /**
     * returns the WurflKey for the device
     *
     * @param \UaMatcher\Browser\BrowserInterface $browser
     * @param \UaMatcher\Engine\EngineInterface   $engine
     * @param \UaMatcher\Os\OsInterface           $os
     *
     * @return string|null
     */
    public function getWurflKey(BrowserInterface $browser, EngineInterface $engine, OsInterface $os)
    {
        $wurflKey = 'blackberry9780_ver1';

        return $wurflKey;
    }
}
