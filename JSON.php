<script type="text/javascript">


    var person = { /*JS not array concept*/
        name: "john",
        age:24,
        gender: "male"
    };

    var mystring = JSON.stringify(person) /*convert the object to a string*/
    var myoject = JSON.parse(mystring); /*convert the string to a object*/




    console.log(mystring);

</script>


