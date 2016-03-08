<?php

namespace BrowserDetectorTest\Helper;

use BrowserDetector\Helper\Linux as LinuxHelper;

/**
 * Test class for KreditCore_Class_BrowserDetector.
 * Generated by PHPUnit on 2010-09-05 at 22:13:26.
 */
class LinuxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIsLinuxPositive
     *
     * @param string $agent
     */
    public function testIsLinuxPositive($agent)
    {
        $object = new LinuxHelper($agent);

        self::assertTrue($object->isLinux());
    }

    public function providerIsLinuxPositive()
    {
        return [
            ['Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.34 (KHTML, like Gecko) Qt/4.8.2'],
        ];
    }

    /**
     * @dataProvider providerIsLinuxNegative
     *
     * @param string $agent
     */
    public function testIsLinuxNegative($agent)
    {
        $object = new LinuxHelper($agent);

        self::assertFalse($object->isLinux());
    }

    public function providerIsLinuxNegative()
    {
        return [
            ['Mozilla/5.0 (iPad; CPU OS 5_1_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B206 Safari/7534.48.3'],
            ['revolt'],
            ['Microsoft Office Excel 2013'],
            ['Mozilla/5.0 (compatible; Linux; InfegyAtlas/1.0; en-US; collection@infegy.com)'],
            ['TBD1083 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['TBDB863 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['TERRA_101 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['Microsoft Office Word 2013 (15.0.4693) Windows NT 6.2'],
            ['Microsoft Outlook Social Connector (15.0.4569) MsoStatic (15.0.4569)'],
            ['MSFrontPage/15.0'],
            ['Mozilla/5.0 (X11; U; Linux Core i7-4980HQ; de; rv:32.0; compatible; Jobboerse.com; http://www.xn--jobbrse-d1a.com) Gecko/20100401 Firefox/24.0'],
        ];
    }
}