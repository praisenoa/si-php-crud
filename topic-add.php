<?php $title = 'Créer un topic'; ?>
<?php include('layouts/header.php');?>


<?php 
if(isset($_POST['submit'])){
    if(isset($_POST['author']) && trim($_POST['author']) !== '' && $_POST['content'] && trim($_POST['content']) !== '' && $_POST['subject'] && trim($_POST['subject']) !== '')
    {
    $add = "INSERT INTO 
      `topics` 
      (`topics`.`subject`, `topics`.`category_id`) 
      VALUES 
      (:subject, :categoryID);
      ";
    $doadd = $conn->prepare($add);
    $doadd->bindValue(':subject', htmlspecialchars($_POST['subject']), PDO::PARAM_STR);
    $doadd->bindValue(':categoryID', $_GET['category'], PDO::PARAM_STR);
    $doadd->execute();
    $newID = $conn->lastInsertID();

    $add = "INSERT INTO 
      `replies` 
      (`replies`.`content`, `replies`.`topic_id`, `replies`.`author`) 
      VALUES 
      (:content, :id, :author);";
    $doadd = $conn->prepare($add);
    $doadd->bindValue(':content', htmlspecialchars($_POST['content']), PDO::PARAM_STR);
    $doadd->bindValue(':author', htmlspecialchars($_POST['author']), PDO::PARAM_STR);
    $doadd->bindValue(':id', $newID, PDO::PARAM_STR);
    $doadd->execute();
    header('Location: ./');
    }

}
?>
<section class="container">
    <?php include('navigation.php'); ?>


    <form action="" method="post">
        <h1 class="section_title">Créer une nouvelle discussion</h1>
        <input class="topic_add_input" type="text" id="author" name="author" placeholder="Votre pseudo" value="Anonymous">
        <input class="topic_add_input" type="text" id="subject" name="subject" placeholder="Titre de la discussion">
        <textarea class="topic_add_text" id="content" name="content" id="" cols="30" rows="10" placeholder="Votre message"></textarea>
        <div class="buttons_topic_container">
            <button class="button_topic_return"><a href="./" style="text-decoration: none; color:black">Retour</a></button>
            <button class="button_topic_submit" name="submit" type="submit">Valider</button>
        </div>
    </form>

    </div>
</section>

<?php include('layouts/footer.php');?>

