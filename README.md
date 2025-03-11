# TastyBites 🍽️ - Online Food Photography Store

TastyBites is an online platform built with CakePHP 5.x that allows users to browse, collect, and purchase high-quality food photography. Whether you're a food blogger, designer, or restaurant owner, you can find stunning images to enhance your content.

## 🌟 Features

📷 Photo Showcase - Browse and search for high-quality food photography.

🛒 Shopping Cart - Add photos to your cart and proceed to checkout.

🔒 User Authentication - Secure login, registration, and password recovery.

💳 Payment Integration - Supports PayPal and credit card payments.

🗄️ Database Management - MySQL-based database with structured data models.


## 🛠️ Installation Guide

1️⃣ Clone the Repository
git clone https://github.com/TonyWu0211/TastyBitesWebsite.git
cd TastyBitesWebsite

2️⃣ Install Dependencies
composer install

3️⃣ Configure the Database
1.Create a new database in MySQL: CREATE DATABASE tastybites;

2.Import the tastybites.sql database file: mysql -u root -p tastybites < tastybites.sql

3.Update config/app_local.php with your database credentials:
'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'tastybites',
    ]
];

4️⃣ Run the Application

"bin/cake server -p 8765",Then open http://localhost:8765 in your browser.




## 🏗️ User Authentication

TastyBites uses CakePHP's Authentication Plugin. To enable authentication:

1.Install the authentication plugin:
  composer require cakephp/authentication

2.Load the plugin in src/Application.php:
 $this->addPlugin('Authentication');

3.Configure authentication in config/app.php.

## 🖼️ Screenshots!
![image](https://github.com/user-attachments/assets/09e8fcbd-d00b-48d4-8c8a-e179ffcd2db6)
![image](https://github.com/user-attachments/assets/f4e6d5a0-a74c-4c5b-9646-7cced9006319)

## 📩 Contribution & Contact
f you have any suggestions or encounter any issues, feel free to submit an issue or reach out:
📧 Email: dongyang.wu0211@gmail.com📷 Instagram: @Tony_Wu
Enjoy TastyBites and happy shopping! 🎉



