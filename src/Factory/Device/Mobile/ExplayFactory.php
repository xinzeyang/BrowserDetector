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

class ExplayFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'rioplay'     => 'explay rio play',
        'a320'        => 'explay a320',
        'surfer 7.34' => 'explay surfer 7.34 3g',
        'm1_plus'     => 'explay m1 plus',
        'd7.2 3g'     => 'explay d7.2 3g',
        'art 3g'      => 'explay art 3g',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general explay device';

    use Factory\DeviceFactoryTrait;
}
