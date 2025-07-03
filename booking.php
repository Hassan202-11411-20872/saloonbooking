<?php
include 'includes/config.php';
include 'includes/header.php';

// Set admin email
$admin_email = 'hassanharman44@gmail.com'; // Change to your real admin email

// Fetch services for dropdown
$services = $pdo->query("SELECT * FROM services")->fetchAll(PDO::FETCH_ASSOC);

// Pre-select service if coming from ?service=ID
$selected_service = isset($_GET['service']) ? intval($_GET['service']) : 0;

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_id = intval($_POST['service_id'] ?? 0);
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // Basic validation
    if (!$service_id || !$date || !$time || !$name || !$email) {
        $error = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Save booking
        $stmt = $pdo->prepare("INSERT INTO bookings (customer_name, customer_email, service_id, booking_date, booking_time) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $service_id, $date, $time]);

        // Get service name
        $service_name = '';
        foreach ($services as $srv) {
            if ($srv['id'] == $service_id) {
                $service_name = $srv['name'];
                break;
            }
        }

        // Save booking notification to file (since email doesn't work in XAMPP)
        $notification_data = [
            'id' => $pdo->lastInsertId(),
            'name' => $name,
            'email' => $email,
            'service_name' => $service_name,
            'date' => $date,
            'time' => $time,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => 'new'
        ];
        
        // Save notification to file
        $notifications_file = 'notifications.json';
        $notifications = [];
        
        if (file_exists($notifications_file)) {
            $notifications = json_decode(file_get_contents($notifications_file), true) ?: [];
        }
        
        $notifications[] = $notification_data;
        file_put_contents($notifications_file, json_encode($notifications, JSON_PRETTY_PRINT));
        
        // Log successful booking
        error_log("New booking received: $name ($email) - $service_name on $date at $time");
        
        // Try email as backup (might work if mail server is configured)
        $subject = "New Booking at Habib Booking Prototype";
        $message = "You have a new booking:\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Service: $service_name\n" .
            "Date: $date\n" .
            "Time: $time\n" .
            "Booked at: " . date('Y-m-d H:i:s') . "\n";
        
        $headers = "From: Habib Booking <hassanharman44@gmail.com>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        
        $email_sent = @mail($admin_email, $subject, $message, $headers);
        
        if (!$email_sent) {
            error_log("Failed to send booking notification email to: $admin_email");
            $email_error = "Booking saved! Check admin panel for notifications.";
        } else {
            error_log("Email notification sent successfully to: $admin_email");
        }

        $success = true;
    }
}
?>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Book Your Appointment</h1>
            <p>Fill in the form below to reserve your spot at Habib Booking Prototype.</p>
        </div>
    </div>
</section>

<section class="featured-services">
    <div class="container" style="max-width: 500px;">
        <?php if ($success): ?>
            <div class="feature" style="background:#e6ffe6; color:#2d7a2d;">
                <h3><i class="fas fa-check-circle"></i> Booking Successful!</h3>
                <p>Thank you for booking. We look forward to seeing you!</p>
                <?php if (isset($email_error)): ?>
                    <p style="font-size:0.9rem;margin-top:0.5rem;"><i class="fas fa-info-circle"></i> <?php echo $email_error; ?></p>
                <?php else: ?>
                    <p style="font-size:0.9rem;margin-top:0.5rem;"><i class="fas fa-envelope"></i> Confirmation email sent to admin.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <?php if ($error): ?>
                <div class="feature" style="background:#ffe6e6; color:#b76e79;">
                    <p><i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?></p>
                </div>
            <?php endif; ?>
            <form method="post" class="booking-form-card">
                <div class="form-group">
                    <label for="service_id"><i class="fas fa-concierge-bell"></i> Service</label>
                    <select name="service_id" id="service_id" required>
                        <option value="">Select a service</option>
                        <?php foreach ($services as $srv): ?>
                            <option value="<?php echo $srv['id']; ?>" <?php if ($selected_service == $srv['id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($srv['name']); ?> (UGX <?php echo number_format($srv['price'],0); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date"><i class="fas fa-calendar-alt"></i> Date</label>
                    <input type="date" name="date" id="date" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="time"><i class="fas fa-clock"></i> Time</label>
                    <input type="time" name="time" id="time" required>
                </div>
                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Your Name</label>
                    <input type="text" name="name" id="name" required placeholder="e.g. Jane Doe">
                </div>
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Your Email</label>
                    <input type="email" name="email" id="email" required placeholder="e.g. jane@email.com">
                </div>
                <button type="submit" class="btn-primary" style="width:100%;margin-top:1rem;font-size:1.1rem;">
                    <i class="fas fa-paper-plane"></i> Book Now
                </button>
            </form>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?> 