<?php
/**
 * Copyright (c) 2012-2017, Thomas Mueller <mimmi20@live.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  BrowserDetector
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2012-2017 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 *
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace BrowserDetector\Detector;

use BrowserDetector\Factory\PlatformFactory;
use BrowserDetector\Factory\Regex\NoMatchException;
use BrowserDetector\Factory\RegexFactory;
use BrowserDetector\Loader\NotFoundException;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

/**
 * Browser Detection class
 *
 * @category  BrowserDetector
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2012-2017 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Os
{
    /**
     * a cache object
     *
     * @var \Psr\Cache\CacheItemPoolInterface
     */
    private $cache = null;

    /**
     * an logger instance
     *
     * @var \Psr\Log\LoggerInterface
     */
    private $logger = null;

    /**
     * @var \BrowserDetector\Factory\RegexFactory
     */
    private $regexFactory = null;

    /**
     * @var \BrowserDetector\Factory\PlatformFactory
     */
    private $platformFactory = null;

    /**
     * sets the cache used to make the detection faster
     *
     * @param \Psr\Cache\CacheItemPoolInterface        $cache
     * @param \Psr\Log\LoggerInterface                 $logger
     * @param \BrowserDetector\Factory\RegexFactory    $regexFactory
     * @param \BrowserDetector\Factory\PlatformFactory $platformFactory
     */
    public function __construct(
        CacheItemPoolInterface $cache,
        LoggerInterface $logger,
        RegexFactory $regexFactory,
        PlatformFactory $platformFactory
    ) {
        $this->cache           = $cache;
        $this->logger          = $logger;
        $this->regexFactory    = $regexFactory;
        $this->platformFactory = $platformFactory;
    }

    /**
     * Gets the information about the browser by User Agent
     *
     * @param string $browserUa
     *
     * @return \UaResult\Os\OsInterface
     */
    public function detect($browserUa)
    {
        $this->logger->debug('platform not detected from the device');

        try {
            $platform = $this->regexFactory->getPlatform();
        } catch (NotFoundException $e) {
            $this->logger->info($e);
            $platform = null;
        } catch (NoMatchException $e) {
            $platform = null;
        } catch (\InvalidArgumentException $e) {
            $this->logger->error($e);
            $platform = null;
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $platform = null;
        }

        if (null === $platform || in_array($platform->getName(), [null, 'unknown'])) {
            $this->logger->debug('platform not detected from the device nor from regex');

            try {
                $platform = $this->platformFactory->detect($browserUa);
            } catch (NotFoundException $e) {
                $this->logger->info($e);
                $platform = new \UaResult\Os\Os(null, null);
            }
        }

        return $platform;
    }
}
