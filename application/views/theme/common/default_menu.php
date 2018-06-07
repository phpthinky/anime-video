
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

                          <li class="home"> <a href="<?php echo site_url(); ?>">Home</a></li>
                          <li class="home"> <a href="<?php echo site_url('livechart'); ?>">Live chart</a></li>
                          <li class="newvideos"> <a href="<?php echo site_url('watch/new_upload'); ?>">New videos</a></li>
                          <li class="anime"> <a href="<?php echo site_url('watch/anime'); ?>">Anime</a></li>
                          <li class="movies"> <a href="<?php echo site_url('watch/movies'); ?>">Movies</a></li>
                            

                          <?php if (!$this->permission->is_loggedin()): ?>
                            
                          <li class="<?php  ?>"><a href="<?php echo site_url('home/login?redirect=').urlencode($_SERVER['PHP_SELF']); ?>"> Login</a></li>
                          
                          <?php endif ?>
                          <?php if ($this->permission->is_loggedin() == true): ?>
                          <!--
                          <li><a href="<?=site_url('user/directory');?>"> <span>My directory</span></a></li>
                          <li><a href="<?=site_url('setting/security');?>"> <span>My account</span></a></li>
                         -->
                            

                          <?php   if ($this->permission->is_admin()): ?>
                            
                          <li><a href="<?=site_url('admin');?>"> <span>Administration</span></a></li>
                          <?php endif ?>
                     
                          
                     
                          
                     
                          <li><a href="<?=site_url('home/logout');?>"> <span>Logout</span></a></li>
                          <?php endif ?>
                          
                      </ul>
                  </div>
              </nav>