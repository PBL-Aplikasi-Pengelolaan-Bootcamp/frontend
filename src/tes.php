<?php

include 'function.php';
$data_login = get_data_user_login();



?>

<html>
    <p><?=$data_login['name']?></p>
</html>