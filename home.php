<section class="discussions_container">
    <h2 class="section_title">
        Les discussions les plus récentes :
    </h2>
    <hr class="main_line">
    <?php
    $query_topics = "SELECT
          `topics`.`topic_id`,
          `topics`.`subject`,
          `topics`.`category_id`,
          `topics`.`date`
          FROM 
          `topics`
          ORDER BY
          `topics`.`date`
          DESC
          LIMIT
          5;
          ";
    $allTopicsQuery = $conn->prepare($query_topics);
    $allTopicsQuery->execute();
    ?>

        <?php while (false !== $row = $allTopicsQuery->fetch(PDO::FETCH_ASSOC)) :?>
    <div class="item_box">
        <a href="topic.php?topic=<?= $row['topic_id'] ?>" class="links">
            <h3 class="item_text"><?= $row["subject"] ?></h3>
        </a>
        <?php
        $timestamp = strtotime($row["date"]);
        $mois_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
        list($nom_jour, $jour, $mois, $annee, $heure, $minute, $seconde) = explode('/', date("w/d/n/Y/H/i/s", $timestamp)); ?>
        <p class="additional_info_title">Date de création :</p>
        <p class="additional_info_detail"><?= $jour . ' ' . $mois_fr[$mois] . ' ' . $annee . ' ' ?>
            à<?= ' ' . $heure . ':' . $minute?></p>
        <hr class="secondary_line">
    </div>
        <?php endwhile;?>
</section>