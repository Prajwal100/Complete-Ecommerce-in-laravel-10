# Advance E-commerce website in  Laravel 7

## Demo video :
https://youtu.be/c5a_wrvJSJo


## Features :

====== FRONT-END =======

- Responsive Layout
- Shopping Cart, Wishlist, Product Reviews
- Coupons & Discounts
- Product attributes: cost price, promotion price, stock, size...
- Blog: category, tag, content, web page 
- Module/Extension: Shipping, payment, discount, ...
- Upload manager: banner, images,..
- SEO support: customer URL
- Newsletter management
- Contact forms with the real-time notification (Laravel Pusher)
- Related Products, Recommendations for you in our categories
- A Product search form
- Laravel Socialite implement(Facebook, Google & twitter) & Customer login
- Product Share and follow from different social platform...
- Payment integration(Paypal)
- Order Tracking system
- Multi-level comment system
many more......

======= ADMIN =======

- Admin roles, permission
- Product manager
- Media manager using unisharp laravel file manager
- Banner manager
- Order management
- Category management
- Brand management
- Shipping Management
- Review Management
- Blog, Category & Tag manager
- User Management
- Coupon Management
- System config: email setting, info shop, maintain status,...
- Line Chart & Pie chart ...
- Generate order in pdf form...
- Real time message & notification
- Profile Settings
Many more....


======= USER DASHBOARD =======


- Order management
- Review Management
- Comment Management
- Profile Settings

## Screenshots :


## Set up :

1. Clone the repo and cd into it
2. composer install
3. Rename or copy .env.example file to .env
4. php artisan key:generate
5. Set your database credentials in your .env file
6.Set your Braintree credentials in your .env file if you want to use PayPal. Specifically BT_MERCHANT_ID, BT_PUBLIC_KEY, BT_PRIVATE_KEY. See this episode. If you don't, it should still work but won't show the paypal payment at checkout.
7. Import db file(database/e-shop.sql) into your database (mysql,sql).
8.npm install
9.npm run dev
10.php artisan serve or use virtual host
11.Visit localhost:8000 in your browser
12. Visit /admin if you want to access the admin panel. Admin Email/Password: admin@gmail.com/1111. User Email/Password: user@gmail.com/1111


