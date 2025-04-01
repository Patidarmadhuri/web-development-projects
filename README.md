# Hello, I'm Madhuri Patidar 👩‍💻

Welcome to my GitHub profile! I'm a passionate **Full-Stack Developer** with strong expertise in building modern and scalable web applications. I love writing clean, efficient, and maintainable code.

## 🔧 Technologies & Tools

- **Languages:** ![Java](https://img.shields.io/badge/Java-ED8B00?style=for-the-badge&logo=java&logoColor=white) ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black) ![TypeScript](https://img.shields.io/badge/TypeScript-007ACC?style=for-the-badge&logo=typescript&logoColor=white) ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) ![C++](https://img.shields.io/badge/C++-00599C?style=for-the-badge&logo=cplusplus&logoColor=white)
- **Frameworks & Libraries:** ![Spring Boot](https://img.shields.io/badge/Spring%20Boot-6DB33F?style=for-the-badge&logo=spring-boot&logoColor=white) ![Angular](https://img.shields.io/badge/Angular-DD0031?style=for-the-badge&logo=angular&logoColor=white) ![Vue.js](https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vue.js&logoColor=4FC08D) ![React](https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB) ![Node.js](https://img.shields.io/badge/Node.js-339933?style=for-the-badge&logo=nodedotjs&logoColor=white)
- **Databases:** ![MongoDB](https://img.shields.io/badge/MongoDB-4EA94B?style=for-the-badge&logo=mongodb&logoColor=white) ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
- **Tools & Platforms:** ![Git](https://img.shields.io/badge/Git-F05032?style=for-the-badge&logo=git&logoColor=white) ![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white) ![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white) ![Kubernetes](https://img.shields.io/badge/Kubernetes-326CE5?style=for-the-badge&logo=kubernetes&logoColor=white) ![AWS](https://img.shields.io/badge/Amazon%20AWS-232F3E?style=for-the-badge&logo=amazon-aws&logoColor=white)
- **Testing:** ![JUnit](https://img.shields.io/badge/JUnit-25A162?style=for-the-badge&logo=junit5&logoColor=white) ![Jasmine](https://img.shields.io/badge/Jasmine-8A4182?style=for-the-badge&logo=jasmine&logoColor=white)
- **Agile Methodologies:** Scrum, SAFe
- **CI/CD:** ![Jenkins](https://img.shields.io/badge/Jenkins-D24939?style=for-the-badge&logo=jenkins&logoColor=white) GitLab CI
- **Other Tools:** Swagger, SonarQube, Postman, IntelliJ IDEA, Visual Studio Code

## 🏆 What I Do

- **Full-Stack Development**: Designing and developing scalable applications using modern technologies like Angular, Spring Boot, and Node.js.
- **Collaborative Projects**: I work well in agile teams, collaborating with product owners, designers, and backend developers.
- **Continuous Learning**: I'm always exploring new technologies and best practices, recently diving into Vue.js and improving my knowledge of cloud computing with AWS and Kubernetes.

## 📂 Key Projects

- **Brand Landscape Analyzer**: A tool for analyzing brand search results, built using Angular 14, Spring Boot, and MongoDB. Improved efficiency for users by automating the process of evaluation.
- **SCT (Smart Charging Truck)**: Developed a solution to automate mining operations for a large industrial client, integrating real-time tracking and delivery functionalities.
- **Traffic Analysis App**: A cloud-based traffic analysis tool, built using Angular 13 and JQuery, with advanced predictive analytics to help improve transportation management.

## 💼 Work Experience

- **Senior Full Stack Developer at HCL Technologies (2022-2023)**: Led the development of the Brand Landscape Analyzer, mentoring junior developers and ensuring project efficiency in an Agile environment.
- **Full Stack Developer at Capgemini (2019-2022)**: Worked on various automation and industrial projects, using a diverse tech stack to build real-time solutions for clients in sectors like mining and manufacturing.

## 🚀 My Goal

My goal is to build innovative software that can make a positive impact. I'm always looking for new opportunities to apply my skills and learn new technologies. If you're looking for a reliable, passionate developer, feel free to reach out.

Feel free to explore my repositories and let me know if you'd like to collaborate on something exciting.

## 🔗 Let's Connect

I'm always open to new challenges, collaborations, and learning opportunities. You can reach out to me through GitHub or my [LinkedIn Profile](https://www.linkedin.com/in/madhuri-fullstack-developer/) or [Portfolio](https://madhuripatidar.mystrikingly.com).

---

**Happy coding!** 🎉
=======
# AI Forum Project

![AI Forum Banner](https://via.placeholder.com/1200x400.png?text=AI+Forum+Project)  
*An interactive forum platform for users to create, view, and comment on posts.*

---

## Table of Contents

- [Project Overview](#project-overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Setup Instructions](#setup-instructions)
- [Database Schema](#database-schema)
- [File Structure](#file-structure)
- [Styleguide Compliance](#styleguide-compliance)
- [Demo Video](#demo-video)
- [GitHub Repository](#github-repository)
- [Future Improvements](#future-improvements)
- [Contact](#contact)

---

## Project Overview

The **AI Forum** is a web-based platform built as part of a university project to demonstrate a fully functional forum system. It allows users to register, log in, create posts, comment on posts, and manage their content. Administrators have additional privileges to manage users, posts, and comments via an admin dashboard. The project includes features like pagination, search functionality, and content truncation for a better user experience.

The project was developed with a focus on security (e.g., preventing SQL injection and XSS attacks), usability (e.g., pagination and search), and adherence to Johannes’ BrightlingWiki PHP Styleguide for consistent coding practices.

---

## Features

- **User Authentication**:
  - Register with a username, email, and password.
  - Log in and log out securely with session management.
  - Passwords are hashed using `password_hash()` for security.

- **Post Management**:
  - Create, edit, and delete posts (for post owners and admins).
  - View a paginated list of posts with 5 posts per page.
  - Search posts by title or content.
  - Truncate post content longer than 200 characters with a "Vollständige Ansicht" toggle button.

- **Comment System**:
  - Add, edit, and delete comments on posts (for comment owners and admins).
  - Toggle visibility of comments with a "Kommentare anzeigen" button.

- **Admin Dashboard**:
  - Manage users (delete users, with a safeguard preventing self-deletion).
  - Manage posts and comments (edit or delete any post/comment).

- **Pagination**:
  - Navigate through posts with Previous/Next links and page numbers.
  - Automatically redirect to the last valid page if an invalid page is accessed.

- **Search Functionality**:
  - Search posts by title or content using a search form.
  - Reset search to view all posts with a "Suche zurücksetzen" link.

- **Security**:
  - SQL injection prevention using prepared statements.
  - XSS prevention by escaping database outputs with `rpl()` and user inputs with `htmlspecialchars()`.

---

## Tech Stack

- **Frontend**:
  - HTML, CSS (Bootstrap for styling), JavaScript (for toggling content and comments).
  - WOW.js for fade-in animations.

- **Backend**:
  - PHP 8.1+ (with MySQLi for database interactions).
  - Session-based authentication.

- **Database**:
  - MySQL (MariaDB compatible).

- **Server**:
  - XAMPP (for local development).

---

## Setup Instructions

### Prerequisites
- XAMPP (or any PHP/MySQL server) installed.
- Git (to clone the repository).
- A web browser (e.g., Chrome, Firefox).

### Steps
1. **Clone the Repository**:
   ```bash
   git clone <your-github-repo-link>
   cd Website-Basis-Forum


2. Set Up the Database:
Start XAMPP and ensure Apache and MySQL are running.
Open phpMyAdmin (http://localhost/phpmyadmin).
Create a new database named ai_forum.
Import the ai_forum.sql file (located in the sql/ directory) to set up the tables and sample data.

3. Configure Database Connection:
Open inc/db_connect.php and update the database credentials if necessary:
php
$conn = mysqli_connect("localhost", "root", "", "ai_forum");

4. Run the Project:
Move the project folder to C:\xampp\htdocs\ (or your XAMPP htdocs directory).
Access the project in your browser: http://localhost/Website-Basis-Forum/index.php.

5. Test with Sample Users:

Admin User:
Email: madhuri@gmail.com
Password: admin123

Regular User:
Email: user1@gmail.com
Password: (hashed in the database, use the "Forgot Password" feature or register a new user).

Database Schema
The project uses a MySQL database named ai_forum with the following tables:

tblusers

Column	Type	Description
u_id	INT (PK, AI)	Unique user ID
u_username	VARCHAR(255)	Username
u_password	VARCHAR(255)	Hashed password
u_email	VARCHAR(255)	Email address
u_role	VARCHAR(50)	Role (user or admin)

tblposts

Column	Type	Description
p_id	INT (PK, AI)	Unique post ID
p_title	VARCHAR(255)	Post title
p_content	TEXT	Post content
p_created_at	DATETIME	Creation timestamp
p_user_id	INT (FK)	ID of the user who created the post

tblcomments

Column	Type	Description
c_id	INT (PK, AI)	Unique comment ID
c_content	TEXT	Comment content
c_created_at	DATETIME	Creation timestamp
c_post_id	INT (FK)	ID of the post being commented on
c_user_id	INT (FK)	ID of the user who created the comment


File Structure

Website-Basis-Forum/
├── css/                    # CSS files (Bootstrap, custom styles)
├── js/                     # JavaScript files (WOW.js, custom scripts)
├── inc/                    # PHP includes and functions
│   ├── db_connect.php      # Database connection
│   ├── post_functions.php  # Functions for post/comment management
│   └── template.php        # Template engine class
├── sql/                    # SQL dump files
│   └── ai_forum.sql        # Database schema and sample data
├── tpl/                    # Template files (PHP views)
│   ├── tpl_admin.php       # Admin dashboard
│   ├── tpl_create.php      # Create new post
│   ├── tpl_delete.php      # Delete post
│   ├── tpl_delete_comment.php # Delete comment
│   ├── tpl_edit.php        # Edit post
│   ├── tpl_edit_comment.php # Edit comment
│   ├── tpl_index.php       # Main template
│   ├── tpl_login.php       # Login page
│   ├── tpl_logout.php      # Logout page
│   ├── tpl_posts.php       # Posts list with pagination and search
│   └── tpl_register.php    # Registration page
├── index.php               # Entry point
└── README.md               # Project documentation

