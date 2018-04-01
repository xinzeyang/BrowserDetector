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

class LeecoFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'le max'   => 'leeco le max',
        'le 1 pro' => 'leeco le x800',
        'lex626'   => 'leeco le x626',
        'le x829'  => 'leeco le x829',
        'le x820'  => 'leeco le x820',
        'lex820'   => 'leeco le x820',
        'lex720'   => 'leeco le x720',
        'le x620'  => 'leeco le x620',
        'le 2'     => 'leeco le x527',
        'le x527'  => 'leeco le x527',
        'le x507'  => 'leeco le x507',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general leeco device';

    use Factory\DeviceFactoryTrait;
}
