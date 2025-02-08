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

use Dotclear\App;
use Dotclear\Helper\Html\Html;

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
            if (App::plugins()->moduleExists('pages')) {
                $urlTypes[] = 'page';
            }

            if (!in_array(App::url()->getType(), $urlTypes)) {
                return '';
            }
        }

        $position = $settings->position;
        if (!in_array($position, ['top', 'bottom', 'user'])) {
            $position = 'top';
        }

        echo Html::jsJson('hscroll', [
            'color'  => $settings->color ?: '#e9573f',
            'top'    => $position == 'top' ? $settings->offset . 'px' : 'unset',
            'bottom' => $position == 'bottom' ? $settings->offset . 'px' : 'unset',
            'shadow' => $settings->shadow,
        ]);

        echo
        App::plugins()->jsLoad(App::blog()->getPF('util.js')) .
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
            if (App::plugins()->moduleExists('pages')) {
                $urlTypes[] = 'page';
            }

            if (!in_array(App::url()->getType(), $urlTypes)) {
                return '';
            }
        }

        echo
        '<div id="hscroll-bar"><div id="hscroll-bar-inner"></div></div>' . "\n" .
        My::jsLoad('hscroll.js');

        return '';
    }
}
