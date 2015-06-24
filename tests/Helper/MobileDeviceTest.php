<?php
namespace BrowserDetectorTest\Helper;

use BrowserDetector\Helper\FirefoxOs;
use BrowserDetector\Helper\MobileDevice;

/**
 * Test class for KreditCore_Class_BrowserDetector.
 * Generated by PHPUnit on 2010-09-05 at 22:13:26.
 */
class MobileDeviceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \BrowserDetector\Helper\MobileDevice
     */
    private $object = null;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->object = new MobileDevice();
    }

    /**
     * @dataProvider providerIsMobile
     *
     * @param string $agent
     */
    public function testIsMobile($agent)
    {
        $this->object->setUserAgent($agent);

        self::assertTrue($this->object->isMobile());
    }

    public function providerIsMobile()
    {
        return array(
            array('Mozilla/5.0 (Mobile; ALCATELOneTouch4012X/SVN 01010B; rv:18.1) Gecko/18.1 Firefox/18.1'),
        );
    }

    /**
     * @dataProvider providerIsNotMobile
     * @param string $agent
     */
    public function testIsNotMobile($agent)
    {
        $this->object->setUserAgent($agent);

        self::assertFalse($this->object->isMobile());
    }

    public function providerIsNotMobile()
    {
        return array(
            array('Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) MxNitro/1.0.0.2000 Chrome/35.0.1849.0 Safari/537.36'),
        );
    }
}
