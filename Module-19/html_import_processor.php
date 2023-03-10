
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<form method="post" action="./html_import_processor.php">
    <div>
        <input name="url">
    </div>
    <div></div>
    <div>
        <input type="submit">
    </div>

</form>
<a href="#">aaaa</a>

<?php
$j = [];
if (!empty($_POST)){
    $headers = [
        'Content-Type:application/json'
    ];
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $_POST['url']);
    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    curl_setopt($ch, CURLOPT_PORT, 80);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $j = array('raw_text' => curl_exec($ch));

    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, 'http://localhost/HtmlProcessor.php');
    curl_setopt($ch2, CURLOPT_POST, 1);
    curl_setopt($ch2, CURLOPT_PORT, 80);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($j));
    echo "<textarea>".curl_exec($ch2)."</textarea>";
}
?>

</body>
</html>

