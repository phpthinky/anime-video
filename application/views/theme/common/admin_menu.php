<nav class="navbar navbar-default-primary navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=site_url('admin');?>">
                <img src="<?=base_url('public/images/logo-only.png');?>">
                <label class="big">COLOFTECH</label>
                <label class="small">State of the Arts &amp; Technology</label>
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li><a href="<?=site_url();?>" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats">Visit site
                </a>
            </li>            
            <li><a href="#" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bar-chart-o"></i>
                </a>
            </li>            
            <li class="dropdown user-profile" >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata['username'];?></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=site_url('user/profile');?>"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                    <li><a href="<?=site_url('user/change_pass');?>"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=site_url("home/logout");?>"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li><a href="<?=site_url('admin');?>"><i class="fa fa-fw fa-home"></i>Dashboard</a></li>
                
                <li>
                    <a href="#" data-toggle="collapse" data-target="#menu-videos"><i class="fa fa-fw fa-camera"></i>  Videos<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="menu-videos" class="collapse">

                        <li><a href="<?=site_url('video');?>"><i class="fa fa-angle-double-right"></i> Add</a></li>
                        <li><a href="<?=site_url('video/anime');?>"><i class="fa fa-angle-double-right"></i> List all Anime</a></li>
                        <li><a href="<?=site_url('video/movies');?>"><i class="fa fa-angle-double-right"></i> List all Movies</a></li>
                    </ul>
                    
                </li>

                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-book"></i>  Reports<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-2" class="collapse">

                        <li><a href="<?=site_url('video/reports');?>"><i class="fa fa-angle-double-right"></i> List reports</a></li>
                    </ul>
                </li>

                <li><a href="#"  data-toggle="collapse" data-target="#backup-1"><i class="fa fa-fw fa-home"></i>Backup <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                 <ul id="backup-1" class="collapse">

                        <li><a href="<?=site_url('admin/backupvideos');?>"><i class="fa fa-angle-double-right"></i> Video only</a></li>
                        <li><a href="<?=site_url('admin/create_zip');?>"><i class="fa fa-angle-double-right"></i> Full database</a></li>

                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>