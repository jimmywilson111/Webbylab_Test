# TEST TASK FOR WEBBYLAB #

### 1. Download zip project and extract: ###
- for Windows (XAMPP): `XAMPP\htdocs`
- for Linux/MacOS: `in apache or nginx working path and add config`
### 2. Import DB dump: ###
- from CLI: `mysql -u [user] -p [database_name] < [filename].sql`
- for phpMyAdmin: `Click Export on the menu across the top of the display. Use Quick to save a copy of the whole 
database. Click Go.`
### 3. Change config.php for your DB credentials or create it from config.sample.php ###

### 4. Open project in browser, you can register new user, or use this credentials: ###
``Login: admin``
``Password: 123456``

### Project folder structure

    ├── css                     # Styles folde
    │   ├── main.css            # Main style file
    ├── boot.php                # Connection to DB, functions
    ├── config.php              # Application config
    ├── config.sample.php       # Application sample config
    ├── create.php              # Creating new movie in DB
    ├── delete.php              # Delete movie from DB
    ├── do_login.php            # Logged in user
    ├── do_logout.php           # Logged out user
    ├── do_register.php         # Create new user
    ├── index.php               # Main file
    ├── login.php               # Login page
    ├── registration.php        # Registration page
    ├── upload.php              # Functional for upload information from file
    ├── webbylab_test.sql       # Database dumb
    └── README.md