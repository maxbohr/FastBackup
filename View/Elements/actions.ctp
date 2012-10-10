<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Backups'), array('controller' => 'backups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Backup'), array('controller' => 'backups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Run Backup'), array('controller' => 'backups', 'action' => 'run')); ?></li>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
	</ul>
</div>
