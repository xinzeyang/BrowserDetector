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

class YarvikFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'tab10-400' => 'yarvik tab10-400',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general yarvik device';

    use Factory\DeviceFactoryTrait;
}
