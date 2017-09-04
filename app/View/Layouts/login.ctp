<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Administrator | <?php echo $title_for_layout; ?></title>
	<?php
	echo $this->fetch('meta');
	echo $this->Html->css(array('bootstrap.min'));
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<body>
<div id="container">
	<?php echo $this->Html->script('jquery-2.2.1');?>

	<?php echo $this->Element('login');?>
	<div id="content">

		<?php echo $this->Flash->render(); ?>
		<?php echo $this->fetch('content'); ?>
	</div>



	<div id="footer">
		<?php //echo $this->Element('footer');?>
	</div>

</div>
<?php echo $this->Js->writeBuffer();?>
</body>
</html>