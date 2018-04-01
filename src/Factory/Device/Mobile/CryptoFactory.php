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

class CryptoFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'q8002' => 'crypto q8002',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general crypto device';

    use Factory\DeviceFactoryTrait;
}
