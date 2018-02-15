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

        <h3 class="title_category"><?= $category_name ?></h3>
        <hr class="hr">
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
                <a href="topic.php?topic=<?= $topicId ?>" class="discussion_a">
                    <div class="discussion_box">
                        <h3 class="title_discussion"><?= $topicSubject ?></h3>
                        <hr class="hr_replies">
                    </div>
                </a>
                <?php
            }

        }

        ?>
        <a href="topic-add.php?category=<?=$category_id?>" class="btnAddTopic">Ajouter un topic</a>
    </section>

<?php include('layouts/footer.php')?>