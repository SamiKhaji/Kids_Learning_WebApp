# Kids Learning App

This project demonstrates a **Kids Learning App** that provides an engaging and educational platform for children. It features secure user authentication, interactive learning materials, quiz modules, and more to enhance the learning experience. Built using **PHP**, **MySQL**, **HTML**, **CSS**, **JavaScript**, and **PHPMailer**, this app is designed to make learning both fun and secure.

You can view a demo of the app in action by clicking on the thumbnail below:

[![Kids Learning App Demo](![image]([https://github.com/user-attachments/assets/831da402-2e80-452a-b217-e62c7329eed9](https://github.com/SamiKhaji/Kids_Learning_WebApp/blob/main/images/demo1.jpg))
)](https://www.dropbox.com/scl/fi/7hzyput3i3oe8207xqhib/Kids_Learning_App_Demo-Made-with-Clipchamp_1735755338412.mp4?rlkey=8yvedijmpieuwuxdyij9ubqom&st=58b7ci6i&dl=0)

## Key Features

- **Secure Authentication**: Developed a secure login system with two-step verification (2FA) and password encryption. **PHPMailer** is used to send verification emails for the 2FA process, significantly enhancing the protection of both admin and user data.
  
- **Admin Dashboard**: Designed an intuitive admin dashboard that allows easy management of educational content, quizzes, and user data. This streamlined content management and improved operational efficiency.
  
- **Quiz Management Module**: Built a dynamic quiz management system that customizes quizzes based on user progress, incorporates daily and weekly contests, and allows administrators to efficiently manage a large question pool using **PHP Excel**.
  
- **Interactive Learning Modules**: The app offers interactive lessons and quizzes that engage children, helping them learn through play and repetition.
  
- **Progress Tracking**: Includes features to track the learning progress of users, including scores from quizzes and contests.

## Tools and Technologies

- **PHP**: Used for the server-side logic, handling user authentication, quiz management, and content delivery.
- **MySQL**: Database used to store user data, quizzes, and learning materials.
- **DBMS (Database Management System)**: Managed the database for efficient storage, retrieval, and management of data.
- **HTML & CSS**: Used to create the structure and styling of the front-end, providing a responsive and user-friendly interface.
- **JavaScript**: Added interactivity to the app, such as dynamic quizzes and real-time progress tracking.
- **PHPMailer**: Used to send verification emails during the two-factor authentication (2FA) process, enhancing the security of user login.
- **PHP Excel**: Utilized for handling large quiz question pools and exporting data to Excel for easier management.

## How to View the Demo

To view the demo of the **Kids Learning App**, simply click on the thumbnail above:

[Watch the Kids Learning App Demo](https://www.dropbox.com/scl/fi/7hzyput3i3oe8207xqhib/Kids_Learning_App_Demo-Made-with-Clipchamp_1735755338412.mp4?rlkey=8yvedijmpieuwuxdyij9ubqom&st=58b7ci6i&dl=0)

You can also watch the video directly from the embedded player above.

## Installation

To run the Kids Learning App locally, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/SamiKhaji/kKids-Learning_WebApp.git
## Installation

To run the Kids Learning App locally, follow these steps:

1. **Install PHP and MySQL** on your machine.
    - You can download and install PHP from the official website: [PHP Downloads](https://www.php.net/downloads.php)
    - For MySQL, you can use [XAMPP](https://www.apachefriends.org/index.html) or [MAMP](https://www.mamp.info/en/) to easily set up both PHP and MySQL together.

2. **Set up the MySQL database** by importing the provided database schema (`kids_learning_app_db.sql`) into your MySQL instance.
    - Open phpMyAdmin or your MySQL database management tool and import the `.sql` file to create the necessary tables and data.

3. **Update the database configuration** in the `config.php` file with your database credentials.
    - Open `config.php` and make sure to enter your MySQL username, password, and database name.

4. **Install PHPMailer** via Composer:
    ```bash
    composer require phpmailer/phpmailer
    ```

5. **Set up your SMTP settings** in the `mailer_config.php` file to enable email delivery for the 2FA process.
    - In the `mailer_config.php` file, configure your SMTP server settings (e.g., SMTP host, username, password, etc.) to enable email sending. You can use services like **Mailgun**, **SendGrid**, or **Gmail** for this.

6. **Start your PHP server** and navigate to the app's URL in your browser.
    - If using XAMPP or MAMP, you can start the server from the control panel.
    - Open your browser and go to `http://localhost/kids-learning-app` or wherever you have hosted the app.

## Usage

- **For Admins**: Use the admin dashboard to manage users, quizzes, and learning materials.
- **For Users**: Engage in interactive quizzes and learning modules, track progress, and participate in daily/weekly contests.
- **For Content Management**: Admins can easily upload and manage educational materials and quizzes through the dashboard.
- **Two-Factor Authentication (2FA)**: Users will receive a verification code via email (sent through **PHPMailer**) to authenticate their login and enhance account security.

## Conclusion

This **Kids Learning App** showcases how educational tools can be integrated with modern web technologies to create a secure, interactive, and efficient learning platform. It offers both a rich experience for users (children) and robust management capabilities for administrators. The integration of **PHP**, **MySQL**, **PHPMailer**, and interactive content makes it a versatile and scalable app for children's learning.

Feel free to explore the demo, and let me know if you have any suggestions or feedback!

