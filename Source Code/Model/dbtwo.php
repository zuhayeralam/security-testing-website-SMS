<?php
class DBtwo {
    public $data;
    public function __construct() {
        $this->data = array();
    }
    public function SearchDbTwo($searchUnescaped) {
        global $mysqli;
        $mysqli = Self::dbconn($mysqli);
	$search = $mysqli->real_escape_string($searchUnescaped);
	$pp = $mysqli->prepare("SELECT  product_table_old.item_id, product_table_old.item_name, product_table_old.seller,product_table_old.price,stock_table.availability
        FROM        product_table_old
        INNER JOIN  stock_table ON product_table_old.item_id = stock_table.product_id
        WHERE product_table_old.item_name LIKE ?  
        OR product_table_old.seller LIKE ?   
        OR product_table_old.item_id LIKE ?
	OR stock_table.availability LIKE ?	
        OR product_table_old.price LIKE ?");
	$pp->bind_param('ssisi', $search,$search,$search,$search,$search);
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
            //OR stock_table.availability LIKE CONCAT('%',?,'%')
        }
    }
    private static function dbconn($mysqli) {
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