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
namespace BrowserDetector\Factory\Device\Mobile;

use BrowserDetector\Factory;
use BrowserDetector\Loader\LoaderInterface;
use Stringy\Stringy;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2017 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class SamsungFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'sm-g570f'        => 'samsung sm-g570f',
        'sm-g570y'        => 'samsung sm-g570y',
        'sm-j3110'        => 'samsung sm-j3110',
        'sm-j3119'        => 'samsung sm-j3119',
        'sm-j105b'        => 'samsung sm-j105b',
        'sm-j105h'        => 'samsung sm-j105h',
        'sm-g610f'        => 'samsung sm-g610f',
        'sm-g610m'        => 'samsung sm-g610m',
        'sm-g610y'        => 'samsung sm-g610y',
        'sm-g390f'        => 'samsung sm-g390f',
        'sm-g955fd'       => 'samsung sm-g955fd',
        'sm-g955f'        => 'samsung sm-g955f',
        'sm-g955u'        => 'samsung sm-g955u',
        'sm-g955w'        => 'samsung sm-g955w',
        'sm-g955a'        => 'samsung sm-g955a',
        'sm-g955p'        => 'samsung sm-g955p',
        'sm-g955t'        => 'samsung sm-g955t',
        'sm-g955v'        => 'samsung sm-g955v',
        'sm-g955r4'       => 'samsung sm-g955r4',
        'sm-g955s'        => 'samsung sm-g955s',
        'sm-g955k'        => 'samsung sm-g955k',
        'sm-g955l'        => 'samsung sm-g955l',
        'sm-g9550'        => 'samsung sm-g9550',
        'sm-g950fd'       => 'samsung sm-g950fd',
        'sm-g950f'        => 'samsung sm-g950f',
        'sm-g950u'        => 'samsung sm-g950u',
        'sm-g950a'        => 'samsung sm-g950a',
        'sm-g950p'        => 'samsung sm-g950p',
        'sm-g950t'        => 'samsung sm-g950t',
        'sm-g950v'        => 'samsung sm-g950v',
        'sm-g950r4'       => 'samsung sm-g950r4',
        'sm-g950w'        => 'samsung sm-g950w',
        'sm-g950s'        => 'samsung sm-g950s',
        'sm-g950k'        => 'samsung sm-g950k',
        'sm-g950l'        => 'samsung sm-g950l',
        'sm-g9500'        => 'samsung sm-g9500',
        'sm-t532'         => 'samsung sm-t532',
        'sm-a9000'        => 'sm-a9000',
        'sm-a810yz'       => 'samsung sm-a810yz',
        'sm-a810f'        => 'samsung sm-a810f',
        'sm-a800f'        => 'sm-a800f',
        'sm-a800y'        => 'sm-a800y',
        'sm-a800i'        => 'sm-a800i',
        'sm-a8000'        => 'sm-a8000',
        'sm-s820l'        => 'sm-s820l',
        'sm-a720f'        => 'samsung sm-a720f',
        'sm-a710m'        => 'sm-a710m',
        'sm-a710fd'       => 'sm-a710fd',
        'sm-a710f'        => 'sm-a710f',
        'sm-a7100'        => 'sm-a7100',
        'sm-a710y'        => 'sm-a710y',
        'sm-a700fd'       => 'sm-a700fd',
        'sm-a700f'        => 'sm-a700f',
        'sm-a700s'        => 'sm-a700s',
        'sm-a700k'        => 'sm-a700k',
        'sm-a700l'        => 'sm-a700l',
        'sm-a700h'        => 'sm-a700h',
        'sm-a700yd'       => 'sm-a700yd',
        'sm-a7000'        => 'sm-a7000',
        'sm-a7009'        => 'sm-a7009',
        'sm-a520f'        => 'samsung sm-a520f',
        'sm-a520k'        => 'samsung sm-a520k',
        'sm-a520l'        => 'samsung sm-a520l',
        'sm-a520s'        => 'samsung sm-a520s',
        'sm-a510fd'       => 'sm-a510fd',
        'sm-a510f'        => 'sm-a510f',
        'sm-a510m'        => 'sm-a510m',
        'sm-a510y'        => 'sm-a510y',
        'sm-a5100'        => 'sm-a5100',
        'sm-a510s'        => 'sm-a510s',
        'sm-a500fu'       => 'sm-a500fu',
        'sm-a500f'        => 'sm-a500f',
        'sm-a500h'        => 'sm-a500h',
        'sm-a500y'        => 'sm-a500y',
        'sm-a500l'        => 'sm-a500l',
        'sm-a5000'        => 'sm-a5000',
        'sm-a320fl'       => 'samsung sm-a320fl',
        'sm-a320f'        => 'samsung sm-a320f',
        'sm-a320y'        => 'samsung sm-a320y',
        'sm-a310f'        => 'sm-a310f',
        'sm-a300fu'       => 'sm-a300fu',
        'sm-a300f'        => 'sm-a300f',
        'sm-a300h'        => 'sm-a300h',
        'sm-j710fn'       => 'sm-j710fn',
        'sm-j710f'        => 'sm-j710f',
        'sm-j710m'        => 'sm-j710m',
        'sm-j710h'        => 'sm-j710h',
        'sm-j700f'        => 'sm-j700f',
        'sm-j700m'        => 'sm-j700m',
        'sm-j700h'        => 'sm-j700h',
        'sm-j510fn'       => 'sm-j510fn',
        'sm-j510f'        => 'sm-j510f',
        'sm-j500fn'       => 'sm-j500fn',
        'sm-j500f'        => 'sm-j500f',
        'sm-j500g'        => 'sm-j500g',
        'sm-j500m'        => 'sm-j500m',
        'sm-j500y'        => 'sm-j500y',
        'sm-j500h'        => 'sm-j500h',
        'sm-j5007'        => 'sm-j5007',
        'sm-j500'         => 'sm-j500',
        'galaxy j5'       => 'sm-j500',
        'sm-j320h'        => 'samsung sm-j320h',
        'sm-j320w8'       => 'samsung sm-j320w8',
        'sm-j320yz'       => 'samsung sm-j320yz',
        'sm-j320p'        => 'samsung sm-j320p',
        'sm-j320g'        => 'samsung sm-j320g',
        'sm-j320fn'       => 'samsung sm-j320fn',
        'sm-j320f'        => 'samsung sm-j320f',
        'sm-j3109'        => 'sm-j3109',
        'sm-j120a'        => 'samsung sm-j120a',
        'sm-j120fn'       => 'sm-j120fn',
        'sm-j120f'        => 'sm-j120f',
        'sm-j120g'        => 'sm-j120g',
        'sm-j120h'        => 'sm-j120h',
        'sm-j120m'        => 'sm-j120m',
        'sm-j110f'        => 'sm-j110f',
        'sm-j110g'        => 'sm-j110g',
        'sm-j110h'        => 'sm-j110h',
        'sm-j110l'        => 'sm-j110l',
        'sm-j110m'        => 'sm-j110m',
        'sm-j111f'        => 'sm-j111f',
        'sm-j105f'        => 'samsung sm-j105f',
        'sm-j100h'        => 'sm-j100h',
        'sm-j100y'        => 'sm-j100y',
        'sm-j100f'        => 'sm-j100f',
        'sm-j100ml'       => 'sm-j100ml',
        'sm-j200gu'       => 'sm-j200gu',
        'sm-j200g'        => 'sm-j200g',
        'sm-j200f'        => 'sm-j200f',
        'sm-j200h'        => 'sm-j200h',
        'sm-j200bt'       => 'sm-j200bt',
        'sm-j200y'        => 'sm-j200y',
        'sm-t285'         => 'samsung sm-t285',
        'sm-t280'         => 'sm-t280',
        'sm-t2105'        => 'sm-t2105',
        'sm-t210r'        => 'sm-t210r',
        'sm-t210l'        => 'sm-t210l',
        'sm-t210'         => 'sm-t210',
        'sm-t900'         => 'sm-t900',
        'sm-t819'         => 'sm-t819',
        'sm-t815y'        => 'sm-t815y',
        'sm-t815'         => 'sm-t815',
        'sm-t813'         => 'sm-t813',
        'sm-t810x'        => 'sm-t810x',
        'sm-t810'         => 'sm-t810',
        'sm-t805'         => 'sm-t805',
        'sm-t800'         => 'sm-t800',
        'sm-t719'         => 'sm-t719',
        'sm-t715'         => 'sm-t715',
        'sm-t713'         => 'sm-t713',
        'sm-t710'         => 'sm-t710',
        'sm-t705m'        => 'sm-t705m',
        'sm-t705'         => 'sm-t705',
        'sm-t700'         => 'sm-t700',
        'sm-t670'         => 'sm-t670',
        'sm-t585'         => 'sm-t585',
        'sm-t580'         => 'sm-t580',
        'sm-t550x'        => 'sm-t550x',
        'sm-t550'         => 'sm-t550',
        'sm-t555'         => 'sm-t555',
        'sm-t561'         => 'sm-t561',
        'sm-t560'         => 'sm-t560',
        'sm-t535'         => 'sm-t535',
        'sm-t533'         => 'sm-t533',
        'sm-t531'         => 'sm-t531',
        'sm - t531'       => 'sm-t531',
        'sm-t530nu'       => 'sm-t530nu',
        'sm-t530'         => 'sm-t530',
        'sm-t525'         => 'sm-t525',
        'sm-t520'         => 'sm-t520',
        'sm-t365'         => 'sm-t365',
        'sm-t355y'        => 'sm-t355y',
        'sm-t350'         => 'sm-t350',
        'sm-t335'         => 'sm-t335',
        'sm-t331'         => 'sm-t331',
        'sm-t330nu'       => 'samsung sm-t330nu',
        'sm-t330'         => 'sm-t330',
        'sm-t325'         => 'sm-t325',
        'sm-t320'         => 'sm-t320',
        'sm-t315'         => 'sm-t315',
        'sm-t311'         => 'sm-t311',
        'sm-t310'         => 'sm-t310',
        'sm-t235'         => 'sm-t235',
        'sm-t231'         => 'sm-t231',
        'sm-t230nu'       => 'sm-t230nu',
        'sm-t230'         => 'sm-t230',
        'sm-t211'         => 'sm-t211',
        'sm-t116nu'       => 'samsung sm-t116nu',
        'sm-t116'         => 'sm-t116',
        'sm-t113'         => 'sm-t113',
        'sm-t111'         => 'sm-t111',
        'sm-t110'         => 'sm-t110',
        'sm-p907a'        => 'sm-p907a',
        'sm-p905m'        => 'sm-p905m',
        'sm-p905v'        => 'sm-p905v',
        'sm-p905'         => 'sm-p905',
        'sm-p901'         => 'sm-p901',
        'sm-p900'         => 'sm-p900',
        'sm-c900f'        => 'samsung sm-c900f',
        'sm-c9000'        => 'samsung sm-c9000',
        'sm-g550fy'       => 'samsung sm-g550fy',
        'sm-g532g'        => 'samsung sm-g532g',
        'sm-g532m'        => 'samsung sm-g532m',
        'sm-g485f'        => 'samsung sm-g485f',
        'sm-j327p'        => 'samsung sm-j327p',
        'sm-g750f'        => 'samsung sm-g750f',
        'sm-g7508q'       => 'samsung sm-g7508q',
        'sm-g7508'        => 'samsung sm-g7508',
        'sm-p605'         => 'sm-p605',
        'sm-p601'         => 'sm-p601',
        'sm-p600'         => 'sm-p600',
        'sm-p550'         => 'sm-p550',
        'sm-p355'         => 'sm-p355',
        'sm-p350'         => 'sm-p350',
        'sm-n930fd'       => 'sm-n930fd',
        'sm-n930f'        => 'sm-n930f',
        'sm-n930w8'       => 'sm-n930w8',
        'sm-n9300'        => 'sm-n9300',
        'sm-n9308'        => 'sm-n9308',
        'sm-n930k'        => 'sm-n930k',
        'sm-n930l'        => 'sm-n930l',
        'sm-n930s'        => 'sm-n930s',
        'sm-n930az'       => 'sm-n930az',
        'sm-n930a'        => 'sm-n930a',
        'sm-n930t1'       => 'sm-n930t1',
        'sm-n930t'        => 'sm-n930t',
        'sm-n930r6'       => 'sm-n930r6',
        'sm-n930r7'       => 'sm-n930r7',
        'sm-n930r4'       => 'sm-n930r4',
        'sm-n930p'        => 'sm-n930p',
        'sm-n930v'        => 'sm-n930v',
        'sm-n930u'        => 'sm-n930u',
        'sm-n920a'        => 'sm-n920a',
        'sm-n920r'        => 'sm-n920r',
        'sm-n920s'        => 'sm-n920s',
        'sm-n920k'        => 'sm-n920k',
        'sm-n920l'        => 'sm-n920l',
        'sm-n920g'        => 'sm-n920g',
        'sm-n920c'        => 'sm-n920c',
        'sm-n920v'        => 'sm-n920v',
        'sm-n920t'        => 'sm-n920t',
        'sm-n920p'        => 'sm-n920p',
        'sm-n920i'        => 'sm-n920i',
        'sm-n920w8'       => 'sm-n920w8',
        'sm-n9200'        => 'sm-n9200',
        'sm-n9208'        => 'sm-n9208',
        'sm-n9009'        => 'sm-n9009',
        'n9009'           => 'sm-n9009',
        'sm-n9008v'       => 'sm-n9008v',
        'sm-n9007'        => 'sm-n9007',
        'n9007'           => 'sm-n9007',
        'sm-n9006'        => 'sm-n9006',
        'n9006'           => 'sm-n9006',
        'sm-n9005'        => 'sm-n9005',
        'n9005'           => 'sm-n9005',
        'sm-n9002'        => 'sm-n9002',
        'n9002'           => 'sm-n9002',
        'sm-n8000'        => 'sm-n8000',
        'sm-n7505l'       => 'sm-n7505l',
        'sm-n7505'        => 'sm-n7505',
        'sm-n7502'        => 'sm-n7502',
        'sm-n7500q'       => 'sm-n7500q',
        'sm-n750'         => 'sm-n750',
        'sm-n916s'        => 'sm-n916s',
        'sm-n915fy'       => 'sm-n915fy',
        'sm-n915f'        => 'sm-n915f',
        'sm-n915t'        => 'sm-n915t',
        'sm-n915g'        => 'sm-n915g',
        'sm-n915p'        => 'sm-n915p',
        'sm-n915a'        => 'sm-n915a',
        'sm-n915v'        => 'sm-n915v',
        'sm-n915d'        => 'sm-n915d',
        'sm-n915k'        => 'sm-n915k',
        'sm-n915l'        => 'sm-n915l',
        'sm-n915s'        => 'sm-n915s',
        'sm-n9150'        => 'sm-n9150',
        'sm-n910v'        => 'sm-n910v',
        'sm-n910fq'       => 'sm-n910fq',
        'sm-n910fd'       => 'sm-n910fd',
        'sm-n910f'        => 'sm-n910f',
        'sm-n910c'        => 'sm-n910c',
        'sm-n910a'        => 'sm-n910a',
        'sm-n910h'        => 'sm-n910h',
        'sm-n910k'        => 'sm-n910k',
        'sm-n910p'        => 'sm-n910p',
        'sm-n910x'        => 'sm-n910x',
        'sm-n910s'        => 'sm-n910s',
        'sm-n910l'        => 'sm-n910l',
        'sm-n910g'        => 'sm-n910g',
        'sm-n910m'        => 'sm-n910m',
        'sm-n910t1'       => 'sm-n910t1',
        'sm-n910t3'       => 'sm-n910t3',
        'sm-n910t'        => 'sm-n910t',
        'sm-n910u'        => 'sm-n910u',
        'sm-n910r4'       => 'sm-n910r4',
        'sm-n910w8'       => 'sm-n910w8',
        'sm-n9100h'       => 'sm-n9100h',
        'sm-n9100'        => 'sm-n9100',
        'sm-n900v'        => 'sm-n900v',
        'sm-n900a'        => 'sm-n900a',
        'sm-n900s'        => 'sm-n900s',
        'sm-n900t'        => 'sm-n900t',
        'sm-n900p'        => 'sm-n900p',
        'sm-n900l'        => 'sm-n900l',
        'sm-n900k'        => 'sm-n900k',
        'sm-n9000q'       => 'sm-n9000q',
        'sm-n900w8'       => 'sm-n900w8',
        'sm-n900'         => 'sm-n900',
        'sm-g935fd'       => 'sm-g935fd',
        'sm-g935f'        => 'sm-g935f',
        'sm-g935a'        => 'sm-g935a',
        'sm-g935p'        => 'sm-g935p',
        'sm-g935r'        => 'sm-g935r',
        'sm-g935t'        => 'sm-g935t',
        'sm-g935v'        => 'sm-g935v',
        'sm-g935w8'       => 'sm-g935w8',
        'sm-g935k'        => 'sm-g935k',
        'sm-g935l'        => 'sm-g935l',
        'sm-g935s'        => 'sm-g935s',
        'sm-g935x'        => 'sm-g935x',
        'sm-g9350'        => 'sm-g9350',
        'sm-g930fd'       => 'sm-g930fd',
        'sm-g930f'        => 'sm-g930f',
        'sm-g9308'        => 'sm-g9308',
        'sm-g930a'        => 'sm-g930a',
        'sm-g930p'        => 'sm-g930p',
        'sm-g930v'        => 'sm-g930v',
        'sm-g930r'        => 'sm-g930r',
        'sm-g930t'        => 'sm-g930t',
        'sm-g930'         => 'sm-g930',
        'sm-g928f'        => 'sm-g928f',
        'sm-g928v'        => 'sm-g928v',
        'sm-g928w8'       => 'sm-g928w8',
        'sm-g928c'        => 'sm-g928c',
        'sm-g928g'        => 'sm-g928g',
        'sm-g928p'        => 'sm-g928p',
        'sm-g928i'        => 'sm-g928i',
        'sm-g9287'        => 'sm-g9287',
        'sm-g925f'        => 'sm-g925f',
        'sm-g925t'        => 'sm-g925t',
        'sm-g925r4'       => 'sm-g925r4',
        'sm-g925i'        => 'sm-g925i',
        'sm-g925p'        => 'sm-g925p',
        'sm-g925k'        => 'sm-g925k',
        'sm-g920k'        => 'sm-g920k',
        'sm-g920l'        => 'sm-g920l',
        'sm-g920p'        => 'sm-g920p',
        'sm-g920v'        => 'sm-g920v',
        'sm-g920t1'       => 'sm-g920t1',
        'sm-g920t'        => 'sm-g920t',
        'sm-g920a'        => 'sm-g920a',
        'sm-g920fd'       => 'sm-g920fd',
        'sm-g920f'        => 'sm-g920f',
        'sm-g920i'        => 'sm-g920i',
        'sm-g920s'        => 'sm-g920s',
        'sm-g9200'        => 'sm-g9200',
        'sm-g9208'        => 'sm-g9208',
        'sm-g9209'        => 'sm-g9209',
        'sm-g920r'        => 'sm-g920r',
        'sm-g920w8'       => 'sm-g920w8',
        'sm-g906s'        => 'samsung sm-g906s',
        'sm-g903f'        => 'sm-g903f',
        'sm-g901f'        => 'sm-g901f',
        'sm-g900fd'       => 'samsung sm-g900fd',
        'sm-g900f'        => 'samsung sm-g900f',
        'galaxy s5'       => 'samsung sm-g900f',
        'sm-g9006v'       => 'samsung sm-g9006v',
        'sm-g900w8'       => 'samsung sm-g900w8',
        'sm-g900p'        => 'samsung sm-g900p',
        'sm-g900r4'       => 'samsung sm-g900r4',
        'sm-g900v'        => 'samsung sm-g900v',
        'sm-g900t1'       => 'samsung sm-g900t1',
        'sm-g900t'        => 'samsung sm-g900t',
        'sm-g900i'        => 'samsung sm-g900i',
        'sm-g900a'        => 'samsung sm-g900a',
        'sm-g900h'        => 'samsung sm-g900h',
        'sm-g900'         => 'samsung sm-g900',
        'sm-g890a'        => 'sm-g890a',
        'sm-g870f'        => 'sm-g870f',
        'sm-g870a'        => 'sm-g870a',
        'sm-g850fq'       => 'sm-g850fq',
        'sm-g850f'        => 'sm-g850f',
        'galaxy alpha'    => 'sm-g850f',
        'sm-g850a'        => 'sm-g850a',
        'sm-g850m'        => 'sm-g850m',
        'sm-g850t'        => 'sm-g850t',
        'sm-g850w'        => 'sm-g850w',
        'sm-g850y'        => 'sm-g850y',
        'sm-g800hq'       => 'sm-g800hq',
        'sm-g800h'        => 'sm-g800h',
        'sm-g800f'        => 'sm-g800f',
        'sm-g800m'        => 'sm-g800m',
        'sm-g800a'        => 'sm-g800a',
        'sm-g800r4'       => 'sm-g800r4',
        'sm-g800y'        => 'sm-g800y',
        'sm-g720n0'       => 'sm-g720n0',
        'sm-g720d'        => 'sm-g720d',
        'sm-g7202'        => 'sm-g7202',
        'sm-g7102t'       => 'sm-g7102t',
        'sm-g7102'        => 'sm-g7102',
        'sm-g7105l'       => 'sm-g7105l',
        'sm-g7105'        => 'sm-g7105',
        'sm-g7106'        => 'sm-g7106',
        'sm-g7108v'       => 'sm-g7108v',
        'sm-g7108'        => 'sm-g7108',
        'sm-g7109'        => 'sm-g7109',
        'sm-g710l'        => 'sm-g710l',
        'sm-g710'         => 'sm-g710',
        'sm-g531f'        => 'sm-g531f',
        'sm-g531h'        => 'sm-g531h',
        'sm-g530t'        => 'sm-g530t',
        'sm-g530h'        => 'sm-g530h',
        'sm-g530fz'       => 'sm-g530fz',
        'sm-g530f'        => 'sm-g530f',
        'sm-g530y'        => 'sm-g530y',
        'sm-g530m'        => 'sm-g530m',
        'sm-g530bt'       => 'sm-g530bt',
        'sm-g5306w'       => 'sm-g5306w',
        'sm-g5308w'       => 'sm-g5308w',
        'sm-g389f'        => 'sm-g389f',
        'sm-g3815'        => 'sm-g3815',
        'sm-g388f'        => 'sm-g388f',
        'sm-g386t1'       => 'samsung sm-g386t1',
        'sm-g386t'        => 'samsung sm-g386t',
        'sm-g386f'        => 'sm-g386f',
        'sm-g361f'        => 'sm-g361f',
        'sm-g361h'        => 'sm-g361h',
        'sm-g360hu'       => 'sm-g360hu',
        'sm-g360h'        => 'sm-g360h',
        'sm-g360t1'       => 'sm-g360t1',
        'sm-g360t'        => 'sm-g360t',
        'sm-g360bt'       => 'sm-g360bt',
        'sm-g360f'        => 'sm-g360f',
        'sm-g360g'        => 'sm-g360g',
        'sm-g360az'       => 'sm-g360az',
        'sm-g357fz'       => 'sm-g357fz',
        'sm-g355hq'       => 'sm-g355hq',
        'sm-g355hn'       => 'sm-g355hn',
        'sm-g355h'        => 'sm-g355h',
        'sm-g355m'        => 'sm-g355m',
        'sm-g3502l'       => 'sm-g3502l',
        'sm-g3502t'       => 'sm-g3502t',
        'sm-g3500'        => 'sm-g3500',
        'sm-g350e'        => 'sm-g350e',
        'sm-g350'         => 'sm-g350',
        'sm-g318h'        => 'sm-g318h',
        'sm-g313hu'       => 'sm-g313hu',
        'sm-g313hn'       => 'sm-g313hn',
        'sm-g310hn'       => 'sm-g310hn',
        'sm-g130h'        => 'sm-g130h',
        'sm-g130e'        => 'samsung sm-g130e',
        'sm-g110h'        => 'sm-g110h',
        'sm-e700f'        => 'sm-e700f',
        'sm-e700h'        => 'sm-e700h',
        'sm-e700m'        => 'sm-e700m',
        'sm-e7000'        => 'sm-e7000',
        'sm-e7009'        => 'sm-e7009',
        'sm-e500h'        => 'sm-e500h',
        'sm-c115'         => 'sm-c115',
        'sm-c111'         => 'sm-c111',
        'sm-c105'         => 'sm-c105',
        'sm-c101'         => 'sm-c101',
        'sm-z130h'        => 'sm-z130h',
        'sm-b550h'        => 'sm-b550h',
        'sgh-t999'        => 'sgh-t999',
        'sgh-t989d'       => 'sgh-t989d',
        'sgh-t989'        => 'sgh-t989',
        'sgh-t959v'       => 'sgh-t959v',
        'sgh-t959'        => 'sgh-t959',
        'sgh-t899m'       => 'sgh-t899m',
        'sgh-t889'        => 'sgh-t889',
        'sgh-t859'        => 'sgh-t859',
        'sgh-t839'        => 'sgh-t839',
        'sgh-t769'        => 'sgh-t769',
        'blaze'           => 'sgh-t769',
        'sgh-t759'        => 'sgh-t759',
        'sgh-t669'        => 'sgh-t669',
        'sgh-t528g'       => 'sgh-t528g',
        'sgh-t499'        => 'sgh-t499',
        'sgh-t399'        => 'samsung sgh-t399',
        'sgh-m919'        => 'sgh-m919',
        'sgh-g810'        => 'samsung sgh-g810',
        'sgh-i997r'       => 'sgh-i997r',
        'sgh-i997'        => 'sgh-i997',
        'sgh-i957r'       => 'sgh-i957r',
        'sgh-i957'        => 'sgh-i957',
        'sgh-i917'        => 'sgh-i917',
        'sgh-i900v'       => 'sgh-i900v',
        'sgh-i9000'       => 'sgh-i9000',
        'sgh-i9008'       => 'sgh-i9008',
        'sgh-i900'        => 'sgh-i900',
        'sgh-i897'        => 'sgh-i897',
        'sgh-i857'        => 'sgh-i857',
        'sgh-i780'        => 'sgh-i780',
        'sgh-i777'        => 'sgh-i777',
        'sgh-i747m'       => 'sgh-i747m',
        'sgh-i747'        => 'sgh-i747',
        'sgh-i727r'       => 'sgh-i727r',
        'sgh-i727'        => 'sgh-i727',
        'sgh-i717'        => 'sgh-i717',
        'sgh-i601'        => 'samsung sgh-i601',
        'sgh-i577'        => 'sgh-i577',
        'sghi568'         => 'samsung sgh-i568',
        'sgh-i560v'       => 'samsung sgh-i560v',
        'sgh-i560'        => 'samsung sgh-i560',
        'sghi560'         => 'samsung sgh-i560',
        'sgh-i550v'       => 'samsung sgh-i550v',
        'sgh-i550'        => 'samsung sgh-i550',
        'sgh-i547'        => 'sgh-i547',
        'sgh-i520v'       => 'samsung sgh-i520v',
        'sgh-i497'        => 'sgh-i497',
        'sgh-i467'        => 'sgh-i467',
        'sgh-i458b'       => 'samsung sgh-i458b',
        'sgh-i455'        => 'samsung sgh-i455',
        'sgh-i450v'       => 'samsung sgh-i450v',
        'sgh-i450'        => 'samsung sgh-i450',
        'sgh-i337m'       => 'sgh-i337m',
        'sgh-i337'        => 'sgh-i337',
        'sgh-i317'        => 'sgh-i317',
        'sgh-i257'        => 'sgh-i257',
        'sgh-f480i'       => 'sgh-f480i',
        'sgh-f480'        => 'sgh-f480',
        'sgh-e250i'       => 'sgh-e250i',
        'sgh-e250'        => 'sgh-e250',
        'sgh-b100'        => 'sgh-b100',
        'sec-sghb100'     => 'sgh-b100',
        'sec-sghu600b'    => 'sgh-u600b',
        'sgh-u800e'       => 'sgh-u800e',
        'sgh-u800'        => 'sgh-u800',
        'shv-e370k'       => 'shv-e370k',
        'shv-e250k'       => 'shv-e250k',
        'shv-e250l'       => 'shv-e250l',
        'shv-e250s'       => 'shv-e250s',
        'shv-e210l'       => 'shv-e210l',
        'shv-e210k'       => 'shv-e210k',
        'shv-e210s'       => 'shv-e210s',
        'shv-e160s'       => 'shv-e160s',
        'shw-m305w'       => 'samsung shw-m305w',
        'shw-m250k'       => 'samsung shw-m250k',
        'shw-m110s'       => 'shw-m110s',
        'shw-m180s'       => 'shw-m180s',
        'shw-m380s'       => 'shw-m380s',
        'shw-m380w'       => 'shw-m380w',
        'shw-m480w'       => 'shw-m480w',
        'shw-m380k'       => 'shw-m380k',
        'scl24'           => 'scl24',
        'sch-u820'        => 'sch-u820',
        'sch-u750'        => 'sch-u750',
        'sch-u660'        => 'sch-u660',
        'sch-u485'        => 'sch-u485',
        'sch-r970'        => 'sch-r970',
        'sch-r950'        => 'sch-r950',
        'sch-r720'        => 'sch-r720',
        'sch-r530u'       => 'sch-r530u',
        'sch-r530c'       => 'sch-r530c',
        'sch-n719'        => 'sch-n719',
        'sch-m828c'       => 'sch-m828c',
        'sch-i535'        => 'sch-i535',
        'sch-i919'        => 'sch-i919',
        'sch-i815'        => 'sch-i815',
        'sch-i800'        => 'sch-i800',
        'sch-i699'        => 'sch-i699',
        'sch-i605'        => 'sch-i605',
        'sch-i545'        => 'samsung sch-i545',
        'i545'            => 'samsung sch-i545',
        'sch-i510'        => 'sch-i510',
        'sch-i500'        => 'sch-i500',
        'sch-i435'        => 'sch-i435',
        'sch-i400'        => 'sch-i400',
        'sch-i200'        => 'sch-i200',
        'sch-s720c'       => 'sch-s720c',
        'gt-s8600'        => 'gt-s8600',
        'gt-s8530'        => 'gt-s8530',
        's8500'           => 'gt-s8500',
        'samsung-s8300'   => 'gt-s8300',
        'gt-s8300'        => 'gt-s8300',
        'samsung-s8003'   => 'gt-s8003',
        'gt-s8003'        => 'gt-s8003',
        'samsung-s8000'   => 'gt-s8000',
        'gt-s8000'        => 'gt-s8000',
        'samsung-s7710'   => 'gt-s7710',
        'gt-s7710'        => 'gt-s7710',
        'gt-s7582'        => 'gt-s7582',
        'gt-s7580'        => 'gt-s7580',
        'gt-s7562l'       => 'gt-s7562l',
        'gt-s7562'        => 'gt-s7562',
        'gt-s7560'        => 'gt-s7560',
        'gt-s7530l'       => 'gt-s7530l',
        'gt-s7530'        => 'gt-s7530',
        'gt-s7500'        => 'gt-s7500',
        'gt-s7392'        => 'gt-s7392',
        'gt-s7390'        => 'gt-s7390',
        'gt-s7330'        => 'gt-s7330',
        'gt-s7275r'       => 'gt-s7275r',
        'gt-s7275'        => 'gt-s7275',
        'gt-s7272'        => 'gt-s7272',
        'gt-s7270'        => 'gt-s7270',
        'gt-s7262'        => 'gt-s7262',
        'gt-s7250'        => 'gt-s7250',
        'gt-s7233e'       => 'gt-s7233e',
        'gt-s7230e'       => 'gt-s7230e',
        'samsung-s7220'   => 'gt-s7220',
        'gt-s7220'        => 'gt-s7220',
        'gt-s6810p'       => 'gt-s6810p',
        'gt-s6810b'       => 'gt-s6810b',
        'gt-s6810'        => 'gt-s6810',
        'gt-s6802'        => 'gt-s6802',
        'gt-s6500d'       => 'gt-s6500d',
        'gt-s6500t'       => 'gt-s6500t',
        'gt-s6500'        => 'gt-s6500',
        'gt-s6312'        => 'gt-s6312',
        'gt-s6310n'       => 'gt-s6310n',
        'gt-s6310'        => 'gt-s6310',
        'gt-s6102b'       => 'gt-s6102b',
        'gt-s6102'        => 'gt-s6102',
        'gt-s5839i'       => 'gt-s5839i',
        'gt-s5830l'       => 'gt-s5830l',
        'gt-s5830i'       => 'gt-s5830i',
        'gt-s5830c'       => 'gt-s5830c',
        'gt-s5570i'       => 'gt-s5570i',
        'gt-s5570'        => 'gt-s5570',
        'gt-s5830'        => 'gt-s5830',
        'ace'             => 'gt-s5830',
        'gt-s5780'        => 'gt-s5780',
        'gt-s5750e'       => 'gt-s5750e orange',
        'gt-s5690'        => 'gt-s5690',
        'gt-s5670'        => 'gt-s5670',
        'gt-s5660'        => 'gt-s5660',
        'gt-s5620'        => 'gt-s5620',
        'gt-s5560i'       => 'gt-s5560i',
        'gt-s5560'        => 'gt-s5560',
        'gt-s5380'        => 'gt-s5380',
        'gt-s5369'        => 'gt-s5369',
        'gt-s5363'        => 'gt-s5363',
        'gt-s5360'        => 'gt-s5360',
        'gt-s5330'        => 'gt-s5330',
        'gt-s5310m'       => 'gt-s5310m',
        'gt-s5310'        => 'gt-s5310',
        'gt-s5303'        => 'samsung gt-s5303',
        'gt-s5302'        => 'gt-s5302',
        'gt-s5301l'       => 'gt-s5301l',
        'gt-s5301'        => 'gt-s5301',
        'gt-s5300b'       => 'gt-s5300b',
        'gt-s5300'        => 'gt-s5300',
        'gt-s5280'        => 'gt-s5280',
        'gt-s5260'        => 'gt-s5260',
        'gt-s5250'        => 'gt-s5250',
        'gt-s5233s'       => 'gt-s5233s',
        'gt-s5230w'       => 'gt s5230w',
        'gt-s5230'        => 'gt-s5230',
        'gt-s5222r'       => 'gt-s5222r',
        'gt-s5222'        => 'gt-s5222',
        'gt-s5220'        => 'gt-s5220',
        'gt-s3850'        => 'gt-s3850',
        'gt-s3802'        => 'gt-s3802',
        'gt-s3653'        => 'gt-s3653',
        'gt-s3650'        => 'gt-s3650',
        'gt-s3370'        => 'gt-s3370',
        'gt-p7511'        => 'gt-p7511',
        'gt-p7510'        => 'gt-p7510',
        'gt-p7501'        => 'gt-p7501',
        'gt-p7500m'       => 'gt-p7500m',
        'gt-p7500'        => 'gt-p7500',
        'gt-p7320'        => 'gt-p7320',
        'gt-p7310'        => 'gt-p7310',
        'gt-p7300b'       => 'gt-p7300b',
        'gt-p7300'        => 'gt-p7300',
        'gt-p7100'        => 'gt-p7100',
        'gt-p6810'        => 'gt-p6810',
        'gt-p6800'        => 'gt-p6800',
        'gt-p6211'        => 'gt-p6211',
        'gt-p6210'        => 'gt-p6210',
        'gt-p6201'        => 'gt-p6201',
        'gt-p6200'        => 'gt-p6200',
        'gt-p5220'        => 'gt-p5220',
        'gt-p5210'        => 'gt-p5210',
        'gt-p5200'        => 'gt-p5200',
        'gt-p5113'        => 'gt-p5113',
        'gt-p5110'        => 'gt-p5110',
        'gt-p5100'        => 'gt-p5100',
        'gt-p3113'        => 'gt-p3113',
        'gt-p3100'        => 'gt-p3100',
        'galaxy tab 2 3g' => 'gt-p3100',
        'gt-p3110'        => 'gt-p3110',
        'galaxy tab 2'    => 'gt-p3110',
        'gt-p1010'        => 'gt-p1010',
        'gt-p1000n'       => 'gt-p1000n',
        'gt-p1000m'       => 'gt-p1000m',
        'gt-p1000'        => 'gt-p1000',
        'gt-n9000'        => 'gt-n9000',
        'gt-n8020'        => 'gt-n8020',
        'gt-n8013'        => 'gt-n8013',
        'gt-n8010'        => 'gt-n8010',
        'gt-n8005'        => 'gt-n8005',
        'gt-n8000d'       => 'gt-n8000d',
        'n8000d'          => 'gt-n8000d',
        'gt-n8000'        => 'gt-n8000',
        'gt-n7108'        => 'gt-n7108',
        'gt-n7105'        => 'gt-n7105',
        'gt-n7100'        => 'gt-n7100',
        'gt-n7000'        => 'gt-n7000',
        'gt-n5120'        => 'gt-n5120',
        'gt-n5110'        => 'gt-n5110',
        'gt-n5100'        => 'gt-n5100',
        'gt-m7603'        => 'gt-m7603',
        'samsung-m7603'   => 'gt-m7603',
        'gt-m7600l'       => 'gt-m7600l',
        'gt-m7600'        => 'gt-m7600',
        'samsung-m7600'   => 'gt-m7600',
        'gt-i9515'        => 'gt-i9515',
        'gt-i9506'        => 'gt-i9506',
        'gt-i9505x'       => 'gt-i9505x',
        'gt-i9505g'       => 'gt-i9505g',
        'gt-i9505'        => 'gt-i9505',
        'gt-i9502'        => 'gt-i9502',
        'gt-i9500'        => 'gt-i9500',
        'gt-i9308'        => 'gt-i9308',
        'gt-i9305t'       => 'samsung gt-i9305t',
        'gt-i9305'        => 'samsung gt-i9305',
        'gt-i9301i'       => 'gt-i9301i',
        'i9301i'          => 'gt-i9301i',
        'gt-i9301q'       => 'gt-i9301q',
        'i9301q'          => 'gt-i9301q',
        'gt-i9301'        => 'gt-i9301',
        'i9301'           => 'gt-i9301',
        'gt-i9300i'       => 'gt-i9300i',
        'gt-l9300'        => 'gt-i9300',
        'gt-i9300'        => 'gt-i9300',
        'i9300'           => 'gt-i9300',
        'gt-i9295'        => 'gt-i9295',
        'i9295'           => 'gt-i9295',
        'gt-i9210'        => 'gt-i9210',
        'gt-i9205'        => 'gt-i9205',
        'gt-i9200'        => 'gt-i9200',
        'gt-i9195i'       => 'gt-i9195i',
        'gt-i9195'        => 'gt-i9195',
        'i9195'           => 'gt-i9195',
        'gt-i9192'        => 'gt-i9192',
        'i9192'           => 'gt-i9192',
        'gt-i9190'        => 'gt-i9190',
        'i9190'           => 'gt-i9190',
        'gt-i9152'        => 'gt-i9152',
        'gt-i9128v'       => 'gt-i9128v',
        'gt-i9105p'       => 'gt-i9105p',
        'gt-i9105'        => 'gt-i9105',
        'gt-i9103'        => 'gt-i9103',
        'gt-i9100t'       => 'gt-i9100t',
        'gt-i9100p'       => 'gt-i9100p',
        'gt-i9100g'       => 'gt-i9100g',
        'gt-i9100'        => 'gt-i9100',
        'i9100'           => 'gt-i9100',
        'galaxy s ii'     => 'gt-i9100',
        'gt-i9088'        => 'gt-i9088',
        'gt-i9082l'       => 'gt-i9082l',
        'gt-i9082'        => 'gt-i9082',
        'gt-i9070p'       => 'gt-i9070p',
        'gt-i9070'        => 'gt-i9070',
        'gt-i9060l'       => 'gt-i9060l',
        'gt-i9060i'       => 'gt-i9060i',
        'gt-i9060'        => 'gt-i9060',
        'gt-i9023'        => 'gt-i9023',
        'galaxy s4'       => 'gt-i9500',
        'galaxy-s4'       => 'gt-i9500',
        'galaxys4'        => 'gt-i9500',
        'galaxy s iv'     => 'gt-i950x',
        'galaxy s'        => 'samsung gt-i9010',
        'galaxy-s'        => 'samsung gt-i9010',
        'gt-i9010'        => 'samsung gt-i9010',
        'gt-i9008l'       => 'gt-i9008l',
        'gt-i9008'        => 'gt-i9008',
        'gt-i9003l'       => 'gt-i9003l',
        'gt-i9003'        => 'gt-i9003',
        'gt-i9001'        => 'gt-i9001',
        'gt-i9000'        => 'gt-i9000',
        'gt-i8910'        => 'gt-i8910',
        'i8910'           => 'gt-i8910',
        'gt-i8750'        => 'gt-i8750',
        'gt-i8730'        => 'gt-i8730',
        'omnia7'          => 'gt-i8700',
        'gt-i8552'        => 'gt-i8552',
        'gt-i8530'        => 'gt-i8530',
        'gt-i8510c'       => 'samsung gt-i8510c',
        'i8510l'          => 'samsung gt-i8510l',
        'i8510m'          => 'samsung gt-i8510m',
        'i8510'           => 'samsung gt-i8510',
        'gt-i8350'        => 'gt-i8350',
        'gt-i8320'        => 'gt-i8320',
        'gt-i8262'        => 'gt-i8262',
        'gt-i8260'        => 'gt-i8260',
        'gt-i8200n'       => 'gt-i8200n',
        'gt-i8200'        => 'gt-i8200',
        'gt-i8190n'       => 'gt-i8190n',
        'gt-i8190'        => 'gt-i8190',
        'gt-i8160p'       => 'gt-i8160p',
        'gt-i8160'        => 'gt-i8160',
        'gt-i8150'        => 'gt-i8150',
        'gt-i8000v'       => 'gt-i8000v',
        'gt-i8000'        => 'gt-i8000',
        'gt-i6410'        => 'gt-i6410',
        'gt-i5801'        => 'gt-i5801',
        'gt-i5800'        => 'gt-i5800',
        'gt-i5700'        => 'gt-i5700',
        'gt-i5510'        => 'gt-i5510',
        'gt-i5508'        => 'gt-i5508',
        'gt-i5503'        => 'gt-i5503',
        'gt-i5500'        => 'gt-i5500',
        'nexus s 4g'      => 'nexus s 4g',
        'nexus s'         => 'nexus s',
        'nexus 10'        => 'nexus 10',
        'nexus player'    => 'nexus player',
        'nexus'           => 'galaxy nexus',
        'galaxy'          => 'gt-i7500',
        'gt-e3309t'       => 'gt-e3309t',
        'gt-e2550l'       => 'gt-e2550l',
        'gt-e2550'        => 'gt-e2550',
        'gt-e2252'        => 'gt-e2252',
        'gt-e2222l'       => 'gt-e2222l',
        'gt-e2222'        => 'gt-e2222',
        'gt-e2202'        => 'gt-e2202',
        'gt-e1282t'       => 'gt-e1282t',
        'gt-c6712'        => 'gt-c6712',
        'gt-c3780'        => 'gt-c3780',
        'gt-c3510'        => 'gt-c3510',
        'gt-c3500'        => 'gt-c3500',
        'gt-c3350'        => 'gt-c3350',
        'gt-c3322'        => 'gt-c3322',
        'gt-C3312r'       => 'gt-c3312r',
        'gt-c3310'        => 'gt-c3310',
        'gt-c3262'        => 'gt-c3262',
        'gt-b7722'        => 'gt-b7722',
        'gt-b7610'        => 'gt-b7610',
        'gt-b7510l'       => 'gt-b7510l',
        'gt-b7510'        => 'gt-b7510',
        'gt-b7350'        => 'gt-b7350',
        'gt-b5510l'       => 'gt-b5510l',
        'gt-b5510'        => 'gt-b5510',
        'gt-b3410'        => 'gt-b3410',
        'gt-b2710'        => 'gt-b2710',
        'gt-b2100i'       => 'gt-b2100i',
        'gt-b2100'        => 'gt-b2100',
        'b2100'           => 'gt-b2100',
        'f031'            => 'f031',
        'continuum-i400'  => 'continuum i400',
        'cetus'           => 'cetus',
        'sc-06d'          => 'sc-06d',
        'sc-02f'          => 'sc-02f',
        'sc-02c'          => 'sc-02c',
        'sc-02b'          => 'sc-02b',
        'sc-01f'          => 'sc-01f',
        's3500'           => 's3500',
        'r631'            => 'r631',
        'i7110'           => 'i7110',
        'yp-gs1'          => 'yp-gs1',
        'yp-gi1'          => 'yp-gi1',
        'yp-gb70'         => 'yp-gb70',
        'yp-g70'          => 'yp-g70',
        'yp-g1'           => 'yp-g1',
        'sch-r730'        => 'sch-r730',
        'sph-p100'        => 'sph-p100',
        'sph-m930bst'     => 'sph-m930bst',
        'sph-m930'        => 'sph-m930',
        'sph-m840'        => 'sph-m840',
        'sph-m580bst'     => 'sph-m580bst',
        'sph-m580'        => 'sph-m580',
        'm560'            => 'samsung sph-m560',
        'm550'            => 'samsung sph-m550',
        'm380'            => 'samsung sph-m380',
        'm370'            => 'samsung sph-m370',
        'm350'            => 'samsung sph-m350',
        'sph-l900'        => 'sph-l900',
        'sph-l720'        => 'sph-l720',
        'sph-l710'        => 'sph-l710',
        'sph-ip830w'      => 'sph-ip830w',
        'sph-d710bst'     => 'sph-d710bst',
        'sph-d710'        => 'sph-d710',
        'smart-tv'        => 'samsung smart tv',
    ];

    /**
     * @var \BrowserDetector\Loader\LoaderInterface|null
     */
    private $loader = null;

    /**
     * @param \BrowserDetector\Loader\LoaderInterface $loader
     */
    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * detects the device name from the given user agent
     *
     * @param string           $useragent
     * @param \Stringy\Stringy $s
     *
     * @return array
     */
    public function detect($useragent, Stringy $s = null)
    {
        foreach ($this->devices as $search => $key) {
            if ($s->contains($search, false)) {
                return $this->loader->load($key, $useragent);
            }
        }

        return $this->loader->load('general samsung device', $useragent);
    }
}
