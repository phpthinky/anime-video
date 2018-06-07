     
    <div id="carousel" class="col-md-12 carousel slide" style="margin:0;padding:0;">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <!-- <li data-target="#carousel-example-generic" data-slide-to="2"></li>  -->
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">

        <!-- First slide -->
        <div class="item active skyblue-vh">
          <img src="http://bilar.bisu.edu.ph/public/uploads/image/feature-aac-18-02-24-12-02-12.jpg"  data-animation="animated fadeIn">
          <div class="carousel-caption">
            <h3 data-animation="animated zoomInLeft" class="caption-title-top">
             Bohol Island State University <br /><span class="campus">Bilar Campus</span>
            </h3>
            <h3 data-animation="animated bounceInRight"  class="caption-title-center">
              A green university for prosperity.
            </h3>
          </div>
        </div> <!-- /.item -->

        <!-- Second slide -->
        <div class="item skyblue-vw">
          <img src="<?=base_url();?>public/images/4.png"  data-animation="animated fadeIn">
          <div class="carousel-caption">
            <h3  class="caption-title-top" data-animation="animated bounceInLeft">
             Bohol Island State University <br /><span class="campus">Bilar Campus</span>

            </h3>
            <h3 data-animation="animated bounceInUp">
            A green university for prosperity.
            </h3>

          </div>
        </div><!-- /.item -->

        <!-- Third slide 
        <div class="item darkerskyblue">
          <div class="carousel-caption">
            <h3 class="icon-container" data-animation="animated zoomInLeft">
              <span class="glyphicon glyphicon-glass"></span>
            </h3>
            <h3 data-animation="animated flipInX">
              This is the caption for slide 3
            </h3>
            <button class="btn btn-primary btn-lg" data-animation="animated lightSpeedIn">Button</button>
          </div>
        </div> /.item -->

      </div><!-- /.carousel-inner -->

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->
