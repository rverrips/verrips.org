<?php
/* Quick test to verify PHP Version, mcrypt installed and MySQL database connectable */

$hostname = "localhost";
$database = "";
$username = "";
$password = "";

$mysqli = new mysqli($localhost, $username, $password, $database);

/* prints PHP version */
printf("PHP version: %s\n", phpversion());
printf("<br>");

/* check if mcrypt modules is installed */

if (function_exists(mcrypt_generic)) {
    printf ("mcrypt functions are available.<br />\n");
} else {
    printf( "mcrypt functions are not available.<br />\n");
}

/* check connection */
if (mysqli_connect_errno()) { printf("Connect failed: %s\n", mysqli_connect_error()); exit(); }

/* print server version */
printf("MySQL Server version: %s\n", $mysqli->server_info);
printf("<br>");

/* close connection */
$mysqli->close(); 

?>