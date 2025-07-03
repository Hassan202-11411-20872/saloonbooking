<?php
include '../includes/config.php';
include '../includes/header.php';

// Fetch all bookings with service name
$stmt = $pdo->query("SELECT b.*, s.name AS service_name FROM bookings b JOIN services s ON b.service_id = s.id ORDER BY b.booking_date DESC, b.booking_time DESC");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="featured-services">
    <div class="container">
        <h2 class="section-title">All Bookings</h2>
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