<?php
declare(ENCODING = 'utf-8');
namespace Browscap\Browser\General;

/**
 * Copyright(c) 2011 ScientiaMobile, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or(at your option) any later version.
 *
 * Refer to the COPYING file distributed with this package.
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */

use Browscap\Browser\Handler as BrowserHandler;

/**
 * KyoceraUserAgentHandler
 * 
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
class Kyocera extends BrowserHandler
{
    public function __construct($wurflContext, $userAgentNormalizer = null)
    {
        parent::__construct($wurflContext, $userAgentNormalizer);
    }
    
    /**
     * Intercept all UAs starting with either 
     * 'kyocera', 'QC-' or 'KWC-'
     *
     * @param string $userAgent
     * @return boolean
     */
    public function canHandle($userAgent)
    {
        return $this->utils->checkIfStartsWith($userAgent, 'kyocera') || $this->utils->checkIfStartsWith($userAgent, 'QC-') || $this->utils->checkIfStartsWith($userAgent, 'KWC-');
    }
    
    protected $prefix = 'KYOCERA';
}
