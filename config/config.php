<?php

  define('DEBUG', true); // set debug to false for production

  // this should be set to false for security reasons. If you need to run migrations from the browser you can set this to true, then run migrations, then set it back to false.
  define('RUN_MIGRATIONS_FROM_BROWSER', true);

  define('DB_NAME', 'mymvc'); // database name
  define('DB_USER', 'root'); // database user
  define('DB_PASSWORD', '1234'); // database password
  define('DB_HOST', '127.0.0.1'); // database host *** use IP address to avoid DNS lookup
  define('DB_CHAR', 'utf8mb4');

  define('DEFAULT_CONTROLLER', 'Home'); // default controller if there isn't one defined in the url
  define('DEFAULT_LAYOUT', 'default'); // if no layout is set in the controller use this layout.

  define('PROOT', '/mymvc_02/'); // set this to '/' for a live server.
  define('VERSION','0.0.'); // release version this can be used to display version or version assets like css and js files useful for fighting cached browser files

  define('SITE_TITLE', 'Gullman MVC Framework'); // This will be used if no site title is set
  define('MENU_BRAND', 'MrG'); //This is the Brand text in the menu
  define('BOOKINGNR_START', 'MrG'); // Sets the start of the bookingnumber

  define('CURRENT_USER_SESSION_NAME', 'kwXeusqldkiIKjehsLQZJFKJ'); //session name for logged in user
  define('REMEMBER_ME_COOKIE_NAME', 'JAJEI6382LSJVlkdjfh3801jvD'); // cookie name for logged in user remember me
  define('REMEMBER_ME_COOKIE_EXPIRY', 2592000); // time in seconds for remember me cookie to live (30 days)

  define('ACCESS_RESTRICTED', 'Restricted'); //controller name for the restricted redirect

  // SwiftMailer Settings
  define('SMTP_ADDRESS', 'smtp.gmail.com'); // Default gmail SMTP address
  define('SMTP_PORT', 587); // Default gmail port
  define('SMTP_ENCRYPTION', 'tls'); // SMTP tls encryption
  define('MAIL_USERNAME', 'jesper.gullman@gmail.com');  // Your gmail address
  define('MAIL_PASSWORD', '770726Jl+');  // Your gmail password
  define('SMTP_AUTH', true);
