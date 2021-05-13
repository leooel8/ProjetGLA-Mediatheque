<?php
if(!isset($_SESSION)){
	session_start();
	$_SESSION['status'] = 'anonymous';
}
$_SESSION['status'] = 'customer';

require("model/db.php");
require("controller/mainPageController.php");
require("controller/mediaPageController.php");
require("controller/roomPageController.php");
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
			// Login
			if($_GET['action'] === 'login') {
				echo 'login';
			}
			// Media page
			else if($_GET['action'] === 'mediaPage' && isset($_GET['id'])) {
				mediaPage($_GET['id']);
			}
			// Room list
			else if($_GET['action'] === 'roomList') {
				roomList();
			}
			// Room page
			else if($_GET['action'] === 'roomPage' && isset($_GET['number'])) {
				roomPage($_GET['number']);
			}
		} else if(isset($_GET['search']) && trim($_GET['search']) != "") {
			searchMedia($_GET['search']);
		}
    } else {
		mainPage();
	}		
} catch(Exception $e) {
	$errorMessage = $e->getMessage();
}