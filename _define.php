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
$this->registerModule(
    'hscroll',
    'Horizontal scrollbar',
    'Franck Paul and contributors',
    '4.6',
    [
        'date'        => '2025-07-21T13:41:54+0200',
        'requires'    => [['core', '2.28']],
        'permissions' => 'My',
        'type'        => 'plugin',
        'settings'    => [
            'blog' => '#params.hscroll',
        ],

        'details'    => 'https://open-time.net/?q=hscroll',
        'support'    => 'https://github.com/franck-paul/hscroll',
        'repository' => 'https://raw.githubusercontent.com/franck-paul/hscroll/main/dcstore.xml',
        'license'    => 'gpl2',
    ]
);
