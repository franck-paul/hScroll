<?php

/**
 * @brief hScroll, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul contact@open-time.net
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
declare(strict_types=1);

namespace Dotclear\Plugin\hScroll;

use Dotclear\App;
use Dotclear\Helper\Html\Form\Div;
use Dotclear\Helper\Html\Html;

class FrontendBehaviors
{
    public static function publicHeadContent(): string
    {
        $settings = My::settings();

        if (!$settings->enabled) {
            return '';
        }

        // Variable data helpers
        $_Bool = fn (mixed $var): bool => (bool) $var;
        $_Int  = fn (mixed $var, int $default = 0): int => $var !== null && is_numeric($val = $var) ? (int) $val : $default;
        $_Str  = fn (mixed $var, string $default = ''): string => $var !== null && is_string($val = $var) ? $val : $default;

        if ($_Bool($settings->single)) {
            // Single mode only, check if post/page context
            $urlTypes = ['post'];
            if (App::plugins()->moduleExists('pages')) {
                $urlTypes[] = 'pages';
            }

            if (!in_array(App::url()->getType(), $urlTypes)) {
                return '';
            }
        }

        $position   = $_Str($settings->position, 'top');
        $color      = $_Str($settings->color, '#e9573f');
        $color_dark = $_Str($settings->color_dark, '#e9573f');
        $offset     = $_Int($settings->offset);
        $width      = $_Int($settings->width, 4);
        $shadow     = $_Bool($settings->shadow);

        if (!in_array($position, ['top', 'bottom', 'left', 'right'], true)) {
            $position = 'top';
        }

        echo Html::jsJson('hscroll', [
            'color'      => $color,
            'color_dark' => $color_dark,
            'top'        => $position !== 'bottom' ? $offset . 'px' : 'unset',
            'bottom'     => $position === 'bottom' ? $offset . 'px' : 'unset',
            'left'       => $position === 'left' ? $offset . 'px' : 'unset',
            'right'      => $position === 'right' ? $offset . 'px' : 'unset',
            'vertical'   => $position === 'left' || $position === 'right',
            'shadow'     => $shadow,
            'position'   => $position,
            'width'      => $width . 'px',
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

        // Variable data helpers
        $_Bool = fn (mixed $var): bool => (bool) $var;
        $_Str  = fn (mixed $var, string $default = ''): string => $var !== null && is_string($val = $var) ? $val : $default;

        if ($_Bool($settings->single)) {
            // Single mode only, check if post/page context
            $urlTypes = ['post'];
            if (App::plugins()->moduleExists('pages')) {
                $urlTypes[] = 'pages';
            }

            if (!in_array(App::url()->getType(), $urlTypes)) {
                return '';
            }
        }

        $position = $_Str($settings->position, 'top');

        echo (new Div('hscroll-bar'))
            ->class($position === 'left' || $position === 'right' ? 'vertical' : '')
            ->items([
                (new Div('hscroll-bar-inner')),
            ])
        ->render() .
        My::jsLoad('hscroll.js');

        return '';
    }
}
