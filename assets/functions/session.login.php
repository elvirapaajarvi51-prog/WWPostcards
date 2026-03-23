<?php
//Checks if submit button has been set
if (isset($_POST['login'])) {

    //Checks if email and password fields are empty
    if (empty($_POST['email']) || empty($_POST['password'])) {
        //redirect user to error page
        header('Location: index.php?action=empty');
        exit();
    }

    // Trims e-mail and password
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //Creates, prepares, and binds and sql query

    $sql = '
    SELECT*
    FROM users
    WHERE email = :email
    AND password = :password
    ';

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();

    //Counts rows returned from database
    $count = $stmt->rowCount();

    if ($count > 0) {
        //Save result to variable
        $row = $stmt->fetch();
        // Creates session variable with user id
        $_SESSION['user_id'] = $row['user_id'];
        // Redirects user to success page
        header('Location: index.php?action=success');
        exit();
    } else {
        // Redirect user to error page
        header('Location: index.php?action=error');
        exit();
    }
}
?>
