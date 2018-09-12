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

namespace plugins\hscroll;

if (!defined('DC_RC_PATH')) {return;}

$core->addBehavior('publicHeadContent', [__NAMESPACE__ . '\hscrollPublic', 'publicHeadContent']);
$core->addBehavior('publicFooterContent', [__NAMESPACE__ . '\hscrollPublic', 'publicFooterContent']);

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
            $urlTypes = ['post'];
            if ($core->plugins->moduleExists('pages')) {
                $urlTypes[] = 'page';
            }
            if (!in_array($core->url->type, $urlTypes)) {
                return;
            }
        }

        $position = $core->blog->settings->hscroll->position;
        if (!in_array($position, ['top', 'bottom', 'user'])) {
            $style = 'top';
        }
        $offset = (integer) $core->blog->settings->hscroll->offset;

        echo
        \dcUtils::jsVars([
            'hscroll_color'  => ($core->blog->settings->hscroll->color ?: '#e9573f'),
            'hscroll_top'    => ($core->blog->settings->hscroll->position == 'top' ? "$offset" . 'px' : 'unset'),
            'hscroll_bottom' => ($core->blog->settings->hscroll->position == 'bottom' ? "$offset" . 'px' : 'unset'),
            'hscroll_shadow' => ($core->blog->settings->hscroll->shadow ? '1' : '0')
        ]) .
        \dcUtils::jsLoad($core->blog->getPF('hScroll/js/cssvar.js')) .
        \dcUtils::cssLoad($core->blog->getPF('hScroll/css/hscroll.css'));
    }

    public static function publicFooterContent($core)
    {
        $core->blog->settings->addNameSpace('hscroll');
        if (!$core->blog->settings->hscroll->enabled) {
            return;
        }

        if ($core->blog->settings->hscroll->single) {
            // Single mode only, check if post/page context
            $urlTypes = ['post'];
            if ($core->plugins->moduleExists('pages')) {
                $urlTypes[] = 'page';
            }
            if (!in_array($core->url->type, $urlTypes)) {
                return;
            }
        }

        echo
        '<div id="hscroll-bar"><div id="hscroll-bar-inner"></div></div>' . "\n" .
        \dcUtils::jsLoad($core->blog->getPF('hScroll/js/hscroll.js'));
    }
}
