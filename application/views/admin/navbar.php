 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-primary elevation-2">
 	<!-- Brand Logo -->
 	<div class="text-center">
 		<a href="<?= base_url('admin'); ?>" class="brand-link">
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
 					<a href="<?= base_url('admin'); ?>" class="nav-link">
 						<i class="nav-icon fas fa-home"></i>
 						<p>
 							Dashboard
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="#" class="nav-link">
 						<i class="nav-icon fas fa-list"></i>
 						<p>
 							Data Master
 							<i class="fas fa-angle-left right"></i>
 						</p>
 					</a>
 					<ul class="nav nav-treeview">
 						<li class="nav-item">
 							<a href="<?= base_url('admin/user'); ?>" class="nav-link">
 								<i class="far fa-circle nav-icon"></i>
 								<p>Management User</p>
 							</a>
 						</li>
 						<li class="nav-item">
 							<a href="<?= base_url('admin/kategori'); ?>" class="nav-link">
 								<i class="far fa-circle nav-icon"></i>
 								<p>Kategori Pengaduan</p>
 							</a>
 						</li>
 					</ul>
 				</li>
 				<li class="nav-header">Data Pengaduan</li>
 				<li class="nav-item">
 					<a href="<?= base_url('admin/pengaduan'); ?>" class="nav-link <?= ($this->uri->segment(2) === 'pengaduan' ? 'active' : ''); ?>">
 						<i class="nav-icon fas fa-book"></i>
 						<p>
 							Pengaduan
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('admin/plot'); ?>" class="nav-link <?= ($this->uri->segment(2) === 'plot' ? 'active' : ''); ?>">
 						<i class="nav-icon fas fa-user-alt"></i>
 						<p>
 							Plot Pengaduan
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('admin/report'); ?>" class="nav-link <?= ($this->uri->segment(2) === 'report' ? 'active' : ''); ?>">
 						<i class="nav-icon fas fa-file"></i>
 						<p>
 							Report Pengaduan
 						</p>
 					</a>
 				</li>
 				<li class="nav-header">Setting</li>
 				<li class="nav-item">
 					<a href="<?= base_url('admin/setting'); ?>" class="nav-link <?= ($this->uri->segment(2) === 'setting' ? 'active' : ''); ?>">
 						<i class="nav-icon fas fa-fire"></i>
 						<p>
 							Setting
 						</p>
 					</a>
 				</li>
 			</ul>
 		</nav>
 		<!-- /.sidebar-menu -->
 	</div>
 	<!-- /.sidebar -->
 </aside>