
$('#frmUpdateProfilePicture').submit(function(e){
    e.preventDefault()
    $.ajax({
      url: "apis/api-updateProfilePicture.php",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false
    }).always(function(jData){
      // console.log(jData)
      if (jData == 'succes') {
        // reset the form
        $('#frmUpdateProfilePicture')[0].reset();
        location.href = 'index.php'
      } else {
        // console.log('invalid filetype')
        $('#msgError').text(jData)
      }
    })
  })

//file type validation
$("#file").change(function() {
    var file = this.files[0];
    var imagefile = file.type;
    var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
    alert('Please select a valid image file (JPEG/JPG/PNG).');
    $("#file").val('');
    return false;
    }
});