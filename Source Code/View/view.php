<?php
class View {
    private $text;
    private $title;
    public function __construct($text, $title) {
        $this->text = $text;
        $this->title = $title;
    }
    public function output() {
        return '<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>'.$this->title.'</title>
        <link rel="stylesheet" href="./Style/style.css" />
        <!-- Responsive for tablet -->
        <link
          rel="stylesheet"
          media="screen and (min-width: 500px)"
          href="./Style/tablet.css"
        />
        <link rel="shortcut icon" href="./img/smslogo.png">
      </head>
      <body id="loginbody" class="footer-bottom">    
 <nav id="navbar">
 <img src="./img/smslogo.png" width="100"alt="SMS Logo" />
    <ul>
       <li>
          <a href="index.php?action=homepage">Home</a>
       </li>
       <li>
          <a href="index.php?action=registerpage">Registration</a>
       </li>
       <li>
          <a href="index.php?action=loginpage">Login</a>
       </li>
    </ul>
 </nav>' . $this->text . '<footer>
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
    public function getLoginPageString() {
        $text = '<main>
    <div>
       <form action="./index.php" method="POST" class="form">
          <h3>Log In</h3>
          <div class="input-group">
             <label for="username">Username</label>
             <input type="text" name="username" id="username" required />
          </div>
          <div class="input-group">
             <label for="loginpassword">Password</label>
             <input type="password" name="loginpassword" id="loginpassword" required />
          </div>
          <input type="submit" value="login" name="loginsubmit" class="buttonlight" />
       </form>
    </div>
   </main>';
        return $text;
    }
    public function loginErrorPageString() {
        $text = '<main>
    <div class="errorcard">
   <h3>Login was unsuccessful.</h3>
 </div>
    <div>
       <form action="./index.php" method="POST" class="form">
          <h3>Log In</h3>
          <div class="input-group">
             <label for="username">Username</label>
             <input type="text" name="username" id="username" required />
          </div>
          <div class="input-group">
             <label for="loginpassword">Password</label>
             <input type="password" name="loginpassword" id="loginpassword" required />
          </div>
          <input type="submit" value="login" name="loginsubmit" class="buttonlight" />
       </form>
    </div>
   </main>';
        return $text;
    }
    public function getRegisterPageString() {
        $text = '<main>
    <div>
       <form action="./index.php" method="POST" class="form">
          <h3>Register</h3>
          <div class="input-group">
             <label for="name">Name</label>
             <input type="text" name="name" id="name" required />
          </div>
          <div class="input-group">
             <label for="username">Username</label>
             <input type="text" name="username" id="username" required />
          </div>
          <div class="input-group">
             <label for="age">Age</label>
             <input type="number" name="age" id="age" required />
          </div>
          <div class="input-group">
             <label for="address">Address</label>
             <input type="text" name="address" id="address" required />
          </div>
          <div class="input-group">
             <label for="regpassword">Password</label>
             <input type="password" name="regpassword" id="regpassword" required />
          </div>
          <div class="input-group">
             <label for="email">Email</label>
             <input type="email" name="email" id="email" required />
          </div>
          <div class="input-group">
          <label for="dboption">Choose Shopping System</label>
          <select id="dboption" name="dboption">
              <option value="dbone">New System</option>
              <option value="dbtwo">Old System</option>
          </select>
          </div>
          <input type="submit" value="register" name="registersubmit" class="buttonlight" />
       </form>
    </div>
 </main>';
        return $text;
    }
    public function registerSuccessPageString() {
        $text = '<main>
    <div class="errorcard">
   <h3>Registration successful.</h3>
 </div>
    <div>
       <form action="./index.php" method="POST" class="form">
          <h3>Register</h3>
          <div class="input-group">
             <label for="name">Name</label>
             <input type="text" name="name" id="name" required />
          </div>
          <div class="input-group">
             <label for="username">Username</label>
             <input type="text" name="username" id="username" required />
          </div>
          <div class="input-group">
             <label for="age">Age</label>
             <input type="number" name="age" id="age" required />
          </div>
          <div class="input-group">
             <label for="address">Address</label>
             <input type="text" name="address" id="address" required />
          </div>
          <div class="input-group">
             <label for="regpassword">Password</label>
             <input type="password" name="regpassword" id="regpassword" required />
          </div>
          <div class="input-group">
             <label for="email">Email</label>
             <input type="email" name="email" id="email" required />
          </div>
          <div class="input-group">
          <label for="dboption">Choose Shopping System</label>
          <select id="dboption" name="dboption">
              <option value="dbone">New System</option>
              <option value="dbtwo">Old System</option>
          </select>
          </div>
          <input type="submit" value="register" name="registersubmit" class="buttonlight" />
       </form>
    </div>
 </main>';
        return $text;
    }
    public function registerErrorPageString() {
        $text = '<main>
    <div class="errorcard">
   <h3>Registration was not successful. Use a valid username.</h3>
 </div>
    <div>
       <form action="./index.php" method="POST" class="form">
          <h3>Register</h3>
          <div class="input-group">
             <label for="name">Name</label>
             <input type="text" name="name" id="name" required />
          </div>
          <div class="input-group">
             <label for="username">Username</label>
             <input type="text" name="username" id="username" required />
          </div>
          <div class="input-group">
             <label for="age">Age</label>
             <input type="number" name="age" id="age" required />
          </div>
          <div class="input-group">
             <label for="address">Address</label>
             <input type="text" name="address" id="address" required />
          </div>
          <div class="input-group">
             <label for="regpassword">Password</label>
             <input type="password" name="regpassword" id="regpassword" required />
          </div>
          <div class="input-group">
             <label for="email">Email</label>
             <input type="email" name="email" id="email" required />
          </div>
          <div class="input-group">
          <label for="dboption">Choose Shopping System</label>
          <select id="dboption" name="dboption">
              <option value="dbone">New System</option>
              <option value="dbtwo">Old System</option>
          </select>
          </div>
          <input type="submit" value="register" name="registersubmit" class="buttonlight" />
       </form>
    </div>
 </main>';
        return $text;
    }
    public function getHomePageString() {
        $text = '<main>
    <div class="welcome">
       <h1 class="cardone">Shopping made <span>easy.</span></h1>
    </div>
 </main>';
        return $text;
    }
}
?>



