<?php
/**
 * @brief hScroll, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul carnet.franck.paul@gmail.com
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
declare(strict_types=1);

namespace Dotclear\Plugin\hScroll;

use dcCore;
use dcUtils;
use Dotclear\App;

class FrontendBehaviors
{
    public static function publicHeadContent(): string
    {
        $settings = My::settings();

        if (!$settings->enabled) {
            return '';
        }

        if ($settings->single) {
            // Single mode only, check if post/page context
            $urlTypes = ['post'];
            if (dcCore::app()->plugins->moduleExists('pages')) {
                $urlTypes[] = 'page';
            }
            if (!in_array(dcCore::app()->url->type, $urlTypes)) {
                return '';
            }
        }

        $position = $settings->position;
        if (!in_array($position, ['top', 'bottom', 'user'])) {
            $position = 'top';
        }
        $offset = (int) $settings->offset;

        echo dcUtils::jsJson('hscroll', [
            'color'  => ($settings->color ?: '#e9573f'),
            'top'    => ($position == 'top' ? "$offset" . 'px' : 'unset'),
            'bottom' => ($position == 'bottom' ? "$offset" . 'px' : 'unset'),
            'shadow' => ($settings->shadow ? '1' : '0'),
        ]);

        echo
        dcUtils::jsLoad(App::blog()->getPF('util.js')) .
        My::jsLoad('cssvar.js') .
        My::cssLoad('hscroll.css');

        return '';
    }

    public static function publicFooterContent(): string
    {
        $settings = My::settings();

        if (!$settings->enabled) {
            return '';
        }

        if ($settings->single) {
            // Single mode only, check if post/page context
            $urlTypes = ['post'];
            if (dcCore::app()->plugins->moduleExists('pages')) {
                $urlTypes[] = 'page';
            }
            if (!in_array(dcCore::app()->url->type, $urlTypes)) {
                return '';
            }
        }

        echo
        '<div id="hscroll-bar"><div id="hscroll-bar-inner"></div></div>' . "\n" .
        My::jsLoad('hscroll.js');

        return '';
    }
}
