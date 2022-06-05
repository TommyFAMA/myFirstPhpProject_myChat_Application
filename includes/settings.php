<?php

$sql = "select * from users where userid = :userid limit 1";
$id = $_SESSION['userid'];  //notice that all session variable values are stored in the global $_SESSION variable:
$data = $DB->read($sql, ['userid' => $id]); // this can be called due to api.php that contains $DB object already being called....


$mydata = ""; //empty string...

if (is_array($data)) {

    $data = $data[0]; //data is equal to whatever the first item...

    //check if iamge exists
    $image = ($data->gender == "Male") ? "ui/images/male.jpg" : "ui/images/female.jpg"; // empty string, condition behind question mark ? is true, whereas condition behind the double colon : is false
    if (file_exists($data->image)) {   //if file exists
        $image = $data->image;
    }

    $gender_male = "";
    $gender_female = "";

    if ($data->gender == "Male") {
        $gender_male = "checked";
    } else {
        $gender_female = "checked";
    }


    $mydata = '

    <style type="text/css">

        @keyframes appear{
            0%{opacity:0; transform: translateY(50px) rotate(30deg); transfrom-origin: 100% 100%;}
            100%{opacity:1; transform: translateY(0px) rotate(0deg); transfrom-origin: 100% 100%;}
        } 
  
    
        form {
            text-align: left;
            margin: auto;
            padding: 10px;
            width: 100%;
            max-width: 400px;
    
        }
    
        input[type=text], input[type=password], input[type=button]{
            padding: 10px;
            margin: 10px;
            width: 200px;
            border-radius: 5px;
            border: solid 1px grey;
        }
    
    
        input[type=button] {
            width: 200px;
            cursor: pointer;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            background-color: #2b5488;
            color: white;
        }
    
        input[type=radio] {
            transform: scale(1.3); /*scale(1) is normal size*/
            cursor: pointer;
        }
    
    
        #error {
            text-align: center;
            padding: 0.5em;
            background-color: red;
            color: white;
            display: none;
    
        }
        
        .dragging{
            border: dashed 2px white;
        }
    
    
    </style>
    
    
    
    
        <div id="error"> error</div>
        <div style="display:flex; animation: appear 1s ease"">
        
            <div>
                <span style="font-size: 10px;">Drag and Drop an image to change</span> <br>
                 <img ondragover="handle_drag_and_drop(event)" ondrop="handle_drag_and_drop(event)" ondragleave="handle_drag_and_drop(event)" src = "' . $image . '" style="width:200px; height:200px;margin:10px;"/>
                 <label for="change_image_input" id="change_image_button" style="background-color: grey; display: inline-block; padding; 1em; border-radius: 5px; cursor: pointer;">
                    Change image                  
                 </label>
                 
                  <input type="file" onchange="upload_profile_image(this.files)" id="change_image_input" style="display: none;" >
            </div>
            
            <form id="myform"> <!--using id links to JS function -->
                <input type="text" name="username" placeholder="Username" value="' . $data->username . '">
                <input type="text" name="email" placeholder="Email" value="' . $data->email . '">
                <div style="padding: 10px;">
                    <br>Gender:<br>
                    <input type="radio" value="Male" name="gender" ' . $gender_male . '> Male <br>
                    <input type="radio" value="Female" name="gender" ' . $gender_female . ' >Female <br>
                </div>
                <input type="password" name="password" placeholder="Password" value="' . $data->password . '"><br>
                <input type="password" name="password2" placeholder="Retype Password" value="' . $data->password . '"><br>
                <input type="button" value="Save" id="save_settings_button" onclick="collect_data(event)"><br>  <!--using the id links with js function"-->
            </form>
        </div>
    
    
    </div>
  
    ';



    $info->message = $mydata;
    $info->data_type = "contacts";
    echo json_encode($info); /* is used to encode a value to JSON format*/



}else{

    $info->message = "No contacts were found";   //send this if thing don't go well.
    $info->data_type = "error";
    echo json_encode($info);
}



?>




