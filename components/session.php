<?php
session_start()
?>
<?php
if (!isset($_SESSION["userid"])) {
  header("Location: login.php");
  exit();
}
?>