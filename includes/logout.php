<?php

if(isset($_SESSION['userid'])){

    unset($_SESSION['userid']);
}

$info->logged_in = false;
echo json_encode($info); // encode a value to JSON format.  {"Peter":35,"Ben":37,"Joe":43}


