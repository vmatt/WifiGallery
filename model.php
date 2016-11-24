<?php
class Model {
	//A függvény annak alapján vizsgálja és adja vissza a GET-ben lévő értéket, hogy melyik php oldal van megnyitva.
	function currentID() {
		if	(strpos($_SERVER['REQUEST_URI'], "index.php")!==false) {
			if (isset($_GET['page'])&&($_GET['page']>=0))
				return intval($_GET['page']);	
			else {
				$_GET['page']=0;
				return intval($_GET['page']);
			}
		}			
		else if ( strpos($_SERVER['REQUEST_URI'], "photo.php")!==false) {
			if (isset($_GET['photo_id'])&&($_GET['photo_id']>=0))
				return intval($_GET['photo_id']);
			else {
				$_GET['photo_id']=0;
				return intval($_GET['photo_id']);
			}
		}
			
	}
	static function readImages ($dir){
		$dir = './'.$dir;
		$dh  = opendir($dir);
		while (false !== ($fileName = readdir($dh))) {
			$ext = substr($fileName, strrpos($fileName, '.') + 1);
			if(in_array($ext, array("jpg","JPG","jpeg","png","gif")))
				$files[] = $fileName;
			}
		return $files;	
  }
	//a függvény azért felel, hogy az előre és a hátralépés gombokhoz megfelelő GET id-k tartozzanak.
  	function idCalculator ($currentID,$imageCount){	
		/*pl. ha az adott kép az első az albumban, akkor 5-öt visszalépve az utolsó képtől számítva 5öt lépünk vissza, ha egyet, akkor az utolsó képtől számítva egyet. Így soha nem lépünk túl negatív, vagy pozitív irányba tömbön.*/
		if($currentID<1) {
			$back5Id=$imageCount-5;
			$backId=$imageCount-1;
			$currentId=$currentID;
			$nextId=($currentID+1);
			$next5Id=($currentID+5);
		}
		
		else if($currentID>=$imageCount-1) {
			$back5Id=($currentID-5);
			$backId=($currentID-1);
			$currentId=$currentID;
			$nextId=0;
			$next5Id=5;
		}
		else {
			$backId=($currentID-1);
			$currentId=$currentID;
			$nextId=($currentID+1);
			 if ($currentID>$imageCount-6) {
				 $back5Id = $currentID-5;
				 $next5Id = $currentID-($imageCount-5);
			 }
			 else if ($currentID<5) {
				 $back5Id = $imageCount-1-$currentID;
				 $next5Id=($currentID+5);
			 }
			 else {
				 $back5Id=$currentID-5;
				 $next5Id=($currentID+5);
			 }
		}
		
		return array($back5Id, $backId, $currentId, $nextId, $next5Id);

	}
}
?>
