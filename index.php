<?php
mysql_connect("localhost","root","");
mysql_select_db("nawel");

require_once("gifts/gift.php");
require_once("gifts/security.php");
require_once("gifts/family.php");

?>

<html>
<head>
<meta charset="UTF-8">
<title>Mon cadeau</title>
</head>
<body>


<?php
$display = true;

if(isset($_POST["see"])) {

	$password = Security::hash($_POST['password']);
	$name = addslashes($_POST['name']);

	if(Family::exists($name,$password)) {
		$display = false;
		echo "Tu dois faire un cadeau à ".Gift::getMyGift($password);
	} else {
		echo "Tu t'es trompé dans le mot de passe";
	}
}

if($display) { ?>
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
