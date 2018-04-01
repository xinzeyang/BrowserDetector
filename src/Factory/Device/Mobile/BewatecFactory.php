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

class BewatecFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'medipad16' => 'bewatec medipad 16',
        'medipad13' => 'bewatec medipad 13',
        'medipad'   => 'bewatec medipad',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general bewatec device';

    use Factory\DeviceFactoryTrait;
}
