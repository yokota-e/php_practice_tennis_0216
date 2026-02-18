<!-- セッションIDがセットされていない人はログインページに飛ばす -->

<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: login.php');
    exit();
}
