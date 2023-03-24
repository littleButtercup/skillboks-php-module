<?php
require_once "./user.php";

if(!empty($_POST)){

    if(isset($_POST['id']) && isset($_POST['method']) && $_POST['method']=='delete'){
        User::delete($_POST['id']);
    }elseif (isset($_POST['id'])){
        User::update($_POST);
    }else{
        User::create($_POST);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php
$v = User::list1();
foreach ($v as $item){
   echo
    '<div style="display: flex"><form action="index.php" method="post" style="display: flex">
    <div>
        <input name="id" type="hidden" value="'.$item['id'].'"/>
        <input name="id" disabled value="'.$item['id'].'"/>
    </div>
    <div>
        <input name="email" value="'.$item['email'].'"/>
    </div>
    <div>
        <input name="first_name" value="'.$item['first_name'].'"/>
    </div>
    <div>
        <input name="last_name" value="'.$item['last_name'].'"/>
    </div>
    <div>
        <input name="age" value="'.$item['age'].'"/>
    </div>
    <div>
        <button type="submit">edit</button>
        
    </div>
</form>
<form method="post" action="index.php">
        <button type="submit">delete</button>
        <input name="id" type="hidden" value="'.$item['id'].'"/>
        <input name="method" type="hidden" value="delete"/>
        </form>
        </div>';
}

?>
<form action="index.php" method="post" style="display: flex">
    <div>
        <input name="id" disabled/>
    </div>
    <div>
        <input name="email"/>
    </div>
    <div>
        <input name="firstName"/>
    </div>
    <div>
        <input name="lastName"/>
    </div>
    <div>
        <input name="age"/>
    </div>
    <div>
        <button type="submit">new</button>

    </div>
</form>
</body>
</html>
