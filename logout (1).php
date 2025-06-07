<?php
session_start();
session_destroy();
header("Location: login.php"); // o index.php si prefieres
exit;
?>
