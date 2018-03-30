<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2018, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace BrowserDetector\Factory\Device\Mobile;

use BrowserDetector\Factory;
use BrowserDetector\Loader\ExtendedLoaderInterface;
use Stringy\Stringy;

class BqFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'edison 3 mini'   => 'bq edison 3 mini',
        'edison 3'        => 'bq edison 3',
        'aquaris x pro'   => 'bq aquaris x pro',
        'aquaris x5'      => 'bq aquaris x5',
        'aquaris e5 hd'   => 'bq aquaris e5 hd',
        'aquaris e5'      => 'bq aquaris e5',
        'aquaris e4'      => 'bq aquaris e4',
        'aquaris m10 fhd' => 'bq aquaris m10 fhd',
        'aquaris m10'     => 'bq aquaris m10',
        'aquaris m5'      => 'bq aquaris m5',
        'aquaris m4.5'    => 'bq aquaris m4.5',
        'aquaris_m4.5'    => 'bq aquaris m4.5',
        'aquaris 5 hd'    => 'bq aquaris 5 hd',
        ' m10 '           => 'bq aquaris m10',
        '7056g'           => 'bq 7056g',
        'bqs-4007'        => 'bq bqs-4007',
        'bqs-4005'        => 'bq bqs-4005',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general bq device';

    use Factory\DeviceFactoryTrait;
}
