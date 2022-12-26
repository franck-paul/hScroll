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

namespace Dotclear\Plugins\hScroll;

use dcCore;
use dcUtils;

if (!defined('DC_RC_PATH')) {
    return;
}

dcCore::app()->addBehaviors([
    'publicHeadContent'   => [__NAMESPACE__ . '\hscrollPublic', 'publicHeadContent'],
    'publicFooterContent' => [__NAMESPACE__ . '\hscrollPublic', 'publicFooterContent'],
]);

class hscrollPublic
{
    public static function publicHeadContent()
    {
        if (!dcCore::app()->blog->settings->hscroll->enabled) {
            return;
        }

        if (dcCore::app()->blog->settings->hscroll->single) {
            // Single mode only, check if post/page context
            $urlTypes = ['post'];
            if (dcCore::app()->plugins->moduleExists('pages')) {
                $urlTypes[] = 'page';
            }
            if (!in_array(dcCore::app()->url->type, $urlTypes)) {
                return;
            }
        }

        $position = dcCore::app()->blog->settings->hscroll->position;
        if (!in_array($position, ['top', 'bottom', 'user'])) {
            $position = 'top';
        }
        $offset = (int) dcCore::app()->blog->settings->hscroll->offset;

        echo dcUtils::jsJson('hscroll', [
            'color'  => (dcCore::app()->blog->settings->hscroll->color ?: '#e9573f'),
            'top'    => ($position == 'top' ? "$offset" . 'px' : 'unset'),
            'bottom' => ($position == 'bottom' ? "$offset" . 'px' : 'unset'),
            'shadow' => (dcCore::app()->blog->settings->hscroll->shadow ? '1' : '0'),
        ]);

        echo
        dcUtils::jsModuleLoad('util.js') .
        dcUtils::jsModuleLoad('hScroll/js/cssvar.js') .
        dcUtils::cssModuleLoad('hScroll/css/hscroll.css');
    }

    public static function publicFooterContent()
    {
        if (!dcCore::app()->blog->settings->hscroll->enabled) {
            return;
        }

        if (dcCore::app()->blog->settings->hscroll->single) {
            // Single mode only, check if post/page context
            $urlTypes = ['post'];
            if (dcCore::app()->plugins->moduleExists('pages')) {
                $urlTypes[] = 'page';
            }
            if (!in_array(dcCore::app()->url->type, $urlTypes)) {
                return;
            }
        }

        echo
        '<div id="hscroll-bar"><div id="hscroll-bar-inner"></div></div>' . "\n" .
        dcUtils::jsModuleLoad('hScroll/js/hscroll.js');
    }
}
