<nav class="main-nav transparent stick-fixed">
	<div class="container">
		<div class="full-wrapper relative clearfix">

			<!-- Logo -->
			<div class="header-logo-wrap">
				<a href="<?php echo site_url(); ?>" class="logo">
					<img src="<?php echo base_url() . 'theme/images/' . $logo; ?>" width="145" height="40" alt="" />
				</a>
			</div>
			<!-- Mobile nav bars -->
			<div class="mobile-nav">
				<i class="fa fa-bars"></i>
			</div>

			<div class="nav-wrapper large-nav">
				<ul class="clearlist local-scroll">
					<!-- Multiple column menu example -->
					<?php
					$navbarModel = new \App\Models\Backend\NavbarModel();
					$parentNavItems = $navbarModel->where('navbar_parent_id', 0)->findAll();

					if (count($parentNavItems) > 0):
					?>
						<?php foreach ($parentNavItems as $row): ?>
							<?php
							$nav_id = $row['navbar_id'];
							$subNavItems = $navbarModel->where('navbar_parent_id', $nav_id)->findAll();
							?>
							<?php if (count($subNavItems) > 0): ?>
								<li>
									<a href="<?= !empty($row['navbar_slug']) ? site_url($row['navbar_slug']) : '#'; ?>" class="menu-down"><?= esc($row['navbar_name']); ?> <i class="fa fa-angle-down"></i></a>

									<!-- Sub -->
									<ul class="nav-sub">
										<?php foreach ($subNavItems as $row2): ?>
											<li>
												<a href="<?= !empty($row2['navbar_slug']) ? site_url($row2['navbar_slug']) : '#'; ?>"><?= esc($row2['navbar_name']); ?></a>
											</li>
										<?php endforeach; ?>
									</ul>
									<!-- End Sub -->
								</li>
							<?php else: ?>
								<li>
									<a href="<?= !empty($row['navbar_slug']) ? site_url($row['navbar_slug']) : '#'; ?>"><?= esc($row['navbar_name']); ?></a>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<li>
							<a href="#">Belum ada menu</a>
						</li>
					<?php endif; ?>
					<!-- End Multiple column menu example -->




			</div>
		</div>
</nav>