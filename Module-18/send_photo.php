<?php
session_start();

if (!isset($_SESSION['sent'])) {
    $_SESSION['sent'] = 0;
} else {
    if (isset($_POST['formCheck'])){
        $_SESSION['sent']++;
    }
}

$sent = $_SESSION['sent'];

if (isset($_FILES['photo'])) {
    try {
        if($_FILES['photo']['type'] == 'image/jpeg' || $_FILES['photo']['type'] == 'image/png' && $_FILES['photo']['size'] < 2048){
            move_uploaded_file($_FILES['photo']['tmp_name'], './images/' . $_FILES['photo']['name']);
        }else{
            throw new Exception('неправельный формат');
        }
    ?>
        <img src="<?php echo './images/' . $_FILES['photo']['name'];?>">
        <?php
    } catch (Exception $e) {
         echo $e->getMessage();
    }
}
?>

<html>
<head></head>
<body>
</body>
<div><?php echo $sent ?></div>
<?php
if ($_SESSION['sent'] > 1){
    throw new Exception('превышено колличество');
}
?>
<form action="send_photo.php" method="post" enctype="multipart/form-data">
    <div>
        <input type="file" name="photo">
    </div>
    <div>
        <input type="hidden" name="formCheck" value="1">
        <button type="submit">ok</button>
    </div>
</form>
</body>

</html>
