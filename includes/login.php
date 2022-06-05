<?php

$info = (object)[];

$data = false;


//validate email
$data['email'] = $DATA_OBJ->email; //object's username parameter

if (empty($DATA_OBJ->email)) {
    $Error = "Please enter a valid email";
}
if (empty($DATA_OBJ->password)) {
    $Error = "Please enter a valid password";
}

if ($Error == "") {

    $query = "select * from users where email = :email limit 1";
    $result = $DB->read($query, $data);

    if (is_array($result)) {

        $result = $result[0];
        if ($result->password == $DATA_OBJ->password) {

            $_SESSION['userid'] = $result->userid;
            $info->message = "You are successfully logged in";
            $info->data_type = "info";
            echo json_encode($info);

        } else {
            $info->message = "Wrong Password";
            $info->data_type = "error";
            echo json_encode($info);

        }

    } else {

        $info->message = "Wrong email";
        $info->data_type = "error";
        echo json_encode($info);
    }
} else {
    $info->message = "Wrong email";
    $info->data_type = "error";
    echo json_encode($info); /*return a JSON object*/  /*The json_encode() function is used to decode a value to JSON format.*/
}


//validate password
$data['password'] = $DATA_OBJ->password; //object's username parameter



