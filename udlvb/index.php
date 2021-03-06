<?php
/**
 * @package Joomla.Site
 * @subpackage  Templates.udlvb
 * @version 1.0.2
 * @author Guillaume
 * @copyright (C) 2020- Guillaume Singlan
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;
// Chargement du framework
include_once JPATH_THEMES . '/' . $this->template . '/lib/head.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">

<head>
    <jdoc:include type="head" />
</head>

<body>
    <header class="title-bar">
        <div class="title-bar-left show-for-large">
            <a href="<?php echo $base;?>"><img src="<?php echo $template;?>/img/udlvb.svg"></a>
            <a href="<?php echo $base;?>"><img src="<?php echo $template;?>/img/universite.svg"></a>
    </div>
        <div class="title-bar-center hide-for-large"><img src="<?php echo $template;?>/img/universite.svg"></div>
        <div class="title-bar-right">
            <button class="menu-icon hide-for-large" type="button" data-toggle="nav"></button>
            <nav class="show-for-large">
            <ul class="menu">
                <jdoc:include type="modules" name="header"/>
            </ul>
        </nav>
        </div>
        <nav class="off-canvas position-right  hide-for-large" id="nav" data-off-canvas>
            <button class="close-button" aria-label="Close menu" type="button" data-close>
                <span aria-hidden="true">&times;</span>
            </button>

            <ul class="menu vertical">
                <jdoc:include type="modules" name="header" />
            </ul>

        </nav>
    </header>
    <main class="off-canvas-content" data-off-canvas-content>
        <jdoc:include type="message" />
        <jdoc:include type="component" />
        <jdoc:include type="modules" name="search" />
    </main>
    <footer>

        <jdoc:include type="modules" name="footer_right" />
        <jdoc:include type="modules" name="footer_center" />
        <jdoc:include type="modules" name="footer_left" />
    </footer>
    <jdoc:include type="modules" name="debug" />
    <script src="/templates/udlvb/js/udlvb.js"></script>
</body>

</html>