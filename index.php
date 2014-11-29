<?php
session_start();

mysql_connect("localhost","root","");
mysql_select_db("nawel");

require_once("gifts/gift.php");
require_once("gifts/security.php");
require_once("gifts/family.php");
require_once("gifts/account.php");

if(isset($_POST["see"])) {

	$password = Security::hash($_POST['password']);
	$name = addslashes($_POST['name']);

	if(Family::exists($name,$password)) {
		$_SESSION['name'] = $name;
		$_SESSION['password'] = Security::encrypt(Security::hash($name),$password);
	}
}

if(isset($_POST['logout']) && isset($_SESSION['name']) && isset($_SESSION['password'])) {
	unset($_SESSION['name']);
	unset($_SESSION['password']);
	session_destroy();
}

if(isset($_POST['change_password']) && isset($_SESSION['name']) && isset($_SESSION['password'])) {
	if(!($_POST['new'] === $_POST['new2'])) {
		$erreur_pwd = "Les mots de passe ne correspondent pas !";
	} else if(!Account::changePassword($_SESSION['name'],Security::decrypt(Security::hash($_SESSION['name']),$_SESSION['password']),$_POST['new'])) {
		$erreur_pwd = "Le mot de passe est erroné !";
	} else {
		$success_pwd = "Mot de passe modifié avec succès !";
	}
}

?>

<html>
<head>
<meta charset="UTF-8">
<title>Mon cadeau</title>
</head>
<body>


<?php

if(isset($_SESSION['name']) && isset($_SESSION['password'])) {
	echo "Tu dois faire un cadeau à ".Gift::getMyGift(Security::decrypt(Security::hash($_SESSION['name']),$_SESSION['password']))."<br><br>";
	if(isset($erreur_pwd)) {
		echo '<span style="color:red">'.$erreur_pwd.'</span><br>';
	} else if(isset($success_pwd)) {
		echo '<span style="color:green">'.$success_pwd.'</span><br>';
	}
	?>
		<form action="#" method="post">
		<input type="password" placeholder="Ancien mot de passe" name="old" /><br>
		<input type="password" placeholder="Nouveau mot de passe" name="new" /><br>
		<input type="password" placeholder="Retapez mot de passe" name="new2" /><br>
		<input type="submit" value="Changer" name="change_password" />
		</form>
	
	<form action="#" method="post">
		<input type="submit" value="Logout" name="logout" />
		</form>
	<?php
} else {
	if(isset($_POST['see'])) {
		echo '<span style="color:red">Le nom et le mot de passe ne correspondent pas !</span><br>';
	}
	?>
		<form action="#" method="post">
		<input type="text" placeholder="Nom" name="name" />
		<input type="password" placeholder="Mot de passe" name="password" />
		<input type="submit" value="Voir" name="see" />
		</form>
	<?php
}
?>

</body>
</html>
