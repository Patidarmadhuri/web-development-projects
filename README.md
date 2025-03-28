# AI Forum Project 🚀

![🎥 **Video Demo**]()  
*An interactive forum platform for discussion and content management*

[![PHP Version](https://img.shields.io/badge/PHP-8.1%2B-777BB4?logo=php)](https://php.net/)
[![MySQL Version](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?logo=mysql)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.2%2B-7952B3?logo=bootstrap)](https://getbootstrap.com)

---

## Table of Contents 📑
- [Project Overview](#project-overview)
- [Key Features](#key-features)
- [Tech Stack](#tech-stack)
- [Installation Guide](#installation-guide)
- [Database Schema](#database-schema-)
- [Project Structure](#project-structure-)
- [Security Features](#security-features-)
- [Admin Credentials](#admin-credentials-)
- [Contributing](#contributing-)
- [License](#license-)

---

## Project Overview

A full-stack forum application developed as a university project, featuring:

✅ User authentication & authorization  
✅ CRUD operations for posts & comments  
✅ Admin dashboard with moderation tools  
✅ Search functionality with pagination  
✅ Responsive UI with Bootstrap  
✅ Secure session management

---

## Key Features

### 👤 User Management
- Registration with email verification
- Secure password hashing with `password_hash()`
- Role-based access control (User/Admin)

### 📝 Post System
- Create/Edit/Delete posts
- Paginated listing (5 posts/page)
- Content preview with "Show More" toggle
- Full-text search functionality

### 💬 Comment System
- Nested comments with threading
- Real-time updates
- Moderation tools for admins

### 🔐 Admin Dashboard
- User management interface
- Content moderation tools
- Activity monitoring
- System health checks

---

## Tech Stack

### Frontend
![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)

### Backend
![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)

### Tools
![XAMPP](https://img.shields.io/badge/XAMPP-FB7A24?logo=xampp&logoColor=white)
![phpMyAdmin](https://img.shields.io/badge/phpMyAdmin-6C78AF?logo=phpmyadmin&logoColor=white)

---

## Installation Guide

### Prerequisites
- XAMPP/WAMP/MAMP installed
- PHP 8.1+
- MySQL 5.7+

### Quick Start
1. Clone repository:
```bash
git clone https://github.com/Patidarmadhuri/web-development-projects.git
cd Website-Basis-Forum
Database setup:

sql

CREATE DATABASE ai_forum;
USE ai_forum;
SOURCE sql/ai_forum.sql;
Configure connection:

php

// inc/db_connect.php
$conn = new mysqli("localhost", "root", "", "ai_forum");
Start XAMPP and visit:

http://localhost/Website-Basis-Forum/index.php

Database Schema 📊

Users Table (tblusers)
Column	Type	Description
u_id	INT	Primary Key, Auto-Increment
u_username	VARCHAR(255)	Unique username
u_password	VARCHAR(255)	Hashed password
u_email	VARCHAR(255)	User email
u_role	VARCHAR(50)	User role (user/admin)

Posts Table (tblposts)
Column	Type	Description
p_id	INT	Primary Key, Auto-Increment
p_title	VARCHAR(255)	Post title
p_content	TEXT	Post content
p_created_at	DATETIME	Creation timestamp
p_user_id	INT	Foreign Key (User ID)

Comments Table (tblcomments)
Column	Type	Description
c_id	INT	Primary Key, Auto-Increment
c_content	TEXT	Comment content
c_created_at	DATETIME	Creation timestamp
c_post_id	INT	Foreign Key (Post ID)
c_user_id	INT	Foreign Key (User ID)

Project Structure 📂

Website-Basis-Forum/
├── css/
│   ├── bootstrap.min.css
│   └── custom.css
├── js/
│   ├── main.js
│   └── wow.min.js
├── inc/
│   ├── db_connect.php
│   ├── post_functions.php
│   └── template.php
├── sql/
│   └── ai_forum.sql
├── tpl/
│   ├── admin/
│   │   ├── dashboard.php
│   │   └── user_management.php
│   ├── auth/
│   │   ├── login.php
│   │   └── register.php
│   └── posts/
│       ├── create.php
│       └── view.php
└── index.php
Security Features 🔒
Prepared statements for SQL injection prevention

XSS protection with htmlspecialchars()

Session validation and regeneration

Role-based access control

CSRF protection tokens

Admin Credentials 🔑
Email: madhuri@gmail.com
Password: admin@123

Contributing 🤝
Fork the repository

Create your feature branch (git checkout -b feature/AmazingFeature)

Commit your changes (git commit -m 'Add some AmazingFeature')

Push to the branch (git push origin feature/AmazingFeature)

Open a Pull Request

License 📄
This project is licensed under the MIT License - see the LICENSE file for details.
