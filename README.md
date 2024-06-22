
# Student Marks Management System

This is a dynamic web application designed to manage student marks in an educational center such as a school. The application allows staff to add, delete, and update student records, and admins to manage staff details. The website is built using HTML, CSS, Bootstrap, PHP, and MySQL, and is hosted on AWS EC2. The source code is available in this GitHub repository.

# Live link
http://3.27.46.173/php%20pages/admin.php

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Setup and Installation](#setup-and-installation)
- [Database Setup](#database-setup)
- [Usage](#usage)
- [Contact](#contact)

## Features

- Staff can add, delete, and update student records.
- Admins can manage staff details, including adding, editing, and removing staff.
- Responsive design with Bootstrap.
- Secure login system for staff and admin.
- Hosted on AWS EC2 for reliable access.

## Technologies Used

 <img width="48" height="48" src="https://img.icons8.com/color/48/html-5--v1.png" alt="html-5--v1"/> <img width="48" height="48" src="https://img.icons8.com/color/48/css3.png" alt="css3"/> <img width="48" height="48" src="https://img.icons8.com/color/48/bootstrap--v2.png" alt="bootstrap--v2"/> <img width="50" height="50" src="https://img.icons8.com/ios/50/php.png" alt="php"/>    <img width="48" height="48" src="https://img.icons8.com/color/48/mysql-logo.png" alt="mysql-logo"/>     <img width="48" height="48" src="https://img.icons8.com/color/48/amazon-web-services.png" alt="amazon-web-services"/>

## Setup and Installation

To set up this project locally, follow these steps:

1. **Clone the repository**:
    ```bash
    git clone https://github.com/S-ganapathy/SMM-dynamic-website
    ```

2. **Navigate to the project directory**:
    ```bash
    cd SMM-dynamic-websit
    ```

3. **Install dependencies** (if any):
    - Ensure you have PHP and MySQL installed on your system.
    - You may also need to configure your web server (e.g., Apache or Nginx).

4. **Upload project files to your AWS EC2 instance**:
    - Use an FTP client or SCP command to transfer files to your EC2 instance.

## Database Setup

1. **Create a database**:
    ```sql
    CREATE DATABASE student_management_db;
    ```

2. **Import the database schema**:
    - Import the provided SQL file into your database:
      ```bash
      mysql -u your-username -p student_management_db < path/to/database.sql
      ```

3. **Configure database connection**:
    - Update the database connection settings in your PHP files (e.g., `config.php`):
      ```php
      <?php
      $servername = "your-server-name";
      $username = "your-username";
      $password = "your-password";
      $dbname = "student_management_db";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      ?>
      ```

## Usage

- **Login**: Staff and admin can log in using their credentials.
- **Student Management**:
  - Staff can add new student records, update existing ones, and delete records as necessary.
  - Admins can manage staff details, including adding new staff members, updating their details, and deleting staff records.
- **Access the website**: Navigate to the public IP or domain name of your AWS EC2 instance.


## Contact

If you have any questions or suggestions, feel free to contact me:

- **Email**: ganapathydgs333@gmail.com
- **GitHub**: [Ganapathy](https://github.com/S-ganapathy)

