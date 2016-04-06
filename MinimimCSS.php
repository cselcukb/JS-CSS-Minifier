<?php

	require_once(dirname(__FILE__).'/AutoLoader.php');

//	include "Classes/Minify/CSS_Minifier.php";

	class MinimimCSS extends CSS_Minifier{

		public function  __construct($root_path= ""){
			parent::__construct($root_path);
		}

	}

?>
