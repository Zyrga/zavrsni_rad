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
    <title>Vivify Academy Blog - Homepage</title>

    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="va-l-page va-l-page--homepage">

    <?php include('header.php') ?>

    <div class="va-l-container">
        <main class="va-l-page-content">

            <?php

                $sql = "SELECT users.id AS usersId, CONCAT(profiles.first_name, ' ', profiles.last_name) AS fullName, posts.created_at, posts.body, posts.title FROM posts INNER JOIN users ON posts.user_id = users.id INNER JOIN profiles ON profiles.user_id = users.id ORDER BY posts.created_at DESC";
                $statement = $connection->prepare($sql);

                $statement->execute();

                $statement->setFetchMode(PDO::FETCH_ASSOC);

                $posts = $statement->fetchAll();

                

            ?>

            <?php
                foreach ($posts as $post) {
            ?>

                    <article class="va-c-article">
                        <header>
                            <h1><a href="single-post.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></h1>

                            <div class="va-c-article__meta"><?php echo($post['created_at']) ?> by <?php echo($post['fullName']) ?></div>
                        </header>

                        <div>
                            
                            <p><?php echo($post['body']) ?></p>
                        </div>
                    </article>

            <?php
                }
            ?>


            <div>
                <a href="all-posts.php" title="All posts">All posts</a>
            </div>
        </main>
        <?php include('sidebar.php') ?>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>