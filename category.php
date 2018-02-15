<?php
include('layouts/header.php');

$query = "SELECT 
    `categories`.`category_id`,
    `categories`.`name`
    FROM
    `categories`
    WHERE
    `category_id` = :id
    ;
    ";

$stmt = $conn->prepare($query);
$stmt->bindValue(':id', $_GET['category']);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);


$category_id = $row['category_id'];
$category_name = $row['name'];


?>
    <section class="container">
<?php include('navigation.php'); ?>
    <section class="discussions_container">
        <h3 class="section_title"><?= $category_name ?></h3>
        <hr class="main_line">
        <?php
        $query_topics = "SELECT
          `topics`.`topic_id`,
          `topics`.`category_id`,
          `topics`.`subject`,
          `topics`.`date`
          FROM 
          `topics`;   
          ";
        $allTopicsQuery = $conn->prepare($query_topics);
        $allTopicsQuery->execute();

        while (false !== $row = $allTopicsQuery->fetch(PDO::FETCH_ASSOC)) {
            $topicId = $row['topic_id'];
            $topicSubject = $row['subject'];
            $topicCategoryId = $row['category_id'];
            $topicDate = $row['date'];

            if ($category_id === $topicCategoryId) {
                ?>
                <a href="topic.php?topic=<?= $topicId ?>" class="links">
                    <div class="item_box">
                        <h3 class="item_text"><?= $topicSubject ?></h3>
                        <?php
                        $timestamp = strtotime($row["date"]);
                        $mois_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
                        list($nom_jour, $jour, $mois, $annee, $heure, $minute, $seconde) = explode('/', date("w/d/n/Y/H/i/s", $timestamp)); ?>
                        <p class="additional_info_title">Date de création :</p>
                        <p class="additional_info_detail"><?= $jour . ' ' . $mois_fr[$mois] . ' ' . $annee . ' ' ?>
                            à<?= ' ' . $heure . ':' . $minute?></p>
                        <hr class="secondary_line">
                    </div>
                </a>
                <?php
            }

        }

        ?>
        <div class="btn_container">
            <a href="topic-add.php?category=<?=$category_id?>" class="button_action">Créer une discussion</a>
        </div>
    </section>
    </section>

<?php include('layouts/footer.php') ?>