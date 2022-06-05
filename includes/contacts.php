<?php

// sleep(3);

$myid = $_SESSION['userid'];
$sql = "select * from users where userid != '$myid' limit 10"; //limit 10 users to be accessed
$myusers = $DB->read($sql, []);

$mydata =
    '
     <style>
        @keyframes appear{
            0%{opacity:0; transform: translateY(50px)}
            100%{opacity:1; transform: translateY(0px)}
        } 
        
        #contact{
            cursor: pointer;
            transition: all .5s cubic-bezier(.91,.27,.2,.87);
        }        
        
        
        #contact:hover{
            
            transform: scale(1.1);
        }
    </style>
    
    <div style="text-align:center; animation: appear 1s ease" >';


if (is_array($myusers)) { //is this an array meaning everything is fine....

    foreach ($myusers as $row) { //look through the data

        $image = ($row->gender == "Male") ? "ui/images/male.jpg" : "ui/images/female.jpg"; // empty string, condition behind question mark ? is true, whereas condition behind the double colon : is false
        if (file_exists($row->image)) {   //if file exists
            $image = $row->image;
        }
        $mydata .= "
                <div id='contact' userid='$row->userid' onclick='start_chat(event)'>                               
                    <img src='$image'>
                    <br>$row->username
                </div>";     //double quote is better than sign quote if you want to display a javascript object inside the quote.


    }

}

/*.= is mean of concatenation*/


$mydata .= '</div>';


$info->message = $mydata;
$info->data_type = "contacts";
echo json_encode($info); /* is used to encode a value to JSON format*/

die;

$info->message = "No contacts were found";   //send this if thing don't go well.
$info->data_type = "error";
echo json_encode($info);   //to encode a value to JSON format.

?>




