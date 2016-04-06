<?php

	include "base_classes/JS.php";
	
	class JS_Minifier extends JS
	{
		private $_basepath;
                private	$_source_folder_name;

		public function __construct($basepath= "", $source_folder_name="raw"){

			if($basepath == ""){
				$this->_basepath= $_SERVER['DOCUMENT_ROOT'].'/js';
			}else{
                              	$this->_basepath= $_SERVER['DOCUMENT_ROOT'].'/'.$basepath;
                        }

                        $this->_source_folder_name= $source_folder_name;

		}

		public function minimizeNWriteJSFolderFilesRecursively(){
			$base_source_dir= $this->_basepath.'/'.$this->_source_folder_name;

			$files= $this->getFolderFilesNMinimizeJSFiles($base_source_dir);
			
		}

		public function getFolderFilesNMinimizeJSFiles($dirname){
                        
			$dh= opendir($dirname);
			
			while (false !== ($filename = readdir($dh))) {
			    $files[] = $filename;
			}

			foreach($files AS $filename){
				if(!is_dir($dirname.'/'.$filename)){
//					if((strrpos($filename, '.js') == 3 )){
					if((strrpos($filename, '.js') !== false ) && (strpos($filename, '.min.js') == false )){
						$this->reset();
						$js_data= file_get_contents($dirname.'/'.$filename);
						
						$this->add($js_data);
						$minified_js_data= $this->minify();

						$minimized_file_name= str_replace('/'.$this->_source_folder_name, "", $dirname.'/'.$filename);
						
					
						$handle= fopen($minimized_file_name, "w+");
						
						fclose($handle);

						file_put_contents($minimized_file_name, $minified_js_data);
						
					}					
				}else{
				
					if($filename != ".." && $filename != "."){
						
						$this->getFolderFilesNMinimizeJSFiles($dirname.'/'.$filename);
					}
				}
			}

		}

	}
	
?>
