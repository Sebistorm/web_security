$('#frmSignup').submit(function(e){
    e.preventDefault()    
    var userName =  $('#inputName').val();
    var userLastName =  $('#inputLastName').val();
    var userEmail =  $('#inputEmail').val();
    var userPassword =  $('#inputPassword').val();
    var userRepeatPassword =  $('#inputRepeatPassword').val();
    var userPhone =  $('#inputPhone').val();

    
    // if ( (userName.length > 1 && userLastName.length > 1 && userEmail.length > 1 && userPhone.length >= 8) &&
    // (userPassword.length >= 8 && userRepeatPassword.length >= 8 && userRepeatPassword == userPassword) ) {
        // console.log('x');
        $.ajax({
        url: "apis/api-signup.php",
        method: "POST",
        data: $('#frmSignup').serialize(),
        dataType: "JSON"
        }).always(function(jData){
        // console.log(jData)
        // {"status":1, "message":"signup success"}
        // {"status":0, "message":"signup error"}
        if(jData.status === 1){
            location.href="login.php"
            return
        } else {
            $('#msgSignupError').text(jData.message);
        }
    
        })
    // } else {
    //     // console.log('signup error')
    // }
  })