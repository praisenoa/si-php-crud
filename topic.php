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
    <?php include('navigation.php') ?>
    <section>
        <div class="test">
            <h1 class="section_title">
                <?= $stmt->fetch(PDO::FETCH_ASSOC)["subject"]; ?>
            </h1>
            <div>
                    <?php
                    $category_id_query = "SELECT
                `topics`.`category_id`
                FROM
                `topics`
                ;";
                    $category_id = $conn->prepare($category_id_query);
                    $category_id->execute();
                    ?>
                    <a href="category.php?category=<?=$category_id->fetch(PDO::FETCH_ASSOC)["category_id"]; ?>" class="button_return_to_list">Retour à la liste</a>
                </div>
            </div>
            <hr class="main_line">
                <?php
                $stmt = $conn->prepare($replies);
                $stmt->bindValue(':id', $_GET['topic']);
                $stmt->execute();
                ?>

                <?php while (false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)) :?>

                    <div class="item_box_topics" id="<?= $row["reply_id"] ?>">
                        <p class="item_text"><?= $row["content"] ?></p>
                        <?php
                        $timestamp = strtotime($row["date"]);
                        $mois_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
                        list($nom_jour, $jour, $mois, $annee, $heure, $minute, $seconde) = explode('/', date("w/d/n/Y/H/i/s", $timestamp)); ?>

                        <p class="additional_info_title">Ajouté par <?= $row["author"] ?></p>
                        <p class="additional_info_detail"><?= $jour . ' ' . $mois_fr[$mois] . ' ' . $annee . ' ' ?>
                            à<?= ' ' . $heure . ':' . $minute ?></p>
                        <hr class="secondary_line">
                    </div>
                <?php endwhile;?>

        <div class="add_reply_form">
            <form action="" method="post">
                <input class="topic_add_input" type="text" name="author" id="author" placeholder="Votre pseudo"
                       value="Anonymous">
                <textarea class="topic_add_text" name="content" id="content" placeholder="Votre message"></textarea>
                <button class="button_submit_reply" type="submit" name="submit">Ajouter votre message</button>
            </form>
        </div>
    </section>
</section>
        <?php include('layouts/footer.php');?>
