// get all users
$.ajax({
    url: "apis/api-getAllUsers.php",
    method: "GET",
    dataType: "JSON"
    }).always(function(ajData){
    // console.log(ajData)
    // // {"status":1, "message":"signup success"}
    // // {"status":0, "message":"signup error"}
    if(ajData.status !== 0){
        for (jUser of ajData) {
            var user = `<div class='user' data-userid='${jUser.id}'>
            <img src="img/${jUser.profilePicture}" alt="profile picture">
            <div class='userInfo'>
                <p class='userName'>${jUser.name}</p>
                <p class='userEmail'>${jUser.lastname}</p>
            </div>
            <button class='btnAddFriend'>Follow</button>
        </div>`
        $('#allUsers').append(user)
        } 
    }
})

$(document).on('click','.btnAddFriend', function () {
    var userId = $(this).parent().attr('data-userid')
    var btnAddFriend = $(this).parent().find('.btnAddFriend')
    

    
    $.ajax({
        url: "apis/api-addFriend.php",
        method: "POST",
        data: {follow_id: userId},
        dataType: 'JSON'
        // dataType: "JSON"
        }).always(function(jData){
        // console.log(jData)
        // // {"status":1, "message":"signup success"}
        // // {"status":0, "message":"signup error"}
        if (jData !== 0) {
            btnAddFriend.text('Followed')
            btnAddFriend.removeClass('btnAddFriend')
        }
        
    })
})

