<html style="direction: rtl">
<head>
    <title> اصلاح خبر</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
<?php
require_once ("header.php");
require_once ("menu.php");
?>
    <title>اصلاح خبر</title>
    <meta charset="utf-8" />
<form action="" method="post">
    <table>
        <tr>
            <td>عنوان خبر </td>
            <td><input type="text" name="name" value="<?php echo $course['name'] ?>" /></td>
        </tr>
        <tr>
            <td>متن خبر</td>
            <td><input type="text" name="teacher" value="<?php echo $course['teacher'] ?>" /></td>
        </tr>
        <tr>
            <td>تاریخ خبر</td>
            <td><input type="text" name="length" value="<?php echo $course['length'] ?>" /></td>
        </tr>
        
        <tr>
            <td colspan="2" style="text-align:center;">
                <input id="btninsert" style="width:180px;" type="submit" value="اصلاح اطلاعات" />
            </td>
        </tr>
    </table>
</form>
</body>
</html>