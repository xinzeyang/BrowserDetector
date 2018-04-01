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

class IberryFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'auxus nuclea n1' => 'iberry auxus nuclea n1',
        'auxus ax02'      => 'iberry auxus ax02',
        'auxus ax01'      => 'iberry auxus ax01',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general iberry device';

    use Factory\DeviceFactoryTrait;
}
