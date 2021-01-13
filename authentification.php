
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Signin Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
<meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <?php
  require_once"inc/connexion.php";
  if(!empty($_GET['action']) && ($_GET['action'])=='deconnexion'){
      unset($_SESSION['pseudo']);
      header('location:authentification.php');
  }
  if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])){
    $pseudo=($_POST['pseudo']);
    $mdp=sha1($_POST['mdp']);
    $error=1;
    $query=$pdo->prepare('SELECT * FROM administrateur WHERE pseudo=?');
    var_dump($query);
    $query->execute(array($pseudo));
    $admin=$query->fetch();
    if($mdp==$admin['mdp'] && $pseudo==$admin['pseudo']){
        $error=0;
    $_SESSION['pseudo'] = $pseudo;
    header('location:admin/admin.php');
    }
    if($error==1){
        header('location:authentification.php?error=1');
    }
  }
  ?>
  <body class="text-center container">
    <form class="form-signin" method="post" action="">

  <h1 class="h3 mb-3 font-weight-normal">Identifiez-vous</h1>
  <?php
  if(isset ($_GET['error']) == 1){
    echo'<div class="alert alert-danger" role="alert">
    Nous n\'avons pas pu vous identifier !
    </div>';
  }
  ?>
  <label for="inputEmail" class="sr-only">Pseudo</label>
  <input type="text" id="inputEmail" class="form-control" placeholder="Pseudo" name="pseudo" required autofocus>
  <label for="inputPassword" class="sr-only">Mot de Passe</label>
  <input type="password" id="inputPassword" class="form-control" placeholder="Mot de Passe" name="mdp" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> se souvenir
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
  
</form>
</body>
</html>
