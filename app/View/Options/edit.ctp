<div class="options form">
<?php echo $this->Form->create('Option'); ?>
	<div class="well">
		<h2><?php echo __('Edit Option'); ?></h2>
	<table class="table table-bordered">
        <tr>
            <th><?php echo $this->Form->input('target_path'); ?></th>    
        </tr>
        <tr>
            <th><?php echo $this->Form->input('db_user'); ?></th>    
        </tr>
        <tr>
            <th><?php echo $this->Form->input('db_pass'); ?></th>    
        </tr>
        <tr>
            <th><?php echo $this->Form->input('backup_key'); ?></th>    
        </tr>
        <tr>
            <td><?php echo $this->Form->end(__('Submit')); ?></td>
        </tr>
    </table>
</div>