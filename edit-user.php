<?php
require_once("include.php");
if(isset($_GET['update'])){
    $usr = $_GET['update'];
    $user_type = $_POST['user_type'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username' AND username!='$usr'");
    $row = $result->fetch_assoc();
    if($row['username']!=null){
        echo "This username already registtered! use another one...";
        exit;
    }
    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND username!='$usr'");
    $row = $result->fetch_assoc();
    if($row['email']!=null){
        echo "This email already registtered! use another one...";
        exit;
    }
    $result = $conn->query("SELECT * FROM users WHERE mobile='$mobile' AND username!='$usr'");
    $row = $result->fetch_assoc();
    if($row['mobile']!=null){
        echo "This mobile already registtered! use another one...";
        exit;
    }
    if($conn->query("UPDATE users SET user_type=$user_type, username='$username', email='$email', mobile='$mobile' WHERE username='$usr'")){
        echo "ok";
    }else{
        echo "error";
    }
    exit;
}
if(isset($_GET['edit'])){
    $usr = $_GET['edit'];
    $result = $conn->query("SELECT * FROM users WHERE username='$usr'");
    $row = $result->fetch_assoc();
?>
    <html>
    <link rel="icon" href="img/Head3.png">
    <header>
        <title>Edit Users</title>
        <?php
        require_once ("header.php");
        require_once("menu.php");
        ?>
        
    </header>
    <br>
    <body>

    <div id="adduser" class="animate">
    <form action="edit-user.php?update=<?php echo $usr?>" method="post">
    <label>User type: *</label>
    <select name="user_type" option="<?php echo $row['user_type']?>">
            <option value="10">Admin</option>
            <option value="7">Manager</option>
            <option value="5">User</option>
            <option value="2">Client</option>
    </select>

    <br>
    <label>Username: *</label>
    <input type="text" name="username" value="<?php echo $row['username']?>" required>
    <br>
    <label>Email:</label>
    <input type="text" name="email" value=<?php echo $row['email']?> >
    <br>
    <label>Mobile:</label>
    <input type="text" name="mobile" value=<?php echo $row['mobile']?> >
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
    <center><button type="submit"><b>Modify</b></button></center>
    </form>
    </div>


    </body>

    </html>
<?php
}
?>