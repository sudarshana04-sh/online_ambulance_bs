# 🚑 Online Ambulance Booking System

This is a web-based Ambulance Booking System developed as part of my final year BCA project. The system allows users to book ambulances online and provides admin functionalities to manage hospitals and ambulance details.

## 🔧 Technologies Used

- *Frontend:* HTML, CSS, Bootstrap
- *Backend:* PHP
- *Database:* MySQL

## 📁 Project Structure

- index.php – Landing page for the application
- login.php – User and Admin login interface
- book.php – Page for booking an ambulance
- addambulance.php – Admin interface to add ambulance details
- addhospital.php – Admin interface to register hospitals
- ambulance.sql – SQL file to set up the database

## 👤 User Roles

### 1. User
- Can log in and request/book an ambulance
- View confirmation of their booking

### 2. Admin
- Manage hospital records
- Manage ambulance records
- View all bookings

## 🛠 Setup Instructions

1. Clone the repository or download the ZIP file.
2. Extract the project folder to your local server directory (e.g., htdocs for XAMPP).
3. Import the ambulance.sql file into your MySQL database using phpMyAdmin.
4. Update your database connection details in db.php.
5. Start Apache and MySQL using XAMPP or WAMP.
6. Open your browser and navigate to http://localhost/AMBULANCE.


## 📌 Features

- User and Admin authentication
- Ambulance booking by users
- Admin panel for hospital and ambulance management
- Dynamic fetch of hospital and ambulance data

## 🚀 Future Enhancements

- Add real-time tracking using GPS APIs
- SMS/Email booking confirmation
- Improved UI/UX
- Role-based permissions

## 🧑‍💻 Author

*Sudarshana Sharma*  
BCA Final Year Project  

## 📃 License

This project is open-source and free to use for educational purposes.
