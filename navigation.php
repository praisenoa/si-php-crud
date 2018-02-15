<div class="navigation_container">
    <!-- categories -->
    <ul>
        <?php
        $query_categories = "SELECT
          `categories`.`category_id`,
          `categories`.`name`
          FROM 
          `categories`;   
          ";
        $allCategoriesQuery = $conn->prepare($query_categories);
        $allCategoriesQuery->execute();
        while (false !== $row = $allCategoriesQuery->fetch(PDO::FETCH_ASSOC)) {
            $categoryId = $row['category_id'];
            $categoryName = $row['name'];
            ?>
            <!-- category -->
            <li class="navigation_items">
                <a class="navigation_links" href="category.php?category=<?=$categoryId?>">
                    <p class="navigation_links_title"><?=$categoryName?></p>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
</div>