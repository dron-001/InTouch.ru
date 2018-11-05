<?

if($_POST['reviews_f']){
    header("Location: /auth/profile.php");
    exit();
    go('stena?id="$_SESSION[id]"');
}

?>