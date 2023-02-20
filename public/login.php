<?php
require '../vendor/autoload.php';

use App\App;
use App\Auth;
use App\User;

session_start();
$pdo = new PDO("sqlite:../data.sqlite", null, null, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);


$auth = new Auth($pdo);

$error = false;

if ($auth->user() !== null) {
    header('location: index.php');
}
$user = new Auth($pdo);
$user = $user->login($_POST['username'], $_POST['password']);
dump($user);
if ($user !== null) {
    header('Location: /index.php');
}
if ($user->id === 1) {
    header("Location: /admin.php?login=1");
    exit();
}

$error = true;
?>







<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Authentification</title>
</head>
<h1 align="center"> Page de connexion</h1>
<?php if ($error) : ?>
<div class="alert alert-danger"></div>
Indentifiant ou mot de passe icorrect.
<?php endif  ?>

<form action="" method="post">
	<div class="form-group">
		<input type="text" class="form-control" name="username" placeholder="Pseudo">
	</div>
	<div class="form-group">
		<input type="password" class="form-control" name="password" placeholder="Mot de passe">
	</div>
	<button class="btn btn-primary">Se connecter</button>
</form>
<?php
dump($_POST);
?>