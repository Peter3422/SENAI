<?php
session_start();
session_destroy();
header('Location: index4.php');
exit;
?>