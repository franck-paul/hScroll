<?php
namespace plugins\hscroll;

# -- BEGIN LICENSE BLOCK ----------------------------------
# This file is part of bigfoot, a plugin for Dotclear 2.
#
# Copyright (c) Franck Paul and contributors
#
# Licensed under the GPL version 2.0 license.
# A copy of this license is available in LICENSE file or at
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
# -- END LICENSE BLOCK ------------------------------------

if (!defined('DC_CONTEXT_ADMIN')) {return;}

// dead but useful code, in order to have translations
__('hscroll') . __('Horizontal scrollbar');

$core->addBehavior('adminBlogPreferencesForm', array(__NAMESPACE__ . '\hscrollBehaviors', 'adminBlogPreferencesForm'));
$core->addBehavior('adminBeforeBlogSettingsUpdate', array(__NAMESPACE__ . '\hscrollBehaviors', 'adminBeforeBlogSettingsUpdate'));

class hscrollBehaviors
{
    public static function adminBlogPreferencesForm($core, $settings)
    {
        # Style options
        $styles = array(
            __("Top")    => 'top',
            __("Bottom") => 'bottom'
        );

        $settings->addNameSpace('hscroll');
        $color = ($settings->hscroll->color ?: '#e9573f');

        echo
        '<div class="fieldset"><h4>hScroll</h4>' .

        '<p><label class="classic">' .
        \form::checkbox('hscroll_enabled', '1', $settings->hscroll->enabled) .
        __('Enable horizontal scrollbar') . '</label></p>' .

        '<h5>' . __('Options') . '</h5>' .

        '<p><label for="hscroll_position" class="classic">' . __('Position:') . '</label> ' .
        \form::combo('hscroll_position', $styles, $settings->hscroll->position) .
        '</p>' .

        '<p><label for="hscroll_offset" class="classic">' . __('Offset position (in pixels):') . '</label> ' .
        \form::number('hscroll_offset', array('default' => $settings->hscroll->offset)) .
        '</p>' .

        '<p><label for="hscroll_color" class="classic">' . __('Scrollbar color:') . '</label> ' .
        \form::color('hscroll_color', array('default' => $color)) . '</p>' .

        '<p><label for="hscroll_shadow" class="classic">' .
        \form::checkbox('hscroll_shadow', '1', $settings->hscroll->shadow) .
        __('Add shadow to the scrollbar') . '</label>' . '</p>' .

        '<p><label for="hscroll_single" class="classic">' .
        \form::checkbox('hscroll_single', '1', $settings->hscroll->single) .
        __('Activate only in single entry context') . '</label>' . '</p>' .

            '</div>';
    }

    public static function adminBeforeBlogSettingsUpdate($settings)
    {
        $settings->addNameSpace('hscroll');
        $settings->hscroll->put('enabled', !empty($_POST['hscroll_enabled']), 'boolean');
        $settings->hscroll->put('position', $_POST['hscroll_position']);
        $settings->hscroll->put('offset', (integer) $_POST['hscroll_offset']);
        $settings->hscroll->put('color', $_POST['hscroll_color']);
        $settings->hscroll->put('shadow', !empty($_POST['hscroll_shadow']));
        $settings->hscroll->put('single', !empty($_POST['hscroll_single']));
    }
}
