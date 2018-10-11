var baseurl = getBaseurl();
function getBaseurl() {
    var pathparts = location.pathname.split('/');
    //alert(location.host);
    if(pathparts[1] == 'Bala'){
        var url = location.origin+'/'+pathparts[1].trim('/')+'/'+pathparts[2].trim('/')+'/';
    } else if (location.host == '172.16.51.134' || location.host == '172.16.51.134:8080' || location.host == 'localhost:8080' || location.host == '172.16.51.116' || location.host == 'localhost') {
        var url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
    } else{
        var url = location.origin+'/'; // http://stackoverflow.com
    }

    return url;
}


$(function() {

  //$('#ans_for_usr').chosen();
});


function setAdminIdPassReset(adminid)
{
    $('#adminUserPassResetID').val(adminid);
}

function setAdminIdDelete(adminid)
{
    $('#adminUserDeelteID').val(adminid);
}

$('#emp_dob').datetimepicker({
	dayOfWeekStart : 1,
    format:'Y-m-d',
    //disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
    //startDate:  '1986/01/05',
    timepicker:false
});
$("#emp_dob").keydown(false);

$('#emp_doj').datetimepicker({
	dayOfWeekStart : 1,
    format:'Y-m-d',
    timepicker:false
});
$("#emp_doj").keydown(false);

function empSearchPage()
{
	var search_key = $('#emp_tab_ssearch').val();
  var user_type  = $('#emp_utype_search').val();
	//alert(search_key);

	var page = 0;

	$.ajax({
        method: "POST",
        url: baseurl+"employee/manageEmployeeAjax/"+page,
        data: { page:page,search_key:search_key,user_type:user_type },
        beforeSend: function(){
        },
        success: function(data){
            $('#empList').html(data);
        }
	});
}

function refreshEmpSearch()
{
	var search_key = $('#emp_tab_ssearch').val();
	if(search_key=='' || search_key == ' '){
		empSearchPage();
	}
}

function setEmpIdPassReset(adminid)
{
    $('#empUserPassResetID').val(adminid);
}

function setEmpIdDelete(adminid)
{
    $('#empUserDeelteID').val(adminid);
}

$(document).ready(function(){  
    var i=1;  
    $('#quest_btn_add').click(function(){  
       i++;   
       //alert('text');
       $('#quest_dyn_div').append('<div class="col-md-12" id="quest_par_div'+i+'"><div class="col-md-8"><div class="form-group"><label for="exampleInputPassword1">Options</label><input type="text" name="option[]" class="form-control" required=""></div></div><div class="col-md-4"><button type="button" name="remove" id="'+i+'" class="btn btn-danger quest_btn_remove">X</button></div></div>');
    });  
    $(document).on('click', '.quest_btn_remove', function(){  
       var button_id = $(this).attr("id");   
       $('#quest_par_div'+button_id+'').remove(); 
       if($("#quest_dyn_div > div").length<1){
            addOptiontoQuestn();
       } 
    });  
 });  

function addOptiontoQuestn()
{
    var qustn_typ = $('#ques_type').val();
    //alert(qustn_typ);
    $('#quest_dyn_div').empty();
    if(qustn_typ!='text'){
        $('#quest_dyn_div').append('<div class="col-md-12" id="quest_par_div1"><div class="col-md-8"><div class="form-group"><label for="exampleInputPassword1">Options</label><input type="text" name="option[]" class="form-control" required=""></div></div><div class="col-md-4"><button type="button" id="quest_btn_add" class="btn btn-primary">Add More</button></div></div>');
    } else {

    }

    var i=1;  
    $('#quest_btn_add').click(function(){  
       i++;   
       //alert('text');
       $('#quest_dyn_div').append('<div class="col-md-12" id="quest_par_div'+i+'"><div class="col-md-8"><div class="form-group"><label for="exampleInputPassword1">Options</label><input type="text" name="option[]" class="form-control" required=""></div></div><div class="col-md-4"><button type="button" name="remove" id="'+i+'" class="btn btn-danger quest_btn_remove">X</button></div></div>');
    });  
    $(document).on('click', '.quest_btn_remove', function(){  
       var button_id = $(this).attr("id");   
       $('#quest_par_div'+button_id+'').remove();  
       //alert($("#quest_dyn_div > div").length);
       if($("#quest_dyn_div > div").length<1){
            addOptiontoQuestn();
       }
       
    });
}

function setQuestionIdDelete(question_id)
{
    $('#questionDeelteID').val(question_id);
}

$('.form-group').on("click",function(){          

    var items = document.getElementsByClassName('req_question');
    for (var i = 0; i < items.length; i++)
    checkboxValidate(items[i].name);
});

function checkboxValidate(name){
    var min = 1 //minumum number of boxes to be checked for this form-group
    if($('input[name="'+name+'"]:checked').length<min){
        $('input[name="'+name+'"]').prop('required',true);
    }
    else{
        $('input[name="'+name+'"]').prop('required',false);
    }
}

function userResultPage()
{
  var search_key = $('#user_result_search').val();
  var emp_type   = $('#emp_type_search').val();
  var templ_id   = $('#emp_reprt_tmpl_srch').val();
  //alert(search_key);

  var page = 0;

  $.ajax({
        method: "POST",
        url: baseurl+"report/manageUserReportAjax/"+page,
        data: { page:page,search_key:search_key,emp_type:emp_type,templ_id:templ_id },
        beforeSend: function(){
        },
        success: function(data){
            $('#resultList').html(data);
        }
  });
}

function getEmpAnswers(emp_id,templ_id,ans_for_usr)
{
  //alert(emp_id);
  //alert(templ_id);
  $.ajax({
        method: "POST",
        url: baseurl+"report/getUserAnsers",
        data: { emp_id:emp_id,templ_id:templ_id,ans_for_usr:ans_for_usr },
        beforeSend: function(){
        },
        success: function(data){
            $('#resultAnswers').html(data);
        }
  });
}

function allowEmpEditAns(emp_id)
{
  $('#ans_acc_emp_id').val(emp_id);
}

function setTemplEdit(templ_id)
{
  $.ajax({
        method: "POST",
        url: baseurl+"question/getTemplEdit",
        data: { templ_id:templ_id },
        beforeSend: function(){
        },
        success: function(data){
            $('#editTemplDiv').html(data);
        }
  });
}

function setTemplDelete(templ_id)
{
  $('#templDeleteID').val(templ_id);
}

function manageQuestionPage()
{
  var templ_id   = $('#qstn_tmpl_srch').val()
  var search_key = $('#qstn_templ_key').val();
  var page = 0;

  $.ajax({
        method: "POST",
        url: baseurl+"question/manageQuestionAjax/"+page,
        data: { page:page,search_key:search_key,templ_id:templ_id },
        beforeSend: function(){
        },
        success: function(data){
            $('#questList').html(data);
        }
  });
}

function setTemplPreview(templ_id)
{
  $.ajax({
        method: "POST",
        url: baseurl+"question/getTemplprev",
        data: { templ_id:templ_id },
        beforeSend: function(){
        },
        success: function(data){
            $('#adminQstnPrevDiv').html(data);
        }
  });
}

function manageTemplatePage()
{
  var user_type  = $('#mang_tmpl_utype').val()
  var search_key = $('#mang_templ_key').val();
  var page = 0;

  $.ajax({
        method: "POST",
        url: baseurl+"question/manageTemplateAjax/"+page,
        data: { page:page,search_key:search_key,user_type:user_type },
        beforeSend: function(){
        },
        success: function(data){
            $('#tempList').html(data);
        }
  });
}

function adminEmpSearchPage()
{
  var search_key = $('#adminemp_tab_ssearch').val();
  var page = 0;

  $.ajax({
        method: "POST",
        url: baseurl+"admin/manageAdminAjax/"+page,
        data: { page:page,search_key:search_key },
        beforeSend: function(){
        },
        success: function(data){
            $('#adminList').html(data);
        }
  });
}

function empTemplateSearch()
{
  var search_key = $('#emp_templ_srch').val();
  var page = 0;

  $.ajax({
        method: "POST",
        url: baseurl+"user/availableQuestionsAjax/"+page,
        data: { page:page,search_key:search_key },
        beforeSend: function(){
        },
        success: function(data){
            $('#userTempList').html(data);
        }
  });
}

function questionResultPage()
{
  var templ_id = $('#qstn_reprt_tmpl_srch').val();
  $.ajax({
        method: "POST",
        url: baseurl+"report/getQuestionReport/",
        data: { templ_id:templ_id },
        beforeSend: function(){
        },
        success: function(data){
            $('#questionReport').html(data);
        }
  });
}

function empAnswerSearch()
{
  var search_key = $('#emp_ansfd_srch').val();
  var page = 0;
  $.ajax({
        method: "POST",
        url: baseurl+"user/userAnswerManageAjax/",
        data: { page:page,search_key:search_key },
        beforeSend: function(){
        },
        success: function(data){
            $('#userAnsList').html(data);
        }
  });
}

function loadEmpTemplate()
{
  var emp_id = $('#ufedb_usr_srch').val();
  
  if(emp_id!=''){
    $('#feedbackReport').html('<div><p style="text-align: center;color: red;">Please choose template to get feedback</p></div>');
  } else {
    $('#feedbackReport').html('<div><p style="text-align: center;color: red;">Please Enter the Employee ID and choose Template to get feelback</p></div>');
  }
  
  $.ajax({
        method: "POST",
        url: baseurl+"report/getAvailFeedTemplt/",
        data: { emp_id:emp_id },
        beforeSend: function(){
        },
        dataType : "json",
        success: function(data){
          if(data.result==1){

            $('#qstn_reprt_tmpl_srch')
                .find('option')
                .remove()
                .end()
                .append('<option value="">--Select--</option>')
                .val('');
           
            $('#qstn_reprt_tmpl_srch').append($("<option></option>").attr("value",data.option_all).text('All'));    
           
            $.each(data.templ_data, function(i, el){
              $('#qstn_reprt_tmpl_srch').append($("<option></option>").attr("value",el.templ_id).text(el.templ_name)); 
            });

          } else {
            $('#qstn_reprt_tmpl_srch')
                .find('option')
                .remove()
                .end()
                .append('<option value="">--Select--</option>')
                .val('');    
          }
        }
  });
}

function getEmployeesFedbck()
{
  var emp_id   = $('#ufedb_usr_srch').val();
  var templ_id = $('#qstn_reprt_tmpl_srch').val();
  
  if(templ_id==''){

    if(emp_id!=''){
      $('#feedbackReport').html('<div><p style="text-align: center;color: red;">Please choose template to get feedback</p></div>');
    } else {
      $('#feedbackReport').html('<div><p style="text-align: center;color: red;">Please Enter the Employee ID and choose Template to get feelback</p></div>');
    }
  }
  

  $.ajax({
    method: "POST",
    url: baseurl+"report/getuserFeedback/",
    data: { emp_id:emp_id,templ_id:templ_id },
    beforeSend: function(){
    },
    success: function(data){
        $('#feedbackReport').html(data);
    }
  });
}

function loadQstnTextAns(qstn_id,templ_id)
{
  //alert(qstn_id);
  //alert(templ_id);

  $.ajax({
    method: "POST",
    url: baseurl+"report/loadTxtAnsQstn/",
    data: { qstn_id:qstn_id,templ_id:templ_id },
    beforeSend: function(){
    },
    success: function(data){
        $('#QstnTextAns').html(data);
    }
  });
}

function loadFeedTextAns(qstn_id,templ_id)
{
  //alert(qstn_id);
  //alert(templ_id);
  var emp_id = $('#ufedb_usr_srch').val();

  $.ajax({
    method: "POST",
    url: baseurl+"report/loadTxtAnsFeed/",
    data: { qstn_id:qstn_id,templ_id:templ_id,emp_id:emp_id },
    beforeSend: function(){
    },
    success: function(data){
        $('#FeedTextAns').html(data);
    }
  });
}