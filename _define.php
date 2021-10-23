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
if (!defined('DC_RC_PATH')) {
    return;
}

$this->registerModule(
    'hscroll',                      // Name
    'Horizontal scrollbar',         // Description
    'Franck Paul and contributors', // Author
    '0.3',                          // Version
    [
        'requires'    => [['core', '2.17']],
        'permissions' => 'admin',
        'type'        => 'plugin',
        'settings'    => [
            'blog' => '#params.hscroll'
        ],

        'details'    => 'https://open-time.net/?q=hscroll',       // Details URL
        'support'    => 'https://github.com/franck-paul/hscroll', // Support URL
        'repository' => 'https://raw.githubusercontent.com/franck-paul/hscroll/main/dcstore.xml'
    ]
);
