// Init variable 
var startTime = null;
var stopTime = null;
// function to start the iframe video 
function startVideos() {
    var distiframe = document.getElementById('distVideo');
    var refiframe = document.getElementById('refVideo');

    // start all video
    distiframe.play()
    refiframe.play()


    // start the timer when the video starts
    startTime = new Date();
    var src = distiframe.src;
    $.ajax({
        type: "POST",
        url: "videoplayer.php",
        data: { "action": "start", "src": src },
        success: function (data) {
            console.log(data);
        }
    });
}

// function to stop the iframe video
function stopVideos() {
    var distiframe = document.getElementById('distVideo');
    var refiframe = document.getElementById('refVideo');

    // stop all video 
    distiframe.pause()
    refiframe.pause()
}

// function to next the iframe video
function nextVideo() {
    // stop the timer when the video next
    stopTime = new Date();
    // if start time is not null, take the difference between start and stop time, else take 0
    if (startTime != null) {
        // get the duration from timer start to timer stop 
        var duration = stopTime - startTime;
        // convert the duration to seconds using the formula below
        var seconds = Math.floor(duration / 1000);
        // else take 0
    } else {
        // pop up a message to the user to start the video first without closing fullscreen
        document.querySelector("#alert").style.display = "block";
        // console.log("Please start the video first");
        return;
    }
    startTime = null;


    // console.log(duration);

    // get the value of the checked radio button
    var radValue = document.querySelector('input[name="rad"]:checked').value;
    var distiframe = document.getElementById('distVideo');
    var refiframe = document.getElementById('refVideo');

    // get video src from iframe
    var src = distiframe.src;

    // call the function php in file videoplayer.php using ajax where sends the distiframe and refiframe to the function php

    $.ajax({
        type: "POST",
        url: "videoplayer.php",
        data: { "action": "next", "radValue": radValue, "src": src, "duration": seconds },
        success: function (data) {
            console.log(data);
            // extract dictionary from json
            var dict = JSON.parse(data);
            // get the next video src
            var nextSrc = dict['src_next'];
            // get the next video ref
            var nextRef = dict['ref_next'];
            // get notificaiton
            var notification = dict['notification'];

            var currentID = dict['currentID'];

            var numTotal = dict['numTotal'];


            // set the next video src to video
            distiframe.src = nextSrc;
            refiframe.src = nextRef;

            // update spancurrent text
            var spancurrent = document.getElementById('spancurrent');
            // console.log(spancurrent);
            spancurrent.innerHTML = currentID + "/" + numTotal;

            // check if the notification is 'end'
            if (notification == 'end') {
                // if yes, stop the video
                stopVideos();
                // pop up a message to the user in a new window
                alert("You have finished all the videos, Thank you for your participation");

                // window.location = 'result.php';

                // wait for 5 seconds

                // redirect to result.php
                setTimeout(function () {
                    window.location = 'result.php';
                }
                    , 500);



            }

        }
    });

}

// Find the right method, call on correct element
function launchFullScreen(element) {
    if (element.requestFullScreen) {
        element.requestFullScreen();
    } else if (element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if (element.webkitRequestFullscreen) {
        element.webkitRequestFullScreen();
    } else if (element.msRequestFullscreen) {
        element.msRequestFullscreen();
    }
}

window.addEventListener("load", function () {
    setTimeout(
        function open(event) {
            document.querySelector(".popup").style.display = "block";
        },
        1000
    )
});

// Close the popup
function closePopup() {
    document.querySelector(".popup").style.display = "none";
    // fullscreen
    launchFullScreen(document.documentElement);
}

// close the alert
function closeAlert() {
    document.querySelector("#alert").style.display = "none";
}


document.querySelector("#close").addEventListener("click", function () {
    document.querySelector(".popup").style.display = "none";
    
    // full screen
    // launchFullScreen(document.documentElement);
});

document.querySelector("#closealert").addEventListener("click", function () {
    document.querySelector("#alert").style.display = "none";
    // full screen
    // launchFullScreen(document.documentElement);
});

