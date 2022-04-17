<!DOCTYPE html>

<?php session_start();
session_destroy();
echo "You are being logged out.";
die(header("Location: login.php")); ?>