<?php
class Views {
	//megjeleníti és linkeli a képeket, melyek a photo.php oldalra mutatnak
	function generateGallery($images,$currentID,$fullpages,$lastpage,$folder) {
		$v = new Views();
		echo "<div id='gallery'>";
	
		if ($currentID<$fullpages){
			for ($i=(5*$currentID); $i<((5*$currentID)+5);$i++) {
				echo "<a href='".$v->generateUrl($i)."'><img alt='".$images[$i]."' src='".$folder."/".$images[$i]."'></a>
			";
			}
		}
		//ha az utolsó oldalon vagyunk, akkor csak a maradék elemeket generálja le
		else
			{
			for ($i=(5*$currentID); $i<((5*$currentID)+$lastpage);$i++) {
			echo "<a href='".$v->generateUrl($i)."'><img alt='".$images[$i]."' src='".$folder."/".$images[$i]."'></a>
			";
			}
		}
		echo "</div>";
	}
	//galéria navigációs sáv generálása
	function generateNavbar ($IDs, $allpages) {
		echo "<div class='navbar'>
				<a href='index.php?page=0'>Ugrás elsőhoz</a>
				<a href='index.php?page=".$IDs[1]."'>Előző</a>
				<a href='index.php?page=".$IDs[3]."'>Következő</a>				
				<a href='index.php?page=".($allpages)."'>Ugrás utolsóhoz</a></div><br>";
	}
	// photo.php navigációs sáv generálása
	function generatePhotoNavbar ($images, $imageCount, $IDs) {
		$v = new Views();
		echo "	<div class='navbar'>			
				<a href='". $v->generateUrl(0) ."'>Ugrás elsőhoz</a>
				<a href='". $v->generateUrl($IDs[0])."'>Ugrás 5-tel hátra</a>
				<a href='". $v->generateUrl($IDs[1])."'>Előző</a>
				<span>Képek száma: ".$v->generateDropDown($images,$IDs)." / ".$imageCount."</span>
				<a href='".$v->generateUrl($IDs[3])."'>Következő</a>				
				<a href='".$v->generateUrl($IDs[4])."'>Ugrás 5-tel előbbre</a>
				<a href='". $v->generateUrl($imageCount-1) ."'>Ugrás utolsóhoz</a></div><br>
				<a href='".$v->generateUrl(rand(0,($imageCount-1)))."'>Random bünti</a><br><br>
				<a href='index.php?page=0'>Vissza a Galériába</a><br>";
	  }
	// photo.php fénykép megjelenítése
	function generateImage ($folder,$filePath){
		echo "<img class='image' src='".$folder."/".$filePath."' align='middle'>";		
	}
	// photo.php lenyíló lista megjelenítése
	function generateDropDown ($images,$IDs) {

		$string = "<form action=''><input type='submit' value='Ugrás'><select name='photo_id'>";
		$i=0;
		foreach ($images as &$value) {
			if ($i==$IDs[2])
				$string .= "<option name='photo_id' value='".($i)."'selected>".($i+1)."</option>";
			else
				$string .= "<option  name='photo_id' value='".($i)."'>".($i+1)."</option>";
			$i++;
		}				
		$string .= "</select></form>";
		return $string;
	}
	
	function generateUrl ($url) {
		return "photo.php?photo_id=".$url;
	}

}
?>
