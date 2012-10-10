<div class="options index">
    <div class="well">
        <h2><?php echo __('Options'); ?></h2>    
    </div>
	<table class="table table-striped table-bordered">
        <tr>
            <th>Target Path</th>
            <td><?php echo h($options[0]['Option']['target_path']); ?>&nbsp;</td>
        </tr>
        <tr>
            <th>Database Backup User</th>
            <td><?php echo h($options[0]['Option']['db_user']); ?>&nbsp;</td>
        </tr>
        <tr>
            <th>Backup User Password</th>
            <td><?php echo h($options[0]['Option']['db_pass']); ?>&nbsp;</td>
        </tr>
        <tr>
            <th>Backup Key</th>
            <td><?php echo h($options[0]['Option']['backup_key']); ?>&nbsp;</td>
        </tr>
        <tr>
            <th class="actions"><?php echo __('Actions'); ?></th>
            <td><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $options[0]['Option']['id']),array('class'=>'btn btn-warning')); ?></td>
        </tr>
    </table>
</div>