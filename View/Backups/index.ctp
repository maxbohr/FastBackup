<div class="backups index">
	<h2><?php echo __('Backups'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('path'); ?></th>
			<th><?php echo $this->Paginator->sort('database'); ?></th>
			<th><?php echo $this->Paginator->sort('backup_validity'); ?></th>
			<th><?php echo $this->Paginator->sort('retention_period'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($backups as $backup): ?>
	<tr>
		<td><?php echo h($backup['Backup']['id']); ?>&nbsp;</td>
        <td>
            <?= $this->Html->link(__($backup['Backup']['name']), array('action' => 'view', $backup['Backup']['id'])) ?>
        </td>
		<td><?php echo h($backup['Backup']['path']); ?>&nbsp;</td>
		<td><?php echo h($backup['Backup']['database']); ?>&nbsp;</td>
		<td><?php echo h($backup['Backup']['backup_validity']); ?>&nbsp;</td>
		<td><?php echo h($backup['Backup']['retention_period']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $backup['Backup']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $backup['Backup']['id']), null, __('Are you sure you want to delete # %s?', $backup['Backup']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<?= $this->element('actions') ?>
