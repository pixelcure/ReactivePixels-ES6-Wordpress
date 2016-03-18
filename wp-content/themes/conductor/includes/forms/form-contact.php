<?php

/************************************************************************************
GENERIC EMAIL CONTACT FORM
include this file in your template before the header.
/************************************************************************************/
global $message;
global $failed;

$failed = false;

if(isset($_POST['email'])) {

	// only one of these errors should output
	$email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
	if(empty($_POST['real_name'])) { died('You did not enter your name.', $message); }
	if(empty($_POST['email'])) { died('You did not enter your email.', $message); }
	if(empty($_POST['comment'])) { died('You did not enter a message.', $message); }
	if(!eregi($email_exp,$_POST['email'])) { died('Enter a valid email address.', $message); }

	// we submit the form only on success
	if ($failed == false) {
		
		$email_to = "destination@email.com";
		$email_from = clean_string($_POST['email']);
		$email_subject = "The Email Subject";

		$real_name = $_POST['real_name'];
		$company = $_POST['company'];
		$email = $_POST['email']; 
		$phone = $_POST['phone']; 
		$comments = $_POST['message'];

		$email_message .= "Name: ".clean_string($real_name)."\n";
		$email_message .= "Company: ".clean_string($company)."\n";
		$email_message .= "Phone: ".clean_string($phone)."\n";
		$email_message .= "Email: ".clean_string($email)."\n";
		$email_message .= "Comments: ".clean_string($comments)."\n";

		// create email headers
		$headers = 'From: '.$email_from."\r\n".'Reply-To: '.$email_from."\r\n".'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers);
		
	}
}

/************************************************************************************
IMPORTANT: Take the below code and place it where
you would like the error/success message to appear.
/************************************************************************************

<?php if (isset($_POST['email'])) { ?>
	<?php if ($failed == true) { ?> 
			<p class="error">We're sorry, but there were error(s) found with the form you submitted.</p>
			<ul class="error"><?php echo $message; ?></ul>
	<?php } else { ?>
			<p class="success">Thank you for your message. We will get back to you soon.</p>
	<?php } ?>
<?php } ?>