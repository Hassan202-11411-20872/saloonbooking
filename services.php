<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<section class="featured-services">
    <div class="container">
        <h2 class="section-title">All Our Services</h2>
        <div class="services-grid">
            <?php
            $stmt = $pdo->query("SELECT * FROM services");
            while ($service = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $image = $service['image'];
                if (filter_var($image, FILTER_VALIDATE_URL)) {
                    $img_url = $image;
                } else {
                    $img_url = 'assets/images/' . $image;
                }
                echo '<div class="service-card">';
                echo '<div class="service-image" style="background-image: url(' . htmlspecialchars($img_url) . ')"></div>';
                echo '<h3>' . htmlspecialchars($service['name']) . '</h3>';
                echo '<p>' . htmlspecialchars($service['description']) . '</p>';
                echo '<div class="service-footer">';
                echo '<span class="price">UGX ' . number_format($service['price'], 0) . '</span>';
                echo '<a href="booking.php?service=' . $service['id'] . '" class="btn-secondary">Book Now</a>';
                echo '</div></div>';
            }
            ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?> 