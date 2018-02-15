<?php $title = 'Administration : Editer'; ?>
<?php include('verification-login.php') ?>
<?php include('layouts/header.php');?>

<?php
$query_replies = "SELECT
          `replies`.`topic_id`,
          `replies`.`content`,
          `replies`.`reply_id`,
          `replies`.`author`,
          `replies`.`date`
          FROM 
          `replies`
          WHERE
          `reply_id` = :id
          ORDER BY
          `replies`.`date`
          DESC
          ";
$allRepliesQuery = $conn->prepare($query_replies);
$allRepliesQuery->bindValue(':id', $_GET['edit']);
$allRepliesQuery->execute();
?>

<div class="admin containerlevrai">
    <form action="" method="post">
    <table class="table_topics">
        <tr>
            <th style="text-align:center;">Topic ID</th>
            <th style="text-align:center;">Reply ID</th>
            <th style="text-align:left;">Content</th>
            <th style="text-align:center;">Date</th>
            <th style="text-align:center;">Author</th>
        </tr>
        <?php while (false !== $row = $allRepliesQuery->fetch(PDO::FETCH_ASSOC)) :?>
        <tr>
            <td style="text-align:center;">
                <?=$row["topic_id"]?>
            </td>
            <td style="text-align:center;">
                <?=$row["reply_id"]?>
            </td>
            <td style="text-align:left;">
                <textarea name="content" id="content" class="contentEdit"><?=$row["content"]?></textarea>
            </td>
            <td style="text-align:center;">

                <?php
        $timestamp = strtotime($row["date"]);
                $mois_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
                list($nom_jour, $jour, $mois, $annee, $heure, $minute, $seconde) = explode('/', date("w/d/n/Y/H/i/s", $timestamp));
                echo $jour.' '.$mois_fr[$mois].' '.$annee.' à '.$heure.':'.$minute.':'.$seconde; 
                ?>
            </td>
            <td style="text-align:center;">
                <textarea name="author" id="author" class="contentEdit"><?=$row["author"]?></textarea>
            </td>
        </tr>
        <?php $topicID = $row['topic_id'] ?>
        <?php endwhile;?>
    </table>
    <div class="flexbtnsend">
        <button class="btnSend" type="submit" name="submit">Sauvegarder</button>
        <a href="./editTopic.php?edit=<?=$topicID?>">Retour</a>
    </div>
    </form>
</div>

<?php
if(isset($_POST['submit'])){
    $query_save = "UPDATE
            `replies`
            SET
            `content` = :content,
            `author` = :author
            WHERE
            `reply_id` = :id
            ;";
    $stmt = $conn->prepare($query_save);
    $stmt->bindValue(':id', $_GET['edit']);
    $stmt->bindValue(':content', $_POST['content']);
    $stmt->bindValue(':author', $_POST['author']);
    $stmt->execute();
}
?>

<?php include('layouts/footer.php');?>