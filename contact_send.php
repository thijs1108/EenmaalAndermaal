<?php
$field_email = $_POST['email'];
$field_message = $_POST['message'];

$mail_to = 'wouter1995@live.nl';
$subject = 'Message from a site visitor '.$field_email;

$body_message = 'E-mail: '.$field_email."\n";
$body_message .= 'Message: '.$field_message;

$headers = 'From: '.$field_email."\r\n";
$headers .= 'Reply-To: '.$field_email."\r\n";

$mail_status = mail($mail_to, $subject, $body_message, $headers);

if ($mail_status) { ?>
	<script language="javascript" type="text/javascript">
		alert('Bedankt voor uw bericht. Wij zullen spoedig contact met u opnemen.');
		window.location = 'contact.php';
	</script>
<?php
}
else { ?>
	<script language="javascript" type="text/javascript">
		alert('Bericht is niet gelukt. Probeer het nog eens.');
		window.location = 'contact.php';
	</script>
<?php
}
?>