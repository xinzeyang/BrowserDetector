<?php
/**
 * Copyright (c) 2012-2016, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
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
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 *
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace BrowserDetector\Detector\Device\Mobile\Samsung;

use BrowserDetector\Detector\Company;
use BrowserDetector\Detector\Device\AbstractDevice;
use BrowserDetector\Detector\Os;
use BrowserDetector\Matcher\Device\DeviceHasSpecificPlatformInterface;
use UaDeviceType;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class SamsungGtp5110 extends AbstractDevice implements DeviceHasSpecificPlatformInterface
{
    /**
     * the class constructor
     *
     * @param string $useragent
     * @param array  $data
     */
    public function __construct(
        $useragent,
        array $data
    ) {
        $this->useragent = $useragent;

        $this->setData(
            [
                'deviceName'        => 'GT-P5110',
                'marketingName'     => 'Galaxy Tab 2 10.1 WiFi',
                'version'           => null,
                'manufacturer'      => (new Company\Samsung())->name,
                'brand'             => (new Company\Samsung())->brandname,
                'formFactor'        => null,
                'pointingMethod'    => 'touchscreen',
                'resolutionWidth'   => 1280,
                'resolutionHeight'  => 800,
                'dualOrientation'   => true,
                'colors'            => 65536,
                'smsSupport'        => true,
                'nfcSupport'        => false,
                'hasQwertyKeyboard' => true,
                'type'              => new UaDeviceType\Tablet(),
            ]
        );
    }

    /**
     * returns the OS Handler
     *
     * @return \BrowserDetector\Detector\Os\AndroidOs
     */
    public function detectOs()
    {
        return new Os\AndroidOs($this->useragent, []);
    }
}
