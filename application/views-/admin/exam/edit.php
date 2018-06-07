<style type="text/css">
  .list-question{
    cursor: pointer;

  }
  .list-question:hover,.list:hover{
    background-color: #FFF8DC;
    color: #008080;
  }
  .list-question .span-hidden{
    display: none;
  }
  .list-question:hover .span-hidden{
    display: inline-block;
    color: #696969;
    font-size: 10px;
    text-align: right;
    float: right;
  } 
  .form-control{border-color: #6495ED
</style>
<ul class="nav nav-tabs" id="ul_new">
  <li class="li_home "><a data-toggle="tab" href="#tab_home" class="tab_home">SETTING</a></li>
  <li class="li_category active"><a data-toggle="tab" href="#tab_category" class="tab_category">CATEGORY</a></li>
  <li class="li_questions disabled"><a data-toggle="tab" href="#tab_questions" class="tab_questions">QUESTION</a></li>

</ul>

<div class="tab-content">

  <div id="tab_home" class="tab-pane fade">
    <h3>Exam settings</h3>
    <div class="col-md-12">

          <form class="form form-horizontal" id="frmnew" method="post" accept="./addexam">
            
            <div class="form-group">
              
          <label>Title of the quiz</label>
          <input type="text" name="q_title" id="q_title" class="form-control" value="<?=isset($exam_title) ? $exam_title : '' ; ?>" />
            </div>
            
            <div class="form-group">
              
          <label>Exam description</label>
          <textarea class="form-control" id="e_description" name="e_description" rows="8" required><?=isset($exam_description) ? $exam_description : '' ; ?></textarea> 
            </div>

            <div class="form-group">
              
          <label></label>
          <button class="btn btn-info btn-sm" style="" type="submit" id="btn_set">Update</button>
            </div>

    <div class="form-group append_exam ">
    </div>
          </form>
    </div>
  </div>

  <div id="tab_category" class="tab-pane fade in active">
    <h3>Exam categories 
      <button class="btn btn-default btn-sm add-category" data-toggle="modal"  data-target="#mtotal_modal" type="button" ><i class="fa fa-plus "></i></button></h3>
    <p>

  <table class="table table-bordered" id="tbl_exams">
    <thead>
      <tr><th>Exam Category</th><th>Type</th><th>Question</th><th>Action</th></tr>
    </thead>
    <tbody>
      
  <?php echo isset($tr) ? $tr : '';?>
    </tbody>
  </table>
    </p>
  </div>


  <div id="tab_questions" class="tab-pane fade">

    <div class="create_question">
       <h3>Create Question</h3>
    <p>
    <div class="form-responsive">
  <form class="form form-horizontal" action="<?=site_url('quiz/add');?>" method="post" autocomplete="off" id="frmquestion" name="frmquestion" >
    <div class="col-md-8">
      <div class="col-md-12">
        <input type="hidden" name="quizes_id" id="quizes_id" value="<?=$exam_id?>" />

    <div class="form-group">
      <label for="question">Question textarea</label>
      <textarea class="form-control" name="question" id="question" class="summernote"></textarea>
    </div>

    
    <div class="form-group choices">
      <label>Answer</label>
      <input type="text" name="choices[]" id="choices0" class="form-control choice" />
      <label>Other choices</label>      
      <input type="text" name="choices[]" id="choices1" class="form-control choice" />
      <input type="text" name="choices[]" id="choices2" class="form-control choice" />
      <input type="text" name="choices[]" id="choices3" class="form-control choice" />
    </div>
    <div class="btn-add-choices"><button class="btn btn-default btn-sm" type="button" id="btn_more">Add more choices...</button><br/><br/></div>

  </div>

  </div>
  </div>
  <div class="col-md-4">

      <div class="col-md-12">
      <div class="form-group">
        <label>You already have <span id="question_added"  style="color:red;">0</span> of <span id="total_question">0</span> questions</label>
      </div>
    </div>
    <div class="form-group">
      <label  for="Add"></label>
      <button class="btn btn-info btn-sm" type="submit" name="btn_add" id="btn_add">Add</button>&nbsp;
      <button class="btn btn-default btn-sm" type="submit" name="btn_addlater" id="btn_addlater">Draft</button>
      <button class="btn btn-success btn-sm " type="submit" name="btn_publish" id="btn_publish" disabled='true'>Publish</button>&nbsp;
    </div>


          <br />
          <br />
       <p style="font-size: 12px; ">
        <b>Important Note:</b><br>
          <span><b>Question textare:</b> </span> Used this area to input the questions. <br />
          <span><b>Choice (1-5):</b> </span>Use the inputbox to input the choices . <br />
          <span><b>Radio button: </b> </span> Click this button (the small circle) to set the correct answer to the following choices. Make sure that the backgound color of your selected answer willchange to light green.<br />
          <span><b>Add button: </b> </span> Click this button to add the question (it will dislabled after you reach the maximum total questions.<br />
          <span><b>Radio button: </b> </span> Click this button to save in draft the questionfor later update.<br />
          <span><b>Radio button: </b> </span> Click this button to publish and show to the public the examination.<br />
        </p> 

        </div>
  </form>
</div>
</p>
    </div>

      <div id="listofquestion" style="display: none;">

        <h4>List of question <div class="pull-right"><i class="btn btn-default btn-close-list fa fa-sign-out"></i></div></h4>
        
        <br/>
        <div class="list_here" style="display: block;"></div>
      </div>
   
  </div>


 </div>  <!-- end tab -->


  <!-- Modal -->
<div id="mtotal_modal" class="modal fade" role="dialog">
<div class="modal-bg hidden">
  <span class="loader"></span>
</div>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" >&times;</button>
        <h4 class="modal-title">Update category settings</h4>
      </div>
      <div class="modal-body">
        
        <p>   
          <style type="text/css">
            .c_setting{
              display: none;
            }
          </style>
    <form action="#" id="frm_mtotal" name="frm_mtotal" class="">
            
            <div class="c_setting">
                
               <div class="form-group">
                <label for="s_category">Select subject/category <i class="btn fa fa-plus"></i></label>
                <?php echo $category; ?>
              </div>
               <div class="form-group">
                <label for="category_notes">Directions: </label>
                <textarea id="directions" name="directions" class="form-control"  placeholder="(optional)"></textarea>
              </div>

              <div class="form-group">
                <label for="question">Select quiz type </label>
                <select class="form-control" id="q_type" name="q_type">
                  <option value="1">Multiple choice</option>
                </select>
              </div>

            </div>
             

         <div class="form-group">
        <label for="txtmtotal"></label><input type="number" name="txtmtotal" id="txtmtotal" class="form-control" value="10" />
         </div>
                     <div class="c_setting">
            <div class="form-group">
              
          <label>Allow shuffle</label>
          <br />
          <label for="q_random_choices" style="font-weight: normal;cursor: pointer"><input type="checkbox" name="q_random_choices" id="q_random_choices" class="checkbox-inline" value="1" /> Shuffle choices </label><br />
          <label for="q_random_question" style="font-weight: normal;cursor: pointer"><input type="checkbox" name="q_random_question" id="q_random_question" class="checkbox-inline" value="1" /> Suffle questions</label><br />
            </div>



            </div>

         <div class="form-group">
        <label style="width:12px;"></label><button class="btn btn-sm btn-info upload" type="submit" id="btn_category">Add</button>
         </div>
            <div class="form-group">
        <label for="error"></label><div id="error"></div>
            </div>
    </form>
        </p>
      </div
    </div>

  </div>
</div>

<script type="text/javascript">
    $('a[data-toggle="tab"]').on('click', function(){
    if ($(this).parent('li').hasClass('disabled')) {
      return false;
    };
  });

</script>
<script type="text/javascript">
  var old_title = '<?=$exam_title?>';

  $('#frmnew').on('submit',function(){
    var data = $(this).serialize();

    max_question = $('#q_total').val();
    var exam_title = $('#q_title').val();

    if(old_title.trim() == exam_title.trim()){
        $('.show-notify').notify('No changes made.', { position:"bottom right", className:"error" }); 
      return false;
    }else{
    

    $.ajax({

      type: 'post',
      data: data+'&exam_id='+exam_id,
      url: '<?=site_url("quiz/update_title_description"); ?>',
      dataType: 'json',

      success: function(resp){
        //console.log(resp)
         if (resp.stats ==  true) {
            $('#q_title').val(exam_title.trim());
        old_title = exam_title.trim();


          $('.show-notify').notify("Question settings updated successfully", { position:"bottom right", className:"success" }); 
          

         }else{

                  $('.show-notify').notify('Error! '+resp.msg, { position:"bottom right", className:"error" }); 
                  if (resp.msg == 'Post failed! The exam title already used.') {
                    $('.append_exam').html('<a href="'+'<?=site_url("quiz/edit/");?>'+resp.quizes_id+'" >Click here to append this exam.</a>')
                  }
              }
      }

    });
  }
    return false;
  });
  
</script>
<script type="text/javascript">
  

  $('.list-question').on('click',function(){
    var e = $(this);
    list_question(e);
  });
  function list_question(e){

  e_category = $(e).parent().parent().data('category');

    var q = $('#questions_'+e_category).text();


    if(parseInt(q) <= 0){

      $('.show-notify').notify('No data. ', { position:"bottom right", className:"error" }); 
      return false;
    }
    $('.li_questions').removeClass('disabled');
    $('.tab_questions').click();

       $('.list_here').html('');


    var data = 'exam_id='+exam_id+'&category_id='+e_category;

    $('#listofquestion').show('slow');
    $('.create_question').hide('fast');

        $.ajax({

      type: 'post',
      data: data,
      url: '<?=site_url("quiz/list_question"); ?>',
      dataType: 'json',

      success: function(resp){

        var n = 1;
         $.each(resp, function(i) {

            var list = '';
            list = '<div class="panel panel-info"><div class="panel-heading"><b style="display:block;width:100%;"><span style="display:inline-block;">'+n+') </span> <span style="display:inline-block;">'+resp[i].post_question+'</span></b></div><div class="panel-body"> <p style="color:green;">Answer: '+resp[i].post_answer+'</p><p>Choice: '+resp[i].post_choice1+'</p><p>Choice: '+resp[i].post_choice2+'</p><p>Choice: '+resp[i].post_choice3+'</p><p>Choice: '+resp[i].post_choice4+'</p></div></div>';
            $('.list_here').append(list);
            n++;
          });
      }

    });
    return false;
  }

  $('.btn-close-list').on('click',function(){

    $('.li_questions').addClass('disabled');
    $('.tab_category').click();
    $('.create_question').show('fast');
    $('.table').show('slow');
    $('#listofquestion').hide('fast');
    

  });
</script>
<script type="text/javascript">
  var is_change = false;
  var e_category = 0;
  var m_total = 0;
  var qa_total;
  var exam_id = <?=$exam_id?>;
  function maxQuestion(e) {
    // body...

    if(is_change == false){
     m_total = $(e).text();
     e_category = $(e).parent().parent().data('category');
     $('#mtotal_modal').modal('show');
     $('#mtotal_modal #txtmtotal').val(m_total);
       $('.c_setting').css('display','none');
       $('#btn_category').html('Update');
    //console.log(e_category);
    is_change = true;
    }else{
      m_total = $('#txtmtotal').val();
       $('#btn_category').html('Add');

       var data = 'exam_id='+exam_id+'&category_id='+e_category+'&maxquestions='+m_total;
              $.ajax({

              type: 'post',
              data: data,
              url: '<?=site_url("quiz/changemaxquestion"); ?>',
              dataType: 'json',

              success: function(resp){
                //console.log(resp)
                if(resp.stats == true){
                 $('#mtotal_'+e_category).html(m_total);  

            $('.show-notify').notify("Settings updated successfully", { position:"bottom right", className:"success" });
                }else{

            $('.show-notify').notify("No changes made.", { position:"bottom right", className:"error" });
                }

              },
              error:function(){

            $('.show-notify').notify("Internal server error occured.", { position:"bottom right", className:"error" });
              }

            });

    }

  }
  $('.close').on('click',function(){

     $('#mtotal_modal').modal('hide');  
     is_change = false;
  });

  $('#frm_mtotal').on('submit',function(){
    var action = $('#btn_category').html();
    if(action == 'Update'){

      maxQuestion($(this));
      $('#mtotal_modal').modal('hide'); 
      is_change = false;
    }else{
      //alert('Setting');
      add_category($(this));
      return false;
    }

    return false;
  });



  function removeCategory(e) {
    // body...
  e_category = $(e).parent().parent().data('category');

    var data = 'exam_id='+exam_id+'&category_id='+e_category;
    //console.log(data);
   // return false;
     $.ajax({

      type: 'post',
      data: data,
      url: '<?=site_url("quiz/removecategory"); ?>',
      dataType: 'json',

      success: function(resp){

     // console.log(resp);
      if(resp.stats == true){

        $('#tr_'+e_category).remove();


                  $('.show-notify').notify(resp.msg, { position:"bottom right", className:"success" }); 
      }else{

                  $('.show-notify').notify(resp.msg, { position:"bottom right", className:"warning" }); 
      }
      }

    });
    return false;

  }


  $('.add-category').on('click',function(){
    $('.c_setting').css('display','block');

  });


</script>

<script type="text/javascript">
 
  $('input[type="radio"]').on('click', function(e) {
   // console.log(e.type);

   var  radio = $(this).val();
   var  answer = $('#choice'+radio).val();
   $('input.form-control').css('border','solid #e5e5e5 1px');
   $('#choice'+radio).css('border','solid #7CFC00 1px');
        //$(this).parent().siblings().css("border", "2px solid white");
        $('.choices').removeClass("alert alert-success"); 
        $(this).parent().parent().addClass("alert alert-success"); 
        
  });

  function clearform(){

          $('input.form-control').css('border','solid #e5e5e5 1px');
          $('.choices').removeClass("alert alert-success"); 
          $('input[type="radio"]').parent().parent().removeClass("alert alert-success"); 
          $('#question').summernote('code', '');
  }

  var is_addquestion = false;
  function addquestion(e){

    //return false;
    if(is_addquestion == false){

      e_category = $(e).parent().parent().data('category');
      m_total = $('#mtotal_'+e_category).text();
      qa_total = $('#questions_'+e_category).text();

          if(parseInt(m_total) == parseInt(qa_total)){
            $('.show-notify').notify('Maximum question already added.', { position:"bottom right", className:"error" }); 
            return false;
          }
          
      $('#total_question').html(m_total);
      $('#question_added').html(qa_total);
      
        $('.li_questions').removeClass('disabled');
      $('.tab_questions').click();
      is_addquestion = true;
    }else{


    var data = $(e).serialize();
    //console.log(data);
    //return false;
    $.ajax({

      type: 'post',
      data: data+'&exam_id='+exam_id+'&category_id='+e_category,
      url: '<?=site_url("quiz/add_question"); ?>',
      dataType: 'json',
        statusCode: {
          404: function() {
                  $('.show-notify').notify('Error 404! page not found.', { position:"bottom right", className:"warning" });
          },
          505: function() {
                  $('.show-notify').notify('Error 505! page not found.', { position:"bottom right", className:"warning" });
          }
         },
         
      success: function(resp){
        //console.log(resp);
        //return false;
        if(resp.stats == true){

        qa_total = parseInt(qa_total) + 1;

        $("#question_added").html(qa_total);
        $('#questions_'+e_category).html(qa_total);

          if(m_total == qa_total){
            $('#btn_publish').removeAttr('disabled');
          }

          $('.show-notify').notify("Question added successfully", { position:"bottom right", className:"success" }); 

          $('#frmquestion')[0].reset();
          clearform();



        }else{

                  $('.show-notify').notify('Error! '+resp.msg, { position:"bottom right", className:"error" }); 
        }
      }

    });

      //is_addquestion = false;

    }
  }


  function add_category(e){
    var data = $(e).serialize();
    //var ar = JSON.stringify($(e).serializeArray());

    var t_category = $('#s_category option:selected').text();
    var t_type = $('#q_type option:selected').text();

        m_total = parseInt($('#txtmtotal').val());

        e_category = $('#s_category').val();

       // var data = 'exam_id='+exam_id+'&category_id='+e_category;
      //console.log(ar);
      //return false;
       $.ajax({

        type: 'post',
        data: data+'&exam_id='+exam_id,
        url: '<?=site_url("quiz/exam_setting"); ?>',
        dataType: 'json',

        success: function(resp){

        //console.log(resp);
       // return false;
        if(resp.stats == true){

          //$('#tr_'+e_category).remove();
           $('#tbl_exams tbody').append("<tr class='list' data-category='"+e_category+"' id='tr_"+e_category+"'><td>"+t_category+"</td><td>"+t_type+"</td><td><span class='btn list-question' id='questions_"+e_category+"' style='width:40%;'>0</span> / <span class='btn span_exam_total' id='mtotal_"+e_category+"' style='width:40%;' onClick='maxQuestion(this)'>"+m_total+"</span></td><td><button class='btn btn-info btn-sm' onClick='addquestion(this)'><i class='fa fa-plus'></i></button> <button class='btn btn-danger btn-sm' type='button' onClick='removeCategory(this)'><i class='fa fa-remove'></i></button></td></tr>");

            $('.list-question').on('click',function(){

              list_question($(this));
            });

                    $(e).notify(resp.msg, { position:"top right", className:"success" }); 
        }else{

                    $(e).notify(resp.msg, { position:"top right", className:"warning" }); 
        }
        }

      });
  }
</script>


<script type="text/javascript">
  
  $('#frmquestion').on('submit',function(){

    var question = $('#question').val();
    var choices = $('input[name="answer"]:checked').val();


    if(question == '' || question == '<p></p>' || question == '<p><br></p>'){

      $('.show-notify').notify('Error! Please input a question.', { position:"bottom right", className:"error" }); 
      return false;
    }
     /*
     if(choices == '' || choices == undefined){


      $('.show-notify').notify('Error! Please select an answer to this question.', { position:"bottom right", className:"error" }); 
      return false;
    }
    */

          if(parseInt(m_total) == parseInt(qa_total)){
            $('.show-notify').notify('Maximum question already added.', { position:"bottom right", className:"error" }); 
            return false;
          }
     is_addquestion = true;
          addquestion(this);
    return false;
    });

  $('.li_category').on('click',function(){
    is_addquestion = false;
     $('.li_questions').addClass('disabled');
  });
  $('.li_home').on('click',function(){
    is_addquestion = false;
     $('.li_questions').addClass('disabled');
  });
</script>
<script type="text/javascript">
  var choices = 4;
  $('#btn_more').on('click',function(){
    $('.choices').append('<input type="text" name="choices[]" id="choices'+choices+'" class="form-control choice" />');
      
      $('.choice').on('blur',function(){
       check_input(this);

      });
    return false;
  });


var input_choices = [];
$('.choice').on('blur',function(){
 check_input(this);

});

function check_input(e) {
  // body...

    var item = $(e).val();
          if(isInArray(item,input_choices)){
            $(e).val('').focus();
            $(e).notify('The same data is not allowed.', { position:"Top left", className:"error" });
          }else{
            
            input_choices.push(item);
          }
}




</script>

