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

        if (!$settings->getBool('enabled')) {
            return '';
        }

        if ($settings->getBool('single', false)) {
            // Single mode only, check if post/page context
            $urlTypes = ['post'];
            if (App::plugins()->moduleExists('pages')) {
                $urlTypes[] = 'pages';
            }

            if (!in_array(App::url()->getType(), $urlTypes)) {
                return '';
            }
        }

        $position   = $settings->getStr('position', false) ?: 'top';
        $color      = $settings->getStr('color', false) ?: '#e9573f';
        $color_dark = $settings->getStr('color_dark', false) ?: '#e9573f';
        $offset     = $settings->getInt('offset', false);
        $width      = $settings->getInt('width', false) ?: 4;
        $shadow     = $settings->getBool('shadow', false);

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

        if (!$settings->getBool('enabled')) {
            return '';
        }

        if ($settings->getBool('single', false)) {
            // Single mode only, check if post/page context
            $urlTypes = ['post'];
            if (App::plugins()->moduleExists('pages')) {
                $urlTypes[] = 'pages';
            }

            if (!in_array(App::url()->getType(), $urlTypes)) {
                return '';
            }
        }

        $position = $settings->getStr('position', false) ?: 'top';

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
