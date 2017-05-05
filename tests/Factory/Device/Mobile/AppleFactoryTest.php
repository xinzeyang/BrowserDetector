<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2017, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace BrowserDetectorTest\Factory\Device\Mobile;

use BrowserDetector\Factory\Device\Mobile\AppleFactory;
use BrowserDetector\Loader\DeviceLoader;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Stringy\Stringy;

/**
 * Test class for \BrowserDetector\Detector\Device\Mobile\GeneralMobile
 */
class AppleFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \BrowserDetector\Factory\Device\Mobile\AppleFactory
     */
    private $object = null;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $adapter      = new Local(__DIR__ . '/../../../../cache/');
        $cache        = new FilesystemCachePool(new Filesystem($adapter));
        $loader       = new DeviceLoader($cache);
        $this->object = new AppleFactory($loader);
    }

    /**
     * @dataProvider providerDetect
     *
     * @param string $agent
     * @param string $deviceName
     * @param string $marketingName
     * @param string $manufacturer
     * @param string $brand
     * @param string $deviceType
     * @param bool   $dualOrientation
     * @param string $pointingMethod
     */
    public function testDetect($agent, $deviceName, $marketingName, $manufacturer, $brand, $deviceType, $dualOrientation, $pointingMethod)
    {
        $s = new Stringy($agent);

        /** @var \UaResult\Device\DeviceInterface $result */
        list($result) = $this->object->detect($agent, $s);

        self::assertInstanceOf('\UaResult\Device\DeviceInterface', $result);

        self::assertSame(
            $deviceName,
            $result->getDeviceName(),
            'Expected device name to be "' . $deviceName . '" (was "' . $result->getDeviceName() . '")'
        );
        self::assertSame(
            $marketingName,
            $result->getMarketingName(),
            'Expected marketing name to be "' . $marketingName . '" (was "' . $result->getMarketingName() . '")'
        );
        self::assertSame(
            $manufacturer,
            $result->getManufacturer()->getName(),
            'Expected manufacturer name to be "' . $manufacturer . '" (was "' . $result->getManufacturer()->getName() . '")'
        );
        self::assertSame(
            $brand,
            $result->getBrand()->getBrandName(),
            'Expected brand name to be "' . $brand . '" (was "' . $result->getBrand()->getBrandName() . '")'
        );
        self::assertSame(
            $deviceType,
            $result->getType()->getName(),
            'Expected device type to be "' . $deviceType . '" (was "' . $result->getType()->getName() . '")'
        );
        self::assertSame(
            $dualOrientation,
            $result->getDualOrientation(),
            'Expected dual orientation to be "' . $dualOrientation . '" (was "' . $result->getDualOrientation() . '")'
        );
        self::assertSame(
            $pointingMethod,
            $result->getPointingMethod(),
            'Expected pointing method to be "' . $pointingMethod . '" (was "' . $result->getPointingMethod() . '")'
        );
    }

    /**
     * @return array[]
     */
    public function providerDetect()
    {
        return [
            [
                'this is a fake ua to trigger the fallback',
                'general Apple Device',
                'general Apple Device',
                'Apple Inc',
                'Apple',
                'Mobile Device',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (iPod; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/3A101a Safari/419.3',
                'iPod Touch',
                'iPod Touch',
                'Apple Inc',
                'Apple',
                'Mobile Device',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (iPhone; U; CPU like Mac OS X) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/4A93 Safari/419.3',
                'iPhone',
                'iPhone',
                'Apple Inc',
                'Apple',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (iPhone; CPU iPhone OS 7_1_2 like Mac OS X) AppleWebKit/537.51.2 (KHTML, like Gecko) Version/7.0 Mobile/11D257 Safari/9537.53',
                'iPhone',
                'iPhone',
                'Apple Inc',
                'Apple',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (iPad; CPU OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12F69 Safari/600.1.4',
                'iPad',
                'iPad',
                'Apple Inc',
                'Apple',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (iPod touch; CPU iPhone OS 9_3_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13E238 Safari/601.1',
                'iPod Touch',
                'iPod Touch',
                'Apple Inc',
                'Apple',
                'Mobile Device',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (X11; U; Linux x86_64; zh-TW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.114 Safari/537.36 Puffin/3.7.0IT',
                'iPad',
                'iPad',
                'Apple Inc',
                'Apple',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.114 Safari/537.36 Puffin/4.4.0IP ',
                'iPhone',
                'iPhone',
                'Apple Inc',
                'Apple',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'UCWEB/2.0 (iOS; U; iPh OS 6_1; zh-CN; iPh3,1) U2/1.0.0 UCBrowser/9.0.0.260 U2/1.0.0 Mobile',
                'iPhone',
                'iPhone',
                'Apple Inc',
                'Apple',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'iOS/6.1.6 (10B500) dataaccessd/1.0',
                'general Apple Device',
                'general Apple Device',
                'Apple Inc',
                'Apple',
                'Mobile Device',
                true,
                'touchscreen',
            ],
            [
                'MobileSafari/601.1 CFNetwork/758.0.2 Darwin/15.0.0',
                'general Apple Device',
                'general Apple Device',
                'Apple Inc',
                'Apple',
                'Mobile Device',
                true,
                'touchscreen',
            ],
            [
                'BB_Work_Connect/1.0.23217.42 CFNetwork/711.3.18 Darwin/14.0.0Mozilla/5.0 (X11; Linux x86_64; rv:41.0) Gecko/20100101 Firefox/41.0',
                'general Apple Device',
                'general Apple Device',
                'Apple Inc',
                'Apple',
                'Mobile Device',
                true,
                'touchscreen',
            ],
        ];
    }
}
