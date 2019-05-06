<?php 
require_once('include.php');
if(isset($_GET['insert'])){
    $user_type = $_POST['user_type'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    $row = $result->fetch_assoc();

    $status = 0;
    if($row['username']!=null){
        $status = 1;
    }
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    $row = $result->fetch_assoc();
    if($row['email']!=null){
        $status = 2;
    }
    $result = $conn->query("SELECT * FROM users WHERE mobile='$mobile'");
    $row = $result->fetch_assoc();
    if($row['mobile']!=null){
        $status = 3;
        // echo "This mobile already registtered! use another one...";
        // exit;
    }
    if($password != $confirm){
        $status = 4;
        // echo "Paswords dose not match! Please enter same password!";
        // exit;
    }
    $hashedpass = md5($password.$salt);
    $time = time();
    $query = "INSERT INTO users (username,`password`,user_type,register_time,lastvisit_time,email,mobile)
    VALUES('$username','$hashedpass',$user_type,'$time','$time','$email','$mobile')";
    if($conn->query($query)){
        $status = 5;
        // echo "Your Signedup successfuly!";
        // exit;
    }else{
        $status = 6;
        // echo "System not work! call to admin! +98 911 380 6028";
        // exit;
    } 
}
echo $_POST['user_type']
?> 

<html>
<link rel="icon" href="img/Head3.png">
<header>
    <title>Add User</title>
    <?php
    require_once ("header.php");
    require_once("menu.php");
    ?>
    
</header>
 <br>
<body>

<?php
    if($status==1){
        ?>
        <div class="alertred">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>This username already registtered! use another one...</strong>
        </div>
        <?php
    }
    elseif($status==2){
        ?>
        <div class="alertred">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>This email already registtered! use another one...</strong>
        </div>
        <?php
    }
    elseif($status==3){
        ?>
        <div class="alertred">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>This mobile already registtered! use another one...</strong>
        </div>
        <?php
    }
    elseif($status==4){
        ?>
        <div class="alertred">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>Passwords dose not match! Please enter same password!</strong>
        </div>
        <?php
    }
    elseif($status==5){
        ?>
        <div class="alertgreen">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>Signedup successfuly!</strong>
        </div>
        <?php
    }
    elseif($status==6){
        ?>
        <div class="alertred">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>System not work! call to admin! +98 911 380 6028</strong>
        </div>
        <?php
    }
?>

<div id="adduser" class="animate">
<form action="signup.php?insert=1" method="post">
<label>User type: *</label>
<select name="user_type">
        <option value="10">Admin</option>
        <option value="7">Manager</option>
        <option value="5">User</option>
        <option value="2">Client</option>
</select>

<br>
<label>Username: *</label>
<input type="text" name="username" required>
<br>
<label>Password: *</label>
<input type="password" name="password" required>
<br>
<label>Confirm Password: *</label>
<input type="password" name="confirm" required>
<br>
<label>Email:</label>
<input type="text" name="email" >
<br>
<label>Mobile:</label>
<input type="text" name="mobile" >
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<center><button type="submit"><b>Signup</b></button></center>
</form>
</div>



</body>

</html>