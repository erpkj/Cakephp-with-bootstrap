<div id="page-container" class="row-fluid">

	<div id="sidebar" class="span3">
		
		<div class="actions">
		
			<ul class="nav nav-list bs-docs-sidenav">
										<li><?php   echo $this->Html->link(__('Logout'), array('action' => 'logout')); ?></li>
							</ul>  <!--.nav nav-list bs-docs-sidenav  -->
		
		</div> <!-- .actions  -->
		
	</div> <!-- #sidebar .span3   -->
	
	<div id="page-content" class="span9">

		<div class="users form">
		
			
				<div class="hero-unit">
  <h1>Welcome <?php echo $this->Auth->user('name'); ?></h1>
  <p>Successfully Logged in</p>
  <p>
    <a class="btn btn-primary btn-large">
    Thank You
    </a>
  </p>
</div>
			
		</div>
			
	</div><!-- #page-content .span9 -->

</div><!-- #page-container .row-fluid -->
