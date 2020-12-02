<?php
	function getUnitedKingdomDate($date){
		$membres = explode('-', $date);
		$date = $membres[2].'/'.$membres[1].'/'.$membres[0];
		return $date;
	}

	function addJours($date, $nbJours){
		$membres = explode('/', $date);
		$date = $membres[2].'-'.$membres[1].'-'.(intval($membres[0])+$nbJours);
		return $date;
	}

	function crypterMDP($mdp){
		return sha1(sha1(encodeEnUTF8($mdp)).encodeEnUTF8(SALT));
	}

	function encodeEnUTF8($text){
		return mb_convert_encoding($text,"UTF-8");
	}

?>
