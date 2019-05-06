<?php

$data = array('user_type' => 10,'username' => 'admin1111','email' =>'11','mobile'=>'444');
$url = "http://10.75.48.183/far/edit-user.php?update=admin1";


$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }

var_dump($result);


?>