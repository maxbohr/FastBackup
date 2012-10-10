<div class="backups form">
<?php echo $this->Form->create('Backup'); ?>
	<div class="well">
		<h2><?php echo __('Add Backup'); ?></h2>
    </div>
    <table class="table table-striped table-bordered">
        <tr>
            <td><?php echo $this->Form->input('name'); ?></td>
        </tr>
		<tr>
            <td><?php echo $this->Form->input('path'); ?></td>
        </tr>
        <tr>
            <td><?php echo $this->Form->input('database'); ?></td>
        </tr>
        <tr>
            <td><?php echo $this->Form->input('backup_validity', array('default' => 7)); ?></td>
        </tr>
        <tr>
            <td><?php echo $this->Form->input('retention_period', array('default' => 999)); ?></td>
        </tr>
        <tr>
            <td><?php echo $this->Form->end(__('Submit')); ?></td>
        </tr>
    </table>
</div>
