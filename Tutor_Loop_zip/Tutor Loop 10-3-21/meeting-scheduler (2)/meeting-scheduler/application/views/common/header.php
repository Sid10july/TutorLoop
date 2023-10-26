	<?php 
	/*todays tutor notification */
	$todayMeetingNotification = $this->common_model->getTutorMeetings(date('Y-m-d'));
 	?>

	<!-- start: header -->
	<header class="header">
				<div class="logo-container">
					<a href="<?= site_url('Dashboard') ?>" class="logo" style="text-decoration:none;">
						<!-- <img src="<?= base_url('assets/images/logo1.png') ?>" height="45" alt="CMS Admin" /> -->
						<div class="sidebar-title" style="margin-top:6px;">
						<h4 class="label label-default text-bold highlight" style="color:white; font-size:18px;">Meeting Scheduler</h4>
						</div>
						
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
					
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
					
					 <!-- form action="pages-search-results.html" class="search nav-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form> 
					
					<span class="separator"></span> -->

			<!-- notification shows only tutor start -->		
			<?php if($_SESSION['role_fid'] == 3) { ?>
					<ul class="notifications">
						<!-- <li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-tasks"></i>
								<span class="badge">3</span>
							</a>
			
							<div class="dropdown-menu notification-menu large">
								<div class="notification-title">
									<span class="pull-right label label-default">3</span>
									Tasks
								</div>
			
								<div class="content">
									<ul>
										<li>
											<p class="clearfix mb-xs">
												<span class="message pull-left">Generating Sales Report</span>
												<span class="message pull-right text-dark">60%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
											</div>
										</li>
			
										<li>
											<p class="clearfix mb-xs">
												<span class="message pull-left">Importing Contacts</span>
												<span class="message pull-right text-dark">98%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
											</div>
										</li>
			
										<li>
											<p class="clearfix mb-xs">
												<span class="message pull-left">Uploading something big</span>
												<span class="message pull-right text-dark">33%</span>
											</p>
											<div class="progress progress-xs light mb-xs">
												<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-envelope"></i>
								<span class="badge">4</span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default">230</span>
									Messages
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle" />
												</figure>
												<span class="title">Joseph Doe</span>
												<span class="message">Lorem ipsum dolor sit.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
												</figure>
												<span class="title">Joseph Junior</span>
												<span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle" />
												</figure>
												<span class="title">Joe Junior</span>
												<span class="message">Lorem ipsum dolor sit.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
												</figure>
												<span class="title">Joseph Junior</span>
												<span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
											</a>
										</li>
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li> -->
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown" title="Today Meeting">
								<i class="fa fa-bell"></i>
								<span class="badge text-bold"><?= count($todayMeetingNotification) ?></span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default text-bold"><?= count($todayMeetingNotification) ?></span>
									Today's Meeting
								</div>
			
								<div class="content">
									<ul>
										
									<?php if(count($todayMeetingNotification) > 0) { 

										foreach ($todayMeetingNotification as $key => $value) {
									 
									 	?>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-calendar bg-primary"></i>
												</div>
												<span class="title"><?= $value->subject_name ?></span>
												<span class="message"><?= $value->start_time." - ".$value->end_time ?></span>
											</a>
										</li>
									<?php } } else { ?>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-meh-o bg-info"></i>
												</div>
												<span class="title">No meeting today..!</span>
									 		</a>
										</li>

									<?php } ?>
										<!-- <li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-lock bg-warning"></i>
												</div>
												<span class="title">User Locked</span>
												<span class="message">15 minutes ago</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-signal bg-success"></i>
												</div>
												<span class="title">Connection Restaured</span>
												<span class="message">10/10/2014</span>
											</a>
										</li> -->
									</ul>
			
									<!-- <hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div> -->
								</div>
							</div>
						</li>
					</ul>
			
			<?php } ?>
			<!-- notification shows only tutor start -->
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?= base_url('assets/uploads/user/'.$_SESSION['profile_img']) ?>" alt="My Profile Image" class="img-circle" style="width:35px; height: 35px;" />
							</figure>
							<div class="profile-info" data-lock-name="Nitin Moon" data-lock-email="nitin.moon@cms.com">
								<span class="name"><?= ucfirst($_SESSION['firstname'])." ".ucfirst($_SESSION['lastname']) ?></span>
								<span class="role"><?= $_SESSION['role_name'] ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
							<!-- 	<li>
									<a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
								</li> -->
								<li>
									<a role="menuitem" tabindex="-1" href="<?= site_url('Dashboard/change_profile') ?>"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?= site_url('Login/logout') ?>"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->
			<div class="inner-wrapper">