<?php
require_once('model.php');
require_once('views.php');

class Controller {
	//legenerálja a galéria oldalt
	function initSite ($folder) {
		$m = new Model();
		//képek beolvasása tömbbe
		$images = $m->readImages($folder);		
		$imageCount = count($images);
		//hány teljes oldal létezik?
		$fullpages = intval($imageCount / 5);
		//az utolsó oldalon hány kép fog megjelenni?
		$lastpage = $imageCount % 5;
		//az utolsó oldallal együtt
		$allpages = $fullpages+1;
		$currentID = $m->currentID();
		$IDs = $m->idCalculator($currentID,$allpages);
		$v = new Views();
		$v->generateNavbar($IDs, $fullpages);
		$v->generateGallery($images,$currentID,$fullpages,$lastpage,$folder);		
	}
	//legenerálja a kép megtekintése oldalt
	function initPhoto ($folder) {		
		$m = new Model();
		$images = $m->readImages($folder);		
		$imageCount = count($images);
		$currentID = $m->currentID();
		$filepath = $images[$currentID];
		$IDs = $m->idCalculator($currentID,$imageCount);
		$v = new Views();
		$v->generatePhotoNavbar($images,$imageCount,$IDs);
		$v->generateImage($folder,$filepath);
	}
	

	


}

?>
