function nextImageTest() {
    // get the value of the image in visualTest.php
    var imageRef = document.getElementById('imageRef');
    var numExp = document.getElementById('numExp');

    // show the numExp to console
    // console.log(numExp);

    // call the function php in file nextImage.php using ajax where sends the imageRef to the function php

    $.ajax({
        type: "POST",
        url: "nextImage.php",
        data: { "action": "next"},
        success: function (data) {
            console.log(data);
            // extract the data from the function php
            var data = JSON.parse(data);

            // get num
            var num = data['num'];

            // get value from flag
            var flag = data['flag'];
            // get value from imageRef
            var imageRef_data = data['imageRef'];

            // set the value of imageRef
            imageRef.src = imageRef_data;

            // set the value of numExp
            numExp.innerHTML = "Plate"+ num + "/38";

            // show the value of flag in console

            // if the flag is true, the image is the last image and the button next is disabled, show the alert message 
            // and load the page videoPlayer.php
            if (flag == true) {
                alert("Ishihara Test is finished, thank you for your participation. Please click OK to continue to the next step.");
                window.location.href = "/~tansy.nguyen/src/dataConfident/dataAnonymous.php";
            }

        }
    });
}

// add a event listener to the button next
document.getElementById('nextImageButton').addEventListener('click', nextImageTest);