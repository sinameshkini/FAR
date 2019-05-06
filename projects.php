<?php
require_once('include.php');
require_once("access.php");
if(isset($_GET['delete'])){
    $success = 0;
    if($conn->query("DELETE FROM projects WHERE `serial` = '{$_GET['delete']}'")){
        $tname = "C".$_GET['delete'];
        if($conn->query("DROP TABLE `far`.$tname;")){  
            $tname = "P".$_GET['delete'];
            if($conn->query("DROP TABLE `far`.$tname;")){
                $tname = "F".$_GET['delete'];
                if($conn->query("DROP TABLE `far`.$tname;")){  
                    $tname = "M".$_GET['delete'];
                    if($conn->query("DROP TABLE `far`.$tname;")){
                        $success = 1;
                    }
                }
            }
        }    
    }
}
if(isset($_GET['update'])){
    $serial = $_GET['update'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $access = $_POST['access'];
    
    $query = "UPDATE projects SET `name`='$name' ,phone='$phone' ,access_code='$access' WHERE `serial`='$serial'";
    if($conn->query($query)){
        echo "edited";
    }else{
        echo "error";
    }
}
if(isset($_GET['select'])){
    $serial = $_GET['select'];
    $result = $conn->query("SELECT * FROM projects WHERE `serial`='$serial'");
    $row = $result->fetch_assoc();
    $_SESSION['project_serial'] = $serial;
    $_SESSION['project_name'] = $row['name'];
}
$result = $conn->query("SELECT * FROM projects");

?>

<html>
<link rel="icon" href="img/Head3.png">
<header>
    <title>Projects</title>
    <?php
    require_once ("header.php");
    require_once ("menu.php");
    ?>
</header>
<body>

<?php
if(isset($success)){
    if($success==1){
        ?>
        <div class="alertgreen">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>Deleted!</strong>
        </div>
        <?php
    }
    elseif ($success==0) {
        ?>
        <div class="alertred">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>Error!</strong>
        </div>
        <?php
    }
}
?>

<div class="animate">

    <div style="float:left; width:20%;" >
      <a id="project" href="create-project.php">Create Project</a>
   
    </div>

    <div style="width:80%;">
    <table style="margin: 0 auto; margin-top: 35px;" >
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Serial Number</th>
            <th>Access Code</th>
            <th>Date</th>
            <th>Modification</th>
        </tr>
        <?php
        $counter = 1;
        while($row = $result->fetch_assoc()){
        ?>
        <tr>
            
            <td><?php echo $counter++ ?></td>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['phone']?></td>
            <td><?php echo $row['serial']?></td>
            <td><?php echo $row['access_code']?></td>
            <td><?php echo date('m/d/Y',$row["init_date"])?></td>
            <td>
            <a class="edit" href="edit-project.php?update=<?php echo $row['serial']; ?>">Edit</a>
            <a class="delete" href="projects.php?delete=<?php echo $row['serial']; ?>">Delete</a>
            <a class="select" href="projects.php?select=<?php echo $row['serial']; ?>">Select</a> 
            </td>

        </tr>
        <?php
        }
        ?>
        

    </table>
    </div>
</div>



</body>

</html>