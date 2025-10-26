# ⚙️ Installation Guide – CodeIgniter 3

This guide explains how to install, configure, and run a **CodeIgniter 3** project integrated with **Bootstrap** (frontend) and **MySQL** (database).

---

## 🧩 Prerequisites

Before installation, make sure the following components are installed on your system:

- **Web Server:** Apache or Nginx  
- **PHP:** PHP must be installed and properly configured.  
- **Database:** MySQL or MariaDB  
- **Composer (optional):** For managing additional PHP dependencies.  

You can check PHP installation by running:
```bash
php -v
```

---

## 🗂️ Folder Structure Overview

After downloading or cloning the project, the main folder structure looks like this:

```plaintext
├── application/
│   ├── config/
│   ├── controllers/
│   ├── models/
│   └── views/
├── assets/               # Frontend assets (CSS, JS, images)
├── system/
├── index.php
└── .htaccess
```

---

## 🛠️ Step-by-Step Installation

### **1. Download or Clone the Project**
Clone the repository or extract the CodeIgniter 3 project files to your web server directory (e.g., `htdocs` or `www`):
```bash
git clone https://github.com/your-username/your-project.git
```

Or manually copy the project folder into:
```
C:\xampp\htdocs\your_project_name   (for Windows)
```
or  
```
/var/www/html/your_project_name     (for Linux/Mac)
```

---

### **2. Configure Base URL**

Open the file:
```
application/config/config.php
```

Find this line and set your project’s base URL:
```php
$config['base_url'] = 'http://localhost/your_project_name/';
```

---

### **3. Configure Database Connection**

Open the database configuration file:
```
application/config/database.php
```

Edit it according to your database setup:
```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'your_database_name',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => TRUE,
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

---

### **4. Import the Database**

If your project includes a `.sql` file (e.g., `database.sql`), import it into MySQL using:

```bash
mysql -u root -p your_database_name < database.sql
```

Or, using **phpMyAdmin**:
1. Open `http://localhost/phpmyadmin`
2. Create a new database (e.g., `your_database_name`)
3. Import the `database.sql` file

---

### **5. Configure Autoload**

Open:
```
application/config/autoload.php
```

Load the libraries and helpers you frequently use:
```php
$autoload['libraries'] = array('database', 'session', 'form_validation');
$autoload['helper'] = array('url', 'form', 'html');
```

---

### **6. Enable URL Rewriting (Optional)**

To remove `index.php` from the URL, create or edit `.htaccess` in the project root:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /your_project_name/
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>
```

Then, open `application/config/config.php` and update:
```php
$config['index_page'] = '';
```

---

### **7. Test the Application**

Open your browser and navigate to:
```
http://localhost/your_project_name/
```

If installed correctly, you should see the **CodeIgniter welcome page** or your project’s homepage.

---

## 🧪 Troubleshooting

| Problem | Possible Solution |
|----------|-------------------|
| **Blank page or 500 error** | Check `application/logs/` for PHP errors. Make sure short tags are enabled (`short_open_tag = On`). |
| **Database connection error** | Verify your database credentials and ensure MySQL is running. |
| **CSS/JS not loading** | Check the `$config['base_url']` and file paths in your views. |
| **404 Page Not Found** | Make sure `.htaccess` is enabled and mod_rewrite is active on Apache. |

---

## 📦 Optional: Configure Virtual Host (Apache)

To access your project with a custom domain (e.g., `http://ci3.test`):

1. Edit Apache’s configuration file:
   ```
   C:\xampp\apache\conf\extra\httpd-vhosts.conf
   ```

   Add:
   ```apache
   <VirtualHost *:80>
       DocumentRoot "C:/xampp/htdocs/your_project_name"
       ServerName ci3.test
   </VirtualHost>
   ```

2. Edit your hosts file:
   ```
   C:\Windows\System32\drivers\etc\hosts
   ```
   Add:
   ```
   127.0.0.1   ci3.test
   ```

3. Restart Apache and open:
   ```
   http://ci3.test/
   ```

---

## ✅ Installation Complete!

Your CodeIgniter 3 project is now ready to run.  
You can begin customizing controllers, models, and views according to your project needs.

---

## 🧠 Developer Notes

- Keep the `application/config/config.php` and `database.php` files secure.  
- Use the `application/logs/` folder to track system errors during development.  
- Always test your `.htaccess` configuration after deployment.  
- Bootstrap and other assets should be placed in the `/assets` folder and linked properly in your views.

---

## 📜 License

This project is open-source and available under the **MIT License**.
