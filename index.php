<?php
if(!isset($_SESSION)){
	session_start();
}


require("model/db.php");
require("controller/mainPageController.php");
require_once("controller/authenticatePageController.php");
require_once("controller/loginCreationPageController.php");
require_once("model/class/AnonymousCustomer.php");

// require_once("model/class/Customer.php");
// require_once("model/class/Provider.php");
// require_once("model/class/Manager.php");
// require_once("model/class/Administrator.php");
// require_once("model/class/Authenticated.php");
use PHPMailer\PHPMailer\PHPMailer;
require 'model/PHPMailer/src/PHPMailer.php';
require 'model/PHPMailer/src/SMTP.php';



try {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['log_email']) && isset($_POST['log_password'])) {
			authenticate($_POST['log_email'], $_POST['log_password']);
		}
		if (isset($_POST['type_form'])) {
			if ($_POST['type_form'] === 'customer') {
				createCustomer($_POST['logCreate_last_name'], $_POST['logCreate_first_name'], $_POST['logCreate_email'], $_POST['genre'], $_POST['logCreate_password'], $_POST['logCreate_password_valid'], $_POST['account_type'], $_POST['logCreate_adress']);
			} else {
				createProvider($_POST['logCreate_company_name'], $_POST['logCreate_email'], $_POST['logCreate_password'], $_POST['logCreate_password_valid'], $_POST['logCreate_adress']);
			}
		}
	} else if(count($_GET) > 0) {
		if (isset($_GET['action'])) {
			if ($_GET['action'] === 'login') {
				loginPage();
			}
			if ($_GET['action'] === 'create_account') {
				loginCreationPage();
			}
		} else if (isset($_GET['search']) && trim($_GET['search']) != "") {
			search($_GET['search']);
		}
	} else {
		mainPage();
	}		
} catch(Exception $e) {
	$errorMessage = $e->getMessage();
}

