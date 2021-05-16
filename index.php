<?php
if(!isset($_SESSION)){
 	session_start();
}

if(!isset($_SESSION['status'])) {
	$_SESSION['status'] = 'anonymous';
}
$_SESSION['status'] = 'manager';

// Model
require("model/db.php");
require_once("model/class/AnonymousCustomer.php");
require_once("model/class/Customer.php");
require_once("model/class/Provider.php");
require_once("model/class/Manager.php");
require_once("model/class/Administrator.php");
require_once("model/class/Authenticated.php");
// Controller
require_once("controller/customerController.php");
require_once("controller/mainPageController.php");
require_once("controller/authenticatePageController.php");
require_once("controller/loginCreationPageController.php");
require_once("controller/mediaPageController.php");
require_once("controller/mediaCreationPageController.php");
require_once("controller/roomPageController.php");
require_once("controller/manageClientController.php");
require_once("controller/manageGestionaireController.php");

require_once("controller/borrowMediaController.php");
// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
require_once 'model/PHPMailer/src/PHPMailer.php';
require_once 'model/PHPMailer/src/SMTP.php';

try {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['log_email']) && isset($_POST['log_password'])) {
			authenticate($_POST['log_email'], $_POST['log_password']);
		}
		// Create account
		else if (isset($_POST['type_form'])) {
			if ($_POST['type_form'] === 'customer') {
				createCustomer($_POST['logCreate_last_name'], $_POST['logCreate_first_name'], $_POST['logCreate_email'], $_POST['genre'], $_POST['logCreate_password'], $_POST['logCreate_password_valid'], $_POST['account_type'], $_POST['logCreate_adress']);
			} else {
				createProvider($_POST['logCreate_company_name'], $_POST['logCreate_email'], $_POST['logCreate_password'], $_POST['logCreate_password_valid'], $_POST['logCreate_adress']);
			}
		}
		// Edit account
		else if(isset($_POST['validEdition'])) {
			editAccount(htmlspecialchars($_POST['lastName']), htmlspecialchars($_POST['firstName']), htmlspecialchars($_POST['email']), htmlspecialchars($_POST['gender']), htmlspecialchars($_POST['adress']));
		}
		// Borrow media
		else if(isset($_POST['borrowMedia'])) {
			borrowMediaPage($_POST['mid'], $_POST['title']);
		}
		// Valid barrow media
		else if(isset($_POST['validBorrowMedia'])) {
			borrowMedia($_POST['mid'], $_POST['sheduledDate']);
		}
		else if (isset($_POST['media_format'])) {
			createMedia();
		}

	} else if(count($_GET) > 0) {
		if (isset($_GET['action'])) {
			// Login
			if ($_GET['action'] === 'login') {
				loginPage();
			}
			// My account
			else if ($_GET['action'] === 'myAccount') {
				myAccountPage();
			}
			else if($_GET['action'] === 'editAccount') {
				editAccountPage();
			}
			// Create account
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
			// My media
			else if($_GET['action'] === 'myMedia') {
				myMediaPage();
			}
			// My History
			else if($_GET['action'] === 'myHistory') {
				myHistoryPage();
			}
			}
      // My History
      else if($_GET['action'] === 'gestionnaireListView') {
        getListGestionnaire();
      }
		} else if (isset($_GET['search']) && trim($_GET['search']) != "") {
			searchMedia($_GET['search']);
		}
		// Search a customer
		else if (isset($_GET['searchClient']) && trim($_GET['searchClient']) != "") {
			searchClient($_GET['searchClient']);
		}
		// Ban a customer
		else if (isset($_GET['banClient'])) {
			banClient($_GET['banClient']);
		}


	} else {
		mainPage();
	}
} catch(Exception $e) {
	$errorMessage = $e->getMessage();
}
