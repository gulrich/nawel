<?php


class Security {
	
	static $algo = MCRYPT_RIJNDAEL_256;
	static $mode = MCRYPT_MODE_CBC;
	static $hash = "sha256";

	public static function encrypt($hash,$text) {
		$key = pack('H*', $hash);
		$iv_size = mcrypt_get_iv_size(Security::$algo, Security::$mode);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$ciphertext = $iv . mcrypt_encrypt(Security::$algo, $key,$text, Security::$mode,$iv);
		return base64_encode($ciphertext);
	}

	public static function decrypt($hash, $text) {
		$key = pack('H*', $hash);
		$ciphertext = base64_decode($text);
		$iv_size = mcrypt_get_iv_size(Security::$algo, Security::$mode);
		$iv_dec = substr($ciphertext, 0, $iv_size);
		$ciphertext_dec = substr($ciphertext, $iv_size);
		$plaintext_dec = mcrypt_decrypt(Security::$algo, $key,$ciphertext_dec, Security::$mode, $iv_dec);
		return $plaintext_dec;
	}

	public static function hash($text) {
		return hash(Security::$hash,$text);
	}
}


?>
