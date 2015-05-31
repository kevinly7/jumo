<?php
if (isset($_POST['action'])) {
   Session_start();
Session_destroy();
header('Location: ' . $_SERVER['HTTP_REFERER']);

}

?>