<?php
if(!isset($_SESSION)){
 	session_start();
}

if(!isset($_SESSION['status'])) {
	$_SESSION['status'] = 'anonymous';
}
$_SESSION['status'] = 'manager';

require("model/db.php");
require("controller/mainPageController.php");
require_once("controller/authenticatePageController.php");
require_once("controller/loginCreationPageController.php");
require_once("controller/mediaCreationPageController.php");
require("controller/mediaPageController.php");
require("controller/roomPageController.php");
require_once("model/class/AnonymousCustomer.php");

require_once("model/class/Customer.php");
require_once("model/class/Provider.php");
require_once("model/class/Manager.php");
require_once("model/class/Administrator.php");
require_once("model/class/Authenticated.php");
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
		if (isset($_POST['media_format'])) {
			createMedia();
		}
	} else if(count($_GET) > 0) {
		if (isset($_GET['action'])) {
			//Login
			if ($_GET['action'] === 'login') {
				loginPage();
			}
			//Create account
			else if ($_GET['action'] === 'create_account') {
				loginCreationPage();
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
			// Media creation
			else if ($_GET['action'] === 'mediaCreation') {
				mediaCreationPage();
			}
		} else if (isset($_GET['search']) && trim($_GET['search']) != "") {
			searchMedia($_GET['search']);
		}
	} else {
		mainPage();
	}		
} catch(Exception $e) {
	$errorMessage = $e->getMessage();
}

