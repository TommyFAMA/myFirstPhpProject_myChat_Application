<?php

session_start(); /*dont need to ask user to login everytime*/


$DATA_RAW = file_get_contents("php://input");  // Reads entire file into a string from POST request by a signup.php/user_info
$DATA_OBJ = json_decode($DATA_RAW);  // equals to json_parse() in javascript, Meaning changing the string into object.


$info = (object)[];   //create an object

/*check if we are login, the userid contains the id of user that actually happens in login-paper and this id will be read from DB  */
if (!isset($_SESSION['userid'])) {

    if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != "login" && $DATA_OBJ->data_type != "signup") {/*if data_type is set and data_type equals to "login"*/
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }

}




/* require_once() will check if the file has already been included*/
require_once("classes/initialise.php"); //used to embed PHP code from another file
$DB = new Database(); /*placed none variable in here */ /*also this DB is available to be used in all include("php files");*/


$Error = "";

//process the data
if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "signup") { /*once calling send_data(data, "signup") in signup.php, below statement will be executed;*/
  
    //sginup
    include("includes/signup.php"); /* vs require: If an error occurs, the include() function generates a warning,
                                      but the script will continue execution.
                                      The require() generates a fatal error, and the script will stop.*/

} elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "login") {

    //login
    include("includes/login.php");

} elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "logout") {

    //user info
    include("includes/logout.php");

} elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "user_info") {

    //user info
    include("includes/user_info.php");

} elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "contacts") {
    //user info
    include("includes/contacts.php");
} elseif (isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "chats" || $DATA_OBJ->data_type == "chats_refresh")) {

    include("includes/chats.php");

} elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "settings") {
    //user info
    include("includes/settings.php");
} elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "save_settings") {
    //user info
    include("includes/save_settings.php");


} elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "send_message") {


    include("includes/send_message.php");
}

function message_left($data, $row)
{

    $image = ($row->gender == "Male") ? "ui/images/male.jpg" : "ui/images/female.jpg"; // empty string, condition behind question mark ? is true, whereas condition behind the double colon : is false
    if (file_exists($row->image)) {   //if file exists
        $image = $row->image;
    }


    return "
    <div id = 'message_left' >
         <div ></div >
         <img src = '$image' >
         <b> $row->username</b><br>
         $data->message<br><br>
         <span style = 'font-size:11px; color:black; ' >".date("jS M Y H:i:s a", strtotime($data->date))."</span >
     </div >
       ";

}

function message_right($data, $row)   //$row represented the user image
{

    $image = ($row->gender == "Male") ? "ui/images/male.jpg" : "ui/images/female.jpg"; // empty string, condition behind question mark ? is true, whereas condition behind the double colon : is false
    if (file_exists($row->image)) {   //if file exists
        $image = $row->image;
    }

    return "                          
          <div id='message_right'> 
            <div></div>                              
            <img src='$image' style='float:right;'>
            <b>$row->username</b><br>
            $data->message<br><br>
            <span style='font-size:11px; color:black; '>".date("jS M Y H:i:s a", strtotime($data->date))."</span>
           </div>          
       ";

}

function message_controls()   //$row represented the user image
{

    return "                          
    </div>  
        <div style='display:flex; width:100%; height:40px;'>
        <label for='message_file'><img src='ui/icons/clip.png' style='opacity:0.8; width:30px; margin:5px; cursor:pointer;'></label> <!--when we click the lebal, it works since label associated with type='file'-->
        <input type='file' id='message_file' name='file' id='file' style='display:none; '/>
        <input id='message_text' onkeyup='enter_pressed(event)' style='flex:6; border:solid thin #ccc; border-bottom:none;' type='text'  placeholder='type your message'/>
        <input style='flex:1; cursor:pointer;' type='button' value='send' onclick='send_message(event)'/>
        </div>
    </div>
       ";

}


//echo $myObject->gender; /*this is how to access information form the object*/

die;
echo "<pre>";
print_r($myObject);  //print readable
echo "</pre>";
