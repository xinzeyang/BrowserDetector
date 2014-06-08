<?php
namespace BrowserDetectorTest\Detector\Device;

use BrowserDetector\Detector\Device\GeneralDesktop;

/**
 * Test class for \BrowserDetector\Detector\Device\GeneralDesktop
 */
class GeneralDesktopTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \BrowserDetector\Detector\Device\GeneralDesktop
     */
    private $object = null;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->object = new GeneralDesktop();
    }

    /**
     * Tears down the fixture, for example, clDevicees a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->object);

        parent::tearDown();
    }

    /**
     * @dataProvider providerCanHandlePositive
     */
    public function testCanHandlePositive($agent)
    {
        $this->object->setUserAgent($agent);

        self::assertTrue($this->object->canHandle());
    }

    public function providerCanHandlePositive()
    {
        return array(
            array('Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)'),
            array('Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.9) Gecko/2008052906 Firefox/3.0'),
            array('Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)'),
            array('Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.94 Safari/537.4'),
        );
    }

    /**
     * @dataProvider providerCanHandleNegative
     */
    public function testCanHandleNegative($agent)
    {
        $this->object->setUserAgent($agent);

        self::assertFalse($this->object->canHandle());
    }

    public function providerCanHandleNegative()
    {
        return array(
            array('Mozilla/5.0 (iPad; CPU OS 5_1_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B206 Safari/7534.48.3'),
        );
    }

    /**
     * @dataProvider providerDetectDevice
     */
    public function testDetectDevice($agent, $device)
    {
        $this->object->setUserAgent($agent);

        self::assertInstanceOf($device, $this->object->detectDevice());
    }

    public function providerDetectDevice()
    {
        return array(
            array('Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)', '\BrowserDetector\Detector\Device\Desktop\WindowsDesktop'),
            array('Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.9) Gecko/2008052906 Firefox/3.0', '\BrowserDetector\Detector\Device\Desktop\WindowsDesktop'),
            array('Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)', '\BrowserDetector\Detector\Device\Desktop\WindowsDesktop'),
            array('Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.94 Safari/537.4', '\BrowserDetector\Detector\Device\Desktop\WindowsDesktop'),
        );
    }

    /**
     * tests that a integer is returned
     */
    public function testGetWeight()
    {
        self::assertInternalType('integer', $this->object->getWeight());
    }
}