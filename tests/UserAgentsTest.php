<?php
/**
 * Copyright (c) 1998-2014 Browser Capabilities Project
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * Refer to the LICENSE file distributed with this package.
 *
 * @category   CompareTest
 *
 * @copyright  1998-2014 Browser Capabilities Project
 * @license    MIT
 */

namespace BrowserDetectorTest;

use BrowserDetector\BrowserDetector;
use Monolog\Handler\NullHandler;
use Monolog\Logger;
use UaDataMapper\InputMapper;
use WurflCache\Adapter\NullStorage;

/**
 * Class UserAgentsTest
 *
 * @category   CompareTest
 *
 * @author     Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @group      useragenttest
 */
abstract class UserAgentsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \BrowserDetector\BrowserDetector
     */
    protected $object = null;

    /**
     * @var \UaDataMapper\InputMapper
     */
    protected static $mapper = null;

    /**
     * @var string
     */
    protected $sourceDirectory = 'tests/issues/00000-browscap/';

    /**
     * This method is called before the first test of this test class is run.
     *
     * @since Method available since Release 3.4.0
     */
    public static function setUpBeforeClass()
    {
        static::$mapper = new InputMapper();
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $logger = new Logger('browser-detector-tests');
        $logger->pushHandler(new NullHandler());

        $cache        = new NullStorage();
        $this->object = new BrowserDetector($cache, $logger);
    }

    /**
     * @return array[]
     */
    public function userAgentDataProvider()
    {
        $start = microtime(true);

        echo 'starting provider ', static::class, ' ...';

        $data            = [];
        $checks          = [];

        $iterator = new \DirectoryIterator($this->sourceDirectory);

        foreach ($iterator as $file) {
            /** @var $file \SplFileInfo */
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }

            $tests = require_once $file->getPathname();

            foreach ($tests as $key => $test) {
                if (isset($data[$key])) {
                    // Test data is duplicated for key
                    continue;
                }

                if (isset($checks[$test['ua']])) {
                    // UA was added more than once
                    continue;
                }

                $data[$key]          = $test;
                $checks[$test['ua']] = $key;
            }
        }

        echo ' finished (', number_format(microtime(true) - $start, 4), ' sec., ', count($data), ' tests)', PHP_EOL;

        return $data;
    }

    /**
     * @dataProvider userAgentDataProvider
     *
     * @param string $userAgent
     * @param array  $expectedProperties
     *
     * @throws \Exception
     * @group  integration
     * @group  useragenttest
     * @group  00000
     */
    public function testUserAgents($userAgent, $expectedProperties)
    {
        $result = $this->object->getBrowser($userAgent);

        static::assertInstanceOf(
            '\UaResult\Result\Result',
            $result,
            'Expected result is not an instance of "\UaResult\Result\Result" for useragent "' . $userAgent . '"'
        );

        static::assertArrayHasKey(
            'Platform_Name',
            $expectedProperties,
            'Expected key "Platform_Name" is missing for useragent "' . $userAgent . '"'
        );

        $foundPlatform = $result->getOs();

        static::assertInstanceOf(
            '\UaResult\Os\OsInterface',
            $foundPlatform,
            'Expected platform is not an instance of "\UaResult\Os\OsInterface" for useragent "' . $userAgent . '"'
        );

        $foundDevice = $result->getDevice();

        static::assertInstanceOf(
            '\UaResult\Device\DeviceInterface',
            $foundDevice,
            'Expected result is not an instance of "\UaResult\Device\DeviceInterface" for useragent "' . $userAgent . '"'
        );

        $expectedPlatformName = $expectedProperties['Platform_Name'];
        $foundPlatformName    = $foundPlatform->getName();

        static::assertInternalType('string', $foundPlatformName);

        static::assertSame(
            $expectedPlatformName,
            $foundPlatformName,
            'Expected actual "Platform_Name" to be "' . $expectedPlatformName . '" (was "' . $foundPlatformName . '" [class: ' . get_class($foundPlatform) . '])' . ' [device class: ' . get_class($foundDevice) . '])'
        );

        static::assertArrayHasKey(
            'Platform_Maker',
            $expectedProperties,
            'Expected key "Platform_Maker" is missing for useragent "' . $userAgent . '"'
        );

        $expectedPlatformMaker = $expectedProperties['Platform_Maker'];
        $foundPlatformMaker    = $foundPlatform->getManufacturer();

        static::assertInternalType('string', $foundPlatformMaker);

        static::assertSame(
            $expectedPlatformMaker,
            $foundPlatformMaker,
            'Expected actual "Platform_Name" to be "' . $expectedPlatformMaker . '" (was "' . $foundPlatformMaker . '" [class: ' . get_class($foundPlatform) . '])' . ' [device class: ' . get_class($foundDevice) . '])'
        );

        static::assertArrayHasKey(
            'Platform_Bits',
            $expectedProperties,
            'Expected key "Platform_Bits" is missing for useragent "' . $userAgent . '"'
        );

        static::assertArrayHasKey(
            'Platform_Version',
            $expectedProperties,
            'Expected key "Platform_Version" is missing for useragent "' . $userAgent . '"'
        );
        /*
        $expectedBrowserName = $expectedProperties['Browser_Name'];
        $foundBrowserName    = $result->getBrowser()->getName();

        static::assertSame(
            $expectedBrowserName,
            $foundBrowserName,
            'Expected actual "Browser" to be "' . $expectedBrowserName . '" (was "' . $foundBrowserName . '")'
        );

        /**
        // @todo: add check for browser version
        // @todo: add check for browser modus
        $expectedBrowserType = static::$mapper->mapBrowserType($expectedProperties['Browser_Type'])->getName();
        $foundBrowserType    = $result->getBrowser()->getType()->getName();

        static::assertSame(
            $expectedBrowserType,
            $foundBrowserType,
            'Expected actual "Browser_Type" to be "' . $expectedBrowserType . '" (was "' . $foundBrowserType . '")'
        );

        $expectedBrowserMaker = $expectedProperties['Browser_Maker'];
        $foundBrowserMaker    = $result->getBrowser()->getManufacturer();

        static::assertSame(
            $expectedBrowserMaker,
            $foundBrowserMaker,
            'Expected actual "Browser_Maker" to be "' . $expectedBrowserMaker . '" (was "' . $foundBrowserMaker . '")'
        );

        // @todo: add check for browser bits

        $expectedDeviceMaker = $expectedProperties['Device_Maker'];
        $foundDeviceMaker    = $result->getDevice()->getManufacturer();

        static::assertSame(
            $expectedDeviceMaker,
            $foundDeviceMaker,
            'Expected actual "Device_Maker" to be "' . $expectedDeviceMaker . '" (was "' . $foundDeviceMaker . '")'
        );

        $expectedDeviceBrand = $expectedProperties['Device_Brand_Name'];
        $foundDeviceBrand    = $result->getDevice()->getBrand();

        static::assertSame(
            $expectedDeviceBrand,
            $foundDeviceBrand,
            'Expected actual "Device_Brand_Name" to be "' . $expectedDeviceBrand . '" (was "' . $foundDeviceBrand . '")'
        );

        $expectedDeviceCodeName = $expectedProperties['Device_Code_Name'];
        $foundDeviceCodeName    = $result->getDevice()->getDeviceName();

        static::assertSame(
            $expectedDeviceCodeName,
            $foundDeviceCodeName,
            'Expected actual "Device_Code_Name" to be "' . $expectedDeviceCodeName . '" (was "' . $foundDeviceCodeName . '")'
        );

        $expectedDeviceName = $expectedProperties['Device_Name'];
        $foundDeviceName    = $result->getDevice()->getMarketingName();

        static::assertSame(
            $expectedDeviceName,
            $foundDeviceName,
            'Expected actual "Device_Name" to be "' . $expectedDeviceName . '" (was "' . $foundDeviceName . '"'
        );
        /**/
    }
}
