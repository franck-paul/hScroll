<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
# This file is part of bigfoot, a plugin for Dotclear 2.
#
# Copyright (c) Franck Paul and contributors
#
# Licensed under the GPL version 2.0 license.
# A copy of this license is available in LICENSE file or at
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
# -- END LICENSE BLOCK ------------------------------------

if (!defined('DC_RC_PATH')) {return;}

$this->registerModule(
    "hscroll",                      // Name
    "Horizontal scrollbar",         // Description
    "Franck Paul and contributors", // Author
    '0.2',                          // Version
    array(
        'requires'    => array(array('core', '2.14')),
        'permissions' => 'admin',
        'support'     => 'https://open-time.net/?q=hscroll',
        'type'        => 'plugin'
    )
);
