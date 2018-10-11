$(document).ready(function () {
        
    $.validator.addMethod("numbers", function (value, element, regex) {
         return value.match(regex);
    }, "Enter Only Numeric Values");

    $.validator.addMethod("alphaval", function (value, element, regex) {
         return value.match(regex);
    }, "Enter Only Alphabets");
    
    $.validator.addMethod("alphanum", function (value, element, regex) {
         return value.match(regex);
    }, "Enter Only Alphanumeric Values");

    $.validator.addMethod("phonenum", function (value, element, regex) {
         return value.match(regex);
    }, "Enter Valid Phone Number");

    $.validator.addMethod("pass_reg", function (value, element, regex) {
         return value.match(regex);
    }, "Password must contain minimum of 8 characters and maximum of 16 characters and should have minimum of one alphabet and one numeric");

    $.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than 2MB');

    $.validator.addMethod('filesizetwenty', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than 20MB');



    $('#add_emp_bulk_form').validate({

        rules: {
            userfile: {
               required: true,
               extension: "xlsx|xls|XLSX|XLS",
               filesize: 2000000
            },
            eadd_act_type: {
                required: true
            }
        },
        messages: {
           userfile: {
                required: "Please upload file",
                extension: "Please upload only XLSX or XLS files"
           },
           eadd_act_type: {
                required: "Please choose an action type"
           }
        }

    });


});

function questValidation()
{
    alert('check');
    var aaa = $('#ans_for_usr').val(); 
    //alert(aaa);
    if(aaa!=null && aaa!=''){
        //alert('ok');
        $('#ans_for_usr_error').hide();
        return true;
    } else {
        //alert('not ok');
        $('#ans_for_usr_error').show();
        return false;
    }
    
}