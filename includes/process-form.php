<?php

// retrieve form data
//$name = $_POST['name'];
$email = $_POST['email'];
/*$location = $_POST['location'];
$subject = $_POST['subject'];
$message = $_POST['message'];*/

// set recipient email address
$to = 'guptatusharrock00@gmail.com';

// set email subject
$email_subject = "New contact form submission";

// construct email message
//$email_message = "Name: $name\n";
$email_message = "Email: $email\n";
//$email_message .= "Location: $location\n";
//$email_message .= "Message:\n$message\n";

// send email
mail($to, $email_subject, $email_message);

?>
