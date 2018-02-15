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

    <div class="container">
        <h1 class="createTopic">Create topic</h1>
        <form class="topicAddForm" action="" method="post">
            <input type="text" id="author" name="author" placeholder="Votre pseudo" value="Anonymous">
            <input type="text" id="subject" name="subject" placeholder="Titre du topic...">
            <textarea id="content" name="content" id="" cols="30" rows="10" placeholder="Message..."></textarea>
            <button name="submit" type="submit">Envoyer</button>
        </form>
        <a href="./" style="margin-top: 100px;" class="btnAddTopic">Retour</a>
    </div>

<?php include('layouts/footer.php');?>

