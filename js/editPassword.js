// show modal box (confirm database)
$('#frmEditPassword').submit(function(e){
    e.preventDefault()
    var currentPassword = $('#userCurrentPassword').val()
    var newPassword = $('#userNewPassword').val()
    var repeatPassword = $('#userRepeatPassword').val()

    // console.log(currentPassword)
    // console.log(newPassword)
    // console.log(repeatPassword)

    if ((currentPassword.length >=8 && newPassword.length >=8 && repeatPassword.length >=8) && (newPassword == repeatPassword)) {
        // console.log('validation complete')
        $.ajax({
            url: "apis/api-newPassword.php",
            method: "POST",
            data: $('#frmEditPassword').serialize(),
            dataType: "JSON"
            }).always(function(jData){
            console.log(jData)
            if(jData.status === 1){
                // console.log('Password updated')
                $('#msgStatus').text('Password updated')
                setTimeout(function(){    
                location.href="index.php"
                return
                }, 2000);
            } else {
                // console.log('Something went wrong')
                $('#msgStatus').text(jData.message)
            }
        
            })

    } else {
        // console.log('validation failed')
        $('#msgStatus').text('Please enter a valid password - It must contain 1 lowercase letter, 1 capital letter and 1 number')
    }
})