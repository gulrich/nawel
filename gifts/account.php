<?php

class Account {

	public static function changePassword($name, $old, $new) {
		if(!Family::exists($name,$old)) {
			return false;
		}
		$to = Gift::getMyGift($old);
		$hash = Gift::getMyHash($old);
		$password = Security::hash($new);
		Family::changePassword($name,$password);
		$newGift = new Gift($name,$to);
		mysql_query("update gifts set hash='".$newGift->getVal()."' where hash='".$hash."'") or die(mysql_error());
		$_SESSION['password'] = Security::encrypt(Security::hash($name),$password);
		return true;
	}
}


?>
