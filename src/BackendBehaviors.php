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
            __('Top')    => 'top',
            __('Bottom') => 'bottom',
        ];

        $color = ($settings->color ?: '#e9573f');

        // Add fieldset for plugin options
        echo
        (new Fieldset('hscroll'))
        ->legend((new Legend(__('hScroll'))))
        ->fields([
            (new Para())->items([
                (new Checkbox('hscroll_enabled', (bool) $settings->enabled))
                    ->value(1)
                    ->label((new Label(__('Enable horizontal scrollbar'), Label::INSIDE_TEXT_AFTER))),
            ]),
            (new Text('h5', __('Options'))),
            (new Para())->items([
                (new Select('hscroll_position'))
                    ->items($styles)
                    ->default($settings->position),
            ]),
            (new Para())->items([
                (new Number('hscroll_offset', 0, 9_999, (int) $settings->offset))
                    ->label((new Label(__('Offset position (in pixels):'), Label::INSIDE_TEXT_BEFORE))),
            ]),
            (new Para())->items([
                (new Color('hscroll_color', $color))
                    ->label((new Label(__('Scrollbar color:'), Label::INSIDE_TEXT_BEFORE))),
            ]),
            (new Para())->items([
                (new Checkbox('hscroll_shadow', (bool) $settings->shadow))
                    ->value(1)
                    ->label((new Label(__('Add shadow to the scrollbar'), Label::INSIDE_TEXT_AFTER))),
            ]),
            (new Para())->items([
                (new Checkbox('hscroll_single', (bool) $settings->single))
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

        $settings->put('enabled', !empty($_POST['hscroll_enabled']), App::blogWorkspace()::NS_BOOL);
        $settings->put('position', $_POST['hscroll_position'], App::blogWorkspace()::NS_STRING);
        $settings->put('offset', (int) $_POST['hscroll_offset'], App::blogWorkspace()::NS_INT);
        $settings->put('color', $_POST['hscroll_color'], App::blogWorkspace()::NS_STRING);
        $settings->put('shadow', !empty($_POST['hscroll_shadow']), App::blogWorkspace()::NS_BOOL);
        $settings->put('single', !empty($_POST['hscroll_single']), App::blogWorkspace()::NS_BOOL);

        return '';
    }
}
