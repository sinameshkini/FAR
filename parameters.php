<?php
require_once("include.php");
require_once("access.php");

$tname = "P".$_SESSION['project_serial'];
if(isset($_GET['add'])){
    $name = $_POST['name'];
    // $type = $_POST['type'];

    $q = "INSERT INTO `far`.$tname (`name`,`value`) VALUES ('$name',0);";
    $result = $conn->query($q);
}
?>
<html>
<link rel="icon" href="img/Head3.png">
<header>
    <title>Parameters Settings</title>
    <?php
    require_once ("header.php");
    require_once ("menu.php");
    ?>
    <link rel="stylesheet" href="style.css" type="text/css">
</header>
<center>
<body>
<?php
if(!isset($_SESSION['project_serial'])){
    echo "First select a project";
    exit;
}
$result = $conn->query("SELECT * FROM $tname");
?>
<div class="animate">
<div id="param">
    <form action="?add=1" method="post">
        <!-- <label id="palabel">Type:</label>
        <select id="paselect" name="type">
            <option value="int">Integer</option>
            <option value="str">String</option>
        </select> -->

        <label id="palabel">Name:</label>
        <input class="painput" name="name">
        <center>
        <button type="submit" id="parameter">Add Parameter</button>
        </center>
    </form>
</div>

<div style="float:left; width:60%; margin-left:50px; margin-top:30px;">
    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Value</th>
            <th></th>
        <tr/>
        <?php
        $counter = 1;
        while($row = $result->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $counter++ ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['value'] ?></td>
            <td><a href="?delete" class="delete">delete</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>
</div>
</body>
</center>

</html>