function nextImageTest() {
    // get the value of the image in visualTest.php
    var imageRef = document.getElementById('imageRef');
    var imageLevel1 = document.getElementById('imageLevel1');
    var imageLevel2 = document.getElementById('imageLevel2');
    var imageLevel3 = document.getElementById('imageLevel3');
    var imageLevel4 = document.getElementById('imageLevel4');
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
            // get value from imageLevel1
            var imageLevel1_data = data['imageLevel1'];
            // get value from imageLevel2
            var imageLevel2_data = data['imageLevel2'];
            // get value from imageLevel3
            var imageLevel3_data = data['imageLevel3'];
            // get value from imageLevel4
            var imageLevel4_data = data['imageLevel4'];

            // set the value of imageRef
            imageRef.src = imageRef_data;
            // set the value of imageLevel1
            imageLevel1.src = imageLevel1_data;
            // set the value of imageLevel2
            imageLevel2.src = imageLevel2_data;
            // set the value of imageLevel3
            imageLevel3.src = imageLevel3_data;
            // set the value of imageLevel4
            imageLevel4.src = imageLevel4_data;

            // set the value of numExp
            numExp.innerHTML = num + "/4";

            // show the value of flag in console

            // if the flag is true, the image is the last image and the button next is disabled, show the alert message 
            // and load the page videoPlayer.php
            if (flag == true) {
                alert("Visual verification is finished, thank you for your participation. Please click OK to continue to the next step.");
                window.location.href = "/~tansy.nguyen/src/instruction/experimentInstruction.php";
            }

        }
    });
}

// add a event listener to the button next
document.getElementById('nextImageButton').addEventListener('click', nextImageTest);