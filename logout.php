<?php
session_start();
$_SESSION = [];
session_destroy();
header("Location: /Somativa_2/index.php");
exit;
