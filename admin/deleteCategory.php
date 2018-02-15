<?php $title = 'Administration : Supprimer'; ?>
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
$allCategoriesQuery->bindValue(':id', $_GET['delete']);
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
            <h1 class="section_title">Supprimer la catégorie : <?=$row['name']?></h1>
            <tr>
                <td>
                    <?=$row["category_id"]?>
                </td>
                <td>                
                    <?=$row["name"]?>
                </td>
            </tr>
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
            `categories`
            WHERE
            `category_id` = :id
            ;";
    $stmt = $conn->prepare($query_save);
    $stmt->bindValue(':id', $_GET['delete']);
    $stmt->execute();
    header('Location: ./');
}
?>

<?php include('layouts/footer.php');?>