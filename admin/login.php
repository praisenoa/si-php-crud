<?php $title = 'Connexion'; ?>
<?php include('layouts/header.php');?>


<div class="containerlevrai">
   <h1 class="section_title">Connexion au panel Admin</h1>
    <form action="" method="post">
        <input class="topic_add_input" type="text" name="username" placeholder="Pseudo">
        <input class="topic_add_input" type="password" name="password" placeholder="Mot de passe">
        <button class="button_connect" type="submit" name="submit">Connexion</button>
    </form>
</div>

<?php
if(isset($_POST['submit'])){
    if(!empty($_POST['username']) && !empty($_POST['password'])) {

        $login_query = "SELECT
            `username`,
            `password`,
            `admin`
            FROM
            `users`
            WHERE
            `username` = :username
            ;";
        $stmt = $conn->prepare($login_query);
        $stmt->bindValue(':username', $_POST['username']);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($_POST['password'] != $row['password']) {
            echo 'Le mot de passe n\'est pas correct, vous ne pouvez pas accéder à l\'administration';
        }
        else {
            session_start();
            $_SESSION['login'] = $_POST['password'];
            header('Location: ./index.php');
        }    
    }
    else {
        echo 'Merci de remplir tous les champs ci-dessus.';
    }
}
?>

<?php include('layouts/footer.php');?>
