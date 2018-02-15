<?php $title = 'Administration : Supprimer'; ?>
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
$allTopicsQuery->bindValue(':id', $_GET['delete']);
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
            <h1 class="title">Supprimer le topic : <?=$row['subject']?></h1>
            <tr>
                <td>
                    <?=$row["topic_id"]?>
                </td>
                <td>                
                    <?=$row["subject"]?>
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
            <button class="btnSend" type="submit" name="submit">Supprimer</button>
            <a href="./">Retour</a>
        </div>
    </form>
</div>

<?php
    if(isset($_POST['submit'])){
        $query_save = "DELETE FROM
            `topics`
            WHERE
            `topic_id` = :id
            ;";
        $stmt = $conn->prepare($query_save);
        $stmt->bindValue(':id', $_GET['delete']);
        $stmt->execute();
        header('Location: ./editCategory.php?edit='.$categoryID);
    }
?>

<?php include('layouts/footer.php');?>