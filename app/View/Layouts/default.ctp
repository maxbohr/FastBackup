<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Fast Backups for linux</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php echo $this->Html->script(array('jquery.js',
    					 'bootstrap.min.js')); ?>
    
   
    <?php echo $this->Html->css(array('bootstrap.min','specific','bootstrap-responsive')); ?>
  
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
  </head>
 <body>
  <div class="container">
	    <div style="color:red;">
            <h1>Fast Backups</h1>
        </div>
	    <div class="navbar" id="menu">
	     <div class="navbar-inner">
	        <div class="container">
	          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </a>
	           <div class="nav-collapse">
	            <ul class="nav">
					<li><?php echo $this->Html->link(__('List Backups'), array('controller' => 'backups', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__('New Backup'), array('controller' => 'backups', 'action' => 'add')); ?> </li>
                    <li><?php echo $this->Html->link(__('Run Complete Backup'), array('controller' => 'backups', 'action' => 'run')); ?></li>
                    <li><?php echo $this->Html->link(__('Settings'), array('controller' => 'options', 'action' => 'index')); ?></li>
	            </ul>
				<ul class="nav pull-right">
                    <? if(AuthComponent::user()): ?>
                        <li class="dropdown">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-user icon-white"></i> <?= AuthComponent::user('username') ?>&nbsp;&nbsp;<b class="caret"></b></a>
                          <ul class="dropdown-menu">
                            <li><?php echo $this->Html->link('Logout',array('controller' => 'users','action'=>'logout'));?></li>
                          </ul>
                        </li>
                    <? else: ?>
                        <li><?php echo $this->Html->link('Log In',array('controller' => 'users','action'=>'login'));?></li>
                    <? endif; ?>
                </ul>
	          </div><!--/.nav-collapse -->
	        </div> <!--  container -->
	      </div> <!--  navbar-inner -->
	    </div> <!--  navbar -->
	    <div class="container-fluid">    
      <div class="row-fluid">
        <div class="hero-unit">
        
        <div class="form-horizontal">
        <fieldset>
        <?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>
        </fieldset>
      </div>
      
        </div><!--/span-->
      </div><!--/row-->
      </div>
      </div>
      <hr>
      



      <footer>
        <p style="color:white;">&copy; Max Bohr&#0153; Consulting  2012</p>
      </footer>
  </body>
</html>
