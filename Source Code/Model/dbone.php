<?php
class DBone {
    public $data;
    public function __construct() {
        $this->data = array();
    }
    public function SearchDbOne($searchUnescaped) {
        global $mysqli;
        $mysqli = Self::dbconn($mysqli);
	$search = $mysqli->real_escape_string($searchUnescaped);

	$pp = $mysqli->prepare("SELECT  product_table.item_id, product_table.item_name, product_table.seller,product_table.price,product_table.type,product_table.man_year,stock_table.availability
        FROM        product_table
        INNER JOIN  stock_table ON product_table.item_id = stock_table.product_id
        WHERE product_table.item_id LIKE ? 
        OR product_table.item_name LIKE ?
        OR product_table.seller LIKE ? 
        OR product_table.price LIKE ?
        OR product_table.type LIKE ?
        OR stock_table.availability LIKE ?  
        OR product_table.man_year LIKE ?");
	$pp->bind_param('ississi', $search,$search,$search,$search,$search,$search,$search);
	$pp->execute();
	$result = $pp->get_result();
        $result_cnt = $result->num_rows;
        if ($result_cnt != 0 && $search != '') {
            while ($row = mysqli_fetch_assoc($result)) {
                $this->data[] = $row;
            }
            return true;
        } else {
            return false; //if data does not exist, return false.
            
        }
    }
    private static function dbconn($mysqli) {
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
    public function __destruct() {
    }
}
?>