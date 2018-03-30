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

class IntelFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'tr10rs1'  => 'intel tr10rs1',
        'tr10cd1'  => 'intel tr10cd1',
        'w032i-c3' => 'intel w032i c3',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general intel device';

    use Factory\DeviceFactoryTrait;
}
