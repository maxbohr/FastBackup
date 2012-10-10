<div class="backups view">
<h2><?php  echo __('Backup'); ?><?php echo $this->Form->postLink(__('Create Backup'), array('action' => 'create_backup', $backup['Backup']['id']), array('class'=>'btn btn-primary pull-right'), __('This will take backup without checking validity. Proceed?')); ?></h2>
	<table class="table table-striped table-bordered">
		<tr>
            <th><?php echo __('Id'); ?></th>
            <td>
                <?php echo h($backup['Backup']['id']); ?>
                &nbsp;
            </td>
            <th><?php echo __('Name'); ?></th>
            <td>
                <?php echo h($backup['Backup']['name']); ?>
                &nbsp;
            </td>
        </tr>
		<tr>
            <th><?php echo __('Path'); ?></th>
            <td>
                <?php echo h($backup['Backup']['path']); ?>
                &nbsp;
            </td>
            <th><?php echo __('Database'); ?></th>
            <td>
                <?php echo h($backup['Backup']['database']); ?>
                &nbsp;
            </td>
        </tr>
		<tr>
            <th><?php echo __('Backup Validity'); ?></th>
            <td>
                <?php echo h($backup['Backup']['backup_validity']); ?>
                &nbsp;
            </td>
            <th><?php echo __('Retention Period'); ?></th>
            <td>
                <?php echo h($backup['Backup']['retention_period']); ?>
                &nbsp;
            </td>
        </tr>
	</table>
    <p>&nbsp;</p>
    <h3>Backup Files</h3>
	<table cellpadding="0" cellspacing="0">
        <? foreach ($backup['Backup']['files'] as $file): ?>
        <tr>
            <td><?= h($file); ?>&nbsp;</td>
        </tr>
        <?php endforeach; ?>
	</table>
    
</div>
