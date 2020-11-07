<?php
include_once ("./View/view.php");
include_once ("./View/searchView.php");
include_once ("./Model/dbone.php");
include_once ("./Model/dbtwo.php");
include_once ("./Model/user.php");
include_once ("./Model/stockopnew.php");
include_once ("./Model/stockopold.php");
class Controller {
    private $model;
    private $view;
    public function __construct() {
        $this->view = new View(NULL,NULL);
    }
    public function execute() {
        if (isset($_GET['action']) && !empty($_GET['action'])) {
            $this->{$_GET['action']}();
            
        } else if (isset($_POST['loginsubmit'])) {
            $username = $_POST['username'];
            $password = $_POST['loginpassword'];
            $this->loginProcess($username, $password);
        } else if (isset($_POST['registersubmit'])) {
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $age = filter_input(INPUT_POST, "age", FILTER_VALIDATE_INT);
            $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING);
            $password = $_POST['regpassword'];
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $dbchoice = $_POST['dboption'];
            $this->registrationProcess($name, $username, $age, $address, $password, $email, $dbchoice);
        } else if (isset($_POST['purchasesubmitnew'])) {
            $itemID = filter_input(INPUT_POST, "itemID", FILTER_VALIDATE_INT);
            $this->purchaseProcessNew($itemID);
        }else if (isset($_POST['purchasesubmitold'])) {
            $itemID = $_POST['itemID'];
            $this->purchaseProcessOld($itemID);
        }  else if (isset($_POST['searchsubmit'])) {
            $searchtext = filter_input(INPUT_POST, "searchtext", FILTER_SANITIZE_STRING);
            $this->searchProcess($searchtext);
        } else {
            $this->homepage();
        }
    }
    public function loginProcess($username, $password) {
        $curr_user = new User();
        $getValidation = $curr_user->getValidation($username, $password);
        if ($getValidation == true) {
		echo "Success";//This is for jmeter
            session_start();
            $_SESSION['username'] = $username;
            header("Location:./index.php?action=searchpage");
        } else {
            header("Location:./index.php?action=loginerrorpage");
        }
    }
        public function logout() {
        session_start();
        session_unset();
        session_destroy();
        $this->homepage();
    }
    public function registrationProcess($name, $username, $age, $address, $password, $email, $dbchoice) {
        $curr_user = new User();
        $registration_success = $curr_user->registerUser($name, $username, $age, $address, $password, $email, $dbchoice);
        if ($registration_success == true) {
		echo "Success";//This is for jmeter
            $this->view = new View($this->view->registerSuccessPageString(), "Register");
            $registerpage = $this->view->output();
            echo $registerpage;
        } else if ($registration_success == false) {
            $this->view = new View($this->view->registerErrorPageString() , "Register");
            $registerpage = $this->view->output();
            echo $registerpage;
        }
    }
    
    public function purchaseProcessNew($itemID) {
        $stockmodel = new StockOperationNew();
        $purchase_success = $stockmodel->StockAccess($itemID);
        if($purchase_success == true){
            header("Location:./index.php?action=searchpagePostPurchase");
        } else{
            $this->view = new SearchView(NULL, ' <div class="emptyrecord">
            <h3>This item is out of stock.</h3>
          </div>', false);
          $searchpage = $this->view->output();
          echo $searchpage;
        }
    }
    public function purchaseProcessOld($itemID) {
        $stockmodel = new StockOperationOld();
        $purchase_success = $stockmodel->StockAccess($itemID);
        if($purchase_success == true){
            header("Location:./index.php?action=searchpagePostPurchase");
        } else{
            $this->view = new SearchView(NULL, ' <div class="emptyrecord">
            <h3>This item is out of stock.</h3>
          </div>', false);
          $searchpage = $this->view->output();
          echo $searchpage;
        }
    }

    
    public function searchProcess($searchtext) {
        $dbmodelone = new DBone();
        $dbmodeltwo = new DBtwo();
        $data_exists_dbone = $dbmodelone->SearchDbOne($searchtext);
        $data_exists_dbtwo = $dbmodeltwo->SearchDbTwo($searchtext);
        if ($data_exists_dbone == true && $data_exists_dbtwo == true) {
            $results_array_dbone = $dbmodelone->data;
            $results_array_dbtwo = $dbmodeltwo->data;
            $merged_results = array_merge($results_array_dbone, $results_array_dbtwo);
            $this->view = new SearchView($merged_results, NULL, true);
            $searchpage = $this->view->output();
            echo $searchpage;
        } else if ($data_exists_dbone == true && $data_exists_dbtwo == false) {
            $this->view = new SearchView($dbmodelone->data, NULL, true);
            $searchpage = $this->view->output();
            echo $searchpage;
        } else if ($data_exists_dbone == false && $data_exists_dbtwo == true) {
            $this->view = new SearchView($dbmodeltwo->data, NULL, true);
            $searchpage = $this->view->output();
            echo $searchpage;
        } else if ($data_exists_dbone == false && $data_exists_dbtwo == false) {
            $this->view = new SearchView(NULL, ' <div class="emptyrecord">
   <h3>Item is not available.</h3>
 </div>', false);
            $searchpage = $this->view->output();
            echo $searchpage;
        }
    }
    
    public function homepage() {
      $this->view = new View($this->view->getHomePageString(), "Home | SMS");
      $homepage = $this->view->output();
      echo $homepage;
    }
  public function searchpage() {
      session_start(); // have to start session at the beginning of page
      $this->view = new SearchView(NULL, NULL, false);
      $searchpage = $this->view->output();
      echo $searchpage;
    }
    public function searchpagePostPurchase() {
        session_start(); // have to start session in the beginning of page
        $this->view = new SearchView(NULL, ' <div class="emptyrecord">
        <h3>You have Purchased an Item.</h3>
      </div>', false);
        $searchpage = $this->view->output();
        echo $searchpage;
      }
  public function registerpage() {
        $this->view = new View($this->view->getRegisterPageString(),"Register");
        $registerpage = $this->view->output();
        echo $registerpage;
    }
    public function loginpage() {
        $this->view = new View($this->view->getLoginPageString(), "Login");
        $loginpage = $this->view->output();
        echo $loginpage;
    }
    public function loginerrorpage() {
        $this->view = new View($this->view->loginErrorPageString(), "Login");
        $loginpage = $this->view->output();
        echo $loginpage;
    }
    public function __destruct() {
    }
}
?>