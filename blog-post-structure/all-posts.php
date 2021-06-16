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

    <link rel="stylesheet" href="styles/styles.css">
</head>
<body class="va-l-page va-l-page--homepage">

    <?php 
        include('header.php') 
    ?>

    <div class="va-l-container">
        <main class="va-l-page-content">

            <?php

                $sql = "SELECT posts.created_at, posts.body, posts.title FROM posts ORDER BY posts.created_at DESC";
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

                            <div class="va-c-article__meta"><?php echo($post['created_at']) ?></div>
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

        <?php 
            include('sidebar.php') 
        ?>
    </div>

    <?php 
        include('footer.php'); 
    ?>

</body>
</html>