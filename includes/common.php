<?php
  include_once "connect.php";
  
  foreach($_REQUEST as $variable=>$value)
  {
    $$variable=trim(strip_tags(addslashes(mysqli_real_escape_string($conn, $value))));
  }
  
?>
