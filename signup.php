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
        margin: auto; /*move it into center*/
        color: grey;
        font-family: myFont;
    }

    #header {
        background-color: #485b6c;
        font-size: 40px;
        text-align: center;
        font-family: headFont;
        width: 100%;
        color: white;

    }

    form {

        margin: auto;
        padding: 10px;
        width: 100%;
        max-width: 400px;

    }

    input[type=text], input[type=password] {
        padding: 10px;
        margin: 10px;
        width: 100%;
        border-radius: 5px;
        border: solid 1px grey;
    }


    input[type=button] {
        width: 100%;
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


</style>
<body>

<div id="wrapper">
    <div id="header">
        My Chat
        <div style="font-size: 20px; font-family: myFont;">Signup</div>
    </div>

    <div id="error"> some text</div>


    <form id="myform"> <!--using id links to JS function -->
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="email" placeholder="Email">
        <div style="padding: 10px;">
            <br>Gender:<br>
            <input type="radio" value="Male" name="gender_male"> Male <br>
            <input type="radio" value="Female" name="gender_female"> Female <br>
        </div>

        <input type="password" name="password" placeholder="Password"><br>
        <input type="password" name="password2" placeholder="Retype Password"><br>
        <input type="button" value="Sign up" id="signup_button"><br>  <!--using the id links with js function"-->

        <br>

        <a href="login.php" style="display:block; text-align:center; text-decoration: none;">
            Sign In here
        </a>


    </form>


</div>

</body>
</html>


<script type="text/javascript">


    /*Function one aimed to getElementById("signup_button")*/
    function _(element) {
        return document.getElementById(element);
    }


    var signup_button = _("signup_button");
    signup_button.addEventListener("click", collect_data); /*addEventListener("click", run collect_data function)*/


    function collect_data() {

        signup_button.disabled = true;
        signup_button.value = "Loading... Please wait...";

        var myform = _("myform");
        var inputs = myform.getElementsByTagName("input"); /*links to the document, it is associated with id myform in this scenario*/

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

                case "gender_male":
                case "gender_female":
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

        send_data(data, "signup"); /*data, data_type*/


    }


    function send_data(data, type) {

        var xml = new XMLHttpRequest(); /*request data from the server, the variable is created as an object*/

        xml.onload = function () { /*the onload event occurs when an object has been loaded*/

            if (xml.readyState == 4 || xml.status == 200) {/*number 4 means request has been read and response*/

                hand_result(xml.responseText); /*XMLHttpRequest.responseText(), mainly used with XMLHttpReuest object to retrieve the specific response*/

                signup_button.disabled = false;
                signup_button.value = "Signup";

            }/*handled by below JS code*/

        }

        data.data_type = type; /*an object stores string named "signup"*/
        var data_string = JSON.stringify(data); /*convert an object to a String*/

        xml.open("POST", "api.php", true); /*pre-requisite that when a request to be sent to target server*/
        xml.send(data_string); /*send the request to the server*/
    }


    function hand_result(result) {

        var data = JSON.parse(result); /*when receiving data from a web server,
                                        the data is always a string.
                                        let it becomes a JavaScript object.*/
        /*obj.name or obj.age...associated array*/
        if (data.data_type == "info") {

            window.location = "index.php"; /*this object is used to redirect to the index.php*/

        } else {  /*if error*/

            var error = _("error");  /*function one: document.getElementById("error")*/
            error.innerHTML = data.message;
            error.style.display = "block"; /*none*/

        }


    }

</script>