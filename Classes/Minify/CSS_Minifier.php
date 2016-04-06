<?php

	include "base_classes/CSS.php";
	
	class CSS_Minifier extends CSS
	{
		private $_basepath;
                private	$_source_folder_name;

		public function __construct($basepath= "", $source_folder_name="raw"){

			if(!$basepath || $basepath == ""){
				$this->_basepath= $_SERVER['DOCUMENT_ROOT'].'/css';
			}else{
				$this->_basepath= $_SERVER['DOCUMENT_ROOT'].'/'.$basepath;
			}

                        $this->_source_folder_name= $source_folder_name;

		}

		public function minimizeNWriteCSSFolderFilesRecursively(){
			$base_source_dir= $this->_basepath.'/'.$this->_source_folder_name;

			$files= $this->getFolderFilesNMinimizeCSSFiles($base_source_dir);
			
		}

		public function getFolderFilesNMinimizeCSSFiles($dirname){
                        
			$dh= opendir($dirname);
			
			while (false !== ($filename = readdir($dh))) {
			    $files[] = $filename;
			}


			foreach($files AS $filename){
				if(!is_dir($dirname.'/'.$filename)){
//					if((strrpos($filename, '.css') == 4 )){
					if((strrpos($filename, '.css') !== false ) && (strpos($filename, '.min.css') == false )){
						$this->reset();
						$css_data= file_get_contents($dirname.'/'.$filename);
						
						$this->add($css_data);
						$minified_css_data= $this->minify();

						$minimized_file_name= str_replace('/'.$this->_source_folder_name, "", $dirname.'/'.$filename);
						
						$handle= fopen($minimized_file_name, "w+");
						
						fclose($handle);

						$result= file_put_contents($minimized_file_name, $minified_css_data);
						
					}					
				}else{
				
					if($filename != ".." && $filename != "."){
						
						$this->getFolderFilesNMinimizeCSSFiles($dirname.'/'.$filename);
					}
				}
			}

		}

	}
	
?>
