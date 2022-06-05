<?php

$info = (object)[];


$data = false;
$data['userid'] =$_SESSION['userid']; /*the user id is generated by latter*/



//validate username
$data['username'] = $DATA_OBJ->username; //object's username parameter
if (empty($DATA_OBJ->username)) {
    $Error .= "Please enter a valid username. <br>"; /*dot simply means add to the empty list*/
} else {

    if (strlen($DATA_OBJ->username) < 3) {
        $Error .= "username must be at least 3 characters long. <br>";
    }
    /*pattern only allowed to a-z, space, A-Z characters*/
    if (!preg_match("/^[a-z A-Z]*$/", $DATA_OBJ->username)) /*pattern is some regular expression*/ {
        $Error .= "Please enter a valid username. <br>";
    }
}

//validate email
$data['email'] = $DATA_OBJ->email; //object's email parameter
if (empty($DATA_OBJ->email)) {
    $Error .= "Please enter a valid email. Dont empty it<br>"; /*dot simply means add to the empty list*/
} else {

    /*pattern only allowed to a-z, space, A-Z characters*/
    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $DATA_OBJ->email)) /*pattern is some regular expression*/ {
        $Error .= "Please enter a valid email. The format should look like username@smtp.domain<br>";
    }
}


$data['gender'] = isset($DATA_OBJ->gender) ? $DATA_OBJ->gender : null; //if($DATA_OBJ->gender) is set, assign $data['gender'] to  $$DATA_OBJ->gender, otherwise assign it to null.

if (empty($DATA_OBJ->gender)) {
    $Error .= "Please select a gender. Dont empty it. <br>"; /*dot simply means add to the empty list*/
} else {

    /*pattern only allowed to a-z, space, A-Z characters*/
    if ($DATA_OBJ->gender != "Male" && $DATA_OBJ->gender != "Female") /*pattern is some regular expression*/ {
        $Error .= "Please select a valid gender. <br>";
    }
}

//validate password
$data['password'] = $DATA_OBJ->password; //object's username parameter
$password = $DATA_OBJ->password2;

if (empty($DATA_OBJ->password)) {
    $Error .= "Please enter a valid password. <br>"; /*dot simply means add to the empty list*/
} else {

    if ($DATA_OBJ->password != $DATA_OBJ->password2) {
        $Error .= "password must be match. <br>";
    }

    if (strlen($DATA_OBJ->password) < 8) {
        $Error .= "username must be at least 8 characters long. <br>";
    }

}


if ($Error == "") {

    $query = "update  users set username=:username, gender=:gender, email=:email,password=:password where userid = :userid limit 1";
    $result = $DB->write($query, $data);

    if ($result) {
        $info->message = "Your data was saved";
        $info->data_type = "save_settings";
        echo json_encode($info);
    } else {

        $info->message = "Your data was Not saved due to an error";
        $info->data_type = "save_settings";
        echo json_encode($info);
    }
} else {
    $info->message = $Error;
    $info->data_type = "save_settings";
    echo json_encode($info); /*return a JSON object*/  /*The json_encode() function is used to encode a value to JSON format.*/
}

