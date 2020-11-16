$(function () {

    var userErrors   = true,
        emailError   = true,
        messageError = true;

    //error box display or not - username
    $('.username').blur(function (){
        if($(this).val().length < 4){
            $(this).css('border','1px solid #f00').parent().find('.asterisk')
                .fadeIn(100).end().find('.custom-alert').fadeIn(200);
            userErrors = true;
        }
        else{
            $(this).css('border','1px solid #080').parent().find('.custom-alert').fadeOut(200)
                .end().find('.asterisk').fadeOut(100);
            userErrors = false;
        }
    })

    //error box display or not - Email
    $('.email').blur(function () {
        if($(this).val().length == 0){
            $(this).css('border','1px solid #f00').parent().find('.asterisk').fadeIn(100)
                .end().find('.custom-alert').fadeIn(200);
            emailError = true;
        }
        else{
            $(this).css('border','1px solid #080').parent().find('.custom-alert').fadeOut(200)
                .end().find('.asterisk').fadeOut(100);
            emailError = false;
        }
    })

    //error box display or not - Message
    $('.message').blur(function (){
        if($(this).val().length < 10){
            $(this).css('border','1px solid #f00').parent().find('.custom-alert').fadeIn(200);
            messageError = true;
        }
        else{
            $(this).css('border','1px solid #080').parent().find('.custom-alert').fadeOut(200);
            messageError = false;
        }
    })

    //submit form
    $('.contact-form').submit(function (e) {
        if(userErrors == true || emailError == true || messageError == true){
            e.preventDefault();
            $('.username , .email ,.message').blur();
        }
    })
})