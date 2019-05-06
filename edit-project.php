<?php
require_once ("include.php");

if(!isset($_GET['update']))
    die("You must set a student number.");
$result = $conn->query("SELECT * FROM projects WHERE `serial` = {$_GET['update']}");
$row = $result->fetch_assoc();
?>

<html>
<link rel="icon" href="img/Head3.png">
<title>Edit project</title>
<header>
    <?php
    require_once ("header.php");
    require_once ("menu.php");
    ?>
    <link rel="stylesheet" href="style.css" type="text/css">
</header>

<body>
<br>
<div id="adduser" class="animate">
<form action="projects.php?update=<?php echo $row['serial'] ?>" method="post">
<label>Name: </label>
<input type="text" name="name" value="<?php echo $row['name']?>" required>
<br>
<label>Phone: </label>
<input type="text" name="phone" value="<?php echo $row['phone']?>" required>
<br>
<label>Access Code: </label>
<input type="text" name="access" value="<?php echo $row['access_code']?>" required>
<br><br><br><br><br><br><br><br><br>
<center><button type="submit"><b>Modify</b></button></center>
</form>
</div>

</body>

</html>

