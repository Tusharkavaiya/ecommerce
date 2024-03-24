<?php
session_start();
include 'comman/connection.php';


session_destroy();
   header("location:index.php");



?>