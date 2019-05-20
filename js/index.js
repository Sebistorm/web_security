// get user info
$.ajax({
url: "apis/api-getUserInfo.php",
method: "POST",
dataType: "JSON"
}).always(function(jData){
// console.log(jData)
// {"status":1, "message":"signup success"}
// {"status":0, "message":"signup error"}
if(jData.status !== 0){
    $('.userName').text(jData[0].name)
    $('.userLastName').text(jData[0].lastname)
    $('.userEmail').text(jData[0].email)
    $('.userPhone').text(jData[0].phone)
    $('#profilePicture').attr("src","img/"+jData[0].profilePicture);
}
})

// create tweet
$('#frmTweet').submit(function(e){
    e.preventDefault()    
    console.log('x');
    if ($('#textareaTweet').val().length >= 1 && $('#textareaTweet').val().length <= 255) {
        $.ajax({
        url: "apis/api-createTweet.php",
        method: "POST",
        data: $('#frmTweet').serialize(),
        dataType: "JSON"
        }).always(function(jData){
        // console.log(jData)
        // {"status":1, "message":"signup success"}
        // {"status":0, "message":"signup error"}
        if(jData.status === 1){
            $('#textareaTweet').val('');
        }
    
        })        
    } else {
        console.log('error - 0 characters')
    }
  })

  // *************************************   get Tweets   **********************************
var sLastTweetTime = 0

setInterval( checkTweets, 5000)

function checkTweets () {
        $.ajax({
        url: "apis/api-getTweets.php",
        method: 'POST',
        data: {sLastTweetTime: sLastTweetTime},
        dataType: 'JSON'

    }).done(function(ajData){
        // console.log(ajData)        
        for( jTweet of ajData ) {
            
            const dateTime = jTweet.tweet_time;
            var [year, month, day, hour , min]= dateTime.split(/[- :]/); // regular expression split that creates array with: year, month, day, hour, minutes, seconds values
            const monthIndex = month // remember that Date's contructor 2nd param is monthIndex (0-11) not month number (1-12)!
            const dateObject = day + '/' + monthIndex + '/' + year  + ' kl. ' + hour  + '.' + min; // our Date object

            var tweet = `<div class="tweet"> <div class="tweetHeader"><div><img class='userWallProfilePicture' src='img/${jTweet.profilePicture}' alt='profilepicture'></div><div class="twitterNameHandles"><span class="twitterName">${jTweet.name}</span><span class="twitterHandle">${jTweet.lastname}</span></div><span class='tweetTime'>${dateObject}</span></div><div class="twitterMessage">${jTweet.tweet}</div></div>`
            $('#tweetsContainer').prepend(tweet)
            sLastTweetTime = jTweet.tweet_time

        } 
    })
} 

checkTweets();

//*****************************************    Logout   *******************************************************************
$(document).on('click', '#logout', function() {
    // console.log('x');
    $.ajax({
        url: "apis/api-logout.php",
        method: 'GET'
    }).done(function(ajData){
        // console.log(ajData)
        location.href="login.php"
    })
})
