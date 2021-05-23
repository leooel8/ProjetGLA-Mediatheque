<?php
if(!isset($_SESSION)){
 	session_start();
}

if(!isset($_SESSION['status'])) {
	$_SESSION['status'] = 'anonymous';
}

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
require_once("controller/authenticatePageController.php");
require_once("controller/borrowMediaController.php");
require_once("controller/manageReservationPageController.php");
require_once("controller/managerCreatesCustomerPageController.php");
require_once("controller/managerValidatesAccountPageController.php");
require_once("controller/managerValidatesMediaPageController.php");
// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
require_once 'model/PHPMailer/src/PHPMailer.php';
require_once 'model/PHPMailer/src/SMTP.php';

//try {
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
		// Manager creates account
		else if (isset($_POST['manager_login_creation'])) {
			managerCreatesAccount($_POST['log_last_name'], $_POST['log_first_name'], $_POST['log_email'], $_POST['log_gender'], $_POST['log_adress'], $_POST['log_premium']);
		}
		// Edit account
		else if(isset($_POST['validEdition'])) {
			editAccount(htmlspecialchars($_POST['lastName']), htmlspecialchars($_POST['firstName']), htmlspecialchars($_POST['email']), htmlspecialchars($_POST['gender']), htmlspecialchars($_POST['adress']));
		}
		// Borrow media
		else if(isset($_POST['borrowMedia'])) {
				borrowMediaPage($_POST['mid'], $_POST['title']);
		} else if(isset($_POST['virtualBorrowMedia'])) {
				virtualBorrowMedia($_POST['mid']);
		}
		// Valid barrow media
		else if(isset($_POST['validBorrowMedia'])) {
			borrowMedia($_POST['mid'], $_POST['sheduledDate'], $_POST['hour']);
		}
		// Edit media
		else if(isset($_POST['editMedia'])) {
			if(!isset($_POST['edition'])) $_POST['edition'] = null;
			if(!isset($_POST['editor'])) $_POST['editor'] = null;
			if(!isset($_POST['duration'])) $_POST['duration'] = null;
			if(!isset($_POST['productor'])) $_POST['productor'] = null;

			editMedia($_POST['mid'], $_POST['format'], $_POST['title'], $_POST['author'], $_POST['quantity'], $_POST['kind'], $_POST['releaseDate'], $_POST['type'], $_POST['price'], $_POST['description'], $_POST['mediaType'], $_POST['edition'], $_POST['editor'], $_POST['productor'], $_POST['duration']);
		}
		// Create media
		else if (isset($_POST['media_format'])) {
			createMedia();
		}
	}
  else if(count($_GET) > 0) {

    ///début des cas GET action
  	if (isset($_GET['action'])) {
			// Login
			if ($_GET['action'] === 'login') {
				loginPage();
			}
			// My account
			else if ($_GET['action'] === 'myAccount') {
				myAccountPage();
			}
			// Edit my account
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
			// My history
			else if($_GET['action'] === 'myHistory') {
				myHistoryPage();
			}
			// My proposition
			else if($_GET['action'] === 'myProposition') {
				myPropositionPage();
			}
			// Edit media
			else if($_GET['action'] === 'editMedia') {
				editMediaPage($_GET['mid']);
			}

			else if ($_GET['action'] === 'manageReservation') {
				manageReservationPage();
			}

			else if($_GET['action'] === 'validReservation') {
				validReservation($_GET['id_reservation']);
			}

			else if($_GET['action'] === 'deleteReservation') {
				deleteReservation($_GET['id_reservation']);
			}

			else if($_GET['action'] === 'managerCreatesCustomer') {
				managerCreatesCustomerPage();
			}

			else if($_GET['action'] === 'ClientSee') {
				//echo "seeClient";
				require("view/reviewClient.php");
			}
			else if($_GET['action'] === 'GestionnaireSee') {
				//echo "seeGes";
				getListGestionnaire();
				//require("view/reviewGestionnaire.php");
			}
			// Manager list
			else if($_GET['action'] === 'gestionnaireListView') {
				getListGestionnaire();
			}

			else if($_GET['action'] === 'renewSubscription') {
				renewSubscriptionPage();
			}

			// Manager validates account page
			else if($_GET['action'] === 'managerValidatesAccount') {
				managerValidatesAccountPage();
			}

			// Manager validates Customer account
			else if($_GET['action'] === 'validateAccountCustomer') {
				validateCustomer($_GET['id_account']);
			}

			// Manager validates Provider account
			else if($_GET['action'] === 'validateAccountProvider') {
				validateProvider($_GET['id_account']);
			}

			// Manager validates media page
			else if($_GET['action'] === 'managerValidatesMedia') {
				managerValidatesMediaPage();
			}

			// Manager validates media
			else if($_GET['action'] === 'validateMedia') {
				validateMedia($_GET['id_media']);
			}

			// Disconnect
			else if($_GET['action'] === 'disconnect') {
				$_SESSION['status'] = 'anonymous';
				$_SESSION['id'] = null;
				mainPage();
			}
			// Extend media duration
			else if($_GET['action'] === 'extendDuration' && isset($_GET['hid'])) {
				extendMediaDuration($_GET['hid']);
			}
			// Lost media
			else if($_GET['action'] === 'lost' && isset($_GET['hid'])) {
				lostMedia($_GET['hid']);
			}
		}
		else if (isset($_GET['search']) && trim($_GET['search']) != "") {
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
		// Unban a client
		else if (isset($_GET['unbanClient'])) {
		  unbanClient($_GET['unbanClient']);
		}
		// Ban a manager
		else if (isset($_GET['banGestionnaire'])){
		  banGestionnaire($_GET['banGestionnaire']);
		}
		// Add a manager
		if (isset($_GET['type_form'])) {
				addGestionnaire($_GET['logCreate_last_name'], $_GET['logCreate_first_name'], $_GET['logCreate_email'], $_GET['genre'],$_GET['logCreate_adress'],$_GET['logCreate_password'],$_GET['logCreate_password_valid']);
		}
		///Voir la liste des gestionnaires
		else if (isset($_GET['reviewGestionnaire'])) {
			getListGestionnaire();
		}
	} else {
		mainPage();
	}
/*} catch(Exception $e) {
	$errorMessage = $e->getMessage();
}*/
