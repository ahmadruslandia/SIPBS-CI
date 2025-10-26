<p align="center">
  <h3 align="center">SIPBS (Sistem Informasi Perangkingan Bank Sampah)</h3>
</p>

[![Resource ui][product-ui]](https://www.figma.com/design/VBYfRcltZWD9W5Nm0Ph4bj/SIPBS--Sistem-Informasi-Perangkingan-Bank-Sampah-?node-id=0-1&t=4CZjR8JisjFNCbST-1)
[![Resource ui][product-ui]](https://www.figma.com/design/VBYfRcltZWD9W5Nm0Ph4bj/SIPBS--Sistem-Informasi-Perangkingan-Bank-Sampah-?node-id=10-54&t=dul9nOLH3ZLK4gCs-1)

[product-ui]: Resource/preview/Preview.png

## Description

Sistem Informasi Perangkingan Bank Sampah (SIPBS) is a web-based application designed to rank the most active waste banks based on the principles of a Decision Support System (DSS). This application enables administrators to monitor and evaluate the performance of each waste bank using periodically collected data. By applying predetermined criteria, the system automatically processes the data and generates objective and accurate rankings.

The main features of this application include waste bank data input, score calculation based on specific criteria, and presentation of ranking results in a user-friendly format. Both administrators and related stakeholders can access the ranking results in real time, making it easier to identify which waste banks are the most active and contribute the most to waste management programs.

In addition, the application supports performance reporting for each waste bank, which can serve as a valuable resource for evaluating and improving the effectiveness of waste management programs.

## Technology Description

### Frontend – Bootstrap

**Bootstrap** is a popular open-source frontend framework used to build responsive and visually consistent web interfaces.  
It provides a collection of pre-designed components such as navigation bars, buttons, forms, modals, and grid layouts, which help developers create modern and mobile-friendly designs efficiently.

**Key Features:**

- Responsive design that automatically adapts to any screen size (desktop, tablet, mobile).
- Predefined CSS classes and UI components to accelerate development.
- Built-in JavaScript plugins for interactive elements (e.g., dropdowns, carousels, modals).
- Easy customization through variables and themes.

**Role in this project:**  
Bootstrap is used to design and structure the user interface, ensuring a clean layout, consistent visual appearance, and optimal user experience across all devices.

---

### Backend – CodeIgniter

**CodeIgniter** is a lightweight and high-performance PHP framework designed for developing web applications quickly and efficiently.  
It follows the **Model–View–Controller (MVC)** architecture, which separates the application logic, data, and presentation layers for better maintainability and scalability.

**Key Features:**

- MVC architecture for organized and modular development.
- Simple configuration and minimal dependencies.
- Built-in libraries for form validation, sessions, file uploads, and database handling.
- Strong security features such as XSS filtering, CSRF protection, and password hashing.
- Excellent performance with low memory footprint.

**Role in this project:**  
CodeIgniter serves as the backend framework responsible for handling user requests, processing business logic, validating inputs, managing sessions, and interacting with the MySQL database.

---

### Database – MySQL

**MySQL** is a widely used open-source relational database management system (RDBMS) known for its reliability, performance, and scalability.  
It stores, manages, and retrieves application data efficiently using structured query language (SQL).

**Key Features:**

- Supports complex queries, relationships, and indexing for optimal performance.
- Ensures data integrity through primary and foreign keys.
- Compatible with various frameworks, including CodeIgniter, through built-in database drivers.
- Provides backup, replication, and transaction support for data safety and consistency.

**Role in this project:**  
MySQL functions as the main database engine that stores all user data, application settings, and transactional information.  
It works in tandem with CodeIgniter’s Model layer to perform CRUD (Create, Read, Update, Delete) operations seamlessly.

---
