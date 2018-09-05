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
namespace BrowserDetector\Loader\Helper;

use Seld\JsonLint\JsonParser;
use Seld\JsonLint\ParsingException;
use Symfony\Component\Finder\SplFileInfo;

class Rules
{
    /**
     * @var \Seld\JsonLint\JsonParser
     */
    private $jsonParser;

    /**
     * @var \Symfony\Component\Finder\SplFileInfo
     */
    private $file;

    /**
     * @var array
     */
    private $rules = [];

    /**
     * @var string|null
     */
    private $default;

    /**
     * @var bool
     */
    private $initialized = false;

    /**
     * @param \Seld\JsonLint\JsonParser             $jsonParser
     * @param \Symfony\Component\Finder\SplFileInfo $file
     */
    public function __construct(
        JsonParser $jsonParser,
        SplFileInfo $file
    ) {
        $this->jsonParser = $jsonParser;
        $this->file       = $file;
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @return string|null
     */
    public function getDefault(): ?string
    {
        return $this->default;
    }

    /**
     * @return bool
     */
    public function isInitialized(): bool
    {
        return $this->initialized;
    }

    /**
     * @return void
     */
    public function __invoke(): void
    {
        try {
            $fileData = $this->jsonParser->parse(
                $this->file->getContents(),
                JsonParser::DETECT_KEY_CONFLICTS | JsonParser::PARSE_TO_ASSOC
            );
        } catch (ParsingException $e) {
            throw new \RuntimeException('file "' . $this->file->getPathname() . '" contains invalid json', 0, $e);
        }

        if (is_array($fileData['rules'])) {
            $this->rules = $fileData['rules'];
        }

        if (is_string($fileData['generic'])) {
            $this->default = $fileData['generic'];
        }

        $this->initialized = true;
    }
}
