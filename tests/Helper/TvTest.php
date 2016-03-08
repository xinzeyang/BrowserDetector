<?php

namespace BrowserDetectorTest\Helper;

use BrowserDetector\Helper\Tv;

/**
 * Test class for KreditCore_Class_BrowserDetector.
 * Generated by PHPUnit on 2010-09-05 at 22:13:26.
 */
class TvTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIsTv
     *
     * @param string $agent
     */
    public function testIsTv($agent)
    {
        $object = new Tv($agent);

        self::assertTrue($object->isTvDevice());
    }

    public function providerIsTv()
    {
        return [
            ['dlink.dsm380'],
            ['Mozilla/5.0 (DTV) AppleWebKit/531.2+ (KHTML, like Gecko) Espial/6.1.15 AQUOSBrowser/2.0 (US01DTV;V;0001;0001)'],
            ['Mozilla/5.0 (Linux; Android 4.4.2; gxt_dongle_3188 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Safari/537.36 bdbrowserhd_i18n/1.8.0.1'],
        ];
    }

    /**
     * @dataProvider providerIsNotTv
     *
     * @param string $agent
     */
    public function testIsNotTv($agent)
    {
        $object = new Tv($agent);

        self::assertFalse($object->isTvDevice());
    }

    public function providerIsNotTv()
    {
        return [
            ['Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) MxNitro/1.0.0.2000 Chrome/35.0.1849.0 Safari/537.36'],
            ['Mozilla/5.0 (Mobile; ALCATELOneTouch4012X/SVN 01010B; rv:18.1) Gecko/18.1 Firefox/18.1'],
            ['Mozilla/5.0 (PLAYSTATION 3; 2.00)'],
            ['Microsoft Office Word 2013 (15.0.4693) Windows NT 6.2'],
            ['Microsoft Outlook Social Connector (15.0.4569) MsoStatic (15.0.4569)'],
            ['Mozilla/5.0 (X11; U; Linux Core i7-4980HQ; de; rv:32.0; compatible; Jobboerse.com; http://www.xn--jobbrse-d1a.com) Gecko/20100401 Firefox/24.0'],
        ];
    }
}