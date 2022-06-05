<!DOCTYPE html>
<html>
<head>
    <title>My Chat</title>
</head>

<style type="text/css">


    @font-face {
        /*using @font-face to designate other appearance of fonts*/
        font-family: headFont; /*any name you want*/
        src: url(ui/fonts/Summer-Vibes-OTF.otf);
    }

    @font-face {
        /*using @font-face to designate other appearance of fonts*/
        font-family: myFont; /*any name you want*/
        src: url(ui/fonts/OpenSans-VariableFont_wdth,wght.ttf);
    }

    #wrapper { /*CSS id name*/
        max-width: 900px;
        min-height: 500px;
        max-height: 630px;
        display: flex; /*	Displays an element as a block-level flex container, side by side*/
        margin: auto; /*move it into center*/
        color: white;
        font-family: myFont;
    }

    #left_pannel {
        min-height: 500px;
        background-color: #27344b;
        flex: 1; /*Proportion of the container block*/
        text-align: center;

    }

    #left_pannel label {
        width: 100%;
        height: 20px;
        display: block; /*each label is line and starts on a new line, takes up the whole width*/
        background-color: #404b56;
        border-bottom: solid thin #ffffff55; /*55 is transparency*/
        cursor: pointer; /*when pointing the label, cursor will change*/
        padding: 5px;
        transition: all 1s ease; /*delay one second to be changed*/
    }

    #left_pannel label:hover { /*when hovering labels, the button will change the background color */

        background-color: #778593;
    }


    #left_pannel label img {
        float: right;
        width: 30px;
    }

    #profile_image {
        width: 100px;
        height: 100px;
        border: solid thin white;
        border-radius: 50%;
        margin: 10px;


    }

    #right_pannel {
        min-height: 500px;
        flex: 4;
        text-align: center;
    }

    #header {
        background-color: #485b6c;
        font-size: 40px;
        text-align: center;
        font-family: headFont;
        width: 100%;
        color: white;
        position: relative;
    }


    #inner_left_pannel {
        background-color: #3c434e;
        flex: 1;
        min-height: 430px;
        max-height: 530px;

    }


    #inner_right_pannel { /*nothing to flex 1, half of inner panel*/
        background-color: #f2f7f8;
        flex: 0; /*shrink as none relative to the rest of the flexible items*/
        min-height: 430px;
        max-height: 530px;
        transition: all 2s ease;
    }


    #radio_setting:checked ~ #inner_right_pannel { /*do flex: 0 to 1 of inner_right_pannel after clicking the radio button*/
        flex: 0
    }

    #radio_contact:checked ~ #inner_right_pannel { /*do flex: 0 to 1 of inner_right_pannel  after clicking the radio button*/
        flex: 0
    }

    #radio_chat:checked ~ #inner_right_pannel { /*do flex: 0 to 1 of inner_right_pannel  after clicking the radio button*/
        flex: 3
    }


    #contact {
        width: 100px;
        height: 120px;
        margin: 10px;
        display: inline-block;
        vertical-align: top;
    }



    #contact img {
        width: 100px;
        height: 100px;
    }


    #active_contact {
        margin: 10px;
        height: 70px;
        border: solid thin #aaa;
        padding: 2px;
        background-color: #eee;
        color: #444;
    }



    #active_contact img {
        width: 70px;
        height: 70px;
        float: left;
        margin: 2px;
    }

    #message_left {
        margin: 10px;
        height: 70px;
        padding: 2px;
        padding-right: 8px;
        background-color: #b9acac;
        color: #444;
        float: left;
        box-shadow: 0px 0px 0px #aaa;
        border-top-left-radius: 50%;
        border-bottom-left-radius: 50%;
        border-top-right-radius: 30%;
        position: relative;
        width: 60%;
        min-width: 200px;

    }



    #message_left img {
        width: 60px;
        height: 60px;
        float: left;
        margin: 2px;
        border-radius: 50%;
        border: solid 2px white;
    }

    #message_left div {
        width: 20px;
        height: 20px;
        background-color: #bf9797;
        border: solid 2px white;
        border-radius: 50%;
        position: absolute;
        left: -10px;
        top: 20px;



    }

    #message_right {
        margin: 10px;
        height: 70px;
        padding: 2px;
        padding-right: 8px;
        background-color: #eee;
        color: #444;
        float: right;
        box-shaddow: 0px 0px 0px #aaa;
        border-top-right-radius: 50%;
        border-bottom-right-radius: 50%;
        border-top-right-radius: 30%;
        position: relative;
        width: 60%;
        min-width: 200px;

    }



    #message_right img {
        width: 60px;
        height: 60px;
        float: left;
        margin: 2px;
        border-radius: 50%;
        border: solid 2px white;
    }

    #message_right div {
        width: 20px;
        height: 20px;
        background-color: #bf9797;
        border: solid 2px white;
        border-radius: 50%;
        position: absolute;
        right: -10px;
        top: 20px;


    }

    .loader_on {
        position: absolute;
        width: 30%;
    }

    .loader_off {
        display: none;
    }







</style>


<body>
<div id="wrapper">
    <div id="left_pannel">

        <div id="user_info" style="padding: 10px;">
            <div id="user_info" style="padding: 10px;">
                <img id="profile_image" src="ui/images/male.jpg">
                <br>
                <span id="username">Username</span>
                <!--using the document.getElementById().innerHTML = "some modification"-->
                <br>
                <span id="email" style="font-size: 12px; opacity: 0.5; ">email@gmail.com </span>
                <div>

                    <label id="label_chat" for="radio_chat">Chat <img src="ui\icons\message.png"> </label>
                    <!--box should be unique name which links to below checkbox id="box"-->
                    <label id="label_contacts" for="radio_contact">Contact <img src="ui\icons\message.png"></label>
                    <label id="label_settings" for="radio_setting">Setting <img src="ui\icons\message.png"></label>
                    <label id="logout" for="radio_logout">Logoutk <img src="ui\icons\message.png"></label>

                </div>
            </div>

        </div>
    </div>


    <div id="right_pannel">
        <div id="header">
            <div id="loader_holder" class="loader_on"><img style="width:70px;" src="ui\icons\giphy.gif"></div>
            My header
        </div>

        <div id="container" style="display: flex;">


            <div id="inner_left_pannel"> <!--contacts data will be listed here!!!-->


            </div>

            <input type="radio" id="radio_chat" name="myradio" style="display: none"> <!--remove the radio button-->
            <input type="radio" id="radio_contact" name="myradio" style="display: none">
            <input type="radio" id="radio_setting" name="myradio" style="display: none">


            <div id="inner_right_pannel"></div>
        </div>

    </div>

</div>


</body>
</html>


<script type="text/javascript">


    var CURRENT_CHAT_USER = "";  //create an empty string

    function _(element) { /*this function absolutely is used to getElementById of the page*/
        return document.getElementById(element);
    }

    var logout = _("logout");                          //button event listener for logout
    logout.addEventListener("click", logout_user);


    var label_contacts = _("label_contacts");          //button event listener for contacts
    label_contacts.addEventListener("click", get_contacts);


    var label_chat = _("label_chat");          //button event listener for contacts
    label_chat.addEventListener("click", get_chats);


    var label_settings = _("label_settings");          //button event listener for contacts
    label_settings.addEventListener("click", get_settings);


    /*get_data(find is an object, type is a string that we want to retrieve)*/
    function get_data(find, type) { /*find is search for... type is which type of data to be sent*/

        var xml = new XMLHttpRequest();/*create a xmlhttp request here used to send data to the server...*/

        var loader_holder = _("loader_holder");
        loader_holder.className = "loader_on";

        xml.onload = function () {
//alert(xml.responseText);
            if (xml.readyState == 4 || xml.status == 200) { /*When readyState is 4 and status is 200, the response is ready:*/
                loader_holder.className = "loader_off";
                handle_result(xml.responseText, type);   //means we have already received the result.. that we can switch the loader_holder off..
            }

        }

        var data = {}; //need to be string to be sent to server. /*need to merge the find and type into data object*/
        data.find = find;   /*property of the object named find*/
        data.data_type = type; /*property of the object named data_type*/
        data = JSON.stringify(data); /*concatenation of property of the object named find and data_type*/

        xml.open("POST", "api.php", true);
        xml.send(data);  /*send it to api.php*/

    }


    //here is the returning result from json method where in #includes folder
    function handle_result(result, type) {   //when the result come back...
//alert(result);
        if (result.trim() != "") { /*not empty, then will perform the below code*/

            var inner_right_pannel = _("inner_right_pannel");
            inner_right_pannel.style.overflow = "visable";

            var obj = JSON.parse(result); // return a JavaScript object/array

            if (typeof (obj.logged_in) != "undefined" && !obj.logged_in) {
                window.location = "login.php"; /*redirect to this webpage*/

            } else {

                switch (obj.data_type) {    //load the user data into right location
                    case "user_info":
                        var username = _("username");
                        var email = _("email");
                        var profile_image = _("profile_image");

                        username.innerHTML = obj.username;
                        email.innerHTML = obj.email;
                        profile_image.src = obj.image;
                        break;

                    case "contacts":    //if the come back result type is contacts, we can instruct it to do below
                        var inner_left_pannel = _("inner_left_pannel");


                        inner_right_pannel.style.overflow = "hidden";
                        inner_left_pannel.innerHTML = obj.message;
                        break;

                    case "chats_refresh":
                        var messages_holder = _("messages_holder");
                        messages_holder.innerHTML = obj.messages;
                        break;

                    case "chats":    //if the come back result type is contacts, we can instruct it to do below
                        var inner_left_pannel = _("inner_left_pannel");

                        inner_left_pannel.innerHTML = obj.user;
                        inner_right_pannel.innerHTML = obj.messages;

                        var messages_holder = _("messages_holder");
                        setTimeout(function(){
                            messages_holder.scrollTo(0,messages_holder.scrollHeight);
                            var message_text = _("message_text");
                            message_text.focus();
                            }, 0);
                        break;

                    case "settings":    //if the come back result type is contacts, we can instruct it to do below
                        var inner_left_pannel = _("inner_left_pannel");
                        inner_left_pannel.innerHTML = obj.message;
                        break;

                    case "save_settings":    //if the come back result type is contacts, we can instruct it to do below
                        alert (obj.message);
                        get_data({}, "user_info");   //go api > include::contacts >> result come back >>> handle_result(reult, type)
                        get_settings(true);
                        break;








                }
            }
        }


    }

    function logout_user() {

        var answer = confirm("Are you sure you want to log out?");

        if (answer) {
            get_data({}, "logout");
        }

    }

    get_data({}, "user_info");
    get_data({}, "contacts");

    var radio_contacts = _("radio_contact");
    radio_contacts.checked = true;



    function get_contacts(e) {
        get_data({}, "contacts");
    }

    function get_chats(e) {

        get_data({}, "chats");

    }

    function get_settings(e) {
        get_data({}, "settings");
    }



    function send_message(e){

        var message_text = _("message_text");
        if(message_text.value.trim()==""){

            alert("please type something to send");
            return;

        }


        get_data({message:message_text.value.trim(), userid:CURRENT_CHAT_USER}, "send_message");
    }


    function enter_pressed(event){
        if (event.keyCode ==13){
            send_message(event);
        }
    }


    setInterval(function(){

            if (CURRENT_CHAT_USER!= ""){

                get_data({userid:CURRENT_CHAT_USER},"chats_refresh");   //{userid:CURRENT_CHAT_USE}this is an object that we can retrieve from other side
            }

        },5000); //5sec






    get_data({}, "user_info");   //go api > include::contacts >> result come back >>> handle_result(reult, type)


</script>


<script type="text/javascript">






    function collect_data() {
        var save_settings_button = _("save_settings_button");
        save_settings_button.disabled = true;
        save_settings_button.value = "Loading... Please wait...";

        var myform = _("myform");
        var inputs = myform.getElementsByTagName("INPUT"); /*links to the document, it is associated with id myform in this scenario*/

        var data = {}; /*create an empty object*/

        for (var i = inputs.length - 1; i >= 0; i--) { /*collect the data typed by a register*/

            var key = inputs[i].name; /*totally includes seven TagNames called input, 7 - 1 = 6*/

            switch (key) {     /*kind of like a if statement*/

                case "username": /*check all the cases here*/
                    data.username = inputs[i].value;
                    break;

                case "email":
                    data.email = inputs[i].value;
                    break;

                case "gender":
                    if (inputs[i].checked) {                 //The checked property sets or returns the checked state of a checkbox.
                        data.gender = inputs[i].value;
                    }
                    break;

                case "password":
                    data.password = inputs[i].value;
                    break;

                case "password2":
                    data.password2 = inputs[i].value;
                    break;
            }
        }

        /*alert(JSON.stringify(data)); /*convert a JS object into a string by using stringify*/

        send_data(data, "save_settings"); /*data, data_type*/


    }


    function send_data(data, type) {

        var xml = new XMLHttpRequest(); /*request data from the server, the variable is created as an object*/

        xml.onload = function () { /*the onload event occurs when an object has been loaded*/

            if (xml.readyState == 4 || xml.status == 200) {/*number 4 means request has been read and response*/

                handle_result(xml.responseText); /*XMLHttpRequest.responseText(), mainly used with XMLHttpReuest object to retrieve the specific response*/
                var save_settings_button = _("save_settings_button");
                save_settings_button.disabled = false;
                save_settings_button.value = "Signup";

            }/*handled by below JS code*/

        }

        data.data_type = type; /*an object stores string named "signup"*/
        var data_string = JSON.stringify(data); /*convert an object to a String*/

        xml.open("POST", "api.php", true); /*pre-requisite that when a request to be sent to target server*/
        xml.send(data_string); /*send the request to the server*/
    }

    function upload_profile_image(files){

        var change_image_button = _("change_image_button");     //getting the button
        change_image_button.disabled = true;                    //then disable the button
        change_image_button.innerHTML = "Uploading Image...";   //change the element's content

        var myform = new FormData();  //create a form object


        var xml = new XMLHttpRequest(); //outside the HTML request

        xml.onload = function () { /*the onload event occurs when an object has been loaded*/

            if (xml.readyState == 4 || xml.status == 200) {/*number 4 means request has been read and response*/

                //alert(xml.responseText); /*XMLHttpRequest.responseText(), mainly used with XMLHttpReuest object to retrieve the specific response*/ //get the result...
                get_data({}, "user_info");   //go api > include::contacts >> result come back >>> handle_result(reult, type)
                get_settings(true);
                change_image_button.disabled = false;
                change_image_button.innerHTML = "Change Image";

            }/*handled by below JS code*/

        }

        myform.append('file', files[0]); //append the first file to the form
        myform.append('data_type', "change_profile_image"); //append the data_type to the form


        xml.open("POST", "uploader.php", true); /*pre-requisite that when a request to be sent to target server*/
        xml.send(myform); /*send the request to the server*/

    }


    function handle_drag_and_drop(e){

        if(e.type == "dragover"){

            e.preventDefault();
            e.target.className = "dragging";

        }else if(e.type == "dragleave"){

            e.target.className = "";

        }else if(e.type == "drop"){

            e.preventDefault();
            e.target.className = "";

            //console.log(e.dataTransfer.files);  //e.dataTransfer.files is exactly same as this.files in upload_profile_image()...
            upload_profile_image(e.dataTransfer.files);

        }else{

            e.target.className = "";

        }
    }

    function start_chat(e){
        var userid = e.target.getAttribute('userid');
        if(e.target.id == ""){
            userid = e.target.parentNode.getAttribute('userid');

        }
        CURRENT_CHAT_USER = userid;

        var radio_chat = _("radio_chat");
        radio_chat.checked = true;
        // on the chats, we can check if the userid exists, then we can use other object properties...
        get_data({userid:CURRENT_CHAT_USER},"chats");   //{userid:CURRENT_CHAT_USE}this is an object that we can retrieve from other side
    }





</script>

