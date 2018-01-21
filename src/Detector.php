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
namespace BrowserDetector;

use BrowserDetector\Cache\Cache;
use BrowserDetector\Factory\BrowserFactory;
use BrowserDetector\Factory\DeviceFactory;
use BrowserDetector\Factory\EngineFactory;
use BrowserDetector\Factory\NormalizerFactory;
use BrowserDetector\Factory\PlatformFactory;
use BrowserDetector\Helper\GenericRequest;
use BrowserDetector\Helper\GenericRequestFactory;
use BrowserDetector\Loader\BrowserLoader;
use BrowserDetector\Loader\DeviceLoader;
use BrowserDetector\Loader\EngineLoader;
use BrowserDetector\Loader\NotFoundException;
use BrowserDetector\Loader\PlatformLoader;
use Psr\Http\Message\MessageInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface as PsrCacheInterface;
use Stringy\Stringy;
use UaResult\Result\Result;
use UaResult\Result\ResultInterface;
use UnexpectedValueException;

/**
 * Browser Detection class
 */
class Detector
{
    /**
     * a cache object
     *
     * @var \BrowserDetector\Cache\Cache
     */
    private $cache;

    /**
     * an logger instance
     *
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * sets the cache used to make the detection faster
     *
     * @param \Psr\SimpleCache\CacheInterface $cache
     * @param \Psr\Log\LoggerInterface        $logger
     */
    public function __construct(PsrCacheInterface $cache, LoggerInterface $logger)
    {
        $this->cache  = new Cache($cache);
        $this->logger = $logger;
    }

    /**
     * Gets the information about the browser by User Agent
     *
     * @param array|\Psr\Http\Message\MessageInterface|string $headers
     *
     * @return \UaResult\Result\ResultInterface
     */
    public function getBrowser($headers): ResultInterface
    {
        $request = $this->buildRequest($headers);

        $deviceFactory = new DeviceFactory(DeviceLoader::getInstance($this->cache, $this->logger));
        $normalizer    = (new NormalizerFactory())->build();
        $deviceUa      = $normalizer->normalize($request->getDeviceUserAgent());

        /* @var \UaResult\Device\DeviceInterface $device */
        /* @var \UaResult\Os\OsInterface $platform */
        try {
            [$device, $platform] = $deviceFactory->detect($deviceUa, new Stringy($deviceUa));
        } catch (NotFoundException $e) {
            $this->logger->debug($e);

            $device   = null;
            $platform = null;
        }

        $browserUa = $normalizer->normalize($request->getBrowserUserAgent());
        $s         = new Stringy($browserUa);

        if (null === $platform) {
            $this->logger->debug('platform not detected from the device');

            $platformFactory = new PlatformFactory(PlatformLoader::getInstance($this->cache, $this->logger));

            try {
                $platform = $platformFactory->detect($browserUa, $s);
            } catch (NotFoundException $e) {
                $this->logger->debug($e);
                $platform = null;
            }
        }

        $browserLoader = BrowserLoader::getInstance($this->cache, $this->logger);

        /* @var \UaResult\Browser\BrowserInterface $browser */
        /* @var \UaResult\Engine\EngineInterface $engine */
        [$browser, $engine] = (new BrowserFactory($browserLoader))->detect($browserUa, $s, $platform);
        $engineLoader       = EngineLoader::getInstance($this->cache, $this->logger);

        if (null === $engine) {
            $this->logger->debug('engine not detected from browser');
            $engine = (new EngineFactory($engineLoader))->detect($browserUa, $s, $browserLoader, $platform);
        }

        return new Result(
            $request->getHeaders(),
            $device,
            $platform,
            $browser,
            $engine
        );
    }

    /**
     * @param array|\Psr\Http\Message\MessageInterface|string $request
     *
     * @throws \UnexpectedValueException
     *
     * @return \BrowserDetector\Helper\GenericRequest
     */
    private function buildRequest($request): GenericRequest
    {
        $requestFactory = new GenericRequestFactory();

        if ($request instanceof MessageInterface) {
            $this->logger->debug('request object created from PSR-7 http message');

            return $requestFactory->createRequestFromPsr7Message($request);
        }

        if (is_array($request)) {
            $this->logger->debug('request object created from array');

            return $requestFactory->createRequestFromArray($request);
        }

        if (is_string($request)) {
            $this->logger->debug('request object created from string');

            return $requestFactory->createRequestFromString($request);
        }

        throw new UnexpectedValueException(
            'the request parameter has to be a string, an array or an instance of \Psr\Http\Message\MessageInterface'
        );
    }

    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \Seld\JsonLint\ParsingException
     *
     * @return void
     */
    public function warmupCache(): void
    {
        BrowserLoader::getInstance($this->cache, $this->logger)->warmupCache();
        PlatformLoader::getInstance($this->cache, $this->logger)->warmupCache();
        EngineLoader::getInstance($this->cache, $this->logger)->warmupCache();
        DeviceLoader::getInstance($this->cache, $this->logger)->warmupCache();
    }
}
