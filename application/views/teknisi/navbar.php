 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-primary elevation-2">
 	<!-- Brand Logo -->
 	<div class="text-center">
 		<a href="<?= base_url('teknisi'); ?>" class="brand-link">
 			<span class="brand-text font-weight-bold"><i class="fas fa-box"></i> SIPMAS</span>
 		</a>
 	</div>

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
 					<a href="<?= base_url('teknisi/plot'); ?>" class="nav-link">
 						<i class="nav-icon fas fa-list"></i>
 						<p>
 							Plot Pengaduan
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('teknisi/report'); ?>" class="nav-link">
 						<i class="nav-icon fas fa-book"></i>
 						<p>
 							Report Pengaduan
 						</p>
 					</a>
 				</li>
 			</ul>
 		</nav>
 		<!-- /.sidebar-menu -->
 	</div>
 	<!-- /.sidebar -->
 </aside>