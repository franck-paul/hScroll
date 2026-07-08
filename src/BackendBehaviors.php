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
use Dotclear\Helper\Html\Form\Checkbox;
use Dotclear\Helper\Html\Form\Color;
use Dotclear\Helper\Html\Form\Fieldset;
use Dotclear\Helper\Html\Form\Label;
use Dotclear\Helper\Html\Form\Legend;
use Dotclear\Helper\Html\Form\Number;
use Dotclear\Helper\Html\Form\Para;
use Dotclear\Helper\Html\Form\Select;
use Dotclear\Helper\Html\Form\Text;

class BackendBehaviors
{
    public static function adminBlogPreferencesForm(): string
    {
        $settings = My::settings();

        # Style options
        $styles = [
            __('At top')    => 'top',
            __('At bottom') => 'bottom',
            __('At left')   => 'left',
            __('At right')  => 'right',
        ];

        $position   = $settings->getStr('position', false) ?: 'top';
        $color      = $settings->getStr('color', false) ?: '#e9573f';
        $color_dark = $settings->getStr('color_dark', false) ?: '#e9573f';
        $offset     = $settings->getInt('offset', false);
        $width      = $settings->getInt('width', false) ?: 4;
        $shadow     = $settings->getBool('shadow', false);
        $single     = $settings->getBool('single', false);

        // Add fieldset for plugin options
        echo
        (new Fieldset('hscroll'))
        ->legend((new Legend(__('hScroll'))))
        ->fields([
            (new Para())->items([
                (new Checkbox('hscroll_enabled', $settings->getBool('enabled', false)))
                    ->value(1)
                    ->label((new Label(__('Enable horizontal or vertical reading scrollbar'), Label::INSIDE_TEXT_AFTER))),
            ]),
            (new Text('h5', __('Options'))),
            (new Para())->items([
                (new Select('hscroll_position'))
                    ->items($styles)
                    ->default($position)
                    ->label((new Label(__('Position:'), Label::INSIDE_TEXT_BEFORE))),
            ]),
            (new Para())->items([
                (new Number('hscroll_offset', 0, 9_999, $offset))
                    ->label((new Label(__('Offset position (in pixels):'), Label::INSIDE_TEXT_BEFORE))),
            ]),
            (new Para())->items([
                (new Number('hscroll_width', 1, 99, $width))
                    ->label((new Label(__('Scrollbar width (in pixels):'), Label::INSIDE_TEXT_BEFORE))),
            ]),
            (new Para())->items([
                (new Color('hscroll_color', $color))
                    ->label((new Label(__('Scrollbar color (light mode):'), Label::INSIDE_TEXT_BEFORE))),
            ]),
            (new Para())->items([
                (new Color('hscroll_color_dark', $color_dark))
                    ->label((new Label(__('Scrollbar color (dark mode):'), Label::INSIDE_TEXT_BEFORE))),
            ]),
            (new Para())->items([
                (new Checkbox('hscroll_shadow', $shadow))
                    ->value(1)
                    ->label((new Label(__('Add shadow to the scrollbar'), Label::INSIDE_TEXT_AFTER))),
            ]),
            (new Para())->items([
                (new Checkbox('hscroll_single', $single))
                    ->value(1)
                    ->label((new Label(__('Activate only in single entry context'), Label::INSIDE_TEXT_AFTER))),
            ]),
        ])
        ->render();

        return '';
    }

    public static function adminBeforeBlogSettingsUpdate(): string
    {
        $settings = My::settings();

        // Post data helpers
        $_Bool = fn (string $name): bool => !empty($_POST[$name]);
        $_Int  = fn (string $name, int $default = 0): int => isset($_POST[$name]) && is_numeric($val = $_POST[$name]) ? (int) $val : $default;
        $_Str  = fn (string $name, string $default = ''): string => isset($_POST[$name]) && is_string($val = $_POST[$name]) ? $val : $default;

        $settings->put('enabled', $_Bool('hscroll_enabled'), App::blogWorkspace()::NS_BOOL);
        $settings->put('position', $_Str('hscroll_position'), App::blogWorkspace()::NS_STRING);
        $settings->put('offset', $_Int('hscroll_offset'), App::blogWorkspace()::NS_INT);
        $settings->put('width', $_Int('hscroll_width'), App::blogWorkspace()::NS_INT);
        $settings->put('color', $_Str('hscroll_color'), App::blogWorkspace()::NS_STRING);
        $settings->put('color_dark', $_Str('hscroll_color_dark'), App::blogWorkspace()::NS_STRING);
        $settings->put('shadow', $_Bool('hscroll_shadow'), App::blogWorkspace()::NS_BOOL);
        $settings->put('single', $_Bool('hscroll_single'), App::blogWorkspace()::NS_BOOL);

        return '';
    }
}
