<?php
mysql_connect("localhost","root","root");
mysql_select_db("nawel");

require_once("../gifts/gift.php");

$generated = false;
if(isset($_POST["generate"])) {
	Gift::generateGifts();
	$generated = true;
}


mysql_close();

?>

<html>
<head>
<meta charset="UTF-8">
<title>Cadeeaux</title>
</head>
<body>
<?php if(!$generated) { ?>
<form action="#" method="post">
<input type="submit" value="Générer" name="generate" />
<?php } else {
echo "Cadeaux générés avec succès ! À l'année prochaine :D";
} ?>
</form>
</body>
