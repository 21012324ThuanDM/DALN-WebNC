<?php
if (!isset($_SESSION)) {
	session_start();
}
unset($_SESSION["success"]);
unset($_SESSION["user"]);

session_destroy();

header("Location: ../../views/customer/index.php");
exit();
?>