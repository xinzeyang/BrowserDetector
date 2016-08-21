<?php

namespace BrowserDetectorTest\Helper;

use BrowserDetector\Helper\Desktop;

/**
 * Test class for KreditCore_Class_BrowserDetector.
 * Generated by PHPUnit on 2010-09-05 at 22:13:26.
 */
class DesktopTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIsDesktop
     *
     * @param string $agent
     */
    public function testIsDesktop($agent)
    {
        $object = new Desktop($agent);

        self::assertTrue($object->isDesktopDevice());
    }

    public function providerIsDesktop()
    {
        return [
            ['Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) MxNitro/1.0.0.2000 Chrome/35.0.1849.0 Safari/537.36'],
            ['CybEye.com/2.0 (compatible; MSIE 9.0; Windows NT 5.1; Trident/4.0; GTB6.4)'],
            ['revolt'],
            ['Microsoft Office Excel 2013'],
            ['iTunes/11.3.1 (Windows; Microsoft Windows 7 x64 Home Premium Edition Service Pack 1 (Build 7601)) AppleWebKit/537.60.17'],
            ['Mozilla/5.0 (X11; BSD Four) AppleWebKit/534.34 (KHTML, like Gecko) wkhtmltoimage Safari/534.34'],
            ['Microsoft Office Word 2013 (15.0.4693) Windows NT 6.2'],
            ['Microsoft Outlook Social Connector (15.0.4569) MsoStatic (15.0.4569)'],
            ['MSFrontPage/15.0'],
            ['Mozilla/2.0 (compatible; MS FrontPage 5.0)'],
            ['Mozilla/5.0 Gecko/20030306 Camino/0.7'],
            ['UCS (ESX) - 4.0-3 errata302 - 28d414cc-2dac-4c0e-a34a-734020b8af66 - 00000000-0000-0000-0000-000000000000 -'],
            ['TinyBrowser/2.0 (TinyBrowser Comment; rv:1.9.1a2pre) Gecko/20201231'],
            ['Apple-PubSub/65.28'],
        ];
    }

    /**
     * @dataProvider providerIsNoDesktop
     *
     * @param string $agent
     */
    public function testIsNoDesktop($agent)
    {
        $object = new Desktop($agent);

        self::assertFalse($object->isDesktopDevice());
    }

    public function providerIsNoDesktop()
    {
        return [
            ['Mozilla/5.0 (Mobile; ALCATELOneTouch4012X/SVN 01010B; rv:18.1) Gecko/18.1 Firefox/18.1'],
            ['Mozilla/5.0 (PLAYSTATION 3; 2.00)'],
            ['Microsoft Office Protocol Discovery'],
            ['Mozilla/4.0 (compatible; Powermarks/3.5; Windows 95/98/2000/NT)'],
            ['ArchiveTeam ArchiveBot/20141009.02 (wpull 0.1002a1) and not Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.101 Safari/537.36'],
            ['Crowsnest/0.5 (+http://www.crowsnest.tv/)'],
            ['Dorado WAP-Browser/1.0.0'],
            ['DINO762 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['Mozilla/5.0 (compatible; MSIE 9.0; Windows NT; MarketwireBot +http://www.marketwire.com)'],
            ['Mozilla/5.0 (DTV) AppleWebKit/531.2+ (KHTML, like Gecko) Espial/6.1.15 AQUOSBrowser/2.0 (US01DTV;V;0001;0001)'],
            ['TBD1083 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['TBDB863 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['TERRA_101 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['Mozilla/5.0 (compatible; PAD-bot/9.0; +http://www.descargarprogramagratis.com/)'],
            ['Mozilla/5.0 (Macintosh; Butterfly/1.0; +http://labs.topsy.com/butterfly/) Gecko/2009032608 Firefox/3.0.8'],
            ['Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6 - James BOT - WebCrawler http://cognitiveseo.com/bot.html'],
            ['Mozilla/4.0 (compatible; Win32; WinHttp.WinHttpRequest.5)'],
            ['Mozilla/5.0 (X11; U; Linux Core i7-4980HQ; de; rv:32.0; compatible; Jobboerse.com; http://www.xn--jobbrse-d1a.com) Gecko/20100401 Firefox/24.0'],
            ['Mozilla/5.0 (X11; U; Linux x86_64; ar-SA) AppleWebKit/534.35 (KHTML, like Gecko)  Chrome/11.0.696.65 Safari/534.35 Puffin/3.11546IP'],
            ['Lemon B556'],
            ['LAVA Spark284/MIDP-2.0 Configuration/CLDC-1.1/Screen-240x320'],
            ['Spice QT-75'],
            ['ALCATEL_TRIBE_3075A/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 ObigoInternetBrowser/Q05A'],
            ['KKT20/MIDP-2.0 Configuration/CLDC-1.1/Screen-240x320'],
            ['Microsoft-CryptoAPI/6.3'],
            ['Mozilla/5.0 (Mobile; rv:32.0) Gecko/20100101 Firefox/32.0'],
            ['Microsoft Data Access Internet Publishing Provider Protocol Discovery'],
            ['Microsoft Data Access Internet Publishing Provider Cache Manager'],
            ['Microsoft-WebDAV-MiniRedir/6.1.7601'],
        ];
    }
}
