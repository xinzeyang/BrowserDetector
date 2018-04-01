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

class AllviewFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'x2_soul'    => 'allview x2 soul',
        'x1_soul'    => 'allview x1 soul',
        'p5-mini'    => 'allview p5 mini',
        'p5_quad'    => 'allview p5 quad',
        'v1_viper_i' => 'allview v1 viper i',
        'v1_viper'   => 'allview v1 viper',
        'a4you'      => 'allview a4you',
        'ax4nano'    => 'allview ax4nano',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general allview device';

    use Factory\DeviceFactoryTrait;
}
