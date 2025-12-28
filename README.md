# Shadma Makeup Artist Website

A futuristic, elegant, and professional single-page website for a makeup artist built with HTML, Tailwind CSS, Vanilla JavaScript, and PHP.

## 🚀 Features

- **Ultra-modern Design**: Glassmorphism effects, gradients, and premium aesthetics
- **Responsive Layout**: Mobile-first design that works on all devices
- **Smooth Animations**: GSAP and AOS-powered scroll animations
- **Interactive Gallery**: Hover effects and lightbox functionality
- **Contact Form**: PHP backend with validation and sanitization
- **Social Media Integration**: WhatsApp, Instagram, and YouTube links
- **SEO Optimized**: Semantic HTML and meta tags
- **Performance Optimized**: Lazy loading and efficient animations

## 📁 Project Structure

```
makeup-artist-website/
├── index.html          # Main website file with all sections
├── script.js           # JavaScript for interactions and animations
├── backend.php         # PHP form handler with validation
└── README.md          # This file
```

## 🛠️ Technologies Used

- **HTML5**: Semantic markup and accessibility
- **Tailwind CSS**: Utility-first CSS framework via CDN
- **Vanilla JavaScript**: No frameworks, clean and modular code
- **PHP**: Backend form processing (no frameworks)
- **GSAP**: Advanced animations and scroll effects
- **AOS**: Animate on scroll library
- **Font Awesome**: Icons
- **Google Fonts**: Typography

## 🚀 Running Locally

### Option 1: Using PHP Built-in Server (Recommended)

1. **Navigate to the project directory:**
   ```bash
   cd "D:\shadma portfoilo\makeup-artist-website"
   ```

2. **Start PHP server:**
   ```bash
   php -S localhost:8000
   ```

3. **Open your browser and visit:**
   ```
   http://localhost:8000
   ```

### Option 2: Using XAMPP

1. **Install XAMPP** (if not already installed)
2. **Copy the project folder** to `C:\xampp\htdocs\makeup-artist-website`
3. **Start Apache** and **MySQL** from XAMPP control panel
4. **Open browser and visit:**
   ```
   http://localhost/makeup-artist-website
   ```

### Option 3: Using WAMP

1. **Install WAMP** (if not already installed)
2. **Copy the project folder** to `C:\wamp\www\makeup-artist-website`
3. **Start WAMP server**
4. **Open browser and visit:**
   ```
   http://localhost/makeup-artist-website
   ```

## 📧 Contact Form Configuration

The contact form sends emails. For production use:

1. **Update email addresses** in `backend.php`:
   ```php
   $to = 'your-actual-email@example.com'; // Line 58
   ```

2. **Configure SMTP** settings if needed for reliable email delivery

3. **Set up proper domain** and SPF/DKIM records for better email deliverability

## 🎨 Customization

### Colors and Branding
- Update color variables in the `:root` CSS section
- Modify gradient definitions for brand colors
- Change font families in Google Fonts link

### Content
- Update all text content in `index.html`
- Replace placeholder images with actual portfolio images
- Modify service pricing and descriptions
- Update contact information and social media links

### Social Media Links
Update the social media URLs in both the contact section and footer:
```html
<!-- WhatsApp -->
https://wa.me/919876543210?text=Hi%20Shadma,%20I'm%20interested%20in%20your%20makeup%20services

<!-- Instagram -->
https://instagram.com/shadma_makeup

<!-- YouTube -->
https://youtube.com/@shadma_makeup
```

## 📱 Features Overview

### Sections Included:
- **Hero**: Emotional headline with CTA buttons
- **About**: Personal story and credentials
- **Services**: 6 detailed service offerings with pricing
- **Gallery**: Interactive image gallery with hover effects
- **Videos**: YouTube Shorts/vertical video embeds
- **Testimonials**: Social proof from satisfied clients
- **Contact**: Working form with PHP backend
- **Footer**: Branding and social media links

### Interactive Elements:
- Mobile-responsive navigation
- Smooth scroll animations
- Gallery lightbox
- Contact form validation
- Scroll-to-top button
- WhatsApp direct chat integration

## 🔒 Security Features

- **Input Sanitization**: All form inputs are properly sanitized
- **CSRF Protection**: POST-only requests
- **Email Validation**: Proper email format checking
- **Phone Validation**: Indian phone number format
- **Error Handling**: Comprehensive error management
- **Logging**: Form submissions are logged for record-keeping

## 📈 Performance Optimizations

- **Lazy Loading**: Images load as needed
- **Minified Libraries**: CDN versions of libraries
- **Efficient Animations**: Hardware-accelerated transforms
- **Optimized Images**: Proper sizing and formats
- **Clean Code**: Modular and maintainable JavaScript

## 🌐 Browser Support

- Chrome/Chromium (recommended)
- Firefox
- Safari
- Edge
- Mobile browsers (iOS Safari, Chrome Mobile)

## 📞 Support

For technical issues or customization requests:
- Check the browser console for JavaScript errors
- Verify PHP server is running for form functionality
- Ensure all files are in the same directory

## 📄 License

This project is provided as-is for portfolio and commercial use. Feel free to modify and adapt for your needs.

---

**Made with ❤️ for beauty and confidence**

*Transforming beauty, one face at a time.*
