<?php $title = 'Deconnexion'; ?>
<?php include('layouts/header.php');?>


<?php 
    session_start();
    session_destroy();
?>

<?php include('verification-login.php') ?>


<?php include('layouts/footer.php');?>
