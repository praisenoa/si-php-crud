<?php $title = 'Gestion des topics'; ?>
<?php include('verification-login.php') ?>
<?php include('layouts/header.php');?>

<?php
$query_categories = "SELECT
          `categories`.`category_id`,
          `categories`.`name`
          FROM 
          `categories`
          WHERE
          `category_id` = :id
          ";
$allCategoriesQuery = $conn->prepare($query_categories);
$allCategoriesQuery->bindValue(':id', $_GET['edit']);
$allCategoriesQuery->execute();
?>
    <div class="admin containerlevrai">
        <form action="" method="post">
            <table class="table_topics">
                <tr>
                    <th>Category ID</th>
                    <th>Name</th>
                </tr>
                <?php while (false !== $row = $allCategoriesQuery->fetch(PDO::FETCH_ASSOC)) :?>
                <h1 class="section_title">Editer la catégorie : <?=$row['name']?></h1>
                <tr>
                    <td>
                        <?=$row["category_id"]?>
                    </td>
                    <td>                
                        <textarea name="name" id="name" class="contentEdit"><?=$row["name"]?></textarea>
                    </td>
                </tr>
                <?php $categoryID = $row["category_id"]; ?>
                <?php endwhile;?>
            </table>
            <div class="flexbtnsend">
                <button class="btnSend" type="submit" name="submit">Sauvegarder</button>
                <a href="./">Retour</a>
            </div>
        </form>

        <?php
        if(isset($_POST['submit'])){
            $query_save = "UPDATE
            `categories`
            SET
            `name` = :name
            WHERE
            `category_id` = :id
            ;";
            $stmt = $conn->prepare($query_save);
            $stmt->bindValue(':id', $_GET['edit']);
            $stmt->bindValue(':name', $_POST['name']);
            $stmt->execute();
            header('Location: ./');
        }
        ?>
        
        <?php
        $query_topics = "SELECT
          `topics`.`topic_id`,
          `topics`.`subject`,
          `topics`.`category_id`,
          `topics`.`date`
          FROM 
          `topics`
          WHERE
          `category_id` = :id
          ORDER BY
          `topics`.`date`
          DESC
          ";
        $allTopicsQuery = $conn->prepare($query_topics);
        $allTopicsQuery->bindValue(':id', $_GET['edit']);
        $allTopicsQuery->execute();
        ?>

        <h1 class="section_title">Topics de la catégorie</h1>

        <table class="table_topics">
            <tr>
                <th>Topic ID</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Category ID</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php while (false !== $row = $allTopicsQuery->fetch(PDO::FETCH_ASSOC)) :?>
            <tr>
                <td>
                    <?=$row["topic_id"]?>
                </td>
                <td>
                    <a href="../topic.php?topic=<?=$row['topic_id']?>">
                        <?=$row["subject"]?>
                    </a>
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
                <td><a href="editTopic.php?edit=<?=$row['topic_id']?>" class="btn" title="Edit">✏️</a></td>
                <td><a href="deleteTopic.php?delete=<?=$row['topic_id']?>" class="btn" title="Delete">❌</a></td>
            </tr>
            <?php endwhile;?>
        </table>
    </div>
