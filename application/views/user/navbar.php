 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-primary elevation-2">
 	<!-- Brand Logo -->
 	<div class="text-center">
 		<a href="<?= base_url('user'); ?>" class="brand-link">
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
 					<a href="<?= base_url('user'); ?>" class="nav-link">
 						<i class="nav-icon fas fa-home"></i>
 						<p>
 							Dashboard
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('user/pengaduan'); ?>" class="nav-link <?= ($this->uri->segment(2) === 'pengaduan' ? 'active' : '') ?>">
 						<i class="nav-icon fas fa-book"></i>
 						<p>
 							Data Pengaduan
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('user/profile'); ?>" class="nav-link <?= ($this->uri->segment(2) === 'profile' ? 'active' : '') ?>">
 						<i class="nav-icon fas fa-user"></i>
 						<p>
 							Profile
 						</p>
 					</a>
 				</li>
 			</ul>
 		</nav>
 		<!-- /.sidebar-menu -->
 	</div>
 	<!-- /.sidebar -->
 </aside>