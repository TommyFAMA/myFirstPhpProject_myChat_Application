<?php



session_start(); //we need to know who this person is...

$info = (object)[];   //create an object

/*check if we are login, the userid contains the id of user that actually happens in login-paper and this id will be read from DB  */

if (!isset($_SESSION['userid'])) {

    if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != "login" && $DATA_OBJ->data_type != "signup"){/*if data_type is set and data_type not equals to "login" and signup*/
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }

}

require_once("classes/initialise.php"); //used to embed PHP code from another file
$DB = new Database(); /*placed none variable in here */ /*also this DB is available to be used in all include("php files");*/

// good to know the data_type first...
$data_type = "";
if(isset($_POST['data_type'])){
    $data_type = $_POST['data_type'];
}

$destination = "";

if(isset($_FILES['file']) && $_FILES['file']['name'] != ""){
    if($_FILES['file']['error'] == 0){


        $folder = "uploads/";
        if(!file_exists($folder)){

            mkdir($folder, 0777, true);
        }
        $destination = $folder.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $destination);  //Moves an uploaded file to a new location

        //we are using some json
        $info->message = "YOUR image was uploaded";
        $info->data_type = $data_type;
        echo json_encode($info); /* is used to encode a value to JSON format*/

    }

}



if($data_type == "change_profile_image" ){

    if($destination != ""){
        //save to DB
        $id = $_SESSION['userid'];
        $query = "update users set image = '$destination' where userid = '$id' limit 1";
        $DB->write($query, []);

    }


}

/*
print_r($_FILES);

Array
(
    [file] => Array
    (
        [name] => jane.jpg
        [type] => image/jpeg
        [tmp_name] => F:\xampp\tmp\phpC813.tmp
        [error] => 0
        [size] => 7127
        )
)

print_r($_POST);

Array
(
    [data_type] => change_profile_image
)

*/