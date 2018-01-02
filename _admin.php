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

if (!defined('DC_CONTEXT_ADMIN')) { return; }

// dead but useful code, in order to have translations
__('hscroll').__('Horizontal scrollbar');

$core->addBehavior('adminBlogPreferencesForm',array('hscrollBehaviors','adminBlogPreferencesForm'));
$core->addBehavior('adminBeforeBlogSettingsUpdate',array('hscrollBehaviors','adminBeforeBlogSettingsUpdate'));

class hscrollBehaviors
{
	private static function getNameAndId($nid,&$name,&$id)
	{
		if (is_array($nid)) {
			$name = $nid[0];
			$id = !empty($nid[1]) ? $nid[1] : null;
		} else {
			$name = $id = $nid;
		}
	}
	/**
	* HTML5 Color field
	*
	* Returns HTML code for an input color field. $nid could be a string or an array of
	* name and ID.
	*
	* @param string|array	$nid			Element ID and name
	* @param integer		$size		Element size
	* @param integer		$max			Element maxlength
	* @param string		$default		Element value
	* @param string		$class		Element class name
	* @param string		$tabindex		Element tabindex
	* @param boolean		$disabled		True if disabled
	* @param string		$extra_html	Extra HTML attributes
	*
	* @return string
	*/
	public static function color($nid, $size=7, $max=7, $default='', $class='', $tabindex='',
	$disabled=false, $extra_html='')
	{
		self::getNameAndId($nid,$name,$id);

		$res = '<input type="color" size="'.$size.'" name="'.$name.'" ';

		$res .= $id ? 'id="'.$id.'" ' : '';
		$res .= $max ? 'maxlength="'.$max.'" ' : '';
		$res .= $default || $default === '0' ? 'value="'.$default.'" ' : '';
		$res .= $class ? 'class="'.$class.'" ' : '';
		$res .= $tabindex ? 'tabindex="'.$tabindex.'" ' : '';
		$res .= $disabled ? 'disabled="disabled" ' : '';
		$res .= $extra_html;

		$res .= ' />';

		return $res;
	}

	public static function adminBlogPreferencesForm($core,$settings)
	{
		# Style options
		$styles = array(
			__("Top") => 'top',
			__("Bottom") => 'bottom'
		);

		$settings->addNameSpace('hscroll');
		$color = ($settings->hscroll->color ? : '#e9573f');

		echo
		'<div class="fieldset"><h4>hScroll</h4>'.

		'<p><label class="classic">'.
		form::checkbox('hscroll_enabled','1',$settings->hscroll->enabled).
		__('Enable horizontal scrollbar').'</label></p>'.

		'<h5>'.__('Options').'</h5>'.

		'<p><label for="hscroll_position" class="classic">'.__('Position:').'</label> '.
		form::combo('hscroll_position',$styles,$settings->hscroll->position).
		'</p>'.

		'<p><label for="hscroll_color" class="classic">'.__('Scrollbar color:').'</label> '.
		self::color('hscroll_color',7,7,$color).'</p>'.

		'<p><label for="hscroll_shadow" class="classic">'.
		form::checkbox('hscroll_shadow','1',$settings->hscroll->shadow).
		__('Add shadow to the scrollbar').'</label>'.'</p>'.

		'<p><label for="hscroll_single" class="classic">'.
		form::checkbox('hscroll_single','1',$settings->hscroll->single).
		__('Activate only in single entry context').'</label>'.'</p>'.

		'</div>';
	}

	public static function adminBeforeBlogSettingsUpdate($settings)
	{
		$settings->addNameSpace('hscroll');
		$settings->hscroll->put('enabled',!empty($_POST['hscroll_enabled']),'boolean');
		$settings->hscroll->put('position',$_POST['hscroll_position']);
		$settings->hscroll->put('color',$_POST['hscroll_color']);
		$settings->hscroll->put('shadow',!empty($_POST['hscroll_shadow']));
		$settings->hscroll->put('single',!empty($_POST['hscroll_single']));
	}
}
