
<?php
    session_start();// initiate session
    include('config.php');//run this code
    
    //once login button has been pressed
    if (isset($_POST['login'])) {
        //get data submited from form and set to corresponding variables
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        //get value entered for username
        $query = $connection->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        //if username doesnt match give error, if match then continue
        if (!$result) {
            echo '<p class="error">Username or Password is incorrect!</p>';
        } else {
            //fetch coresponding password to verify if they match give success message or error message if not
            if (password_verify($password, $result['userpassword'])) {
                $_SESSION['user_id'] = $result['userID'];//fetch coresponding user id and set it as the User id for the session
                echo '<p class="success">Log in successful!</p>';
            } else {
                echo '<p class="error">Username or Password is incorrect!</p>';
            }
        }
    }
?>

<html> 
<!-- Login Form, method post so that the form data is sent as an HTTP-->
<form method="post" action="" name="signinForm">
  <div class="form-element">
    <label>Username</label> 
    <input type="text" name="username" pattern="[a-zA-Z0-9]+" required /> <!-- letter/number entry is required-->
  </div>
  <div class="form-element">
    <label>Password</label>
    <input type="password" name="password" required /><!-- an entry is required-->
  </div>
  <button type="submit" name="login" value="login">Login</button>
</form>
</html>