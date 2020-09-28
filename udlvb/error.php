<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.saplana
 *
 * @copyright   Copyright (C) 2019 Ordi Service All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentError $this */

$app  = JFactory::getApplication();
$user = JFactory::getUser();

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

include_once JPATH_THEMES . '/' . $this->template . '/lib/head.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">

<head>
	<meta charset="utf-8" />
	<title>
		<?php echo $this->title; ?>
		<?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
	</title>

</head>

<body>
	<!-- Body -->
	<div class="body">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<!-- Header -->
			<header class="header" role="banner">
				<nav>
					<jdoc:include type="modules" name="nav" />
				</nav>
			</header>
			
			<main>
			<!-- Begin Content -->
			<h1 class="page-header">
				<?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?>
			</h1>
			
			
			
			<p><strong>
					<?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
			<p>
				<?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?>
			</p>
			<ul>
				<li>
					<?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?>
				</li>
				<li>
					<?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?>
				</li>
				<li>
					<?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?>
				</li>
				<li>
					<?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?>
				</li>
			</ul>
		
			
			<?php if (JModuleHelper::getModule('mod_search')) : ?>
			<p><strong>
					<?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
			<p>
				<?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?>
			</p>
			<?php $module = JModuleHelper::getModule('mod_search'); ?>
			<?php echo JModuleHelper::renderModule($module); ?>
			<?php endif; ?>
			<p>
				<?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>
			</p>
			<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><span class="icon-home" aria-hidden="true"></span>
					<?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
		
		
			<hr />
			<p>
				<?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?>
			</p>
			<blockquote>
				<span class="label label-inverse">
					<?php echo $this->error->getCode(); ?></span>
				<?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?>
				<?php if ($this->debug) : ?>
				<br />
				<?php echo htmlspecialchars($this->error->getFile(), ENT_QUOTES, 'UTF-8');?>:
				<?php echo $this->error->getLine(); ?>
				<?php endif; ?>
			</blockquote>
			<?php if ($this->debug) : ?>
			<div>
				<?php echo $this->renderBacktrace(); ?>
				<?php // Check if there are more Exceptions and render their data as well ?>
				<?php if ($this->error->getPrevious()) : ?>
				<?php $loop = true; ?>
				<?php // Reference $this->_error here and in the loop as setError() assigns errors to this property and we need this for the backtrace to work correctly ?>
				<?php // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions ?>
				<?php $this->setError($this->_error->getPrevious()); ?>
				<?php while ($loop === true) : ?>
				<p><strong>
						<?php echo JText::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
				<p>
					<?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
					<br />
					<?php echo htmlspecialchars($this->_error->getFile(), ENT_QUOTES, 'UTF-8');?>:
					<?php echo $this->_error->getLine(); ?>
				</p>
				<?php echo $this->renderBacktrace(); ?>
				<?php $loop = $this->setError($this->_error->getPrevious()); ?>
				<?php endwhile; ?>
				<?php // Reset the main error object to the base error ?>
				<?php $this->setError($this->error); ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		
			<!-- End Content -->
			</main>
			<jdoc:include type="modules" name="debug" style="none" />
		
		
		</div>
	</div>
	<!-- Footer -->
	<div class="footer">

		<p class="pull-right">
			<a href="#top" id="back-top">
				<?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
			</a>
		</p>
		<p>
			&copy;
			<?php echo date('Y'); ?>
			<?php echo $sitename; ?>
		</p>
	
	</div>
	<?php echo $this->getBuffer('modules', 'debug', array('style' => 'none')); ?>
</body>

</html>