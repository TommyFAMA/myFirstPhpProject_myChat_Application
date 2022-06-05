<?php

//we need to read from the DB to know which the user is...


$arr['userid'] = "null"; //this will return nothing in users where userid = :userid in line 12
if (isset($DATA_OBJ->find->userid)) {
    $arr['userid'] = $DATA_OBJ->find->userid; //this is coming from the api.php ~$DATA_OBJ = json_decode($DATA_RAW);
}


$refresh = false;

if($DATA_OBJ->data_type == "chats_refresh"){
    $refresh = true;
}

$sql = "select * from users where userid = :userid limit 1"; //this :userid is taken from $arr['userid']  $arr = :userid
$result = $DB->read($sql, $arr);

if (is_array($result)) {   //this will return an array of object...
    //user found
    $row = $result[0];

    $image = ($row->gender == "Male") ? "ui/images/male.jpg" : "ui/images/female.jpg"; // empty string, condition behind question mark ? is true, whereas condition behind the double colon : is false
    if (file_exists($row->image)) {   //if file exists
        $image = $row->image;
    }

    $row->image = $image;


    $mydata ="";
    if(!$refresh){

                 $mydata = "Now Chatting with:<br>
                <div id='active_contact'>                               
                    <img src='$image'>
                    $row->username
                </div>";

    }

    $messages = "";

    if(!$refresh) {
        $messages = "
            <div id='messages_holder_parent' style=' height:630px;'>  
            <div id='messages_holder' style=' height:480px; overflow-y:scroll;'>";
    }


    //read from db
    $a['sender'] = $_SESSION['userid'] ;
    $a['receiver'] = $arr['userid']; //receiver

    $sql = "select * from messages where (sender = :sender && receiver = :receiver) || receiver = :sender && sender = :receiver order by id desc limit 10";
    $result2 = $DB->read($sql, $a);
    if (is_array($result2)) {
        $result2 = array_reverse($result2);
        foreach ($result2 as $data) {

            $myuser = $DB->get_user($data->sender);

            if ($_SESSION['userid'] == $data->sender) {   // I am the sender, put it on the right

                $messages .= message_right($data, $myuser);
            } else {

                $messages .= message_left($data, $myuser);
            }
        }
    }


    if(!$refresh) {
        $messages .= message_controls();
    }


    $info->user = $mydata;
    $info->messages = $messages;
    $info->data_type = "chats";
    if($refresh){
        $info->data_type = "chats_refresh";
    }
    echo json_encode($info); /* is used to encode a value to JSON format*/

} else {
    //read from db
    $a['userid'] = $_SESSION['userid'] ;


    $sql = "select * from messages where (sender = :userid || receiver = :userid) group by msgid order by id desc limit 10";
    $result2 = $DB->read($sql, $a);
    $mydata = "Previews Chats:<br>";

    if (is_array($result2)) {

        $result2 = array_reverse($result2);
        foreach ($result2 as $data) {

            #code...
            $other_user = $data->sender;
            if($data->sender == $_SESSION['userid']){
                $other_user = $data->receiver;
            }
            $myuser = $DB->get_user($other_user);

            $image = ($myuser->gender == "Male") ? "ui/images/male.jpg" : "ui/images/female.jpg"; // empty string, condition behind question mark ? is true, whereas condition behind the double colon : is false
            if (file_exists($myuser->image)) {   //if file exists
                $image = $myuser->image;
            }


                $mydata .= "

                <div id='active_contact' userid='$myuser->userid' onclick='start_chat(event)' style='cursor:pointer'>                              
                    <img src='$image'>
                    $myuser->username<br>
                    <span styel='font-size: 11px;'>'$data->message'</span>
                </div>";
            }
    }

    $info->user = $mydata;
    $info->messages = "";
    $info->data_type = "chats";

    echo json_encode($info); /* is used to encode a value to JSON format*/
}


//$mydata = $DATA_OBJ->find->userid; //this is coming from the api.php ~$DATA_OBJ = json_decode($DATA_RAW);


?>




