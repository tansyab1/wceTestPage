<?php
// receive action from the form
if (isset($_POST['send-link'])) {
    // get email from the form
    $email = $_POST['email'];
    // check if email is empty
    if (empty($email)) {
        // if email is empty, redirect to
        // the resetPassword.php page
        // with error message
        header("Location: resetPassword.php?error=emptyemail");
        exit();
    } else {
        // call resetPassword function
        resetPassword($email);
    }
}

// resetPassword function
function resetPassword($email)
{
    // connect to the database
    // $conn = mysqli_connect("wcetest-do-user-13153530-0.b.db.ondigitalocean.com","doadmin","AVNS_8WsUdQ7GU9RwUI5S9gd","DATA", 25060);
              
    $conn = mysqli_connect("localhost","root","","DATA");
    // check if email is valid
    $sql = "SELECT * FROM `userNote` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        // if email is valid, get the password of the user from the database
        $row = mysqli_fetch_assoc($result);
        $password = $row['passwordUser'];
        // send email to the user
        $to = $email;
        $subject = "WCE Test - Reset your password";

        // bold the password in the email
        $message = "Your password is: " . $password;

        // new line
        $message .= "\r \r";

        // give the thank you message
        $message .= "Thank you for attending the WCE Test. If you have any questions, please contact us at tansy.nguyen@math.univ-paris13.fr \r \r";

        // message footer
        $message .= "Best regards, \r \r";

        // give the signature
        $message .= "Tan Sy Nguyen \r \r";
        // give phone number and email
        $message .= "Phone: +33 7 82 84 86 96\r \r";
        $message .= "Email: tansy.nguyen@math.univ-paris13.fr";
        



        $headers = "From: tansy.nguyen@math.univ-paris13.fr";
        mail($to, $subject, $message, $headers);
        // redirect to the resetPassword.php page
        // with success message
        // popup message that the email has been sent then redirect to the login page
        echo "<script type='text/javascript'>alert('An email has been sent to your email address. Please check your email to get your password.');</script>";
        echo "<script type='text/javascript'>window.location.href = 'resetPassword.php';</script>";

        exit();
    } else {
        // if email is invalid, redirect to the resetPassword.php page and popup message that the email is invalid
        echo "<script type='text/javascript'>alert('The email is invalid. Please try again.');</script>";
        echo "<script type='text/javascript'>window.location.href = 'resetPassword.php';</script>";
        
        exit();
    }
}
?>