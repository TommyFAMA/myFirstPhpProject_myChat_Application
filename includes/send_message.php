<?php

$arr['userid'] = "null";
if (isset($DATA_OBJ->find->userid)) {
    $arr['userid'] = $DATA_OBJ->find->userid;
}

$sql = "select * from users where userid = :userid limit 1";
$result = $DB->read($sql, $arr);



if (is_array($result)) {   //this will return an array of object...

    $arr['message'] = $DATA_OBJ->find->message;
    $arr['data'] = date("Y-m-d H:i:s");
    $arr['sender'] = $_SESSION['userid'];
    $arr['msgid'] = get_random_string_max(60);



        $arr2['sender'] = $_SESSION['userid'];
        $arr2['receiver'] = $arr['userid'];
        $sql = "select * from messages where (sender = :sender && receiver = :receiver) || receiver = :sender && sender = :receiver limit 1";
        $result2 = $DB->read($sql, $arr2);

        if(is_array($result2)){
            $arr['msgid'] = $result2[0]->msgid;
        }



    $query = "insert into messages (sender ,receiver ,message,date ,msgid ) values (:sender,:userid,:message,:data,:msgid)";
    $DB->write($query, $arr);





    //user found
    $row = $result[0];

    $image = ($row->gender == "Male") ? "ui/images/male.jpg" : "ui/images/female.jpg"; // empty string, condition behind question mark ? is true, whereas condition behind the double colon : is false
    if (file_exists($row->image)) {   //if file exists
        $image = $row->image;
    }


    $row->image = $image;

    $mydata = "
                Now Chatting with:<br>
                <div id='active_contact'>                               
                <img src='$image'>
                 $row->username
                </div>";     //double quote is better than sign quote if you want to display a javascript object inside the quote.

    $messages = "
                <div id='messages_holder_parent' style=' height:630px;'>  
                <div id='messages_holder' style=' height:480px; overflow-y:scroll;'>";


                //read from db

                $a['msgid'] = $arr['msgid'];

                $sql = "select * from messages where msgid  = :msgid order by id desc limit 10";
                $result2 = $DB->read($sql, $a);

                if(is_array($result2)){

                    $result2 = array_reverse($result2);
                    foreach ($result2 as $data){

                        $myuser = $DB->get_user($data->sender);

                        if($_SESSION['userid'] == $data->sender){   // I am the sender, put it on the right

                            $messages .= message_right($data, $myuser);
                        }else{

                            $messages .= message_left($data, $myuser);
                        }


                    }
                }



    $messages .=message_controls();

    $info->user = $mydata;
    $info->messages = $messages;
    $info->data_type = "chats";
    echo json_encode($info); /* is used to encode a value to JSON format*/

} else {
    //user not found
    $info->message = "That contact was not found";   //send this if thing don't go well.
    $info->data_type = "chats";
    echo json_encode($info);
}




     function get_random_string_max($length){
        $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u',
        'v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $text ="";
        $length = rand(4,$length);
        for($i=0;$i<4;$i++){

            $random = rand(0,61);

            $text .= $array[$random];
        }
        return $text;
    }





//$mydata = $DATA_OBJ->find->userid; //this is coming from the api.php ~$DATA_OBJ = json_decode($DATA_RAW);


?>




