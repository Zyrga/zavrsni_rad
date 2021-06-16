<?php

    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon.ico">
    <title>Vivify Blog</title>

    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="va-l-page va-l-page--homepage">

<?php
    include('header.php');
?>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if (!empty($_POST['title'])) {
            $title = $_POST['title'];
        }

        if (!empty($_POST['body'])) {
            $body = $_POST['body'];
        }

        if(!empty($title) && !empty($body)) {
            $sql = "INSERT INTO posts (title, body, published) VALUES ('$title', '$body', 1, 1)";
    
            try {
                $statement = $connection->prepare($sql);
                $statement->execute();
                echo 'New record created succefully.';
            } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }
    }
?>

<body>
<form action="create-post.php" method="post">
    Title: <input type="text" name="title"><br>
    Body: <input type="text" name="body"><br>
    <input type="submit">
</form>


<?php
     include('sidebar.php');
?>

<?php
     include('footer.php');
?>

</body>