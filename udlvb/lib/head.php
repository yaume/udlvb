<?php
/**
* @package Joomla.Site
* @subpackage Templates.udlvb
* @version 1.0.2
* @author Guillaume
* @copyright (C) 2020- Guillaume Singlan
* @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
$app 		= JFactory::getApplication();
$pageParams  	= $app->getParams();
$sitename	= $app->getCfg('sitename');
$title = $this->getTitle();
$doc = JFactory::getDocument();
$base = $this->baseurl;
$template = 'templates/'.$this->template;
// Change generator tag
$this->setGenerator('');
// get html head data
$head = $doc->getHeadData();
$doc->setHtml5(true);
$doc->setMetadata('viewport', 'width=device-width, initial-scale=1');
$doc->setMetadata('charset','UTF-8');
// Copyrights
$doc->setMetadata('copyright', htmlspecialchars($app->getCfg('sitename')));
// get html head data
$head = $doc->getHeadData();
// remove deprecated meta-data (html5)
unset($head['metaTags']['http-equiv']);
unset($head['metaTags']['standard']['title']);
unset($head['metaTags']['standard']['rights']);
unset($head['metaTags']['standard']['language']);
$doc->setHeadData($head);

//Add your styles
$doc->addStyleSheet($template . '/css/udlvb.css');