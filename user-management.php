<?php
require_once('include.php');
$result = $conn->query("SELECT * FROM users");
if(isset($_GET['delete'])){
    $usr = $_GET['delete'];
    if($conn->query("DELETE FROM users WHERE `username` = '$usr'")){
        echo "ok";
    }else{
        echo "error";
    }
    
    header('Location: http://10.75.48.183/far/user-management.php');
    
}
?>

<html>
<link rel="icon" href="img/Head3.png">
<header>
    <title>User management</title>
    <?php
    require_once ("header.php");
    require_once ("menu.php");
    ?>
</header>
<body>

<div class="animate">

<div style="float:left; width:20%;" >
  <a id="project" href="signup.php">Add User</a>

</div>

<div style="width:80%;">
<table style="margin: 0 auto; margin-top: 35px;" >
    <tr>
        <th>#</th>
        <th>UserType</th>
        <th>Username</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Modification</th>
    </tr>
    <?php
    $counter = 1;
    while($row = $result->fetch_assoc()){
    ?>
    <tr>
        
        <td><?php echo $counter++ ?></td>
        <td><?php if( $row['user_type'] == "10"){echo "Admin";} 
                elseif ( $row['user_type'] == "7"){echo "Manager";}
                elseif( $row['user_type'] == "5"){echo "User";}
                elseif( $row['user_type'] == "2"){echo "Client";}?></td>
        <td><?php echo $row['username']?></td>
        <td><?php echo $row['email']?></td>
        <td><?php echo $row['mobile']?></td>
        <td>
        <a class="edit" href="edit-user.php?edit=<?php echo $row['username']?>">Edit</a>
        <a class="delete" href="user-management.php?delete=<?php echo $row['username']; ?>">Delete</a>
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