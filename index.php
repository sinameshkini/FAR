<?php
require_once ('include.php');
if(isset($_GET['login'])){
    login();
}elseif (isset($_GET['logout'])){
    logout();
}
if(isset($_SESSION['username'])){
    if($_SESSION['user_type']>5) {
        require_once("projects.php");
    }
    exit;
}

function login(){
    global $conn;
    global $salt;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result=$conn->query("SELECT * FROM users WHERE username='$username'");
    $row=$result->fetch_assoc();
    if($row["username"] == null){
        echo "Login Failed. Check your Username and Password";
        exit;
    }else{
        $hashedpass = md5($password.$salt);
        if($row['password'] == $hashedpass){
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['project_name']="";
            // require_once('projects.php');
            header("Location: http://10.75.48.183/far/projects.php");
            // exit;
        }
        else{
            echo "Login Failed. Check your Username and Password";
            exit;
        }
       
    }
}
function logout(){
    $_SESSION = array();
    session_destroy();
}
?>



<html id="wallpaper">
<title>Login</title>
<link rel="stylesheet" href="style.css" type="text/css">
<link rel="icon" href="img/Head3.png">
<body class="animate">

    <center>
        <div id="login">
        <div id="login-top">
        <br>
            <img src="img/Head42.png">
            <p>LOG IN</p>
        </div>

            <form method="post" action="index.php?login=1">
            <input type="text" name="username" placeholder=" Enter Username">
            <br /><br />
            <input class="input" name="password" type="password" placeholder=" Enter Password" required minlength="2">
            <br /><br />
            <br /><br />
            <button type="submit"><b>Login</b></button>
            </form>
        </div>
    </center>
</body>
</html>