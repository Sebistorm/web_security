$.ajax({
  url: "apis/api-getIpCount.php",
  method: "POST",
  data: $('#frmSignup').serialize()
  }).always(function(jData){
  // console.log(jData)
  // {"status":1, "message":"signup success"}
  // {"status":0, "message":"signup error"}
  if(jData >= 2){
      var recaptcha = '<div class="g-recaptcha" data-sitekey="6LcLh6QUAAAAAPuysiw92LGrY162ZwgR3u9_MqrV"></div>';
      $('#recaptchaContainer').prepend(recaptcha);
  } else {
    console.log('under 3 login attempts')
  }
})


$('#frmUser').submit(function(e){
    e.preventDefault()
    $.ajax({
      url: "apis/api-login.php",
      method: "POST",
      data: $('#frmUser').serialize(),
      dataType: 'JSON'
    }).always(function(jData){
      console.log(jData)
      if (jData.status == 1) {
      location.href = 'index.php';
      } else if (jData.status == 2) {
        location.href = 'login.php';
        $('#loginMessage').text('username and password did not match');

      } else if (jData.status == 3) {
        $('#loginMessage').text(jData.message);

      } else if (jData.status == 4) {
        $('#loginMessage').text(jData.message);
        location.href = 'login.php';

      } else if (jData.status == 5) {
        $('#loginMessage').text(jData.message);

      }
    })
  })