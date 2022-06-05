<?php
/*Purpose of this is used to retrieve data value from database and display them on the panel of the index.php webpage*/
$info =  (object)[];

$data = false;



$data['userid'] = $_SESSION['userid'];


if ($Error == "") {

    $query = "select * from users where userid = :userid limit 1";
    $result = $DB->read($query, $data);

    if (is_array($result)) {
        $result = $result[0];
        $result ->data_type = "user_info";

        //check if image exists
        $image = ($result->gender == "Male") ? "ui/images/male.jpg" : "ui/images/female.jpg" ; // empty string, condition behind question mark ? is true, whereas condition behind the double colon : is false
        if(file_exists($result->image)){   //if file exists
            $image = $result->image;
        }

        $result->image = $image;
        echo json_encode($result); /* is used to encode a value to JSON format*/

    } else {

        $info->message = "Wrong email";
        $info->data_type = "error";
        echo json_encode($info);
    }
} else {
    $info->message = $Error;
    $info->data_type = "error";
    echo json_encode($info); /*return a JSON object*/  /*The json_encode() function is used to encode a value to JSON format.*/
}







