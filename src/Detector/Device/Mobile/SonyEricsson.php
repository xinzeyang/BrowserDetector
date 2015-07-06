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

namespace BrowserDetector\Detector\Device\Mobile;

use BrowserDetector\Detector\Chain;
use BrowserDetector\Detector\Company;
use BrowserDetector\Detector\AbstractDevice;
use BrowserDetector\Detector\MatcherInterface\DeviceHasChildrenInterface;
use BrowserDetector\Detector\MatcherInterface\DeviceInterface;
use BrowserDetector\Detector\Os\AndroidAbstractOs;
use BrowserDetector\Detector\Os\Bada;
use BrowserDetector\Detector\Os\Brew;
use BrowserDetector\Detector\Os\Java;
use BrowserDetector\Detector\Os\Linux;
use BrowserDetector\Detector\Os\Symbianos;
use BrowserDetector\Detector\Os\UnknownAbstractOs;
use BrowserDetector\Detector\Os\WindowsMobileAbstractOs;
use BrowserDetector\Detector\Os\WindowsPhoneAbstractOs;
use BrowserDetector\Detector\Type\Device as DeviceType;

/**
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @copyright 2012-2014 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class SonyEricsson
    extends AbstractDevice
    implements DeviceInterface, DeviceHasChildrenInterface
{
    /**
     * the detected browser properties
     *
     * @var array
     */
    protected $properties = array(
        'wurflKey'               => null, // not in wurfl

        // device
        'model_name'             => 'general SonyEricsson Device',
        'model_extra_info'       => null,
        'marketing_name'         => null,
        'has_qwerty_keyboard'    => true,
        'pointing_method'        => 'touchscreen',
        // product info
        'ununiqueness_handler'   => null,
        'uaprof'                 => null,
        'uaprof2'                => null,
        'uaprof3'                => null,
        'unique'                 => true,
        // display
        'physical_screen_width'  => null,
        'physical_screen_height' => null,
        'columns'                => null,
        'rows'                   => null,
        'max_image_width'        => null,
        'max_image_height'       => null,
        'resolution_width'       => null,
        'resolution_height'      => null,
        'dual_orientation'       => null,
        'colors'                 => null,
        // sms
        'sms_enabled'            => true,
        // chips
        'nfc_support'            => true,
    );

    /**
     * checks if this device is able to handle the useragent
     *
     * @return boolean returns TRUE, if this device can handle the useragent
     */
    public function canHandle()
    {
        $sonyPhones = array(
            'sonyericsson',
            'sony',
            'c1505',
            'c1605',
            'c1905',
            'c2105',
            'c5303',
            'c6602',
            'c6603',
            'c6503',
            'c6903',
            'xperia z',
            'c6833',
            'd6503',
            'd5503',
            'd6603',
            'd5803',
            'd2303',
            'd2005',
            'e10i',
            'e15i',
            'e15av',
            'ebrd1',
            'lt15i',
            'lt18',
            'lt18i',
            'lt22i',
            'lt25i',
            'lt26i',
            'lt28h',
            'lt30p',
            'mk16i',
            'mt11i',
            'mt15i',
            'mt27i',
            'nexushd2',
            'r800i',
            's312',
            'sk17i',
            'sgp311',
            'sgp312',
            'sgp321',
            'sgp511',
            'sgp512',
            'sgp521',
            'sgpt12',
            'sgpt13',
            'st15i',
            'st16i',
            'st17i',
            'st18i',
            'st19i',
            'st20i',
            'st21i',
            'st22i',
            'st23i',
            'st24i',
            'st25i',
            'st26i',
            'st27i',
            'u20i',
            'w508a',
            'w760i',
            'wt13i',
            'wt19i',
            'x1i',
            'x10',
            'xst2',
            'playstation',
            'psp',
            'xperia arc'
        );

        if (!$this->utils->checkIfContains($sonyPhones, true)) {
            return false;
        }

        $others = array('uno_x10', 'x10.dual');

        if ($this->utils->checkIfContains($others, true)) {
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
        return 1633866;
    }

    /**
     * returns the type of the current device
     *
     * @return \BrowserDetector\Detector\Type\Device\TypeInterface
     */
    public function getDeviceType()
    {
        return new DeviceType\MobilePhone();
    }

    /**
     * returns the type of the current device
     *
     * @return \BrowserDetector\Detector\Company\CompanyInterface
     */
    public function getManufacturer()
    {
        return new Company\SonyEricsson();
    }

    /**
     * returns the type of the current device
     *
     * @return \BrowserDetector\Detector\Company\CompanyInterface
     */
    public function getBrand()
    {
        return new Company\SonyEricsson();
    }

    /**
     * returns null, if the device does not have a specific Operating System, returns the OS Handler otherwise
     *
     * @return \BrowserDetector\Detector\AbstractOs
     */
    public function detectOs()
    {
        $os = array(
            new AndroidAbstractOs(),
            new Bada(),
            new Brew(),
            new Java(),
            new Symbianos(),
            new WindowsMobileAbstractOs(),
            new WindowsPhoneAbstractOs(),
            new Linux(),
        );

        $chain = new Chain();
        $chain->setDefaultHandler(new UnknownAbstractOs());
        $chain->setUseragent($this->useragent);
        $chain->setHandlers($os);

        return $chain->detect();
    }

    /**
     * detects the device name from the given user agent
     *
     * @return \BrowserDetector\Detector\AbstractDevice
     */
    public function detectDevice()
    {
        $chain = new Chain();
        $chain->setUserAgent($this->useragent);
        $chain->setNamespace('\BrowserDetector\Detector\Device\Mobile\SonyEricsson');
        $chain->setDirectory(
            __DIR__ . DIRECTORY_SEPARATOR . 'SonyEricsson' . DIRECTORY_SEPARATOR
        );
        $chain->setDefaultHandler($this);

        return $chain->detect();
    }
}
