<?php

class Account {

	static $pwdlen = 8;

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
	
	private static function randomPassword() {
		$alphabet = explode(",","a,b,c,d,e,f,g,h,u,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,1,2,3,4,5,6,7,8,9,0");
		$pwd = "";
		for ($x = 0; $x < Account::$pwdlen; $x++) {
			$pwd .= $alphabet[array_rand($alphabet)];
		}
		return $pwd;		
	}
	
	public static function resetPassword($name) {
		$pwd = Account::randomPassword();
		Account::changePassword($name,Family::getPassword($name),$pwd);
		Mail::lostPassword(Family::getEmail($name),$name,$pwd);
	}
}


?>
