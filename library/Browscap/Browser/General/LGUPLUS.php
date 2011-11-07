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
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */

use Browscap\Browser\Handler as BrowserHandler;

/**
 * LGPLUSUserAgentHandler
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
class LGUPLUS extends BrowserHandler
{
    protected $prefix = 'LGUPLUS';

    public function __construct($wurflContext, $userAgentNormalizer = null)
    {
        parent::__construct($wurflContext, $userAgentNormalizer);
    }

    /**
     *
     * @param string $userAgent
     * @return string
     */
    public function canHandle($userAgent)
    {
        return $this->utils->checkIfContainsAnyOf($userAgent, array('LGUPLUS', 'lgtelecom'));
    }

    
    /**
     *
     * @param string $userAgent
     * @return string
     */
    public function applyConclusiveMatch($userAgent)
    {
        return WURFL_Constants::GENERIC;
    }


    private $lgupluses = array(
        'generic_lguplus_rexos_facebook_browser' => array('Windows NT 5', 'POLARIS'),
        'generic_lguplus_rexos_webviewer_browser' => array('Windows NT 5'),
        'generic_lguplus_winmo_facebook_browser' => array('Windows CE', 'POLARIS'),
        'generic_lguplus_android_webkit_browser' => array('Android', 'AppleWebKit')
);

    public function applyRecoveryMatch($userAgent)
    {
        foreach($this->lgupluses as $deviceId => $values) {
            if($this->utils->checkIfContainsAll($userAgent, $values)) {
                return $deviceId;
            }
        }
        return 'generic_lguplus';
    }

}
