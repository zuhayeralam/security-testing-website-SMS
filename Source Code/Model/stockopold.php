<?php
class StockOperationOld {

   public function __construct() {
   }

    public function StockAccess($itemID) {
        global $mysqli;
        $mysqli = Self::dbconn($mysqli);
	$pp = $mysqli->prepare("SELECT * From stock_table WHERE availability = 'In Stock' AND product_id = ?");
	$pp->bind_param('i', $itemID);
	$pp->execute();
	$result = $pp->get_result();

        $result_cnt = $result->num_rows;
        if ($result_cnt != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $num_items = $row["stock"];
                $updated_num_items = $num_items - 1;
                //update purchase
		$pp = $mysqli->prepare("UPDATE stock_table SET stock=? WHERE product_id =?");
		$pp->bind_param('ii',$updated_num_items,$itemID);
		$pp->execute();

                //update availability
		$pp = $mysqli->prepare("UPDATE stock_table SET availability='Out of Stock' WHERE product_id = ? AND stock = 0");
		$pp->bind_param('i',$itemID);
		$pp->execute();
            }
            return true;
        } else {
            return false; //if out of stock, return false.
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