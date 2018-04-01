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

class DoroFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'liberto 825'      => 'doro liberto 825',
        'liberto 820 mini' => 'doro liberto 820 mini',
        'liberto 820'      => 'doro liberto 820',
        'doro 8030'        => 'doro 8030',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general doro device';

    use Factory\DeviceFactoryTrait;
}
