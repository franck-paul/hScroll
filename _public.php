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

$core->addBehavior('publicHeadContent', array('hscrollPublic', 'publicHeadContent'));
$core->addBehavior('publicFooterContent', array('hscrollPublic', 'publicFooterContent'));

class hscrollPublic
{
    public static function publicHeadContent($core)
    {
        $core->blog->settings->addNameSpace('hscroll');
        if (!$core->blog->settings->hscroll->enabled) {
            return;
        }

        if ($core->blog->settings->hscroll->single) {
            // Single mode only, check if post/page context
            $urlTypes = array('post');
            if ($core->plugins->moduleExists('pages')) {
                $urlTypes[] = 'page';
            }
            if (!in_array($core->url->type, $urlTypes)) {
                return;
            }
        }

        $position = $core->blog->settings->hscroll->position;
        if (!in_array($position, array('top', 'bottom', 'user'))) {
            $style = 'top';
        }
        $offset = (integer) $core->blog->settings->hscroll->offset;

        echo
        dcUtils::jsVars(array(
            'hscroll_color'  => ($core->blog->settings->hscroll->color ?: '#e9573f'),
            'hscroll_top'    => ($core->blog->settings->hscroll->position == 'top' ? "$offset" . 'px' : 'unset'),
            'hscroll_bottom' => ($core->blog->settings->hscroll->position == 'bottom' ? "$offset" . 'px' : 'unset'),
            'hscroll_shadow' => ($core->blog->settings->hscroll->shadow ? '1' : '0')
        )) .
        dcUtils::jsLoad($core->blog->getPF('hScroll/js/cssvar.js')) .
        dcUtils::cssLoad($core->blog->getPF('hScroll/css/hscroll.css'));
    }

    public static function publicFooterContent($core)
    {
        $core->blog->settings->addNameSpace('hscroll');
        if (!$core->blog->settings->hscroll->enabled) {
            return;
        }

        if ($core->blog->settings->hscroll->single) {
            // Single mode only, check if post/page context
            $urlTypes = array('post');
            if ($core->plugins->moduleExists('pages')) {
                $urlTypes[] = 'page';
            }
            if (!in_array($core->url->type, $urlTypes)) {
                return;
            }
        }

        echo
        '<div id="hscroll-bar"><div id="hscroll-bar-inner"></div></div>' . "\n" .
        dcUtils::jsLoad($core->blog->getPF('hScroll/js/hscroll.js'));
    }
}
