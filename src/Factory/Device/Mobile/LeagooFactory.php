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

class LeagooFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'shark 1' => 'leagoo shark 1',
        'elite 5' => 'leagoo elite 5',
        'elite 4' => 'leagoo elite 4',
        't1_plus' => 'leagoo t1 plus',
        'lead 2'  => 'leagoo lead 2',
        'lead 1'  => 'leagoo lead 1',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general leagoo device';

    use Factory\DeviceFactoryTrait;
}
