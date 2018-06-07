 <div class="col-md-12 u-login">
 <form class="form-inline" action="" method="post" id="headerLogin">
  <div class="form-group">
  <input type="text" class="form-control" id="user_name" name="user_name"placeholder="Enter your email/username">
  </div>
  <div class="form-group">
  <input type="password" class="form-control" id="pwd" name="pwd"placeholder="Enter your password">
  </div>
  <button type="submit" class="btn btn-default">Submit</button> <button type="button" class="btn btn-default btn-close" onclick="showlogin()">Close</button>
 </form>
</div>
 <script type="text/javascript">
         var islogin = false;
       function showlogin(){
            if(islogin == false){
            $('.login-header').show();
            $('#user_name').focus()
            islogin = true;
            }else{
                $('.login-header').hide();
                islogin = false;

            }
        	} 
       $('#headerLogin').on('submit',function(){
         var data = $('#headerLogin').serialize();
          $.ajax({ type:'post',
           data:data, url: '<?=site_url("ref=home&com=login");?>',
            dataType: 'json',
             success : function(resp){
              console.log(resp);
               if (resp.stat == true) {
                $('.u-login').notify(resp.msg+" redirecting...",{position:"bottom",className:"success" });
                setTimeout(function(){$('#headerLogin').hide('slow');
                        window.location = '<?=site_url();?>';
                    },2000) 
            }else{
             $('#headerLogin').notify(resp.msg, { position:"bottom", className:"error" }); 
         } 
         }
     });
          return false;
      });
        </script>