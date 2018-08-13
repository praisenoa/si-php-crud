<?php $title = 'Administration : Editer'; ?>
<?php include('verification-login.php') ?>
<?php include('layouts/header.php');?>


<?php
$query_topics = "SELECT
          `topics`.`topic_id`,
          `topics`.`subject`,
          `topics`.`category_id`,
          `topics`.`date`
          FROM 
          `topics`
          WHERE
          `topic_id` = :id
          ORDER BY
          `topics`.`date`
          DESC
          ";
$allTopicsQuery = $conn->prepare($query_topics);
$allTopicsQuery->bindValue(':id', $_GET['edit']);
$allTopicsQuery->execute();
?>
<div class="admin containerlevrai">
    <form action="" method="post">
    <table class="table_topics">
        <tr>
            <th>Topic ID</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Category ID</th>
        </tr>
        <?php while (false !== $row = $allTopicsQuery->fetch(PDO::FETCH_ASSOC)) :?>
        <h1 class="title">Editer le topic : <?=$row['subject']?></h1>
        <tr>
            <td>
                <?=$row["topic_id"]?>
            </td>
            <td>                
                <textarea name="subject" id="subject" class="contentEdit"><?=$row["subject"]?></textarea>
            </td>
            <td>

                <?php
    $timestamp = strtotime($row["date"]);
                $mois_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
                list($nom_jour, $jour, $mois, $annee, $heure, $minute, $seconde) = explode('/', date("w/d/n/Y/H/i/s", $timestamp));
                echo $jour.' '.$mois_fr[$mois].' '.$annee.' à '.$heure.':'.$minute.':'.$seconde; 
                ?>
            </td>
            <td>
                <?=$row["category_id"]?>
            </td>
        </tr>
        <?php $categoryID = $row["category_id"]; ?>
        <?php endwhile;?>
    </table>
    <div class="flexbtnsend">
        <button class="btnSend" type="submit" name="submit">Sauvegarder</button>
        <a href="./editCategory.php?edit=<?=$categoryID?>">Retour</a>
    </div>
    </form>
    
    <?php
    if(isset($_POST['submit'])){
        $query_save = "UPDATE
            `topics`
            SET
            `subject` = :subject
            WHERE
            `topic_id` = :id
            ;";
        $stmt = $conn->prepare($query_save);
        $stmt->bindValue(':id', $_GET['edit']);
        $stmt->bindValue(':subject', $_POST['subject']);
        $stmt->execute();
        header('Location: ./editCategory.php?edit='.$categoryID);
    }
    ?>
    
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
          `topic_id` = :id
          ORDER BY
          `replies`.`date`
          DESC
          ";
    $allRepliesQuery = $conn->prepare($query_replies);
    $allRepliesQuery->bindValue(':id', $_GET['edit']);
    $allRepliesQuery->execute();
?>
    <h1 class="title">Commentaires du topic :</h1>
    <table class="table_topics">
        <tr>
            <th style="text-align:center;">Topic ID</th>
            <th style="text-align:center;">Reply ID</th>
            <th style="text-align:left;">Content</th>
            <th style="text-align:center;">Date</th>
            <th style="text-align:center;">Author</th>
            <th style="text-align:center;">Edit</th>
            <th style="text-align:center;">Delete</th>
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
                <?=$row["content"]?>
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
                <?=$row["author"]?>
            </td>
            <td style="text-align:center;">
                <a href="editReply.php?edit=<?=$row['reply_id']?>" class="btn" title="Edit">✏️</a>
            </td>
            <td style="text-align:center;">
                <a href="deleteReply.php?delete=<?=$row['reply_id']?>" class="btn" title="Delete">❌</a>
            </td>
        </tr>
        <?php endwhile;?>
    </table>
</div>

<?php include('layouts/footer.php');?>
