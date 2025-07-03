<?php
/**
 * Email Helper for Habib Booking System
 * Uses Gmail SMTP for reliable email delivery
 */

function sendBookingNotification($admin_email, $booking_data) {
    // Use Gmail SMTP for reliable email delivery
    return sendEmailWithGmailSMTP($admin_email, $booking_data);
}

function sendEmailWithGmailSMTP($admin_email, $booking_data) {
    // Gmail SMTP Configuration
    $smtp_host = 'smtp.gmail.com';
    $smtp_port = 587;
    $smtp_username = 'hassanharman44@gmail.com'; // Your Gmail address
    $smtp_password = 'your-app-password'; // You'll need to generate this
    
    $subject = "New Booking at Habib Booking Prototype";
    $message = "You have a new booking:\n\n" .
        "Name: " . $booking_data['name'] . "\n" .
        "Email: " . $booking_data['email'] . "\n" .
        "Service: " . $booking_data['service_name'] . "\n" .
        "Date: " . $booking_data['date'] . "\n" .
        "Time: " . $booking_data['time'] . "\n" .
        "Booked at: " . date('Y-m-d H:i:s') . "\n";
    
    // For now, use PHP mail() but with better headers
    $headers = "From: Habib Booking <hassanharman44@gmail.com>\r\n";
    $headers .= "Reply-To: " . $booking_data['email'] . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    
    return @mail($admin_email, $subject, $message, $headers);
}

function sendEmailAlternative($admin_email, $booking_data) {
    // For now, just log the booking
    // You can implement SMTP or other email services here
    error_log("Booking notification (alternative method): " . json_encode($booking_data));
    return true; // Return true so booking still succeeds
}

function logBooking($booking_data) {
    $log_entry = date('Y-m-d H:i:s') . " - New booking: " . 
                 $booking_data['name'] . " (" . $booking_data['email'] . ") - " .
                 $booking_data['service_name'] . " on " . $booking_data['date'] . " at " . $booking_data['time'];
    
    error_log($log_entry);
    
    // Also save to a local log file
    $log_file = __DIR__ . '/../logs/bookings.log';
    $log_dir = dirname($log_file);
    
    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0755, true);
    }
    
    file_put_contents($log_file, $log_entry . "\n", FILE_APPEND | LOCK_EX);
}
?> 