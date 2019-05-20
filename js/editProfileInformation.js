// get user info
$.ajax({
    url: "apis/api-getUserEditInfo.php",
    method: "POST",
    dataType: "JSON"
    }).always(function(jData){
    // console.log(jData)
    // // {"status":1, "message":"signup success"}
    // // {"status":0, "message":"signup error"}
    if(jData.status !== 0){
        $('#userName').val(jData[0].name)
        $('#userLastName').val(jData[0].lastname)
        $('#userEmail').val(jData[0].email)
        $('#userPhone').val(jData[0].phone)
    }
})

// show modal box (confirm database)
$('#frmEditProfile').submit(function(e){
    e.preventDefault()
    $('#exampleModalCenter').modal('show')
})

// check if password is correct
$(document).on('click', '#btnConfirmPassword', function() {
    // validation
    if ($('#userPassword').val().length >= 8) {
        // console.log('validation done')
        $.ajax({
            url: "apis/api-checkPassword.php",
            method: "POST",
            data: $('#frmConfirmPassword').serialize(),
            dataType: "JSON"
            }).always(function(jData){
            console.log(jData)
            if(jData.status === 1){
                // console.log('Correct Password')
                saveUserInfo();
                
            } else {
                // console.log('wrong password')
                $('#msgConfirmPassword').text(jData.message)
            }
        
            })
    } else {
        // console.log('too short password')
        // $('#msgConfirmPassword').text('Too short password')
        $('#msgConfirmPassword').text('Wrong password')
    }
})





  function saveUserInfo () {
    var userName =  $('#userName').val();
    var userLastName =  $('#userLastName').val();
    var userEmail =  $('#userEmail').val();
    var userPhone =  $('#userPhone').val();

    if (userName.length > 1 && userLastName.length > 1 && userEmail.length > 1 && userPhone.length >= 8) {
        $.ajax({
        url: "apis/api-saveProfileInfo.php",
        method: "POST",
        data: $('#frmEditProfile').serialize(),
        dataType: "JSON"
        }).always(function(jData){
        // console.log(jData)
        if (jData.status === 1) {
            $('#msgConfirmPassword').text('Correct Password - User updated')
        }
        setTimeout(function(){
            if(jData.status === 1){
                location.href="index.php"
                return
            }
        }, 2000);
        })
    } else {
        // console.log('edit user error')
    }
  }