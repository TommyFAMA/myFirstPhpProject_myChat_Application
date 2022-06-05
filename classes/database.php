<?php

class Database
{
    private $con; /*it can not be accessed by outside*/


    //construct
    function __construct()
    {
        $this->con = $this->connect();
    }

    //connect to database
    private function connect()
    {
        $string = "mysql:host=localhost;dbname=mychat_db";

        try /*if everything goes well*/
        {
            $connection = new PDO($string, DBUSER, DBPASS);
            return $connection;

        } catch (PDOException $e) {
            echo $e->getMessage();/*printout the message*/

        }

        return false;


    }


    ///write to database
    public function write($query, $data_array = []) /*write to the database*/
    {


        $con = $this->connect(); /*open the connection*/ /*$data_array = [] means this array is optional*/
        $statement = $con->prepare($query);  /*prepare our enquiry*/
        $check = $statement->execute($data_array);

        if ($check) {
            return true;
        }
        return false;

    }



    ///read from database
    public function read($query, $data_array = []) /*write to the database*/ /*we should apply $query and $data_array = [] in function read*/
    {


        $con = $this->connect(); /*open the connection*/ /*$data_array = [] means this array is optional*/
        $statement = $con->prepare($query);  /*prepare our enquiry*/
        $check = $statement->execute($data_array); /*check if the statement whether true*/

        if ($check) {
            $result = $statement->fetchAll(PDO::FETCH_OBJ); /*::access the function inside the DPO, without creating the object PDO*/
            if(is_array($result) && count($result) > 0){
                return $result;
            }
            return false;
        }
        return false;

    }


    public function get_user($userid)
    {


        $con = $this->connect();
        $arr['userid'] = $userid;
        $query = "select * from users where userid = :userid limit 1";
        $statement = $con->prepare($query);
        $check = $statement->execute($arr);

        if ($check) {
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result) > 0)
            {
                return $result[0];
            }
            return false;
        }
        return false;

    }



    public function generate_id($max)
    {


        $rand = "";
        $rand_count = rand(4, $max);
        for ($i = 0; $i < $rand_count; $i++) {
            $r = rand(0, 9);
            $rand .= $r; /*concatenate*/

        }

        return $rand;

    }
}



