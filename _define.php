<?php
/**
 * @brief hscroll, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul carnet.franck.paul@gmail.com
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('DC_RC_PATH')) {return;}

$this->registerModule(
    "hscroll",                      // Name
    "Horizontal scrollbar",         // Description
    "Franck Paul and contributors", // Author
    '0.2',                          // Version
    [
        'requires'    => [['core', '2.15']],
        'permissions' => 'admin',
        'support'     => 'https://open-time.net/?q=hscroll',
        'type'        => 'plugin'
    ]
);
