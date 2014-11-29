<?php


class Mail {
	
	static $from = "From: Père Noël <pere.noel@polenord.com>";
	
	private static function sendMail($to,$subject,$message) {
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/plain; charset=iso-8859-1' . "\r\n";
		$headers .= Mail::$from . "\r\n";
		mail($to, $subject, $message, $headers);
	}
	
	public static function lostPassword($to,$name,$password) {
		$subject = 'Mot de passe oublié';
		$message = "Ho ho ho, salut ".$name.",\n\n";
		$message .= "Il parait que tu as perdu ton mot de passe et que tu ne sais plus à qui tu dois faire un cadeau.";
		$message .= "Mais ne t'en fais pas, un peu de poussière de nez de renne et le tour est joué !\n";
		$message .= "Ton nouveau mot de passe est: ".$password."\n";
		$message .= "File changer ton mot de passe avant que Père Fouettard ne vienne le voler\n\n";
		$message .= "Joyeux Noël,\nPère Noël\n\n";
		$message .= "Ps: Il est intuile de répondre à cet e-mail. En effet les lutins ont déjà assez de travail et n'ont pas le temps de répondre à tous les e-mails.";
		
		Mail::sendMail($to,$subject,$message);
	}
}

?>
