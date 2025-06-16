<?php
session_start();
$mahp = $_GET['mahp'];
if (isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function($m) use ($mahp) {
        return $m !== $mahp;
    });
}
header('Location: cart.php');
exit;