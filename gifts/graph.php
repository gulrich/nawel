<?php

class Graph {

	private $nodes;
	
		
	public function __construct($nodes) {
        
		$src = array();
		foreach ($nodes as $k => $v) {
		    $src[$k] = $v;
		}
		$res = array();
		
		$res[] = $src[0];
		unset($src[0]);
		$src = array_values($src);
		
		while(!empty($src)) {
			$i = mt_rand(0,count($src)-1);
			$res[] = $src[$i];
			unset($src[$i]);
			$src = array_values($src);
		}
		
		$this->nodes = $res;
    }
	
	public function getNodes() {
		return $this->nodes;
	}

	public function __toString() {
		return implode(" -> ",$this->nodes);
	}
	
}

?>
