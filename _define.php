<?php

/**
 * @brief hscroll, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul contact@open-time.net
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
$this->registerModule(
    'hScroll',
    'Horizontal or vertical reading scrollbar',
    'Franck Paul and contributors',
    '6.0',
    [
        'date'        => '2026-08-03T10:00:16+0200',
        'requires'    => [['core', '2.39']],
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
