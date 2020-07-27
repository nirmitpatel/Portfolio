<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$surname = $_POST['surname'];
$visitor_email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

//Validate first
if(empty($name)||empty($surname)||empty($visitor_email)||empty($message)) 
{
    echo "Name, surname, email and message are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Please enter a valid email address!";
    exit;
}

$email_from = 'nirmitpatel1994@gmail.com';
$email_subject = "Portfolio Contact Form";
$email_body = "You have received a new message from the user $name .\n".
    "Here is the message:\n $message".
    
$to = "nirmitpatel1994@gmail.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
//header('Location: thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 