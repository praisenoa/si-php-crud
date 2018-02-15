<?php $title = 'Accueil Forum'; ?>
<?php include('layouts/header.php');?>


<?php
$topics = "SELECT 
  `topics`.`topic_id`, 
  `topics`.`category_id`, 
  `topics`.`subject`, 
  `topics`.`date` 
  FROM 
  `topics` 
  ";
$stmt = $conn->prepare($topics);
$stmt->execute();
?>

<section class="container">
    <?php include('navigation.php')?>
    <?php include('home.php') ?>
</section>

<?php include('layouts/footer.php');?>
