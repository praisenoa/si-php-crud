<?php $title = 'Gestion des topics'; ?>
<?php include('verification-login.php') ?>
<?php include('layouts/header.php');?>

<?php
$query_categories = "SELECT
          `categories`.`category_id`,
          `categories`.`name`
          FROM 
          `categories`
          ORDER BY
          `categories`.`category_id`
          ";
$allCategoriesQuery = $conn->prepare($query_categories);
$allCategoriesQuery->execute();
?>
<div class="admin containerlevrai">

    <h1 class="section_title">Gestion des Catégories</h1>

    <table class="table_topics">
        <tr>
            <th>Category_id</th>
            <th>Name</th>
            <th style="text-align:center;">Edit</th>
            <th>Delete</th>
        </tr>
        <?php while (false !== $row = $allCategoriesQuery->fetch(PDO::FETCH_ASSOC)) :?>
        <tr>
            <td>
                <?=$row["category_id"]?>
            </td>
            <td>
                <a href="../category.php?category=<?=$row['category_id']?>">
                    <?=$row["name"]?>
                </a>
            </td>
            <td style="text-align:center;"><a href="editCategory.php?edit=<?=$row['category_id']?>" class="btn" title="Edit">✏️</a></td>
            <td><a href="deleteCategory.php?delete=<?=$row['category_id']?>" class="btn" title="Delete">❌</a></td>
        </tr>
        <?php endwhile;?>
    </table>
    <div style="margin-top: 40px">
    <a class="button_add_admin" href="addCategory.php">Créer une catégorie</a>
    </div>
</div>

<?php include('layouts/footer.php');?>
