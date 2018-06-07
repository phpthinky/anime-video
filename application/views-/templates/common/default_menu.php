
<nav class="navbar navbar-coloftech">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                      <button type="button" data-target="#nav-portal" data-toggle="collapse" class="navbar-toggle">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="<?=site_url();?>"></a>
                
                  </div>
                  <!-- Collection of nav links, forms, and other content for toggling -->
                  <div id="nav-portal" class="collapse navbar-collapse">
                      
                      <ul class="nav navbar-nav navbar-left">

                          <?php if ($this->auto_m->getColleges(1)): ?>
                              
                            <li class="dropdown home">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-home"></i></i> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <?php echo $this->auto_m->getColleges(2); ?>

                                </ul>
                          </li>
                            <?php else: ?>
                          <li class="home"> <a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i></a></li>
                            <?php endif ?> 
                            

                          <?php if (!$this->permission->is_loggedin()): ?>
                            
                          <li class="<?php  ?>"><a href="<?php echo site_url('login?redirect=').urlencode($_SERVER['PHP_SELF']); ?>"> Login</a></li>
                          <li class="<?php  ?>"><a href="<?php echo site_url('register'); ?>"> Signup</a></li>
                          <?php endif ?>
                          <?php if ($this->permission->is_loggedin()): ?>
                          <!--
                          <li><a href="<?=site_url('user/directory');?>"> <span>My directory</span></a></li>
                          <li><a href="<?=site_url('setting/security');?>"> <span>My account</span></a></li>
                         -->
                            
                          <li><a href="<?=site_url('user');?>"> <span>Profile</span></a></li>
                          <li><a href="<?=site_url('exam');?>"> <span>Exam</span></a></li>

                          <?php if ($this->permission->is_admin($this->session->userdata['id'])): ?>
                            
                          <li><a href="<?=site_url('admin');?>"> <span>Administration</span></a></li>
                          <?php endif ?>
                     
                          
                     
                          
                     
                          <li><a href="<?=site_url('logout');?>"> <span>Logout</span></a></li>
                          <?php endif ?>
                          
                      </ul>
                  </div>
              </nav>