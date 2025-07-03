# Habib Booking Prototype

A complete, professional salon booking system built with PHP, MySQL, and modern CSS. This system allows customers to view services, book appointments, and administrators to manage bookings.

## 🌟 Features

- **Modern, Responsive Design** - Beautiful UI that works on all devices
- **Service Management** - Display services with images and pricing
- **Online Booking System** - Easy appointment booking with date/time selection
- **Admin Panel** - View all bookings in a clean, organized table
- **Email Notifications** - Automatic admin notifications for new bookings
- **UGX Currency Support** - Optimized for Ugandan Shillings
- **Internet Image Support** - Use online images or local files
- **Professional Booking Form** - User-friendly form with validation

## 🚀 Quick Start

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- XAMPP/WAMP/MAMP (for local development)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Hassan202-11411-20872/saloonbooking.git
   cd saloonbooking
   ```

2. **Set up the database**
   - Create a new MySQL database named `habibz`
   - Import the following SQL:

   ```sql
   -- Create services table
   CREATE TABLE services (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(100) NOT NULL,
     description TEXT NOT NULL,
     price DECIMAL(10,2) NOT NULL,
     image VARCHAR(255) NOT NULL
   );

   -- Create bookings table
   CREATE TABLE bookings (
     id INT AUTO_INCREMENT PRIMARY KEY,
     customer_name VARCHAR(100) NOT NULL,
     customer_email VARCHAR(100) NOT NULL,
     service_id INT NOT NULL,
     booking_date DATE NOT NULL,
     booking_time TIME NOT NULL,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     FOREIGN KEY (service_id) REFERENCES services(id)
   );

   -- Sample services with online images
   INSERT INTO services (name, description, price, image) VALUES
   ('Haircut', 'Professional haircut by our expert stylists.', 25000.00, 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=400&q=80'),
   ('Manicure', 'Pamper your hands with our luxurious manicure.', 18000.00, 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80'),
   ('Makeup', 'Get a stunning look for any occasion.', 40000.00, 'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=400&q=80');
   ```

3. **Configure database connection**
   - Edit `includes/config.php`
   - Update database credentials:
   ```php
   $host = 'localhost';
   $db   = 'habibz';
   $user = 'root';
   $pass = '';
   ```

4. **Set admin email**
   - Edit `booking.php`
   - Update the admin email address:
   ```php
   $admin_email = 'your-email@example.com';
   ```

5. **Access the system**
   - Homepage: `http://localhost/habibz/`
   - Services: `http://localhost/habibz/services.php`
   - Booking: `http://localhost/habibz/booking.php`
   - Admin: `http://localhost/habibz/admin/bookings.php`

## 📁 Project Structure

```
habibz/
├── index.php              # Homepage with services display
├── services.php           # All services page
├── booking.php            # Booking form and logic
├── admin/
│   └── bookings.php       # Admin panel to view bookings
├── includes/
│   ├── config.php         # Database configuration
│   ├── header.php         # Site header and navigation
│   └── footer.php         # Site footer
├── assets/
│   └── css/
│       └── style.css      # Modern, responsive styles
└── README.md              # This file
```

## 🎨 Customization

### Adding New Services
1. Add to database:
   ```sql
   INSERT INTO services (name, description, price, image) VALUES
   ('New Service', 'Description here', 30000.00, 'image-url-here');
   ```

### Changing Currency
- The system is configured for UGX (Ugandan Shillings)
- To change currency, update the price display in PHP files

### Styling
- Edit `assets/css/style.css` to customize colors, fonts, and layout
- The design uses a pink/rose color scheme (#b76e79)

## 🔧 Features in Detail

### Booking System
- Service selection with pricing
- Date and time picker
- Customer information collection
- Email validation
- Success/error messages

### Admin Panel
- View all bookings
- Customer details
- Service information
- Booking dates and times
- Sort by date (newest first)

### Responsive Design
- Mobile-friendly layout
- Modern card-based design
- Smooth animations
- Professional typography

## 📧 Email Notifications

The system automatically sends email notifications to the admin when:
- A new booking is submitted
- Includes customer details, service, date, and time

## 🛡️ Security Features

- SQL injection prevention with prepared statements
- XSS protection with htmlspecialchars()
- Input validation
- Secure database connections

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🆘 Support

For support or questions:
- Create an issue on GitHub
- Contact the development team

## 🎯 Roadmap

- [ ] User authentication system
- [ ] Payment integration
- [ ] SMS notifications
- [ ] Calendar view for bookings
- [ ] Service categories
- [ ] Customer reviews
- [ ] Multi-language support

---

**Built with ❤️ for modern salon management** 