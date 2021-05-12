<?php
if(!isset($_SESSION)){
	session_start();
}

require("model/db.php");
require("controller/mainPageController.php");
require_once("model/class/AnonymousCustomer.php");
require_once("model/class/Customer.php");
require_once("model/class/Provider.php");
require_once("model/class/Manager.php");
require_once("model/class/Administrator.php");
require_once("model/class/Authenticated.php");
use PHPMailer\PHPMailer\PHPMailer;
require 'model/PHPMailer/src/PHPMailer.php';
require 'model/PHPMailer/src/SMTP.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      echo "<p> Post </p>";
    } else if(count($_GET) > 0) {
        if(isset($_GET['action'])) {
			if($_GET['action'] === 'login') {
				echo 'login';
			}
		} else if(isset($_GET['search']) && trim($_GET['search']) != "") {
			search($_GET['search']);
		}
    } else {
		mainPage();
	}		
} catch(Exception $e) {
	$errorMessage = $e->getMessage();
}