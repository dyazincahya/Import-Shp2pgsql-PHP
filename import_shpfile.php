<?php
	function remove_dir($dir) {
	  	if (is_dir($dir)) {
		    $objects = scandir($dir);
		    foreach ($objects as $object) {
		      	if ($object != "." && $object != "..") {
		        	if (filetype($dir."/".$object) == "dir") 
		           		remove_dir($dir."/".$object); 
		        	else unlink($dir."/".$object);
		      	}
		    }
		    reset($objects);
		    rmdir($dir);
		}
	}
	
	if($_POST['import']){
		$root_dir = dirname(__FILE__);
        $extension = explode(".", str_replace(' ', '_',$_FILES["shpfile"]["name"]));
		if(strtolower($extension[1]) == 'zip' || strtolower($extension[1]) == 'rar'){
			$temp = $_FILES['shpfile']['tmp_name'];	
			$name_file = str_replace(".".$extension[1],"",$_FILES['shpfile']['name']);
			$new_folder = mkdir("temp/".$name_file);
			$dir = "temp/".$name_file;
			if(move_uploaded_file($temp, $dir."/".$name_file.".".$extension[1])) {
				$zip = new ZipArchive;
				if ($zip->open($dir."/".$name_file.".".$extension[1]) === TRUE) {
					$zip->extractTo($dir);
					$zip->close();
					unlink($dir."/".$name_file.".".$extension[1]);
					
					foreach(glob($dir."/".$name_file."/*.shp") as $filename) {
						$filename_new = '"'.str_replace(array("/","\\"), DIRECTORY_SEPARATOR ,$root_dir."/".$filename).'"';
						$output_shp = exec('"C:\Program Files (x86)\PostgreSQL\9.3\bin\shp2pgsql" -s 4236 '.$filename_new.' test90 | "C:\Program Files (x86)\PostgreSQL\9.3\bin\psql" -U postgres -d coba_shp');
						remove_dir($dir);
					}
					echo "<script>alert('SHP berhasil di import. <br>STATUS : $output_shp');</script>";
				} else {
					echo "<script>alert('SHP gagal di import ! <br>STATUS : $output_shp');</script>";
				}
			}
		} else {
			echo "<script>alert('type file tidak di izinkan ! (".$extension[1].")');</script>";
		}
	}
?>