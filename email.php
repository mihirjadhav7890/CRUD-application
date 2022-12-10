<?php



$to_email = "deepurox.yadav@gmail.com";
$subject = "IV TRIP: FORM SUBMISSION";
$body = "Hi, thank you for submitting the form. Hope you enjoy your trip. Safe Journey.";
$headers = "From: sender email";

if (mail( $to_email , $subject , $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}

?>
