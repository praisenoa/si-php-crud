<?php $title = 'Administration : Supprimer'; ?>
<?php include('verification-login.php') ?>
<?php include('layouts/header.php');?>



<div class="admin containerlevrai">
    <form action="" method="post">
        <table class="table_topics">
            <tr>
                <th>Name</th>
            </tr>

            <h1 class="section_title">Créer une catégorie :</h1>
            <tr>
                <td>
                    <input class="nameCategory" type="text" name="name" placeholder="Entrez le nom de la nouvelle catégorie (30 caractères max.)">
                </td>
            </tr>

        </table>
        <div class="flexbtnsend">
            <button class="btnSend" type="submit" name="submit">Créer</button>
            <a href="./">Retour</a>
        </div>
    </form>
</div>

<?php
if(isset($_POST['submit'])){
    $add = "INSERT INTO 
      `categories` 
      (`categories`.`name`) 
      VALUES 
      (:name);
      ";
    $doadd = $conn->prepare($add);
    $doadd->bindValue(':name', htmlspecialchars($_POST['name']), PDO::PARAM_STR);
    $doadd->execute();
    header('Location: ./');
}
?>

<?php include('layouts/footer.php');?>