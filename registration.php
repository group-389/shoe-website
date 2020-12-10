<?php
    session_start(); //start session with database
    include('config.php');// run code from that file
    
    //once register button has been pressed
    if (isset($_POST['signup'])) {
        //get data submited from form and set to corresponding variables
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        //adds some security to the password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
        $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        
        //Check if email is already in use and print error message
        if ($query->rowCount() > 0) {
            echo '<p class="error">This email address has already been used!</p>';
        }

        //take information from the form and update User table with the information
        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO users(username,userpassword,email) VALUES (:username,:password_hash,:email)");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);//Adds encrypted password to database
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $result = $query->execute();
            if ($result) {
                echo '<p class="success">You were successful signing up</p>';
            } else {
                echo '<p class="error">There was an issue signing up</p>';
            }
        }
    }
?>

<html> <!-- Basic Registration/Sign up form post method so form information can be recieved-->
<form method="post" action="" name="signupForm">
    <div class="form-element">
        <label>Username</label>
        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required /> <!-- letter/number entry is required-->
    </div>
    <div class="form-element">
        <label>Email</label>
        <input type="email" name="email" required /> <!-- entry is required-->
    </div>
    <div class="form-element">
        <label>Password</label>
        <input type="password" name="password" required /> <!-- entry is required-->
    </div>
    <button type="submit" name="signup" value="signup">Register</button>
</form>
</html>