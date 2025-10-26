# ⚙️ Installation Guide – CodeIgniter 4

This guide provides a complete step-by-step tutorial to install and configure a **CodeIgniter 4** project integrated with **Bootstrap** (frontend) and **MySQL** (database).

---

## 🧩 Prerequisites

Before installing, make sure your environment meets the following requirements:

- **Web Server:** Apache or Nginx  
- **PHP:** PHP 7.4 or later with the following extensions enabled:  
  - intl  
  - mbstring  
  - json  
  - mysqli  
  - xml  
- **Database:** MySQL or MariaDB  
- **Composer:** Required to manage dependencies and create CodeIgniter 4 projects  

Check PHP version and Composer installation using:
```bash
php -v
composer -V
```

---

## 🗂️ Folder Structure Overview

Once CodeIgniter 4 is installed, the main folder structure looks like this:

```plaintext
├── app/
│   ├── Config/
│   ├── Controllers/
│   ├── Models/
│   ├── Views/
├── public/
│   ├── assets/
│   └── index.php
├── system/
├── writable/
├── .env
├── composer.json
└── spark
```

---

## 🛠️ Step-by-Step Installation

### **1. Create or Clone the Project**
#### Option A — Create a new CodeIgniter 4 project using Composer
```bash
composer create-project codeigniter4/appstarter your_project_name
cd your_project_name
```

#### Option B — Clone an existing project
```bash
git clone https://github.com/your-username/your-project.git
cd your-project
composer install
```

---

### **2. Configure the Environment**
Duplicate the provided `.env.example` file and rename it to `.env`:
```bash
cp env .env
```

Then, open `.env` and enable environment mode:
```ini
CI_ENVIRONMENT = development
```

Set your base URL according to your setup:
```ini
app.baseURL = 'http://localhost:8080/'
```

---

### **3. Configure the Database**
In the same `.env` file, configure your MySQL connection:
```ini
database.default.hostname = localhost
database.default.database = your_database_name
database.default.username = root
database.default.password = your_password
database.default.DBDriver = MySQLi
```

---

### **4. Import Database**
If your project includes a SQL file, import it using:
```bash
mysql -u root -p your_database_name < database.sql
```
Or use **phpMyAdmin** → Import → Choose `database.sql` → Go.

---

### **5. Run the Application**
Use the built-in PHP development server to start your app:
```bash
php spark serve
```

Then open your browser and go to:
```
http://localhost:8080
```

---

### **6. Enable Bootstrap Integration**
Place your Bootstrap files (CSS, JS, images) inside the `public/assets/` directory.

Example structure:
```plaintext
public/
├── assets/
│   ├── css/
│   │   └── bootstrap.min.css
│   ├── js/
│   │   └── bootstrap.bundle.min.js
│   └── images/
```

In your view files, link the assets like this:
```html
<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
```

---

## 🧩 System Architecture (MVC)

CodeIgniter 4 follows the **Model-View-Controller (MVC)** pattern:

```plaintext
User Interface (Bootstrap)
        ↓
Controller (CodeIgniter)
        ↓
Model (Database Interaction)
        ↓
Database (MySQL)
```

---

## 🧪 Troubleshooting

| Problem | Possible Solution |
|----------|-------------------|
| **404 Page Not Found** | Make sure the route is defined in `app/Config/Routes.php`. |
| **Database connection error** | Verify your `.env` database configuration. |
| **Composer not recognized** | Ensure Composer is installed and added to PATH. |
| **App not loading assets** | Check the base URL and paths to CSS/JS files. |

---

## 📦 Optional: Setup Virtual Host (Apache)

If you want to access your app using a custom local domain (e.g., `http://ci4.test`):

1. Edit Apache’s configuration file:
   ```
   C:\xampp\apache\conf\extra\httpd-vhosts.conf
   ```
   Add:
   ```apache
   <VirtualHost *:80>
       DocumentRoot "C:/xampp/htdocs/your_project_name/public"
       ServerName ci4.test
   </VirtualHost>
   ```

2. Edit your hosts file:
   ```
   C:\Windows\System32\drivers\etc\hosts
   ```
   Add:
   ```
   127.0.0.1   ci4.test
   ```

3. Restart Apache and open:
   ```
   http://ci4.test/
   ```

---

## ✅ Installation Complete!

Your CodeIgniter 4 project is now ready to run.  
You can start building controllers, models, and views according to your project’s requirements.

---

## 🧠 Developer Notes

- Always keep your `.env` file secure and never commit it to version control.  
- Use `php spark routes` to view all active routes.  
- Use `php spark db:seed` to run database seeders (if available).  
- Use `writable/logs/` to monitor application logs.  
- Customize Bootstrap or frontend styles inside `public/assets/`.

---

## 📜 License

This project is open-source and available under the **MIT License**.
