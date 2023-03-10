 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
 	<!-- Brand Logo -->
 	<a href="<?= base_url('teknisi'); ?>" class="brand-link">
 		<span class="brand-text font-weight-bold">SARPRAS</span>
 	</a>

 	<!-- Sidebar -->
 	<div class="sidebar">
 		<!-- Sidebar Menu -->
 		<nav class="mt-2">
 			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
 				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
 				<li class="nav-header">Menu</li>
 				<li class="nav-item">
 					<a href="<?= base_url('teknisi'); ?>" class="nav-link">
 						<i class="nav-icon fas fa-home"></i>
 						<p>
 							Dashboard
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="#" class="nav-link">
 						<i class="nav-icon fas fa-clipboard-list"></i>
 						<p>
 							Data Pengaduan
 							<i class="fas fa-angle-left right"></i>
 						</p>
 					</a>
 					<ul class="nav nav-treeview">
 						<li class="nav-item">
 							<a href="<?= base_url('teknisi/plot'); ?>" class="nav-link">
 								<i class="far fa-circle nav-icon"></i>
 								<p>Plot Pengaduan</p>
 							</a>
 							<a href="<?= base_url('teknisi/report'); ?>" class="nav-link">
 								<i class="far fa-circle nav-icon"></i>
 								<p>Report Pengaduan</p>
 							</a>
 						</li>
 					</ul>
 				</li>
 			</ul>
 		</nav>
 		<!-- /.sidebar-menu -->
 	</div>
 	<!-- /.sidebar -->
 </aside>