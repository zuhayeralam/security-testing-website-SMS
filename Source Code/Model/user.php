<?php
class User {
    public function __construct() {
    }
    public function getValidation($usernameUnescaped, $password) {
        global $mysqli;
        $mysqli = Self::dboneconn($mysqli);
	$username = $mysqli->real_escape_string($usernameUnescaped);
        $pp = $mysqli->prepare("SELECT username FROM user WHERE username LIKE ? AND password LIKE ?");
	$pp->bind_param('ss', $username, $password);
	$pp->execute();
	$result = $pp->get_result();
        $result_cnt_dbone = $result->num_rows;
        $mysqli = Self::dbtwoconn($mysqli);
        $pp = $mysqli->prepare("SELECT username FROM user_old WHERE username LIKE ? AND password LIKE ?");
	$pp->bind_param('ss', $username, $password);
	$pp->execute();
	$result = $pp->get_result();
        $result_cnt_dbtwo = $result->num_rows;
        if ($result_cnt_dbone == 1 || $result_cnt_dbtwo == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function registerUser($name, $username, $age, $address, $password, $email, $dbchoice) {
        global $mysqli;
        $mysqli = Self::dboneconn($mysqli);
        $pp = $mysqli->prepare("SELECT username FROM user WHERE username LIKE ?");
	$pp->bind_param('s', $username);
	$pp->execute();
	$result = $pp->get_result();
        $result_cnt_dbone = $result->num_rows;
        $mysqli = Self::dbtwoconn($mysqli);
        $pp = $mysqli->prepare("SELECT username FROM user_old WHERE username LIKE ?");
	$pp->bind_param('s', $username);
	$pp->execute();
	$result = $pp->get_result();
        $result_cnt_dbtwo = $result->num_rows;
        if ($result_cnt_dbone != 0 || $result_cnt_dbtwo != 0) {
            return false;
        } else if ($dbchoice == "dbone") {
            $mysqli = Self::dboneconn($mysqli);
            $pp = $mysqli->prepare("INSERT INTO user(name,username,age,address,password,email) VALUES (?,?,?,?,?,?)");
	    $pp->bind_param('ssisss', $name,$username,$age,$address,$password,$email);
	    $pp->execute();

            return true;
        } else if ($dbchoice == "dbtwo") {
          $mysqli = Self::dbtwoconn($mysqli);
            $pp = $mysqli->prepare("INSERT INTO user_old(name,username,age,address,password,email) VALUES (?,?,?,?,?,?)");
	    $pp->bind_param('ssisss', $name,$username,$age,$address,$password,$email);
	    $pp->execute();

          return true;
      }
    }
    public static function dboneconn($mysqli) {
        $dbIP = '';
        $dbusername = 'sms_user';
        $dbpassword = 'pleaseconnect';
        $database = 'lamp_db2_new';

        $mysqli = new mysqli($dbIP, $dbusername, $dbpassword, $database);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        return $mysqli;
    }
    public static function dbtwoconn($mysqli) {
        $dbIP = '';
        $dbusername = 'sms_user';
        $dbpassword = 'pleaseconnect';
        $database = 'lamp_db2_old';

        $mysqli = new mysqli($dbIP, $dbusername, $dbpassword, $database);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        return $mysqli;
    }
    public function __destruct() {
    }
}
?>