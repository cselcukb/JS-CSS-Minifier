<?php

     	require_once(dirname(__FILE__).'/AutoLoaderJS.php');

//	include "Classes/Minify/CSS_Minifier.php";

        class MinimimJS extends JS_Minifier{

                public function  __construct($root_path = ""){
                        parent::__construct($root_path);
                }

        }

?>
