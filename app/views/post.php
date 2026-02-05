<?php 
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "app/models/comment.php";
    comment($_GET["p"],$_SESSION["user_info"]["user_id"], $_POST["content"] );

    header("location:/post?p=".$_GET["p"]);

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>PostaFun</title>
</head>

<body>
    <div class="navigation">
        <h3>PostaFun</h3>
        <nav class="navbar">

            <?php
            require "app/utils/tools.php";
            if (is_authenticated()) {
                $user = $_SESSION["user_info"];
                $first_name = $user["first_name"];
                $last_name = $user["last_name"];
                $avatar = $user["avatar"];
                $username = $user["username"];
                echo <<<HTML
                <ul>
                    <li>
                        <a href="/profil?u=$username">$first_name $last_name</a>
                    </li>
                    <li>
                        <a href="/logout">Deconnexion</a>
                    </li>
                </ul>
                HTML;
            } else {
                echo <<<HTML
                <ul>
                    <li>
                        <a href="/inscription">Inscription</a>
                    </li>
                    <li>
                        <a href="/connexion">Connexion</a>
                    </li>
                </ul>
              HTML;
            }
            ?>
        </nav>
    </div>

    <div class="post-container">
        <?php
            require_once "app/models/post.php";
            $post = show_post($_GET ["p"]);
        ?>
        <div class="feed">

                <div class="post-card">

                    <div class="post-header">
                        <strong><?= htmlspecialchars($post['username']) ?></strong>
                        <span class="date"><?= $post['created_at'] ?></span>
                    </div>

                    <div class="post-content">
                        <p><?= nl2br(htmlspecialchars($post['content'] ?? '')) ?></p>
                    </div>

                    <?php if (!empty($post['banner'])): ?>
                        <?php $banner = '/' . ltrim($post['banner'], '/'); ?>
                        <img src="<?= htmlspecialchars($banner) ?>" class="post-image" alt="post image">
                    <?php endif; ?>

                    <!-- Boutons -->
                    <?php if (is_authenticated()):?>
                        <div class="post-actions">
                            <a href="/like?id=<?= $post['id'] ?>">❤️ Like</a>
                            <a href="/post?p=<?= $post['id'] ?>">💬 Commenter</a>
                        </div>
                    <?php endif ?>




                </div>

        </div>
        <hr>
         <div class="post-creation">
            <form action="" method="post">
                <div class="field">
                    <textarea name="content" id="content" placeholder="Contenu du post"></textarea>
                </div>
                <div class="validation">
                    
                    <input type="submit" value="commenter">
                </div>
            </form>
        </div>
        <div class="comments">
            <?php 
                 require_once "app/models/comment.php";
                 $comments = fetch_comment($post["id"]);?>
            <?php foreach( $comments as $comment) :?>
                <div class="comment-card">

                    <div class="comment-header">
                        <strong><?= htmlspecialchars($comment['username']) ?></strong>
                        <span class="date"><?= $comment['created_at'] ?></span>
                    </div>

                    <div class="comment-content">
                        <p><?= nl2br(htmlspecialchars($comment['content'] ?? '')) ?></p>
                    </div>

                </div>
            <?php endforeach ?>
        </div>

    </div>





</body>

</html>