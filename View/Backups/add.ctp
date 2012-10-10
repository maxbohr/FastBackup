<div class="backups form">
<?php echo $this->Form->create('Backup'); ?>
	<fieldset>
		<legend><?php echo __('Add Backup'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('path');
		echo $this->Form->input('database');
		echo $this->Form->input('backup_validity', array('default' => 7));
		echo $this->Form->input('retention_period', array('default' => 999));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?= $this->element('actions') ?>
