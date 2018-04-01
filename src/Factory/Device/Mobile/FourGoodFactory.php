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

class FourGoodFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        't700i_3g'   => '4good t700i 3g',
        's555m 4g'   => '4good s555m 4g',
        's501m 3g'   => '4good s501m 3g',
        's450m 4g'   => '4good s450m 4g',
        'light a103' => '4good light a103',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general 4good device';

    use Factory\DeviceFactoryTrait;
}
