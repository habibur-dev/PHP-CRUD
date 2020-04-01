<?php

$conn = new mysqli('localhost', 'root', '', 'phpcrud');

if ($conn->connect_error) {
  die("Could not connect to the Database! ".$conn->connect_error);
}



 ?>
