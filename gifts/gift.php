<?php

require_once("graph.php");
require_once("family.php");
require_once("security.php");


class Gift {
		
	private $val;

	public function __construct($from, $to) {
		$this->val = Security::encrypt(Family::getPassword($from),$to);
	}

	public function getVal() {
		return $this->val;
	}

	public static function gifts($family) {
		$g = new Graph($family);
		$nodes = $g->getNodes();
		$gifts = array();
		
		foreach ($nodes as $k => $v) {
			if($k == count($nodes)-1) {
				$k2 = 0;
			} else {
				$k2 = $k+1;
			}
		    $gifts[] = new Gift($nodes[$k],$nodes[$k2]);
		}
		shuffle($gifts);
		return $gifts;
	}


	public static function generateGifts() {
		$gf = Gift::gifts(Family::getNames());
		mysql_query("delete from gifts") or die(mysql_error());
		foreach ($gf as $k => $v) {
			mysql_query("insert into gifts values('".$v->getVal()."')") or die(mysql_error());
		}
	}

	public static function getMyGift($hash) {		
		$family = Family::getNames();
		$r = mysql_query("select hash from gifts") or die(mysql_error());
		while($d = mysql_fetch_array($r)) {
			$plaintext = trim(Security::decrypt($hash,$d['hash']));

			if(in_array($plaintext,$family)) {
				return $plaintext;
			}
		}

		return "error";
	}

}

?>
