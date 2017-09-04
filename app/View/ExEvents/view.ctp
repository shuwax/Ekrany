<div class="container">
<h2><?php echo __('Pracownik'); ?></h2>
	<dl>
		<dt><?php echo __('Id:'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Imie:'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nazwisko:'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pracodawca:'); ?></dt>
		<dd>
			<?php echo h($salon['Salon']['name']); ?>
			&nbsp;
		</dd>

	</dl>
</div>


