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

class DellFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'venue 8 7840'  => 'dell venue 8 7840',
        'venue pro'     => 'dell venue pro',
        'venue 8 hspa+' => 'dell venue 8 hspa+',
        'venue 8 3830'  => 'dell venue 8 3830',
        'venue 7 hspa+' => 'dell venue 7 hspa+',
        'venue 7 3730'  => 'dell venue 7 3730',
        'venue'         => 'dell venue',
        'streak 10 pro' => 'dell streak 10 pro',
        'streak 7'      => 'dell streak 7',
        'streak'        => 'dell streak',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general dell device';

    use Factory\DeviceFactoryTrait;
}
