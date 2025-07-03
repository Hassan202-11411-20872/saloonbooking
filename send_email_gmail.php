<?php
// Gmail SMTP Email Sender for Habib Booking System
// You'll need to install PHPMailer: composer require phpmailer/phpmailer

// First, install PHPMailer by running this command in your project folder:
// composer require phpmailer/phpmailer

// Then uncomment the code below and configure it

/*
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmailWithGmail($to_email, $subject, $message) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hassanharman44@gmail.com'; // Your Gmail
        $mail->Password   = 'your-app-password'; // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Recipients
        $mail->setFrom('hassanharman44@gmail.com', 'Habib Booking System');
        $mail->addAddress($to_email);
        
        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email sending failed: {$mail->ErrorInfo}");
        return false;
    }
}
*/

// For now, let's create a simple solution that works without external libraries
function sendSimpleEmail($to_email, $subject, $message) {
    // This is a basic attempt - may not work in XAMPP
    $headers = "From: Habib Booking <hassanharman44@gmail.com>\r\n";
    $headers .= "Reply-To: hassanharman44@gmail.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    
    return mail($to_email, $subject, $message, $headers);
}

// Test email function
if (isset($_POST['test_email'])) {
    $result = sendSimpleEmail(
        'hassanharman44@gmail.com',
        'Test Email from Habib Booking System',
        "This is a test email to verify Gmail delivery.\n\nSent at: " . date('Y-m-d H:i:s')
    );
    
    if ($result) {
        echo "<div style='background:#e6ffe6;color:#2d7a2d;padding:1rem;margin:1rem;border-radius:8px;'>✅ Test email sent! Check your Gmail inbox and spam folder.</div>";
    } else {
        echo "<div style='background:#ffe6e6;color:#b76e79;padding:1rem;margin:1rem;border-radius:8px;'>❌ Email failed. XAMPP needs mail server configuration.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email Test - Habib Booking</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        .container { max-width: 600px; margin: 0 auto; }
        .btn { background: #b76e79; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        .btn:hover { background: #a05a65; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Email Test for Habib Booking System</h1>
        
        <form method="post">
            <button type="submit" name="test_email" class="btn">Send Test Email to hassanharman44@gmail.com</button>
        </form>
        
        <h3>To get emails working, you need to:</h3>
        <ol>
            <li><strong>Install PHPMailer:</strong> Run <code>composer require phpmailer/phpmailer</code></li>
            <li><strong>Generate Gmail App Password:</strong> 
                <ul>
                    <li>Go to Gmail → Settings → Security</li>
                    <li>Enable 2-Factor Authentication</li>
                    <li>Generate App Password</li>
                    <li>Use that password in the code</li>
                </ul>
            </li>
            <li><strong>Update the code:</strong> Uncomment the PHPMailer code above</li>
        </ol>
        
        <p><strong>Current Status:</strong> Your booking system works perfectly with file-based notifications. Email is optional but can be added later.</p>
    </div>
</body>
</html> 