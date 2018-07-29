<?php
ob_start();
session_start();
$title = "African Roll Ball Federation";
$active = "feeds";
require_once 'partials/init.php';
require_once 'partials/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);
    $query = $con-> prepare("INSERT INTO `msgs`(`name`, `email`, `msg`) VALUES (?,?,?)");
    $query->execute(array($name, $email,$msg));
 //   if ($query->rowCount() > 0)
//    $data = $query->fetchAll(PDO::FETCH_ASSOC)[0];

   header('Location:index.php');
   exit();
}
ob_end_flush();
