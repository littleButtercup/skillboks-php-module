<?php

//$connection = new PDO("mysql:host=localhost;dbname=example;charset=utf8",'root','5555');
//
//$statement = $connection->query("SELECT * FROM user");
//
//$statement->execute();
//
//while($data = $statement->fetchColumn(3)){
//echo $data . '<br>';
//}

class User{
    public $id, $email, $firstName, $lastName, $age, $dateCreate;

public static function create($a){
    $connection = new PDO("mysql:host=localhost;dbname=example;charset=utf8",'root','5555');
    $qwery = $connection->prepare(
        "INSERT INTO user (email, first_name, last_name, age) VALUES (:email, :firstName, :lastName, :age)");
    $qwery->execute($a);
}

public static function update($a){
    $connection = new PDO("mysql:host=localhost;dbname=example;charset=utf8",'root','5555');
    $updateUser = $connection->prepare(
        "UPDATE user SET email = :email, first_name = :first_name,last_name = :last_name, age = :age WHERE id = :id");
    $updateUser->execute($a);
}

public static function delete($a){
    $connection = new PDO("mysql:host=localhost;dbname=example;charset=utf8",'root','5555');
    $deleteUser = $connection->prepare(
        "DELETE from user WHERE id = :id");
    $deleteUser->execute(['id'=>$a]);
}

public static function list1(){
    $connection = new PDO("mysql:host=localhost;dbname=example;charset=utf8",'root','5555');
    $list = $connection->prepare( "SELECT id, email, first_name, last_name, age, date_created FROM user" );
    $list->execute();
    return $list;
}
}






