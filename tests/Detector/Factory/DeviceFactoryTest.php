<?php

namespace BrowserDetectorTest\Detector\Factory;

use BrowserDetector\Detector\Factory\DeviceFactory;

/**
 * Test class for \BrowserDetector\Detector\Device\Mobile\GeneralMobile
 */
class DeviceFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerDetect
     *
     * @param string $agent
     * @param string $deviceName
     * @param string $marketingName
     * @param string $manufacturer
     * @param string $brand
     */
    public function testDetect($agent, $deviceName, $marketingName, $manufacturer, $brand)
    {
        /** @var \UaResult\Device\DeviceInterface $result */
        $result = DeviceFactory::detect($agent);

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
            $result->getManufacturer(),
            'Expected manufacturer name to be "' . $manufacturer . '" (was "' . $result->getManufacturer() . '")'
        );
        self::assertSame(
            $brand,
            $result->getBrand(),
            'Expected brand name to be "' . $brand . '" (was "' . $result->getBrand() . '")'
        );

        self::assertInternalType('string', $result->getManufacturer());
    }

    /**
     * @return array[]
     */
    public function providerDetect()
    {
        return [
            [
                'Dalvik/1.6.0 (Linux; U; Android 4.4.4; MI PAD MIUI/5.11.1)',
                'Mi Pad',
                'Mi Pad',
                'Xiaomi Tech',
                'Xiaomi',
            ],
            [
                'Dalvik/2.1.0 (Linux; U; Android 6.0.1; MI 4LTE MIUI/V7.3.2.0.MXDCNDD) NewsArticle/5.1.3',
                'Mi 4 LTE',
                'Mi 4 LTE',
                'Xiaomi Tech',
                'Xiaomi',
            ],
            [
                'Mozilla/4.0 (compatible; MSIE 4.01; Windows CE; PPC; 240x320; SPV M700; OpVer 19.123.2.733) OrangeBot-Mobile 2008.0 (mobilesearch.support@orange-ftgroup.com)',
                'M700',
                'M700',
                'SPV',
                'SPV',
            ],
            [
                'Mozilla/4.0 (compatible; MSIE 6.0; Windows 95; PalmSource; Blazer 3.0) 16; 160x160',
                'Blazer',
                'Blazer',
                'Palm',
                'Palm',
            ],
            [
                'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; Sprint:PPC-6700) Opera 8.65 [en]',
                '6700',
                '6700',
                'Sprint',
                'Sprint',
            ],
            [
                'Mozilla/5.0 (Macintosh; ARM Mac OS X) AppleWebKit/538.15 (KHTML, like Gecko) Safari/538.15 Version/6.0 Raspbian/8.0 (1:3.8.2.0-0rpi27rpi1g) Epiphany/3.8.2',
                'Raspberry Pi',
                'Raspberry Pi',
                'Raspberry Pi Foundation',
                'Raspberry Pi Foundation',
            ],
            [
                'TIANYU-KTOUCH/A930/Screen-240X320',
                'Tianyu A930',
                'Tianyu A930',
                'K-Touch',
                'K-Touch',
            ],
            [
                'Lemon B556',
                'B556',
                'B556',
                'Lemon',
                'Lemon',
            ],
            [
                'LAVA Spark284/MIDP-2.0 Configuration/CLDC-1.1/Screen-240x320',
                'Spark 284',
                'Spark 284',
                'Lava',
                'Lava',
            ],
            [
                'Spice QT-75',
                'QT-75',
                'QT-75',
                'Spice',
                'Spice',
            ],
            [
                'KKT20/MIDP-2.0 Configuration/CLDC-1.1/Screen-240x320',
                'KKT20',
                'KKT20',
                'Lava',
                'Lava',
            ],
            [
                'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11) Sprint:MotoQ9c',
                'Q9c',
                'Q9c',
                'Motorola',
                'Motorola',
            ],
            [
                'Mozilla/5.0 (Linux; U; en-us; Velocitymicro/T408) AppleWebKit/530.17(KHTML, like Gecko) Version/4.0Safari/530.17',
                'Cruz',
                'T408',
                'Velocity Micro',
                'Velocity Micro',
            ],
            [
                'SAMSUNG-GT-C3312R Opera/9.80 (X11; Linux zvav; U; en) Presto/2.12.423 Version/12.16',
                'GT-C3312R',
                'GT-C3312R',
                'Samsung',
                'Samsung',
            ],
            [
                'Opera/9.80 (Linux armv6l; U; NETRANGEMMH;HbbTV/1.1.1;CE-HTML/1.0;THOMSON LF1V401; en) Presto/2.10.250 Version/11.60',
                'LF1V401',
                'LF1V401',
                'Thomson',
                'Thomson',
            ],
            [
                'Opera/9.80 (Linux armv6l; U; NETRANGEMMH;HbbTV/1.1.1;CE-HTML/1.0;THOMSON LF1V394; en) Presto/2.10.250 Version/11.60',
                'LF1V394',
                'LF1V394',
                'Thomson',
                'Thomson',
            ],
            [
                'Opera/9.80 (Linux armv6l; U; NETRANGEMMH;HbbTV/1.1.1;CE-HTML/1.0;THOM LF1V373; en) Presto/2.10.250 Version/11.60',
                'LF1V373',
                'LF1V373',
                'Thomson',
                'Thomson',
            ],
            [
                'Opera/9.80 (Linux armv7l; U; NETRANGEMMH;HbbTV/1.1.1;CE-HTML/1.0;Vendor/THOMSON;SW-Version/V8-MT51F01-LF1V325;Cnt/HRV;Lan/swe; NETRANGEMMH;HbbTV/1.1.1;CE-HTML/1.0) Presto/2.12.362 Version/12.11',
                'LF1V325',
                'LF1V325',
                'Thomson',
                'Thomson',
            ],
            [
                'Opera/9.80 (Linux armv7l; U; NETRANGEMMH;HbbTV/1.1.1;CE-HTML/1.0;Vendor/THOM;SW-Version/V8-MT51F01-LF1V307;Cnt/DEU;Lan/bul) Presto/2.12.362 Version/12.11',
                'LF1V307',
                'LF1V307',
                'Thomson',
                'Thomson',
            ],
            [
                'AppleCoreMedia/1.0.0.12F69 (Apple TV; U; CPU OS 8_3 like Mac OS X; en_us)',
                'AppleTV',
                'AppleTV',
                'Apple Inc',
                'Apple',
            ],
            [
                'SYM.S200.SYM.T63.DEWAV60A_64_11B_HW (MRE/3.1.00(1280);MAUI/_DY33891_Symphony_L102;BDATE/2014/04/18 14:22;LCD/240320;CHIP/MT6260;KEY/Normal;TOUCH/0;CAMERA/1;SENSOR/0;DEV/DEWAV60A_64_11B_HW;WAP Browser/MAUI (HTTP PGDL;HTTPS);GMOBI/001;MBOUNCE/002;MOMAGIC/003;INDEX/004;SPICEI2I/005;GAMELOFT/006;) Y3389_DY33891_Symphony_L102 Release/2014.04.18 WAP Browser/MAUI (HTTP PGDL; HTTPS) Profile/  Q03C1-2.40 en-US',
                'I2I',
                'I2I',
                'Spice',
                'Spice',
            ],
            [
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; HD7 T9292)',
                'T9292',
                'HD7',
                'HTC',
                'HTC',
            ],
            [
                'Mozilla/5.0 (Series40; NokiaC2-03/06.96; Profile/MIDP-2.1 Configuration/CLDC-1.1) Gecko/20100401 S40OviBrowser/5.0.0.0.31',
                'C2-03',
                'C2',
                'Nokia',
                'Nokia',
            ],
            [
                'Nokia205/2.0 (03.19) Profile/MIDP-2.1 Configuration/CLDC-1.1 UCWEB/2.0 (Java; U; MIDP-2.0; en-US; Nokia205) U2/1.0.0 UCBrowser/9.5.0.449 U2/1.0.0 Mobile',
                'Asha 205',
                'Asha 205',
                'Nokia',
                'Nokia',
            ],
            [
                'Nokia311/5.0 (03.81) Profile/MIDP-2.1 Configuration/CLDC-1.1 UCWEB/2.0 (Java; U; MIDP-2.0; en-US; Nokia311) U2/1.0.0 UCBrowser/9.5.0.449 U2/1.0.0 Mobile',
                '311',
                'Asha 311',
                'Nokia',
                'Nokia',
            ],
            [
                'NokiaX2-01/5.0 (08.71) Profile/MIDP-2.1 Configuration/CLDC-1.1 UCWEB/2.0 (Java; U; MIDP-2.0; en-US; NokiaX2-01) U2/1.0.0 UCBrowser/9.4.1.377 U2/1.0.0 Mobile',
                'X2-01',
                'X2',
                'Nokia',
                'Nokia',
            ],
            [
                'Nokia110/2.0 (03.47) Profile/MIDP-2.1 Configuration/CLDC-1.1 UCWEB/2.0 (Java; U; MIDP-2.0; en-US; Nokia110) U2/1.0.0 UCBrowser/9.5.0.449 U2/1.0.0 Mobile',
                '110',
                '110',
                'Nokia',
                'Nokia',
            ],
            [
                'NokiaC2-03/2.0 (07.63) Profile/MIDP-2.1 Configuration/CLDC-1.1 UCWEB/2.0 (Java; U; MIDP-2.0; en-US; NokiaC2-03) U2/1.0.0 UCBrowser/9.5.0.449 U2/1.0.0 Mobile',
                'C2-03',
                'C2',
                'Nokia',
                'Nokia',
            ],
            [
                'Nokia206/2.0 (04.52) Profile/MIDP-2.1 Configuration/CLDC-1.1 UCWEB/2.0 (Java; U; MIDP-2.0; en-US; Nokia206) U2/1.0.0 UCBrowser/9.5.0.449 U2/1.0.0 Mobile',
                'Asha 206',
                'Asha 206',
                'Nokia',
                'Nokia',
            ],
            [
                'Nokia200/2.0 (12.04) Profile/MIDP-2.1 Configuration/CLDC-1.1 UCWEB/2.0 (Java; U; MIDP-2.0; en-US; Nokia200) U2/1.0.0 UCBrowser/9.5.0.449 U2/1.0.0 Mobile',
                'Asha 200',
                'Asha 200',
                'Nokia',
                'Nokia',
            ],
            [
                'NokiaX2-02/2.0 (11.57) Profile/MIDP-2.1 Configuration/CLDC-1.1 UCWEB/2.0 (Java; U; MIDP-2.0; en-US; NokiaX2-02) U2/1.0.0 UCBrowser/9.5.0.449 U2/1.0.0 Mobile',
                'X2-02',
                'X2',
                'Nokia',
                'Nokia',
            ],
            [
                'Nokia308/2.0 (05.80) Profile/MIDP-2.1 Configuration/CLDC-1.1 UCWEB/2.0 (Java; U; MIDP-2.0; en-US; Nokia308) U2/1.0.0 UCBrowser/9.5.0.449 U2/1.0.0 Mobile',
                '308',
                '308',
                'Nokia',
                'Nokia',
            ],
            [
                'Nokia305/2.0 (07.42) Profile/MIDP-2.1 Configuration/CLDC-1.1 UCWEB/2.0 (Java; U; MIDP-2.0; en-US; Nokia305) U2/1.0.0 UCBrowser/9.5.0.449 U2/1.0.0 Mobile',
                '305',
                '305',
                'Nokia',
                'Nokia',
            ],
            [
                'NokiaC1-01/2.0 (03.35) Profile/MIDP-2.1 Configuration/CLDC-1.1 nokiac1-01/UC Browser7.6.1.82/69/351 UNTRUSTED/1.0',
                'C1-01',
                'C1',
                'Nokia',
                'Nokia',
            ],
            [
                'Mozilla/5.0 (Symbian/3; Series60/5.3 Nokia500/111.021.0028; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/535.1 (KHTML, like Gecko) NokiaBrowser/8.3.1.4 Mobile Safari/535.1 3gpp-gba',
                '500',
                '500',
                'Nokia',
                'Nokia',
            ],
            [
                'Mozilla/5.0 (Series30Plus; Nokia220/10.03.11; Profile/Series30Plus Configuration/Series30Plus) Gecko/20100401 S40OviBrowser/3.8.1.0.5',
                '220',
                'Asha 220',
                'Nokia',
                'Nokia',
            ],
            [
                'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 650) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586',
                'Lumia 650',
                'Lumia 650',
                'Microsoft Corporation',
                'Microsoft',
            ],
            [
                'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 535) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586',
                'Lumia 535',
                'Lumia 535',
                'Microsoft Corporation',
                'Microsoft',
            ],
            [
                'Mozilla/5.0 (Windows NT 6.2; ARM; Trident/7.0; Touch; rv:11.0; WPDesktop; Lumia 640 LTE) like Gecko',
                'Lumia 640 LTE',
                'Lumia 640 LTE',
                'Microsoft Corporation',
                'Microsoft',
            ],
            [
                'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 540 Dual SIM) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586',
                'Lumia 540',
                'Lumia 540',
                'Microsoft Corporation',
                'Microsoft',
            ],
            [
                'UCWEB/2.0 (Java; U; MIDP-2.0; Nokia203/20.37) U2/1.0.0 UCBrowser/8.7.0.218 U2/1.0.0 Mobile',
                'Asha 203',
                'Asha 203',
                'Nokia',
                'Nokia',
            ],
            [
                'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Xbox; Xbox One) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586',
                'Xbox One',
                'Xbox One',
                'Microsoft Corporation',
                'Microsoft',
            ],
            [
                'Nokia6120c/3.83; Profile/MIDP-2.0 Configuration/CLDC-1.1 Google',
                '6120c',
                '6120 Classic',
                'Nokia',
                'Nokia',
            ],
            [
                'Mozilla/5.0 (Windows Phone 8.1; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; ARCHOS; 40 Cesium) like Gecko',
                '40 Cesium',
                '40 Cesium',
                'Archos',
                'Archos',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.2; MediPaD Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Safari/537.36',
                'MediPaD',
                'MediPaD',
                'BEWATEC Kommunikationstechnik GmbH',
                'BEWATEC',
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; Lenovo_S856) U2/1.0.0 UCBrowser/9.7.0.520 Mobile',
                'S856',
                'S856',
                'Lenovo',
                'Lenovo',
            ],
            [
                'Mozilla/5.0 (Windows Phone 8.1; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; BLU; WIN HD LTE; BLU 000-33) like Gecko',
                'Win HD LTE',
                'Win HD LTE',
                'BLU',
                'BLU',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.2.2; de-de; AQIPAD_7G Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'Aqiston Aqipad 7G',
                'Aqiston Aqipad 7G',
                'TechniSat',
                'TechniSat',
            ],
            [
                'UCWEB/2.0 (Windows; U; wds 8.10; de-DE; NOKIA; RM-974_1080) U2/1.0.0 UCBrowser/4.2.1.541 U2/1.0.0 Mobile',
                'RM-974',
                'Lumia 635 International',
                'Nokia',
                'Nokia',
            ],
            [
                'Mozilla/4.0 (compatible; MSIE 4.01; Windows CE; PPC; MDA Compact/1.1 Profile/MIDP-2.0 Configuration/CLDC-1.1)',
                'MDA Compact',
                'MDA Compact',
                'T-Mobile',
                'T-Mobile',
            ],
            [
                'MOT-E1000/80.28.08I MIB/2.2.1 Profile/MIDP-2.0 Configuration/CLDC-1.1',
                'E1000',
                'E1000',
                'Motorola',
                'Motorola',
            ],
            [
                'SonyEricssonCK15i/R3AE017 TelecaBrowser/Q07C1-1 Profile/MIDP-2.0 Configuration/CLDC-1.1',
                'CK15i',
                'CK15i',
                'SonyEricsson',
                'SonyEricsson',
            ],
            [
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; 7 Pro T7576)',
                'T7576',
                '7 Pro',
                'HTC',
                'HTC',
            ],
            [
                'Mozilla/5.0 (Nintendo WiiU) AppleWebKit/536.30 (KHTML, like Gecko) NX/3.0.4.2.12 NintendoBrowser/4.3.1.11264.EU',
                'WiiU',
                'WiiU',
                'Nintendo',
                'Nintendo',
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; MT27i Build/6.1.1.B.1.54) U2/1.0.0 UCBrowser/10.6.0.706 Mobile',
                'MT27i',
                'Xperia Sola',
                'SonyEricsson',
                'SonyEricsson',
            ],
            [
                'UCWEB/2.0(Linux; U; Opera Mini/7.1.32052/30.3697; en-US; Cynus T1 Build/IMM76D) U2/1.0.0 UCBrowser/10.6.2.599 Mobile',
                'Cynus T1',
                'Cynus T1',
                'Mobistel',
                'Elson',
            ],
            [
                'SAMSUNG-GT-C3350/C3350MBULF1 NetFront/4.2 Profile/MIDP-2.0 Configuration/CLDC-1.1',
                'GT-C3350',
                'GT-C3350',
                'Samsung',
                'Samsung',
            ],
            [
                'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; BLU; WIN JR LTE; BLU 000-33) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537',
                'Win JR LTE',
                'Win JR LTE',
                'BLU',
                'BLU',
            ],
            [
                'UCWEB/2.0 (Windows; U; wds 8.10; de-DE; NOKIA; RM-1045_1012) U2/1.0.0 UCBrowser/4.2.1.541 U2/1.0.0 Mobile',
                'RM-1045',
                'Lumia 930 International',
                'Nokia',
                'Nokia',
            ],
            [
                'HTC_HD2_T8585/480x800 4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 8.12; MSIEMobile 6.0)',
                'T8585',
                'HD2',
                'HTC',
                'HTC',
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; SM-A500F Build/LRX22G) U2/1.0.0 UCBrowser/10.6.8.732 Mobile',
                'SM-A500F',
                'Galaxy A5',
                'Samsung',
                'Samsung',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.0.2; SM-A500FU Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.133 Mobile Safari/537.36',
                'SM-A500FU',
                'Galaxy A5 (Europe)',
                'Samsung',
                'Samsung',
            ],
            [
                'Opera/9.80 (Linux armv7l; LOEWE-SL32x/2.2.13.0 HbbTV/1.1.1 (; LOEWE; SL32x; LOH/2.2.13.0;;) CE-HTML/1.0 Config(L:deu,CC:DEU) NETRANGEMMH) Presto/2.12.407 Version/12.51',
                'SL32x',
                'SL32x',
                'Loewe',
                'Loewe',
            ],
            [
                'UCWEB/2.0(Linux; U; Opera Mini/7.1.32052/30.3697; en-US; HM NOTE 1S Build/KTU84P) U2/1.0.0 UCBrowser/10.5.2.582 Mobile',
                'HM NOTE 1S',
                'HM NOTE 1S',
                'Xiaomi Tech',
                'Xiaomi',
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; Redmi_Note_3) U2/1.0.0 UCBrowser/9.7.0.520 Mobile',
                'Redmi Note 3',
                'Redmi Note 3',
                'Xiaomi Tech',
                'Xiaomi',
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; G-TiDE E77 Build/JDQ39) U2/1.0.0 UCBrowser/10.7.0.733 Mobile',
                'E77',
                'E77',
                'G-Tide',
                'G-Tide',
            ],
            [
                'Opera/9.80 (Linux mips; ) Presto/2.12.407 Version/12.51 MB97/0.0.39.10 (ALDINORD, Mxl661L32, wireless) VSTVB_MB97',
                'Smart TV',
                'Smart TV',
                'Samsung',
                'Samsung',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.2.1; en-US; One Build/MIUI 4.8.29) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/10.8.8.730 U3/0.8.0 Mobile Safari/534.30',
                'M7',
                'One',
                'HTC',
                'HTC',
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; GT-N7100) U2/1.0.0 UCBrowser/10.1.2.571 Mobile',
                'GT-N7100',
                'Galaxy Note II',
                'Samsung',
                'Samsung',
            ],
            [
                'Mozilla/5.0 (Nintendo 3DS; U; ; de) Version/1.7610.EU',
                '3DS',
                '3DS',
                'Nintendo',
                'Nintendo',
            ],
            [
                'BlackBerry9000/4.6.0.126 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/285',
                'BlackBerry 9000',
                'Bold',
                'RIM',
                'RIM',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.3.1; de-de; Xperia T Build/JLS36I) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30 CyanogenMod/10.2.0/mint',
                'LT30p',
                'Xperia T',
                'Sony',
                'Sony',
            ],
            [
                'BlackBerry9700/5.0.0.321 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/604',
                'BlackBerry 9700',
                'BlackBerry 9700',
                'RIM',
                'RIM',
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; GT-I9001) U2/1.0.0 UCBrowser/9.8.0.534 Mobile',
                'GT-I9001',
                'GT-I9001',
                'Samsung',
                'Samsung',
            ],
            [
                'Mozilla/5.0 (Mobile; OneTouch6015X SVN:01010B MMS:1.1; rv:32.0) Gecko/32.0 Firefox/32.0',
                'OT-6015X',
                'OT-6015X',
                'Alcatel',
                'Alcatel',
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; HUAWEI G510-0100 Build/HuaweiG510-0100) U2/1.0.0 UCBrowser/10.1.5.583 Mobile',
                'G510-0100',
                'G510-0100',
                'Huawei',
                'Huawei',
            ],
            [
                'Mozilla/5.0 (SAMSUNG; SAMSUNG-GT-S8530-VODAFONE/S8530BUJL1; U; Bada/1.2; de-de) AppleWebKit/533.1 (KHTML, like Gecko) Dolfin/2.2 Mobile WVGA SMM-MMS/1.2.0 NexPlayer/3.0 profile/MIDP-2.1 configuration/CLDC-1.1 OPN-B',
                'GT-S8530',
                'GT-S8530',
                'Samsung',
                'Samsung',
            ],
            [
                'UCWEB/2.0(Linux; U; Opera Mini/7.1.32052/30.3697; en-US; PadFone 2 Build/JRO03L) U2/1.0.0 UCBrowser/10.7.0.636 Mobile',
                'PadFone 2',
                'PadFone 2',
                'Asus',
                'Asus',
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; GT-S6312 Build/JZO54K) U2/1.0.0 UCBrowser/10.2.0.584 Mobile',
                'GT-S6312',
                'GT-S6312',
                'Samsung',
                'Samsung',
            ],
            [
                'Mozilla/5.0 (Windows NT 6.2; ARM; Trident/7.0; Touch; rv:11.0; WPDesktop; WP 4.7; TrekStor) like Gecko',
                'WinPhone 4.7 HD',
                'WinPhone 4.7 HD',
                'TrekStor',
                'TrekStor',
            ],
            [
                'UCWEB/2.0(Linux; U; Opera Mini/7.1.32052/30.3697; en-US; Nexus 7 Build/LMY47V) U2/1.0.0 UCBrowser/10.6.2.599 Mobile',
                'Nexus 7',
                'Nexus 7',
                'Asus',
                'Asus',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.3; de-de; TechniPhone 5 Build/JLS36C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'TechniPhone 5',
                'TechniPhone 5',
                'TechniSat',
                'TechniSat',
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; Nexus 4 Build/LMY48T) U2/1.0.0 UCBrowser/10.5.0.668 Mobile',
                'Nexus 4',
                'Nexus 4',
                'LG',
                'LG',
            ],
        ];
    }
}
