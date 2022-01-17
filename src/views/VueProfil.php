<?php
	
	namespace mywishlist\views;
	
	class VueProfil
	{
		
		function render() :string{
			$id = $_SESSION["userid"];
			$u = \mywishlist\models\User::where('user_id', "=", $id)->get();
			$elements = new Elements();
			$render = $elements->renderHeaders().$elements->renderHeader();
			//TODO
			return $render;
		}
	}