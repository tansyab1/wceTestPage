function nextImageTest(result, resultNumCorrect) {
    // get the value of the image in visualTest.php
    var imageRef = document.getElementById('imageRef');
    var numExp = document.getElementById('numExp');
    var num = document.querySelector("input").valueAsNumber;

    // // add value of num to array resultNum
    // $_SESSION['resultNum'].push(num);


    // show the numExp to console
    // console.log(numExp);

    // call the function php in file nextImage.php using ajax where sends the imageRef to the function php

    $.ajax({
        type: "POST",
        url: "nextImage.php",
        data: { "action": "next", "num": num},
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

            var resultNumCorrect = data['numCorrect'];

            // set the value of imageRef
            imageRef.src = imageRef_data;

            // set the value of numExp
            numExp.innerHTML = "Plate "+ num + "/38";

            // show the value of flag in console

            // if the flag is true, the image is the last image and the button next is disabled, show the alert message 
            // and load the page videoPlayer.php
            if (flag == true) {
                
                // // compare the resultNum with the resultNumCorrect
                // var resultNum = $_SESSION['resultNum'];
                // var result = $_SESSION['resultNumCorrect'];

                // // compart the resultNum with the result index by index and count the number of correct answers
                // var resultNumCorrect = 0;
                // for (var i = 0; i < resultNum.length; i++) {
                //     if (resultNum[i] == result[i]) {
                //         resultNumCorrect++;
                //     }
                // }

                // if the accuracy is less than 70%, show the alert message and load the page videoPlayer.php
                if (resultNumCorrect < 26) {
                    alert("Your accuracy is less than 70%, could you please try again.");
                    window.location.href = "/~tansy.nguyen/src/visual/colorVisual.php";
                } else {
                    alert("You have passed the Ishihara Test, thank you for your participation. Please click OK to continue to the next step.");
                    window.location.href = "/~tansy.nguyen/src/dataConfident/dataAnonymous.php";
                }
                
            }

        }
    });
}

// add a event listener to the button next
document.getElementById('nextImageButton').addEventListener('click', nextImageTest);