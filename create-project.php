<?php
require_once("include.php");
require_once("access.php");
if(isset($_GET['insert'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $serial = $_POST['serial'];
    $access = $_POST['access'];
    
    $result = $conn->query("SELECT * FROM projects WHERE `serial`='$serial'");
    $row = $result->fetch_assoc();
    if($row['serial']!=null){
        echo "This serial already registtered! use another one...";
        exit;
    }
    $success = 0;
    $status = 5;
    $time = time();
    $query = "INSERT INTO projects (`serial`,`name`,phone,access_code,init_date)
    VALUES('$serial','$name','$phone','$access','$time')";
    $tname = "C".$serial;
    if($conn->query($query)){
        $query = "CREATE TABLE `far`.$tname (`floor` TINYINT(4) NOT NULL,`action` TINYINT(2) NOT NULL);";
        if($conn->query($query)){
            $tname = "P".$serial;
            $query = "CREATE TABLE `far`.$tname (`name` VARCHAR(20) NOT NULL,`value` INT(11) NOT NULL);";
            if($conn->query($query)){
                $tname = "F".$serial;
                $query = "CREATE TABLE `far`.$tname (`floor` TINYINT(4) NOT NULL,`action` TINYINT(2) NOT NULL);";
                if($conn->query($query)){
                    $tname = "M".$serial;
                    $query = "CREATE TABLE `far`.$tname (`floor` TINYINT(4) NOT NULL,`action` TINYINT(2) NOT NULL);";
                    if($conn->query($query)){
                        $success = 1;
                    }
                }
            }
        }
    }
    if($success){
        $status = 1;
    }else{
        $status = 0;
    }
}
?>

<html>
<link rel="icon" href="img/Head3.png">
<title>Create Project</title>
<header>
    <?php
    require_once("header.php");
    require_once("menu.php");
    ?>
    <link rel="stylesheet" type="text/css" href="style.css">
</header>
<br>
<body>
<div id="adduser" class="animate">
<form action="create-project.php?insert=1" method="post">
<label>Name: </label>
<input type="text" name="name" required>
<br>
<label>Phone: </label>
<input type="text" name="phone" required>
<br>
<label>Serial Number: </label>
<input type="text" name="serial" required>
<br>
<label>Access Code: </label>
<input type="text" name="access" required>
<br><br><br><br><br><br><br><br><br><br>
<center><button type="submit"><b>Create</b></button></center>
</form>
</div>

<?php
    if($status){
        ?>
        <div class="alertgreen">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>Created successfully</strong>
        </div>
        <?php
    }
?>

</body>
</html>