<?php
// Test email functionality
echo "<h2>Email Test Results</h2>";

// Check if mail function exists
if (function_exists('mail')) {
    echo "✅ PHP mail() function is available<br>";
} else {
    echo "❌ PHP mail() function is NOT available<br>";
}

// Test basic email sending
$to = "hassanharman44@gmail.com"; // Change to your email
$subject = "Test Email from Habib Booking System";
$message = "This is a test email to verify email functionality is working.";
$headers = "From: noreply@habibbookingprototype.com";

$result = @mail($to, $subject, $message, $headers);

if ($result) {
    echo "✅ Test email sent successfully!<br>";
    echo "Check your email: $to<br>";
} else {
    echo "❌ Test email failed to send<br>";
    echo "Error: " . error_get_last()['message'] . "<br>";
}

// Show PHP mail configuration
echo "<h3>PHP Mail Configuration:</h3>";
echo "SMTP: " . ini_get('SMTP') . "<br>";
echo "smtp_port: " . ini_get('smtp_port') . "<br>";
echo "sendmail_path: " . ini_get('sendmail_path') . "<br>";
echo "mail.add_x_header: " . ini_get('mail.add_x_header') . "<br>";
?> 