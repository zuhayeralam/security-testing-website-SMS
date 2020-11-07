<?php
class SearchView {
    private $text;
	private $username; //wrote for xss demonstration
	private $address = "Feature not available for system older than 2015"; //wrote for xss demonstration

    public function __construct($result_array, $text, $has_data) {
        if ($has_data) {
            $this->generateTable($result_array);
        } else {
            $this->text = $text;
        }
    }
    public function output() {
        //Code added for xss demonstration. This is only implemented for one (new) db.
	//MVC was not followed for this demonstration code.
	$this->username = $_SESSION["username"];
      global $mysqli;
      $mysqli = new mysqli('144.6.229.241', 'sms_user', 'pleaseconnect', 'lamp_db2_new');
      if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
      }
      $pp = $mysqli->prepare("SELECT * FROM user WHERE username=?");
	$pp->bind_param('s', $this->username);
	$pp->execute();
	$result = $pp->get_result();
        $result_cnt = $result->num_rows;
        if ($result_cnt != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $this->username = htmlspecialchars($row["username"], ENT_QUOTES);
		$this->address = htmlspecialchars($row["address"], ENT_QUOTES);
		}
            }
	// Above code in this output() function is only for XSS demonstration.

        return '<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
        <link rel="stylesheet" href="./Style/style.css" />
        <!-- Responsive for tablet -->
        <link
          rel="stylesheet"
          media="screen and (min-width: 500px)"
          href="./Style/tablet.css"
        />
        <link rel="shortcut icon" href="./img/smslogo.png">
      </head>
      <body id="searchbody" class="footer-bottom">    
 <nav id="navbar">
 <img src="./img/smslogo.png" width="100"alt="SMS Logo" />
    <ul>
       <li>
          <a href="index.php?action=searchpage">Home</a>
       </li>
       <li>
          <a href="index.php?action=logout">Logout</a>
       </li>
    </ul>
 </nav>
 <main>
 <div>
 <div class="table-top-card">
   	Username: ' . $this->username . ' </br>
	 Address: ' . $this->address . ' </h3> </div>

         <form action="./index.php" method="POST" class="form">
            <h3>Search Products</h3>
            <div class="input-group">
               <input type="text" name="searchtext" id="searchtext" required />
            </div>
            <input type="submit" name="searchsubmit" value="Search" class="buttonlight" />
         </form>
      </div> ' . $this->text . '</main>
 <footer>
       <div class="footer-text">
          <p>
             Shopping Management System
          </p>
          <br><br>
          <p>
             Copyright &copy; 2020 <br />
             Zuhayer (510356)
          </p>
       </div>
    </footer>
 </body>
 </html>';
    }
    private function generateTable($result_array) {
        $this->text.= '<div class="table-top-card">
   <h3>Search Results</div></h3><table class="primary-table">
   <thead>
       <tr>
         <th> Item ID</th>
         <th> Item Name</th>
         <th> Seller</th>
         <th> Price</th>
         <th> Type </th>
         <th> Year of Manufacture </th>
         <th> Availability </th>
         <th></th>
       </tr>
   </thead>
   <tbody>';
        for ($x = 0;$x < sizeof($result_array);$x++) {
            if (isset($result_array[$x]["type"]) && isset($result_array[$x]["man_year"])) {
                $this->text.= '
                <tr>   
                <td>' . htmlspecialchars($result_array[$x]["item_id"], ENT_QUOTES) . '</td>  
                <td>' . htmlspecialchars($result_array[$x]["item_name"], ENT_QUOTES) . '</td>  
                <td>' . htmlspecialchars($result_array[$x]["seller"], ENT_QUOTES) . '</td>  
                <td>' . htmlspecialchars($result_array[$x]["price"], ENT_QUOTES) . '</td>  
                <td>' . htmlspecialchars($result_array[$x]["type"], ENT_QUOTES) . '</td>  
                <td>' . htmlspecialchars($result_array[$x]["man_year"], ENT_QUOTES) . '</td>
                <td>' . htmlspecialchars($result_array[$x]["availability"], ENT_QUOTES) . '</td>
                <form action="./index.php" method="POST">
                   <input type="hidden" name="itemID" value="'.$result_array[$x]["item_id"].'">
                   <td><input type="submit" name="purchasesubmitnew" class="buttonlight tablebutton" value="Purchase" </td>
                </form>
             </tr>  
            ';
            }
            if (!isset($result_array[$x]["type"]) && !isset($result_array[$x]["man_year"])) {
                $this->text.= '
                <tr>   
                <td>' . htmlspecialchars($result_array[$x]["item_id"], ENT_QUOTES) . '</td>  
                <td>' . htmlspecialchars($result_array[$x]["item_name"], ENT_QUOTES) . '</td>  
                <td>' . htmlspecialchars($result_array[$x]["seller"], ENT_QUOTES) . '</td>  
                <td>' . htmlspecialchars($result_array[$x]["price"], ENT_QUOTES) . '</td>  
                <td></td>  
                <td></td>
                <td>' . htmlspecialchars($result_array[$x]["availability"], ENT_QUOTES) . '</td>
             <form action="./index.php" method="POST">
                <input type="hidden" name="itemID" value="'.$result_array[$x]["item_id"].'">
                <td><input type="submit" name="purchasesubmitold" class="buttonlight tablebutton" value="Purchase" </td>
             </form>  
             </tr>   
            ';
            }
        }
        $this->text.= '</tbody></table>';
    }
}
?>



