<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Beauty & Relaxation at Habib Booking Prototype</h1>
            <p>Book your appointment today and experience the luxury you deserve</p>
            <a href="booking.php" class="btn-primary">Book Now</a>
        </div>
    </div>
</section>

<section class="featured-services">
    <div class="container">
        <h2 class="section-title">Our Services</h2>
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
                echo '<p>' . htmlspecialchars(substr($service['description'], 0, 100)) . '...</p>';
                echo '<div class="service-footer">';
                echo '<span class="price">UGX ' . number_format($service['price'], 0) . '</span>';
                echo '<a href="booking.php?service=' . $service['id'] . '" class="btn-secondary">Book Now</a>';
                echo '</div></div>';
            }
            ?>
        </div>
        <div class="text-center">
            <a href="services.php" class="btn-outline">View All Services</a>
        </div>
    </div>
</section>

<section class="why-choose-us">
    <div class="container">
        <h2 class="section-title">Why Choose Habib Booking Prototype</h2>
        <div class="features-grid">
            <div class="feature">
                <i class="fas fa-spa"></i>
                <h3>Professional Staff</h3>
                <p>Our highly trained professionals provide exceptional service with attention to detail.</p>
            </div>
            <div class="feature">
                <i class="fas fa-certificate"></i>
                <h3>Premium Products</h3>
                <p>We use only the highest quality products for all our treatments.</p>
            </div>
            <div class="feature">
                <i class="fas fa-heart"></i>
                <h3>Relaxing Atmosphere</h3>
                <p>Enjoy a serene environment designed for your comfort and relaxation.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>