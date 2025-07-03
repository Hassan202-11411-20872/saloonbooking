<?php
include '../includes/config.php';
include '../includes/header.php';

// Fetch all bookings with service name
$stmt = $pdo->query("SELECT b.*, s.name AS service_name FROM bookings b JOIN services s ON b.service_id = s.id ORDER BY b.booking_date DESC, b.booking_time DESC");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch notifications from file
$notifications = [];
$notifications_file = '../notifications.json';
if (file_exists($notifications_file)) {
    $notifications = json_decode(file_get_contents($notifications_file), true) ?: [];
}
?>

<section class="featured-services">
    <div class="container">
        <h2 class="section-title">All Bookings</h2>
        
        <?php if (!empty($notifications)): ?>
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #b76e79; margin-bottom: 1rem;">📧 Recent Notifications</h3>
            <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
                <thead>
                    <tr style="background:#e6ffe6;color:#2d7a2d;">
                        <th style="padding:10px;">Name</th>
                        <th>Email</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_reverse($notifications) as $notif): ?>
                    <tr style="border-bottom:1px solid #f0f0f0;background:#f9fff9;">
                        <td style="padding:10px;"><?php echo htmlspecialchars($notif['name']); ?></td>
                        <td><?php echo htmlspecialchars($notif['email']); ?></td>
                        <td><?php echo htmlspecialchars($notif['service_name']); ?></td>
                        <td><?php echo htmlspecialchars($notif['date']); ?></td>
                        <td><?php echo htmlspecialchars($notif['time']); ?></td>
                        <td><span style="background:#2d7a2d;color:#fff;padding:2px 8px;border-radius:12px;font-size:0.8rem;"><?php echo htmlspecialchars($notif['status']); ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
        <?php endif; ?>
        
        <h3 style="color: #b76e79; margin-bottom: 1rem;">📊 All Bookings (Database)</h3>
        <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
            <thead>
                <tr style="background:#f9e6e9;color:#b76e79;">
                    <th style="padding:10px;">Name</th>
                    <th>Email</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Booked At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $b): ?>
                <tr style="border-bottom:1px solid #f0f0f0;">
                    <td style="padding:10px;"><?php echo htmlspecialchars($b['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($b['customer_email']); ?></td>
                    <td><?php echo htmlspecialchars($b['service_name']); ?></td>
                    <td><?php echo htmlspecialchars($b['booking_date']); ?></td>
                    <td><?php echo htmlspecialchars(substr($b['booking_time'],0,5)); ?></td>
                    <td><?php echo htmlspecialchars($b['created_at']); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($bookings)): ?>
                <tr><td colspan="6" style="text-align:center;padding:20px;">No bookings yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?> 