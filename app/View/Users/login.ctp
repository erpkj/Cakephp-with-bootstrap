<div id="page-container" class="row-fluid">

	<div id="sidebar" class="span3">
		
		<div class="actions">
		
			<ul class="nav nav-list bs-docs-sidenav">
										<li><?php   echo $this->Html->link(__('Yet not Register?'), array('action' => 'register')); ?></li>
							</ul>  <!--.nav nav-list bs-docs-sidenav  -->
		
		</div> <!-- .actions  -->
		
	</div> <!-- #sidebar .span3   -->
	
	<div id="page-content" class="span9">

		<div class="users form">
		
			<?php echo $this->Form->create('User', array('inputDefaults' => array('label' => false), 'class' => 'form form-horizontal')); ?>
				<fieldset>
					<h2><?php echo __('Administrator Login'); ?></h2>

<div class="control-group">
	<?php echo $this->Form->label('username', 'Username', array('class' => 'control-label'));?>
	<div class="controls">
		<?php echo $this->Form->input('username', array('class' => 'span12')); ?>
	</div><!-- .controls -->
</div><!-- .control-group -->

<div class="control-group">
	<?php echo $this->Form->label('password', 'Password', array('class' => 'control-label'));?>
	<div class="controls">
		<?php echo $this->Form->input('password', array('class' => 'span12')); ?>
	</div><!-- .controls -->
</div><!-- .control-group -->

				</fieldset>
			<?php echo $this->Form->submit('Login', array('class' => 'btn btn-large btn-primary')); ?>
<?php echo $this->Form->end(); ?>
			
		</div>
			
	</div><!-- #page-content .span9 -->

</div><!-- #page-container .row-fluid -->
