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

class KingzoneFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'k1 turbo' => 'kingzone kz-168',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general kingzone device';

    use Factory\DeviceFactoryTrait;
}
