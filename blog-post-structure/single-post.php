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
<body class="va-l-page va-l-page--single">

<?php include('header.php'); ?>

    <div class="va-l-container">
        <main class="va-l-page-content">

            <?php
                if (isset($_GET['post_id'])) {

                    $sql = "SELECT posts.id AS postId, posts.created_at, posts.body, posts.title FROM posts WHERE posts.id = {$_GET['post_id']}";
                    $sql2 = "SELECT * FROM comments WHERE comments.post_id = {$_GET['post_id']}";
                    $statement = $connection->prepare($sql);
                    $statement2 = $connection->prepare($sql2);

                    $statement->execute();
                    $statement2->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $statement2->setFetchMode(PDO::FETCH_ASSOC);

                    $singlePost = $statement->fetch();
                    $comments = $statement2->fetch();
                        // echo '<pre>';
                        // var_dump($singlePost);
                        // echo '</pre>';

            ?>

                    <article class="va-c-article">
                        <header>
                            <h1><?php echo $singlePost['title'] ?></h1>

                            <h3>category: <strong>Sports</strong></h3>

                            <div class="va-c-article__meta"><?php echo $singlePost['created_at'] ?></div>
                        </header>

                        <div>
                            <p><?php echo $singlePost['body'] ?></p>
                        </div>

                        <div class="comments">
                            <h3>comments</h3>

                            <div class="single-comment">
                                <div>posted by:<?php echo $comments['created_at'] ?></div>
                                <div><?php echo $comments['text'] ?>
                                </div>
                            </div>
                        </div>
                    </article>

            <?php
                } else {
                    echo('post_id nije prosledjen kroz $_GET');
                }
            ?>

        </main>

        <?php
            include('sidebar.php');
        ?>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>