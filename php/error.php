<?php

$id = $_POST['ID'];
$ed = $_POST['ErrorDescription'];
$type = $_POST['Type'];
 
$to = 'jacob.alexander.reed@gmail.com';
$subject = 'Database Question Error Report';

$message = "ID: $id\r\nDescription: $ed\r\nType: $type";
 
if ($id !== '' && $ed !== '') { // this line checks that we have a valid email address
mail($to, $subject, $message); //This method sends the mail.
echo "<div class='alert alert-info'>The error report has been sent. It will be reviewed and corrected shortly. Thank you!</div>"; // success message
}else{
echo "<div class='alert alert-info'>Sorry. One of the fields was left blank. Please fill all of the fields, and then, try again.</div>";
}

?>