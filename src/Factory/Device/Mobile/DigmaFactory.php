<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2017, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace BrowserDetector\Factory\Device\Mobile;

use BrowserDetector\Factory;
use BrowserDetector\Loader\ExtendedLoaderInterface;
use Stringy\Stringy;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2017 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class DigmaFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'ns9797mg'    => 'digma ns9797mg',
        'ns7001ql'    => 'digma ns7001ql',
        'ns6902ql'    => 'digma ns6902ql',
        'ts7055mg'    => 'digma ts7055mg',
        'ts1087mg'    => 'digma ts1087mg',
        'ht7074ml'    => 'digma ht7074ml',
        'ct5006pg'    => 'digma ct5006pg',
        'cs5007pg'    => 'digma cs5007pg',
        'cs1051pg'    => 'digma cs1051pg',
        'vs5013ml'    => 'digma vs5013ml',
        'vox s502 3g' => 'digma vox s502 3g',
        'ps8106pg'    => 'digma ps8106pg',
        'ps8040mg'    => 'digma ps8040mg',
        'ps7022mg'    => 'digma ps7022mg',
        'ps7005mg'    => 'digma ps7005mg',
        'ps1043mg'    => 'digma ps1043mg',
        'ps604m'      => 'digma ps604m',
        'ps474s'      => 'digma ps474s',
        'tt7071mg'    => 'digma tt7071mg',
        'tt7026mw'    => 'digma tt7026mw',
        'tt7008aw'    => 'digma tt7008aw',
        'tt7000mg'    => 'digma tt7000mg',
        'tt1003mg'    => 'digma tt1003mg',
        'pt452e'      => 'digma pt452e',
        'lt5001pg'    => 'digma lt5001pg',
        'lt4001pg'    => 'digma lt4001pg',
        'idxd10 3g'   => 'digma idxd10 3g',
        'idxd8'       => 'digma idxd8',
        'idxd7'       => 'digma idxd7 3g',
        'idxd5'       => 'digma idxd5',
        'idxd4'       => 'digma idxd4 3g',
        'idx5'        => 'digma idx5',
        'idsd7'       => 'digma idsd7 3g',
        'ids10'       => 'digma ids10',
        'idrq10'      => 'digma idrq10 3g',
        'idnd7'       => 'digma idnd7',
        'idjd7'       => 'digma idjd7',
        'idj7'        => 'digma idj7',
        'd700'        => 'digma d700',
    ];

    /**
     * @var \BrowserDetector\Loader\LoaderInterface|null
     */
    private $loader = null;

    /**
     * @param \BrowserDetector\Loader\ExtendedLoaderInterface $loader
     */
    public function __construct(ExtendedLoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * detects the device name from the given user agent
     *
     * @param string           $useragent
     * @param \Stringy\Stringy $s
     *
     * @return array
     */
    public function detect(string $useragent, Stringy $s = null): array
    {
        foreach ($this->devices as $search => $key) {
            if ($s->contains($search, false)) {
                return $this->loader->load($key, $useragent);
            }
        }

        return $this->loader->load('general digma device', $useragent);
    }
}
