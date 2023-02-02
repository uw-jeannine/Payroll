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
    $('#newMessage :submit').attr('disabled','');
    $('#receiver').focus(function(){
        $("#searchReceiver").modal('show');
        $('#keyName').focus();
    }); 
    $('#keyName').keyup(function(){
        var data='lookReceiver=' + $('#keyName').val();
        $.post('../includes/processor.php',
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
    $('.msg-results').hide();   
    $(".pic").click(function(){
        $("#modal_pic").modal('show')
    }); 
});
function searchMsg(a){
        var key=$('#searchMsg').val();
        if (key!='') {
            $('.msg-results').show();
            $('.messages').hide();
            var data = "searchMsg="+key+"&what="+a;
         $.post('../includes/processor.php',
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