<?php
require("../db.php");
require_once("../class/AnonymousCustomer.php");
// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';


$email = $_GET['email'];

$ac = new AnonymousCustomer;
$ac->forgottenPassword($email);

echo json_encode(true);