$(window).load(function () {
    $('.employees').fadeIn(500);
});
$(window).scroll(function () {
  var  scrollTop = $(window).scrollTop();
    if (scrollTop >= 71) {
        $('.navbar-brand').fadeIn(300);
        $('header').hide();
        $('.body').addClass('keep');
        $('.container:first').addClass('fixed');    
    } else if (scrollTop < 71)   {
        $('.navbar-brand').fadeOut(300);
        $('header').show();
        $('.body').removeClass('keep');
        $('.container:first').removeClass('fixed');
    }  
});
$(document).ready(function(){
    $('.viewPen').click(function(){
        var a = $(this).data('what');
        $('#'+a).modal('show');
    });
    $('.viewPay').click(function(){
        var a = $(this).data('what');
        $('#'+a).modal('show');
    });
    $(".pic").click(function(){ $("#modal_pic").modal('show')});
    /* New message controls*/
    $('#receiver').focus(function(){
        $("#searchReceiver").modal('show');
        $('#keyName').focus();
    });
        $('#keyName').keyup(function(){
        var data='lookReceiver=' + $('#keyName').val();
        $.post('./includes/processor.php',
            data,
            function(data){
                $('.user-results').html(data);
                $('.choosen').click(function(){
                    var receiver = $(this).data('uname');
                    $('#receiver').val(receiver);
                    $('#newMessage :submit').removeAttr('disabled','');
                    $('#keyName').val('');
                    $('.user-results').html('');
                    $("#searchReceiver").modal('hide');
                });
            },
            'html'
            );

    });
    /* /New message Controls */
    function search(){
        $('.results').hide();
        var key=$('#search').val();
        var exist = $('.employees').html();
        if (key!='') {
            $('.results').show();
            $('.employees').hide();
            var data = $('.searchForm').serialize();
         $.post('includes/processor.php',
            data,
            function(data){
                $('.results').html(data);
            },
            'html'
            );
        };
        if (key=='') {
            $('.employees').fadeIn();
        };
    
    }
    $('#search').keyup(function(){
        search();
    });
    $('.payments thead tr').css('background-color',' #555');
    $('.payments thead tr').css('color',' #fff');
    $('.payments tbody tr:odd').css('background-color','#eee');
    $('.msg-results').hide();
    });
function searchMsg(a){
        var key=$('#searchMsg').val();
        if (key!='') {
            $('.msg-results').show();
            $('.messages').hide();
            var data = "searchMsg="+key+"&what="+a;
         $.post('./includes/processor.php',
            data,
            function(data){
                $('.msg-results').html(data);
            },
            'html'
            );
        };
        if (key=='') {
            $('.msg-results').hide();
            $('.messages').show();
        };
    }
//Validation

 $(document).ready(function() {
        $("#addEmployee").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                dob: "required",
                phone:{
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                address: "required",
                gender: "required",
                branch: "required",
                designation: "required",
                department: "required",
                joinDate: "required",
                salary: {
                    required:true,
                    number:true,
                },
                assurance: {
                    required:true,
                    number:true
                },
                deductions: "required",
                accountNo: {
                    required:true,
                    number:true,
                    minlength:10,
                    maxlength:10
                },
                type: "required",
                picture: "required",
                user: {
                    required: true,
                    email: true
                },
                pass: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },
                
            },
            messages: {
                firstname: "Enter employee firstname",
                lastname: "Enter employee lastname",
                dob: "Enter the birhtdate of an employee",
                phone: {
                    required: "Enter an employee phone number",
                    number: "Enter valid phone number",
                    minlength: " Phone Number must be 10 numbers",
                    maxength: " Phone Number must be 10 numbers"
                },
                address: "Enter an address of an employee",
                gender: "Please select the gender of an employeee",
                branch: "Select an employee branch",
                designation: "Enter what an employee deserved for",
                department: "Select an employee department",
                joinDate: "Select the date an employee has joined",
                salary: {
                    required: "Enter an employee salary",
                    number: "Salary amount must be in numbers"
                },
                assurance: {
                    required: "Enter an employee assurance deduction",
                    number: "Assurance deduction must be in numbers"
                },
                deductions: {
                    required: "Enter other deductions",
                    number: "Other deductions must be numbers"
                },
                accountNo: {
                    required: "Enter an employee bank account",
                    number: "Bank account number must be numbers"
                },
                type: "Determine the access of employee to the system",
                picture: "Select the picture of an employee",
                user: {
                    required: "Enter employee email",
                    email: "Enter valid email"
                },
                pass: {
                    required: "Provide a password for an employee",
                    minlength: "Password must be at least 6 characters long"
                },
                confirm_password: {
                    required: "Please confirm password",
                    equalTo: "The password do not match"
                }
            }
        }); 
    });
  $().ready(function() {
    $('.command-pay').click(function(){
        print('.pay-table');
    })
        $("#updateEmployee").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                dob: "required",
                phone:{
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                address: "required",
                gender: "required",
                branch: "required",
                designation: "required",
                department: "required",
                joinDate: "required",
                salary: {
                    required:true,
                    number:true
                },
                assurance: {
                    required:true,
                    number:true
                },
                deductions: "required",
                accountNo: {
                    required:true,
                    number:true
                },
                type: "required",
                user: {
                    required: true,
                    email: true
                },
                pass: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },
                
            },
            messages: {
                firstname: "Enter employee firstname",
                lastname: "Enter employee lastname",
                dob: "Enter the birhtdate of an employee",
                phone: {
                    required: "Enter an employee phone number",
                    number: "Enter valid phone number",
                    minlength: " Phone Number must be 10 numbers",
                    maxlength: " Phone Number must be 10 numbers"
                },
                address: "Enter an address of an employee",
                gender: "Please select the gender of an employeee",
                branch: "Select an employee branch",
                designation: "Enter what an employee deserved for",
                department: "Select an employee department",
                joinDate: "Select the date an employee has joined",
                salary: {
                    required: "Enter an employee salary",
                    number: "Salary amount must be in numbers"
                },
                assurance: {
                    required: "Enter an employee assurance deduction",
                    number: "Assurance deduction must be in numbers"
                },
                deductions: {
                    required: "Enter other deductions",
                    number: "Other deductions must be numbers"
                },
                accountNo: {
                    required: "Enter an employee bank account",
                    number: "Bank account number must be numbers",
                    minlength: "Bank account number must be 10",
                    maxlength: "Bank account number must be 10"
                },
                type: "Determine the access of employee to the system",
                user: {
                    required: "Enter employee email",
                    email: "Enter valid email"
                },
                pass: {
                    required: "Provide a password for an employee",
                    minlength: "Password must be at least 6 characters long"
                },
                confirm_password: {
                    required: "Please confirm password",
                    equalTo: "The password do not match"
                }
            }
        }); 
    });