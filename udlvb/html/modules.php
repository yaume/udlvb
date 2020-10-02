<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.udlvb
 *
 * @copyright   Copyright (C) 2020 Ordi Service All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

function modChrome_menu($module, &$params, &$attribs)
{ 
	
	echo $module->content;

}
function modChrome_footer_menu($module, &$params, &$attribs)
{ 
	echo '<nav class="footer-navbar">';
	echo $module->content;
	echo '</nav>';

}
