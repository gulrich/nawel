<?php


class Family {

	public static function getPasswords() {
		$r = mysql_query("select password from family") or die(mysql_error());
		$family = array();
		while($d = mysql_fetch_array($r)) {
			$family[] = $d['password'];
		}
		return $family;
	}

	public static function getNames() {
		$r = mysql_query("select name from family") or die(mysql_error());
		$family = array();
		while($d = mysql_fetch_array($r)) {
			$family[] = $d['name'];
		}
		return $family;
	}

	public static function getPassword($name) {
		$r = mysql_query("select password from family where name='".$name."'") or die(mysql_error());
		if($d = mysql_fetch_array($r)) {
			return $d['password'];
		}
		else return null;
	}

	public static function exists($name, $password) {
		$r = mysql_query("select count(*) as n from family where name='".$name."' and password='".$password."'") or die(mysql_error());
		$d = mysql_fetch_array($r);
		if($d['n'] > 0) {
			return true;
		} else {
			return false;
		}
	}


	public static function add($name) {
		mysql_query("insert into family values('".$name."','".Security::hash($name)."')") or die(mysql_error());
	}

	public static function remove($name) {
		mysql_query("delete from family where name='".$name."'") or die(mysql_error());
	}

	public static function changePassword($name,$password) {
		mysql_query("update family set password='".$password."' where name='".$name."'") or die(mysql_error());
	}

}


?>
