<?php
// database connection
define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE_NAME", "colors-db");

// http errors
define("HTTP_ERROR_404", "HTTP/1.1 404 Not Found");
define("HTTP_ERROR_403", "HTTP/1.1 403 Forbidden");
define("HTTP_ERROR_422", "HTTP/1.1 422 Unprocessable Entity");
define("HTTP_ERROR_500", "HTTP/1.1 500 Internal Server Error");

//http status
define("HTTP_STATUS_200", "HTTP/1.1 200 OK");
define("HTTP_STATUS_201", "HTTP/1.1 201 CREATED");