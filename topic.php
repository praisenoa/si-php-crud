<?php $title = 'Topic' ?>
<?php include('layouts/header.php');?>

<?php
$topics = "SELECT 
  `subject`,
  `topic_id`
  FROM 
  `topics`
  WHERE
  `topic_id` = :id 
  ";
$stmt = $conn->prepare($topics);
$stmt->bindValue(':id', $_GET['topic']);
$stmt->execute();

$replies = "SELECT 
          `reply_id`, 
          `topic_id`, 
          `category_id`, 
          `content`, 
          `date`,
          `author`
        FROM 
          `replies`
        WHERE
          `topic_id` = :id
        ;";

?>

    <?php
// Write comment

if(isset($_POST['submit'])){
    if(isset($_POST['author']) && trim($_POST['author']) !== '' && $_POST['content'] && trim($_POST['content']) !== '')
    {
        $add = "INSERT INTO 
      `replies` 
      (`replies`.`content`, `replies`.`author`, `replies`.`topic_id`) 
      VALUES 
      (:content, :author, :topicID);
      ";
        $doadd = $conn->prepare($add);
        $doadd->bindValue(':content', htmlspecialchars($_POST['content']), PDO::PARAM_STR);
        $doadd->bindValue(':author', htmlspecialchars($_POST['author']), PDO::PARAM_STR);
        $doadd->bindValue(':topicID', $_GET['topic'], PDO::PARAM_STR);
        $doadd->execute();
        $newID = $conn->lastInsertID();
        header('Location: #'. $newID .'');
    } else {
        echo "sa march po";
    }  
}
?>

        <section class="container">
            <?php include('navigation.php')?>
            <section class="discussions_container">
                <h1>
                    <?= $stmt->fetch(PDO::FETCH_ASSOC)["subject"]; ?>
                </h1>

                <?php        
                $stmt = $conn->prepare($replies);
                $stmt->bindValue(':id', $_GET['topic']);
                $stmt->execute();
                ?>

                <?php while (false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)) :?>

                <div class="comment" id="<?=$row[" reply_id "]?>">
                    <p>
                        <?=$row["content"]?>
                    </p>
                    <span>Auteur : <?=$row["author"]?></span>
                </div>
                <?php endwhile;?>

                <a href="./" class="btnAddTopic">Retour à la liste</a>


                <div class="reply">
                    <form action="" method="post">
                        <input type="text" name="author" id="author" placeholder="Votre pseudo" value="Anonymous">
                        <textarea name="content" id="content" placeholder="Votre message..."></textarea>
                        <button type="submit" name="submit">Envoyer</button>
                    </form>
                </div>
            </section>
        </section>
        <?php include('layouts/footer.php');?>
