# Bike-Mart-BD

**Bike-Mart-BD** is an eCommerce platform for bike enthusiasts. It allows users to explore bike categories, subcategories, and products while providing an admin panel to manage content and orders effectively.

---

## **Project Overview**
### Frontend
- **Framework**: React
- **Key Features**:
  - Dynamic product listing
  - Hero banners and SEO-friendly pages
  - Category, subcategory, and child category filtering
  - Contact, blog, and custom pages

### Backend
- **Framework**: Laravel
- **Database**: MySQL
- **Authentication**: Laravel Sanctum
- **Admin Panel**: Bootstrap-based custom admin panel
- **Key Features**:
  - Secure RESTful APIs
  - Role and permission management
  - SEO management for pages and products
  - Inventory and order management

---

## **Features**

### **Frontend**
- SEO-optimized homepage, contact page, and about page.
- Header with categories, subcategories, and child categories.
- Dynamic home page sections:
  - Hero banners (image, text, button).
  - Featured products.
  - Products by category.
- Footer with social links, contact info, and custom pages.
- Product view page with detailed product information.
- Blog, about, and contact pages.

### **Backend**
- Authentication system with Sanctum for API security.
- Role-based access control using Spatie Permissions.
- API endpoints for:
  - Categories, subcategories, child categories
  - Products, featured products
  - Orders and inventory management
  - SEO setups and hero sections
- Admin dashboard for content management.

---


## **Database Schema**
### Core Tables
- **users**: `id`, `name`, `email`, `phone`, `address`, `role`
- **categories**: `id`, `name`, `slug`, `image`, `priority`
- **products**: `id`, `name`, `slug`, `categoryId`, `current_price`, `stock_qty`, `image`
- **orders**: `id`, `full_name`, `phone`, `email`, `address`, `amount`

---

## **Security Features**
1. **Authentication**: Laravel Sanctum for token-based API protection.
2. **Input Validation**: All API requests are validated using Laravel's `Request` validation.
3. **CORS**: Configured in `cors.php` to allow access from authorized domains.
4. **Rate Limiting**: Applied to APIs to prevent abuse.

---

## **Development Workflow**
1. Clone the repo and set up the backend as described above.
2. Use Postman or similar tools to test API endpoints.
3. Integrate the frontend React app with the backend.
4. Test all functionality locally before deploying.

---

## **Future Enhancements**
- Add payment gateway integration (Stripe/PayPal).
- Implement advanced search and filters for products.
- Develop a mobile app using the same API.

---

## **Contributors**
- **Your Name** - [GitHub Profile](https://github.com/nirjonroy)

---

## **License**
This project is licensed under the [https://www.facebook.com/BikeMartBD/].
