<?php
session_start();
session_destroy();
echo 'You have been logged out. <a href="/">Go back</a>';
// redirect to the login page
header("Location: index.php");
?>