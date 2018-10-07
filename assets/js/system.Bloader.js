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

function getEmpAnswers(emp_id,templ_id)
{
  //alert(emp_id);
  //alert(templ_id);
  $.ajax({
        method: "POST",
        url: baseurl+"report/getUserAnsers",
        data: { emp_id:emp_id,templ_id:templ_id },
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