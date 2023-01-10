 <?php

  define('DB_HOST', 'localhost');
  define('DB_USER', 'rc150757_restorent08');
  define('DB_PASSWORD', 'Dz%Da=!p3q_#');
  define('DB_SCHEMA', 'rc150757_restorent');
  
  // establish a connection to the database server
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA);
  
  if ($conn->connect_error) {
    die('Error: Unable to connect to database server!');
  }
  
?>
