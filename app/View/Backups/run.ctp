<div class="backups index">
	<h2><?php echo __('Backup Results'); ?></h2>
	<table class="table table-bordered">
        <? foreach ($backup_results as $backup): ?>
        <tr>
            <td><?php echo h($backup['Backup']['id']); ?>&nbsp;</td>
            <td>
                <?= $this->Html->link(__($backup['Backup']['name']), array('action' => 'view', $backup['Backup']['id'])) ?>
            </td>
            <td><?php echo h($backup['Backup']['path']); ?>&nbsp;</td>
            <td><?php echo h($backup['Backup']['database']); ?>&nbsp;</td>
            <td><?php echo h($backup['Backup']['status']); ?>&nbsp;</td>
            <td><?php echo h($backup['Backup']['message']); ?>&nbsp;</td>
        </tr>
        <?php endforeach; ?>
	</table>
</div>
