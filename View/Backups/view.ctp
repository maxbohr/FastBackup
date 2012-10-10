<div class="backups view">
<h2><?php  echo __('Backup'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($backup['Backup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($backup['Backup']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path'); ?></dt>
		<dd>
			<?php echo h($backup['Backup']['path']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Database'); ?></dt>
		<dd>
			<?php echo h($backup['Backup']['database']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Backup Validity'); ?></dt>
		<dd>
			<?php echo h($backup['Backup']['backup_validity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Retention Period'); ?></dt>
		<dd>
			<?php echo h($backup['Backup']['retention_period']); ?>
			&nbsp;
		</dd>
	</dl>
    <p>&nbsp;</p>
    <h3>Backup Files</h3>
	<table cellpadding="0" cellspacing="0">
        <? foreach ($backup['Backup']['files'] as $file): ?>
        <tr>
            <td><?= h($file); ?>&nbsp;</td>
        </tr>
        <?php endforeach; ?>
	</table>
    <?php echo $this->Form->postLink(__('Create Backup'), array('action' => 'create_backup', $backup['Backup']['id']), null, __('This will take backup without checking validity. Proceed?')); ?>
</div>
<?= $this->element('actions') ?>
