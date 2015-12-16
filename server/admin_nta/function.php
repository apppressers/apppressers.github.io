<?php
include 'db.php';

function stopka(){
	
$start = 2012;
$teraz = date(Y);
?>
Copyrights &copy; <?php if($start == $teraz){ echo $teraz; } else { echo $start.'-'.$teraz; } ?> <a href="http://www.invedion.com" title="INVEDION &trade;">INVEDION</a> &trade; company. All rights reserved.
<?php
}

function logowanie(){
?>    
    <form action="index.php" method="post">
    <div class="login_bg">    
    <input name="login" type="text" style="position:absolute; top:234px; left:98px; width:237px; height:23px; border:none; background:transparent; color:#2d2029; font-weight:bold;" />
    <input name="haslo" type="password" style="position:absolute; top:295px; left:98px; width:237px; height:23px; border:none; background:transparent; color:#2d2029; font-weight:bold;" />
    </div>
    <div class="login_btn_bg"><input id="login_btn" type=submit value="" ></div>
    </form> 
<?php
}


function logout(){
		
	unset($_SESSION['authorization_nta_admin']);
	$wynik_niszcz = session_destroy();
}


function change_password(){

	$old_pass = $_POST['old_pass'];
	$new_pass = $_POST['new_pass'];
	$new2_pass = $_POST['new2_pass'];
	$zmienna_wyslij = $_POST['zmienna_wyslij'];
	$sesja = $_SESSION['authorization_nta_admin'];
	
if ($old_pass && $new_pass && $new2_pass &&  $zmienna_wyslij){

		$lacz = lacz_bd();
 		$wynik_sprawdzenie = $lacz->query("SELECT * from nta_admin WHERE name ='$sesja' AND pass = sha1('$old_pass')");
		
		if ($wynik_sprawdzenie->num_rows>0){
				
	if($new_pass == $new2_pass){
	
		$lacz = lacz_bd();	
	  	$wynik = $lacz->query("UPDATE nta_admin SET pass = sha1('$new_pass') WHERE name ='$sesja'");	
			
			?><br /><div class="ok_bg"><div class="ok">Password has been changed</div></div><?	
	}
	else{ ?><br /><div class="no_bg"><div class="no">Incorrect new password</div></div><?	
	}	
  }
 else{ ?><br /><div class="no_bg"><div class="no">Incorrect old password</div></div><?php
 }
}
if ((!$old_pass || !$new_pass || !$new2_pass) &&  $zmienna_wyslij){
	
	?><br /><div class="no_bg"><div class="no">Fill in all fields</div></div><?php
}
?>
<div class="top_txt">Changing the password:</div>
<form action="index.php?id=1" method="post">
<input type="hidden" name="zmienna_wyslij" value="1" /> 
<div class="linia" /></div><div class="linia" /></div>
<div class="top_box" style="margin-top:10px;"><div class="top_box_txt" style="left:10px;">Password:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:120px;" /></div>
<div class="center_box" style="height:126px;">
<img src="images/pass_ico.png" width="80" height="126" style="float:left; margin-left:20px;" />
<table style="padding:30px 50px 0 0;">
  <tr>
    <td align="left"><div class="tytul_web">Old password:</div></td>
    <td><input name="old_pass" type="password" size="25" class="ramka_input" /></td>
  </tr>
  <tr>
    <td align="left"><div class="tytul_web">New password:</div></td>
    <td><input name="new_pass" type="password" size="25" class="ramka_input" /></td>
  </tr>
  <tr>
    <td align="left"><div class="tytul_web">Confirm password:</div></td>
    <td><input name="new2_pass" type="password" size="25" class="ramka_input" /></td>
  </tr>
</table>
</div>
<div class="bottom_box"><br /><input id="zapisz" type=submit value=""></div>
<div class="linia" /></div>
</form>
<?php
}


function statistic(){
?>	
<div class="top_txt">Information</div>
<div class="linia" /></div>
<div class="top_box"><div class="top_box_txt" style="left:10px;">Today:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" /><div style=" font-family:xclusive-regular; font-size:16px; color:#d0d0d0; padding-top:7px;"><?php echo date("d.m.Y"); ?></div></div>
<div class="center_box" style="background-color:#eee8e4;">

<img src="images/statistic_ico.png" width="64" height="53" style="float:left; padding:20px;" />
<div style="padding:20px 100px 20px 0;">
	 <div style="font-family:xclusive-regular; font-size:16px; margin:20px 0 20px 0;">Welcome to the administration panel.</div>
</div>
</div>
<div class="linia" /></div>
<div class="linia" /></div>
<?php
} 

function images($id){
	
	$fpa = $_GET['fpa'];
	
	if($fpa){
		
		if (file_exists('../images/'.$fpa)){
 		unlink('../images/'.$fpa);
 		} 
	}
?>
<div style="margin:30px 0 30px 0;">
	<div class="top_txt">Your Images</div>
	<div class="linia2" /></div>
	<div class="linia2" /></div>
    
    <div style="width:1000px; margin-top:10px;">      
    <?php
	class ImageFilter extends FilterIterator {
    public function accept() { return preg_match('@\.(gif|jpe?g|png)$@i',$this->current()); }
	}
		
		$domain = $_SERVER['HTTP_HOST'];
		$ywa = 'http://' . $domain; 
		
		foreach (new ImageFilter(new DirectoryIterator('../images/')) as $img) { 
			$name = explode(".", $img);
			$exe = array_pop($name);
		?>
     <div style="float:left; margin:6px;">   
     <div class="foto_fpa_bg">
     <a rel="example_group" href="../images/<?php echo $img; ?>" class="foto"><img src="../images/<?php echo $name[0]; ?>.<?php echo $exe; ?>" width="178" height="112" /></a>
     <a href="index.php?id=9&fpa=<?php echo $img; ?>" class="press_del"><img src="images/delete.png" width="26" height="26"></a>
     </div>
	 <div class="fpa_link"><?php echo $plugin_url.'/server/images';?>/<?php echo $name[0]; ?>.<?php echo $exe; ?></div>
     </div>
	<?php } ?>
	</div><div style="clear:both;"></div><br /><br />
    
</div>        
<?	
}

function tails($id){

$idc = $_GET['idc'];
$del = $_GET['del'];
$add = $_GET['add'];
$ido = $_GET['ido'];
$dnta = $_GET['dnta'];
$dfnta = $_GET['dfnta'];
$addf = $_GET['addf'];
$addw = $_GET['addw'];
$online = $_GET['online'];

if($dnta && $dfnta){
	
	$lacz = lacz_bd();
	$wynik = $lacz->query("DELETE FROM nta_grid_photo WHERE id = '$dnta'");
	if($wynik){
		
		if (file_exists('../images/tails/'.$dfnta)){
 		unlink('../images/tails/'.$dfnta);
 		} 
	}
} 

if($addf && $addw){
?>
    
    
    <div class="top_txt">Tile: Add photo <br /><span style="font-size:14px;">(your photo will be rescaled to <?php echo $addw; ?>px x 432px)</span></div>
		<input id="addf" name="addf" type="file" /><br />
        <div class="linia2" /></div>
		<div class="linia2" /></div>
        <div id="load_foto" style="width:800px; margin-top:10px;">
        <img src="images/tails.jpg" width="800" height="370">       
        </div><div style="clear:both;"></div><br /><br />
        <a href="index.php?id=<?php echo $id; ?>"><img src="images/back.png" width="109" height="42"></a><br /><br />
 
<?php
}

if($online && $ido){
	
	$lacz = lacz_bd();	
	$wynik = $lacz->query("update nta_grid set online = '$online' where id = '$ido'"); 
} 

if ($add){

	$name = $_POST['name'];
	$title_posiotion = $_POST['title_posiotion'];
	$tail_width = $_POST['tail_width'];
	$tail_delay = $_POST['tail_delay'];
	$tail_effect = $_POST['tail_effect'];
	$article_effect = $_POST['article_effect'];			
	$zmienna_wyslij = $_POST['zmienna_wyslij'];			
	
	if ($name && $title_posiotion && $tail_width && $tail_delay && $article_effect && $zmienna_wyslij){
				
	$lacz = lacz_bd();	
	$wynik = $lacz->query("INSERT INTO nta_grid VALUES ('', '$name', '$tail_effect', '$tail_delay', '$tail_width', '$title_posiotion', '$article_effect', '0')");
	if($wynik){ 
		 
	?><br /><div class="ok_bg"><div class="ok">Added entry</div></div><?php }
	}
	if ((!$name || !$title_posiotion || !$tail_width || !$tail_delay || !$article_effect)  && $zmienna_wyslij){ ?><br /><div class="no_bg"><div class="no">Fill in all fields</div></div><?php }

?>
		<div style="margin:30px 0 30px 0;">
        <div class="top_txt">Tile: Add</div>
        <div class="linia2" /></div>
		<div class="linia2" /></div>
        <form action="index.php?id=<?php echo $id; ?>&add=1" method="post">
        <input type="hidden" name="zmienna_wyslij" value="1" />
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Name:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <input name="name" type="text" style="text-align:center; width:400px; margin-top:8px;" />
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Title position:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <select name="title_posiotion" style="text-align:center; width:400px; margin-top:8px;">
              <option value="bottom">bottom</option>
              <option value="top">top</option>
            </select>
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Tile width:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <input name="tail_width" type="text" style="text-align:center; width:400px; margin-top:8px;" />
            <div class="top_box_txt" style="left:620px;">max 1050px</div>
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Tile delay:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <input name="tail_delay" type="text" style="text-align:center; width:400px; margin-top:8px;" value="-" />
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Tile effect:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <select name="tail_effect" style="text-align:center; width:400px; margin-top:8px;">
              <option value="">Basic</option>
              <option value="flipHorz">Horizontal Flip</option>
              <option value="flipVert">Vertical Flip</option>
              <option value="scrollHorz">Horizontal Scroll</option>
              <option value="scrollVert">Vertical Scroll</option>                            
              <option value="shuffle">Shuffle</option>
              <option value="tileSlide">Slide</option>
            </select>
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Article effect:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <select name="article_effect" style="text-align:center; width:400px; margin-top:8px;">
              <option value="cards">Cards</option>
              <option value="curl">Curl</option>
              <option value="fade">Fade</option>
              <option value="fan">Fan</option>
              <option value="flip">Flip</option>
              <option value="fly">Fly</option>
              <option value="fly-reverse">Fly Reverse</option>
              <option value="fly-simplified">Fly Simplified</option>
              <option value="grow">Grow</option>
              <option value="helix">Helix</option>
              <option value="papercut">Papercut</option>
              <option value="skew">Skew</option>
			  <option value="tilt">Tilt</option>
              <option value="twirl">Twirl</option>
              <option value="wave">Wave</option>
              <option value="zipper">Zipper</option>
          </select>
		</div>
        <img src="images/tails.jpg" width="800" height="370" style="margin:10px 0 10px 0;">               
        <div class="center_box2" style="background-color:#eee8e4; border-top:#91a0a6 1px solid; height:66px;"><br /><input id="zapisz" type=submit value="" ></div>
        <div class="linia2" /></div>
        <div class="linia2" /></div>
        <br /><br /><a href="index.php?id=<?php echo $id; ?>" style="margin-left:690px;"><img src="images/back.png" width="109" height="42" ></a>
        </form>
        </div>
<?	
}

if ($del){

$lacz = lacz_bd();
$wynik = $lacz->query("DELETE FROM nta_grid WHERE id = '$del'");

	$question_d = $lacz->query("SELECT photo FROM nta_grid_photo WHERE id_grid = '$del'");
		for ($lp3 = 0; $rz3 = $question_d ->fetch_row(); ++$lp3){ $tab3[$lp3] = $rz3; }		
		if ($question_d ->num_rows>0){
			foreach ($tab3 as $sdelete){ 
				
				if (file_exists('../images/tails/'.$sdelete[0])){
				unlink('../images/tails/'.$sdelete[0]);
				} 					
			}
			
			$wynik2 = $lacz->query("DELETE FROM nta_grid_photo WHERE id_grid = '$del'");
		}
}

if ($idc){ 
	
	$name = $_POST['name'];
	$title_posiotion = $_POST['title_posiotion'];
	$tail_width = $_POST['tail_width'];
	$tail_delay = $_POST['tail_delay'];
	$tail_effect = $_POST['tail_effect'];
	$article_effect = $_POST['article_effect'];			
	$zmienna_wyslij = $_POST['zmienna_wyslij'];			
	
	if ($name && $title_posiotion && $tail_width && $tail_delay && $article_effect && $zmienna_wyslij){
				
	$lacz = lacz_bd();	
	$wynik = $lacz->query("UPDATE nta_grid SET title = '$name', effect = '$tail_effect', delay = '$tail_delay', width = '$tail_width', title_position = '$title_posiotion', article_effect = '$article_effect' WHERE id = '$idc'"); 
	if($wynik){ 
	
	?><br /><div class="ok_bg"><div class="ok">Updated entry</div></div><?php }
	}
	if ((!$name || !$title_posiotion || !$tail_width || !$tail_delay || !$article_effect)  && $zmienna_wyslij){ ?><br /><div class="no_bg"><div class="no">Fill in all fields</div></div><?php }

?>
		<div style="margin:30px 0 30px 0;">
        <div class="top_txt">Tile: Edit</div>
        <div class="linia2" /></div>
		<div class="linia2" /></div>
        <?		
								
		$lacz = lacz_bd();
		$zapytanie = $lacz->query("SELECT * FROM nta_grid WHERE id = '$idc'");
   		$wyswietl = $zapytanie->fetch_row();
		?>
        <form action="index.php?id=<?php echo $id; ?>&idc=<?php echo $wyswietl[0]; ?>" method="post">
        <input type="hidden" name="zmienna_wyslij" value="1" />
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Name:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <input name="name" type="text" style="text-align:center; width:400px; margin-top:8px;" value="<?php echo $wyswietl[1]; ?>" />
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Title position:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <select name="title_posiotion" style="text-align:center; width:400px; margin-top:8px;">              
              <option value="bottom" <?php if($wyswietl[5]=='bottom'){ ?>selected="selected"<?php } ?>>bottom</option>
              <option value="top" <?php if($wyswietl[5]=='top'){ ?>selected="selected"<?php } ?>>top</option>
            </select>
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Tile width:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <input name="tail_width" type="text" style="text-align:center; width:400px; margin-top:8px;" value="<?php echo $wyswietl[4]; ?>" />
            <div class="top_box_txt" style="left:620px;">max 1050px</div>
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Tile delay:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <input name="tail_delay" type="text" style="text-align:center; width:400px; margin-top:8px;" value="<?php echo $wyswietl[3]; ?>" />
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Tile effect:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <select name="tail_effect" style="text-align:center; width:400px; margin-top:8px;">
              <option value="" <?php if($wyswietl[2]==''){ ?>selected="selected"<?php } ?>>Basic</option>
              <option value="flipHorz" <?php if($wyswietl[2]=='flipHorz'){ ?>selected="selected"<?php } ?>>Horizontal Flip</option>
              <option value="flipVert" <?php if($wyswietl[2]=='flipVert'){ ?>selected="selected"<?php } ?>>Vertical Flip</option>
              <option value="scrollHorz" <?php if($wyswietl[2]=='scrollHorz'){ ?>selected="selected"<?php } ?>>Horizontal Scroll</option>
              <option value="scrollVert" <?php if($wyswietl[2]=='scrollVert'){ ?>selected="selected"<?php } ?>>Vertical Scroll</option>
              <option value="shuffle" <?php if($wyswietl[2]=='shuffle'){ ?>selected="selected"<?php } ?>>Shuffle</option>
              <option value="tileSlide" <?php if($wyswietl[2]=='tileSlide'){ ?>selected="selected"<?php } ?>>Slide</option>
            </select>
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Article effect:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <select name="article_effect" style="text-align:center; width:400px; margin-top:8px;">
              <option value="cards" <?php if($wyswietl[6]=='cards'){ ?>selected="selected"<?php } ?>>Cards</option>
              <option value="curl" <?php if($wyswietl[6]=='curl'){ ?>selected="selected"<?php } ?>>Curl</option>
              <option value="fade" <?php if($wyswietl[6]=='fade'){ ?>selected="selected"<?php } ?>>Fade</option>
              <option value="fan" <?php if($wyswietl[6]=='fan'){ ?>selected="selected"<?php } ?>>Fan</option>
              <option value="flip" <?php if($wyswietl[6]=='flip'){ ?>selected="selected"<?php } ?>>Flip</option>
              <option value="fly" <?php if($wyswietl[6]=='fly'){ ?>selected="selected"<?php } ?>>Fly</option>
              <option value="fly-reverse" <?php if($wyswietl[6]=='fly-reverse'){ ?>selected="selected"<?php } ?>>Fly Reverse</option>
              <option value="fly-simplified" <?php if($wyswietl[6]=='fly-simplified'){ ?>selected="selected"<?php } ?>>Fly Simplified</option>
              <option value="grow" <?php if($wyswietl[6]=='grow'){ ?>selected="selected"<?php } ?>>Grow</option>
              <option value="helix" <?php if($wyswietl[6]=='helix'){ ?>selected="selected"<?php } ?>>Helix</option>
              <option value="papercut" <?php if($wyswietl[6]=='papercut'){ ?>selected="selected"<?php } ?>>Papercut</option>
              <option value="skew" <?php if($wyswietl[6]=='skew'){ ?>selected="selected"<?php } ?>>Skew</option>
			  <option value="tilt" <?php if($wyswietl[6]=='tilt'){ ?>selected="selected"<?php } ?>>Tilt</option>
              <option value="twirl" <?php if($wyswietl[6]=='twirl'){ ?>selected="selected"<?php } ?>>Twirl</option>
              <option value="wave" <?php if($wyswietl[6]=='wave'){ ?>selected="selected"<?php } ?>>Wave</option>
              <option value="zipper" <?php if($wyswietl[6]=='zipper'){ ?>selected="selected"<?php } ?>>Zipper</option>
          </select>
		</div>       
        <img src="images/tails.jpg" width="800" height="370" style="margin:10px 0 10px 0;"> 
        <div class="center_box2" style="background-color:#eee8e4; border-top:#91a0a6 1px solid; height:66px;"><br /><input id="zapisz" type=submit value="" ></div>
        <div class="linia2" /></div>
        <div class="linia2" /></div>
        <br /><br /><a href="index.php?id=<?php echo $id; ?>" style="margin-left:690px;"><img src="images/back.png" width="109" height="42" ></a>
        </form>
        </div>
<?php
}

if (!$idc && !$add && !$addf){
	
	$limit = 15; 
	$pg = $_GET['page']; 
			
	if(!isset($pg)) {
    	
	   $l1 = 0;
       $l2 = $limit; 
			
	} else {
		    				
           $l1 = $limit * $pg - $limit; 
    	   $l2 = $limit; 			
        }

	$lacz = lacz_bd();
	$q = $lacz->query("SELECT * FROM nta_grid ORDER BY id DESC LIMIT $l1,$l2"); 
	for ($licznik = 0; $rzad = $q->fetch_row(); ++$licznik){ $tablica[$licznik] = $rzad; }
	
	$q2 = $lacz->query("SELECT count(*) FROM nta_grid");  
    list($records)=$q2->fetch_row();		
?>
<div class="top_txt">Tiles</div>
<div class="linia" /></div>
<div class="linia" /></div>
<div class="center_box" style="height:67px; background-color:#eee8e4;"><br /><a href="index.php?id=<?php echo $id; ?>&add=1" title="Add"><img src="images/add.png" width="109" height="29" ></a></div>
<div class="top_box">
<div class="top_box_txt" style="left:24px;">No.</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:62px;" />
<div class="top_box_txt" style="left:135px;">Name</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:250px;" />
<div class="top_box_txt" style="left:400px;">Tiles Parameters</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:655px;" />

<div class="top_box_txt" style="left:720px;">Options</div>
</div>
<div class="center_box">
<table style="margin-bottom:7px; width:840px;">
  <tr>
<?php
	if ($q->num_rows>0){ 
	$lp =1; 
	foreach ($tablica as $wyswietl){

?>  
    <td width="55" height="60" align="center" class="tab_info_kreski"><div class="tab_info"><?php echo $lp; ?>.</div></td>
    <td align="center" class="tab_info_kreski"><a href="index.php?id=3&gc=<?php echo $wyswietl[0]; ?>" class="tab_info" title="Tail title / Title position"><?php echo $wyswietl[1]; ?><br /><span style="color:#4fb2fc; font-size:11px;"><?php echo $wyswietl[5]; ?></span></a></td>
    <td width="70"  align="center" class="tab_info_kreski"><div class="tab_info" title="Tiles width"><?php echo $wyswietl[4]; ?></div></td>
    <td width="120"  align="center" class="tab_info_kreski"><div class="tab_info" title="Tiles effect"><?php echo $wyswietl[2]; ?></div></td>
    <td width="120"  align="center" class="tab_info_kreski"><div class="tab_info" title="Article effect"><?php echo $wyswietl[6]; ?></div></td>
    <td width="80"  align="center" class="tab_info_kreski"><div class="tab_info" title="Tail delay"><?php echo $wyswietl[3]; ?></div></td>
    <td width="183" align="center" class="tab_info_kreski">
        <table>
          <tr>
            <td width="50" align="center"><a href="index.php?id=<?php echo $id; ?>&idc=<?php echo $wyswietl[0]; ?>" title="edit"><img src="images/edit.png" width="26" height="26"></a></td>
            <td width="50" align="center"><a href="index.php?id=<?php echo $id; ?>&del=<?php echo $wyswietl[0]; ?>" title="delete"><img src="images/delete.png" width="26" height="26"></a></td>
            <td width="83" align="right">
                <?php if($wyswietl[7]==1){ ?><a href="index.php?id=<?php echo $id; ?>&online=2&ido=<?php echo $wyswietl[0]; ?><?php if($_GET['page']){ ?>&page=<?php echo $_GET['page']; } ?>" title="online/offline"><img src="images/online.png" width="78" height="33"></a><?php } else { ?>
                <a href="index.php?id=<?php echo $id; ?>&online=1&ido=<?php echo $wyswietl[0]; ?><?php if($_GET['page']){ ?>&page=<?php echo $_GET['page']; } ?>" title="online/offline"><img src="images/offline.png" width="78" height="33"></a><?php } ?>
            </td>
          </tr>
        </table>   
    </td>
  </tr>
  <tr>
  	<td width="55" height="60" align="center" class="tab_info_kreski"></td>
    <td height="60" align="center" class="tab_info_kreski" colspan="5">
    <?php
		$lacz = lacz_bd();
		$question = $lacz->query("SELECT id, photo FROM nta_grid_photo WHERE id_grid = '$wyswietl[0]' ORDER BY id ASC");
		for ($lp2 = 0; $rz = $question->fetch_row(); ++$lp2){ $tab[$lp2] = $rz; }		
		if ($question->num_rows>0){
			foreach ($tab as $pnta){ 
	?>
    <div class="foto_nta_bg">
     <a rel="example_group" href="../images/tails/<?php echo $pnta[1]; ?>" class="foto"><img src="../images/tails/<?php echo $pnta[1]; ?>" width="50" height="50" /></a>
     <a href="index.php?id=<?php echo $id; ?>&dnta=<?php echo $pnta[0]; ?>&dfnta=<?php echo $pnta[1]; ?>" class="nta_del"><img src="images/delete.png" width="16" height="16"></a>
    </div>
    <?php } unset ($tab); } ?>
    </td>
    <td width="183" height="60" align="center" class="tab_info_kreski"><a href="index.php?id=<?php echo $id; ?>&addf=<?php echo $wyswietl[0]; ?>&addw=<?php echo $wyswietl[4]; ?>" title="Add photo"><img src="images/add.png" width="83" height="22" ></a></td>
  </tr>
<?php $lp++; } ?>
</table>
</div>
<div class="linia" /></div>
<div class="linia" /></div>
<div class="pagination_bg">
<?php
       if($records >= 1){	
				
           $pag['posts'] = $records; 
           $pag['limit'] = $limit; 
           $pag['page'] = addslashes(strip_tags($_GET['page'])); 
           $pag['separator'] = '?id='.$id.'&'; 
           $pag['url_class'] = 'pages'; 
           $pag['a_pg_class'] = 'active_pg'; 
           $pag['page_label'] = 'Page:'; 		

               ?><div style="width:840px; text-align:center;"><?php ECHO print_pagination($pag); ?></div><?php
    	}
?>
</div>
<?php } else { ?><div class="tytul_web"><br /> none</div><?php } ?>
<br /><br /><br />
<?php
	}
}


function articles($id){
	
$gc = $_GET['gc'];

$idc = $_GET['idc'];
$del = $_GET['del'];
$add = $_GET['add'];
$af = $_GET['af'];
$ido = $_GET['ido'];
$online = $_GET['online'];

$afid = $_GET['afid'];
$aff = $_GET['aff'];
$fp = $_GET['fp'];

if($fp){
	
	
	$fdel = $_GET['fdel'];
	
	if($fdel){
		
		if (file_exists('../images/articles/'.$fdel)){
 		unlink('../images/articles/'.$fdel);
 		} 

	}
?>
        <div class="top_txt">Gallery: Add photo <br />
        <span style="font-size:14px;">
        (recommended width 990px, <a href="index.php?id=<?php echo $id; ?>&fp=<?php echo $fp; ?>" title="click to refresh" style="color:#60C;">refresh after upload</a>)
        </span></div> 
		<input id="fp" name="fp" type="file" /><br />
        <div class="linia2" /></div>
		<div class="linia2" /></div>
        <div id="load_foto" style="width:980px; margin-top:10px;">
		
		<?	
		define('AN', $fp);
					
		class ImageFilter extends FilterIterator {

		public function accept() { 
		
			return preg_match('@\_'.AN.'_g.(gif|jpe?g|png)$@i',$this->current()); 
			}
		}

		foreach (new ImageFilter(new DirectoryIterator('../images/articles/')) as $img) { 
			$nazwa = explode(".", $img);
			$exe = array_pop($nazwa);
		?>
         <div class="foto_bg">
         <a rel="example_group" href="../images/articles/<?php echo $img; ?>" class="foto"><img src="../images/articles/<?php echo $nazwa[0]; ?>.<?php echo $exe; ?>" width="178" height="112" /></a>
         <a href="index.php?id=<?php echo $id; ?>&fp=<?php echo $fp; ?>&fdel=<?php echo $img; ?>" class="press_del">
         <img src="images/delete.png" width="26" height="26"></a>
         </div>
         <?php } ?>
         
        </div><div style="clear:both;"></div><br /><br />
        <a href="index.php?id=<?php echo $id; ?>"><img src="images/back.png" width="109" height="42"></a><br /><br />
        <?	
}

if($afid && $aff){
	
	$lacz = lacz_bd();
	$wynik = $lacz->query("update nta_article set photo = '' where id = '$afid'");
	if($wynik){
		
		if (file_exists('../images/articles/'.$aff)){
 		unlink('../images/articles/'.$aff);
 		} 
	}	
}

if($online && $ido){
	
	$lacz = lacz_bd();	
	$wynik = $lacz->query("update nta_article set online = '$online' where id = '$ido'"); 
}

if($af){
?>   
    <div class="top_txt">Article: Add photo <br /><span style="font-size:14px;">(your photo will be rescaled to 1020px x 597px)</span></div> 
	<input id="af" name="af" type="file" /><br />
    <div class="linia2" /></div>
	<div class="linia2" /></div>
    <br /><br />
    <a href="index.php?id=<?php echo $id; ?><?php if($gc){ ?>&gc=<?php echo $gc; } ?>"><img src="images/back.png" width="109" height="42"></a><br /><br />
<?php
} 

if ($add){

	$date_input = $_POST['date_input'];
	$title_input = $_POST['title_input'];
	$tiles_name = $_POST['tiles_name'];
	$text_input = $_POST['text_input'];			
	$zmienna_wyslij = $_POST['zmienna_wyslij'];			
	
	if ($date_input && $title_input && $tiles_name && $text_input && $zmienna_wyslij){
				
	$lacz = lacz_bd();	
	$wynik = $lacz->query("INSERT INTO nta_article VALUES ('', '$tiles_name', '', '$date_input', '$title_input', '$text_input', '0')");
	if($wynik){ 
		 
	?><br /><div class="ok_bg"><div class="ok">Added entry</div></div><?php }
	}
	if (!$date_input && !$title_input && !$tiles_name && !$text_input && $zmienna_wyslij){ ?><br /><div class="no_bg"><div class="no">Fill in all fields</div></div><?php }

?>
		<div style="margin:30px 0 30px 0;">
        <div class="top_txt">Articles: Add</div>
        <div class="linia2" /></div>
		<div class="linia2" /></div>
        <form action="index.php?id=<?php echo $id; ?><?php if($gc){ ?>&gc=<?php echo $gc; } ?>&add=1" method="post">
        <input type="hidden" name="zmienna_wyslij" value="1" />
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Tile:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:110px;" />
            <?php
			$lacz = lacz_bd();
			$question = $lacz->query("SELECT id, title FROM nta_grid");
			for ($lp = 0; $rz = $question->fetch_row(); ++$lp){ $tab[$lp] = $rz; }		
			if ($question->num_rows>0){
			?>
            <select name="tiles_name" style="text-align:center; width:400px; margin-top:8px;">
            <?php foreach ($tab as $tiles_name){ ?>
              <option value="<?php echo $tiles_name[0]; ?>"><?php echo $tiles_name[1]; ?></option>
            <?php } ?>
            </select>
			<?php } ?>
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Date:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:110px;" />
            <input name="date_input" type="text" style="text-align:center; width:400px; margin-top:8px;" value="<?php echo date("Y-m-d"); ?>" />
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Title:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:110px;" />
            <input name="title_input" type="text" style="text-align:center; width:400px; margin-top:8px;" />
		</div>
       
        <div class="center_box2" style="background-color:#eee8e4; height:35px; margin:10px 0 10px 0;">
        <div class="top_box_txt_center" >Full description:</div>
        <a href="index.php?id=9" target="_blank" title="photos" class="fpa" ><img src="images/aparat_ico.png" width="30" height="22"></a>
        </div>        
         <div style="width:800px; text-align:start;"><textarea name="text_input" cols="90" rows="10" class="summernote" ></textarea></div>        
        <br /><br />
        <div class="center_box2" style="background-color:#eee8e4; border-top:#91a0a6 1px solid; height:66px;"><br /><input id="zapisz" type=submit value="" ></div>
        <div class="linia2" /></div>
        <div class="linia2" /></div>
        <br /><br /><a href="index.php?id=<?php echo $id; ?><?php if($gc){ ?>&gc=<?php echo $gc; } ?>" style="margin-left:690px;"><img src="images/back.png" width="109" height="42" ></a>
        </form>
        </div>
<?	
}

if ($del){

	$lacz = lacz_bd();
	$wynik = $lacz->query("DELETE FROM nta_article WHERE id = '$del'");

	$katalog = '../images/articles/';
	if(glob("$katalog/*")){
		
		foreach (glob("$katalog/*_".$del."_g.*") as $filename){
			if($file != '$katalog' && $file != '..'){}
			unlink("$filename");
		}
	}

	if (file_exists('../images/articles/'.$del.'_a.jpg')){ unlink('../images/articles/'.$del.'_a.jpg'); } 
	if (file_exists('../images/articles/'.$del.'_a.jpeg')){ unlink('../images/articles/'.$del.'_a.jpeg'); } 
	if (file_exists('../images/articles/'.$del.'_a.png')){ unlink('../images/articles/'.$del.'_a.png'); } 
	if (file_exists('../images/articles/'.$del.'_a.gif')){ unlink('../images/articles/'.$del.'_a.gif'); } 
}

if ($idc){ 
	
	$date_input = $_POST['date_input'];
	$title_input = $_POST['title_input'];
	$tiles_name = $_POST['tiles_name'];
	$text_input = $_POST['text_input'];			
	$zmienna_wyslij = $_POST['zmienna_wyslij'];			
	
	if ($date_input && $title_input && $tiles_name && $text_input && $zmienna_wyslij){
				
	$lacz = lacz_bd();	
	$wynik = $lacz->query("UPDATE nta_article SET id_grid = '$tiles_name', date = '$date_input', title = '$title_input', information = '$text_input' WHERE id = '$idc'"); 
	if($wynik){ 
	
	?><br /><div class="ok_bg"><div class="ok">Updated entry</div></div><?php }
	}
	if (!$date_input && !$title_input && !$tiles_name && !$text_input && $zmienna_wyslij){ ?><br /><div class="no_bg"><div class="no">Fill in all fields</div></div><?php }

?>
		<div style="margin:30px 0 30px 0;">
        <div class="top_txt">Articles: Edit</div>
        <div class="linia2" /></div>
		<div class="linia2" /></div>
        <?		
								
		$lacz = lacz_bd();
		$zapytanie = $lacz->query("SELECT * FROM nta_article WHERE id = '$idc'");
   		$wyswietl = $zapytanie->fetch_row();
		?>
        <form action="index.php?id=<?php echo $id; ?><?php if($gc){ ?>&gc=<?php echo $gc; } ?>&idc=<?php echo $wyswietl[0]; ?>" method="post">
        <input type="hidden" name="zmienna_wyslij" value="1" />
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Tile:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:110px;" />
            <?php
			$lacz = lacz_bd();
			$question = $lacz->query("SELECT id, title FROM nta_grid");
			for ($lp = 0; $rz = $question->fetch_row(); ++$lp){ $tab[$lp] = $rz; }		
			if ($question->num_rows>0){
			?>
            <select name="tiles_name" style="text-align:center; width:400px; margin-top:8px;">
            <?php foreach ($tab as $tiles_name){ ?>
              <option value="<?php echo $tiles_name[0]; ?>" <?php if($wyswietl[1]==$tiles_name[0]){ ?>selected="selected"<?php } ?>><?php echo $tiles_name[1]; ?></option>
            <?php } ?>
            </select>
			<?php } ?>
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Date:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:110px;" />
            <input name="date_input" type="text" style="text-align:center; width:400px; margin-top:8px;" value="<?php echo $wyswietl[3]; ?>" />
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Title:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:110px;" />
            <input name="title_input" type="text" style="text-align:center; width:400px; margin-top:8px;" value="<?php echo $wyswietl[4]; ?>" />
		</div>
       
        <div class="center_box2" style="background-color:#eee8e4; height:35px; margin:10px 0 10px 0;">
        <div class="top_box_txt_center" >Full description:</div>
        <a href="index.php?id=9" target="_blank" title="photos" class="fpa" ><img src="images/aparat_ico.png" width="30" height="22"></a>
        </div>        
         <div style="width:800px; text-align:start;"><textarea name="text_input" cols="90" rows="10" class="summernote" ><?php echo $wyswietl[5]; ?></textarea></div>
        <br /><br />
        <div class="center_box2" style="background-color:#eee8e4; border-top:#91a0a6 1px solid; height:66px;"><br /><input id="zapisz" type=submit value="" ></div>
        <div class="linia2" /></div>
        <div class="linia2" /></div>
        <br /><br /><a href="index.php?id=<?php echo $id; ?><?php if($gc){ ?>&gc=<?php echo $gc; } ?>" style="margin-left:690px;"><img src="images/back.png" width="109" height="42" ></a>
        </form>
        </div>
<?php
}

if (!$idc && !$add && !$af && !$fp){
	
	$limit = 10; 
	$pg = $_GET['page']; 
			
	if(!isset($pg)) {
    	
	   $l1 = 0;
       $l2 = $limit; 
			
	} else {
		    				
           $l1 = $limit * $pg - $limit; 
    	   $l2 = $limit; 			
        }

	$lacz = lacz_bd();
	if($gc){ $q = $lacz->query("SELECT * FROM nta_article WHERE id_grid = '$gc' ORDER BY date DESC, id DESC LIMIT $l1,$l2"); } 
	else { $q = $lacz->query("SELECT * FROM nta_article ORDER BY date DESC, id DESC LIMIT $l1,$l2"); } 
	for ($licznik = 0; $rzad = $q->fetch_row(); ++$licznik){ $tablica[$licznik] = $rzad; }
	
	if($gc){ $q2 = $lacz->query("SELECT count(*) FROM nta_article WHERE id_grid = '$gc'"); }
	else { $q2 = $lacz->query("SELECT count(*) FROM nta_article"); } 
    list($records)=$q2->fetch_row();		
?>
<div class="top_txt">Articles</div>
<div class="linia" /></div>
<div class="linia" /></div>
<div class="center_box" style="height:67px; background-color:#eee8e4;"><br /><a href="index.php?id=<?php echo $id; ?><?php if($gc){ ?>&gc=<?php echo $gc; } ?>&add=1"><img src="images/add.png" width="109" height="29" ></a></div>
<div class="top_box">
<div class="top_box_txt" style="left:24px;">No.</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:62px;" />
<div class="top_box_txt" style="left:100px;">Date</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:165px;" />
<div class="top_box_txt" style="left:205px;">Photo</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:287px;" />
<div class="top_box_txt" style="left:450px;">Title</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:655px;" />
<div class="top_box_txt" style="left:720px;">Options</div>
</div>
<div class="center_box">
<table style="margin-bottom:7px; width:840px;">
  <tr>
<?php
	if ($q->num_rows>0){ 
	$lp =1; 
	foreach ($tablica as $wyswietl){
		
		$title = substr($wyswietl[4], 0, 40);
		$rok = substr($wyswietl[3], 0, 4); 
		$miesiac = substr($wyswietl[3], 5, 2); 
		$dzien = substr($wyswietl[3], 8, 2);
		
		$gt = $lacz->query("SELECT title, id FROM nta_grid WHERE id = '$wyswietl[1]'"); 
		$sgt = $gt->fetch_row();
?>  
    <td width="55" height="60" align="center" class="tab_info_kreski"><div class="tab_info"><?php echo $lp; ?>.</div></td>
    <td width="105" align="center" class="tab_info_kreski"><div class="tab_info" title="Article date"><?php echo $dzien; ?>.<?php echo $miesiac; ?>.<?php echo $rok; ?></div></td>
    <td width="110" align="center" class="tab_info_kreski">
    <?php if($wyswietl[2]){ ?>
    <div class="foto_ntaa_bg">
     <a rel="example_group" href="../images/articles/<?php echo $wyswietl[2]; ?>" class="foto"><img src="../images/articles/<?php echo $wyswietl[2]; ?>" width="100" height="50" /></a>
     <a href="index.php?id=<?php echo $id; ?>&afid=<?php echo $wyswietl[0]; ?>&aff=<?php echo $wyswietl[2]; ?>" class="nta_del"><img src="images/delete.png" width="16" height="16"></a>
    </div>
    <?php } else{ ?>
    <a href="index.php?id=<?php echo $id; ?>&af=<?php echo $wyswietl[0]; ?>" style="margin:5px; display:block;"><img src="images/bg_photo.jpg" width="100" height="50" /></a>
    <?php } ?>
    </td>
    <td align="center" class="tab_info_kreski">
    <div class="tab_info" title="Article title / Tail name"><?php echo $title; if(strlen($title)==40){ echo "..."; } ?><br />
    <a href="index.php?id=<?php echo $id; ?>&gc=<?php echo $sgt[1]; ?>" style="color:#4fb2fc; font-size:11px; text-decoration:none;"><?php echo $sgt[0]; ?></a></div>
    </td>
    <td width="183" align="center" class="tab_info_kreski">
        <table>
          <tr>
            <td width="34"><a href="index.php?id=<?php echo $id; ?>&fp=<?php echo $wyswietl[0]; ?>" title="photos"><img src="images/aparat_ico.png" width="30" height="22"></a></td>
            <td width="33" align="center"><a href="index.php?id=<?php echo $id; ?><?php if($gc){ ?>&gc=<?php echo $gc; } ?>&idc=<?php echo $wyswietl[0]; ?>" title="edit"><img src="images/edit.png" width="26" height="26"></a></td>
            <td width="33" align="center"><a href="index.php?id=<?php echo $id; ?><?php if($gc){ ?>&gc=<?php echo $gc; } ?>&del=<?php echo $wyswietl[0]; ?>" title="delete"><img src="images/delete.png" width="26" height="26"></a></td>
            <td width="83" align="right">
<?php if($wyswietl[6]==1){ ?><a href="index.php?id=<?php echo $id; ?><?php if($gc){ ?>&gc=<?php echo $gc; } ?>&online=2&ido=<?php echo $wyswietl[0]; ?><?php if($_GET['page']){ ?>&page=<?php echo $_GET['page']; } ?>" title="online/offline"><img src="images/online.png" width="78" height="33"></a><?php } else { ?>
                <a href="index.php?id=<?php echo $id; ?><?php if($gc){ ?>&gc=<?php echo $gc; } ?>&online=1&ido=<?php echo $wyswietl[0]; ?><?php if($_GET['page']){ ?>&page=<?php echo $_GET['page']; } ?>" title="online/offline"><img src="images/offline.png" width="78" height="33"></a><?php } ?>
            </td>
          </tr>
        </table>   
    </td>
  </tr>
<?php $lp++; } ?>
</table>
</div>
<div class="linia" /></div>
<div class="linia" /></div>
<div class="pagination_bg">
<?php
       if($records >= 1){	
				
           $pag['posts'] = $records; 
           $pag['limit'] = $limit; 
           $pag['page'] = addslashes(strip_tags($_GET['page'])); 
          if($gc){ $pag['separator'] = '?id='.$id.'&gc='.$gc.'&'; } else { $pag['separator'] = '?id='.$id.'&'; } 
           $pag['url_class'] = 'pages'; 
           $pag['a_pg_class'] = 'active_pg'; 
           $pag['page_label'] = 'Page:'; 		

               ?><div style="width:840px; text-align:center;"><?php ECHO print_pagination($pag); ?></div><?php
    	}
?>
</div>
<?php } else { ?><div class="tytul_web"><br /> none</div><?php } ?>
<br /><br /><br />
<?php
	}
}


function messages($id){
	
$idc = $_GET['idc'];
$ido = $_GET['ido'];
$online = $_GET['online'];

if($online && $ido){
	
	$lacz = lacz_bd();	
	$wynik = $lacz->query("update nta_message set online = '$online' where id = '$ido'"); 
}


if ($idc){ 
	
	$bgc_input = $_POST['bgc_input'];
	$tc_input = $_POST['tc_input'];
	$message_input = $_POST['message_input'];
	$title_input = $_POST['title_input'];	
	$text_input = $_POST['text_input'];			
	$zmienna_wyslij = $_POST['zmienna_wyslij'];			
	
	if ($bgc_input && $tc_input && $message_input && $title_input && $text_input && $zmienna_wyslij){
				
	$lacz = lacz_bd();	
	$wynik = $lacz->query("UPDATE nta_message SET bgc = '$bgc_input', tc = '$tc_input', message = '$message_input', title = '$title_input', information = '$text_input' WHERE id = '$idc'"); 
	if($wynik){ 
	
	?><br /><div class="ok_bg"><div class="ok">Updated entry</div></div><?php }
	}
	if (!$bgc_input && !$tc_input && !$message_input && !$title_input && !$text_input && $zmienna_wyslij){ ?><br /><div class="no_bg"><div class="no">Fill in all fields</div></div><?php }

?>
		<div style="margin:30px 0 30px 0;">
        <div class="top_txt">Message: Edit</div>
        <div class="linia2" /></div>
		<div class="linia2" /></div>
        <?		
								
		$lacz = lacz_bd();
		$zapytanie = $lacz->query("SELECT * FROM nta_message WHERE id = '$idc'");
   		$wyswietl = $zapytanie->fetch_row();
		?>
        <form action="index.php?id=<?php echo $id; ?><?php if($gc){ ?>&gc=<?php echo $gc; } ?>&idc=<?php echo $wyswietl[0]; ?>" method="post">
        <input type="hidden" name="zmienna_wyslij" value="1" />
                
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Background:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <input class="picker" name="bgc_input" type="text" style="text-align:center; width:400px; margin-top:8px;" value="<?php echo $wyswietl[1]; ?>" />
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Text:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <input class="picker" name="tc_input" type="text" style="text-align:center; width:400px; margin-top:8px;" value="<?php echo $wyswietl[2]; ?>" />
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Message:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <input name="message_input" type="text" style="text-align:center; width:400px; margin-top:8px;" value="<?php echo $wyswietl[3]; ?>" />
		</div>
        
        <div class="top_box2">
			<div class="top_box_txt" style="left:24px;">Title:</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:130px;" />
            <input name="title_input" type="text" style="text-align:center; width:400px; margin-top:8px;" value="<?php echo $wyswietl[4]; ?>" />
		</div>
       
        <div class="center_box2" style="background-color:#eee8e4; height:35px; margin:10px 0 10px 0;">
        <div class="top_box_txt_center" >Full description:</div>
        <a href="index.php?id=9" target="_blank" title="photos" class="fpa" ><img src="images/aparat_ico.png" width="30" height="22"></a>
        </div>        
         <div style="width:800px; text-align:start;"><textarea name="text_input" cols="90" rows="10" class="summernote" ><?php echo $wyswietl[5]; ?></textarea></div>
        <br /><br />
        <div class="center_box2" style="background-color:#eee8e4; border-top:#91a0a6 1px solid; height:66px;"><br /><input id="zapisz" type=submit value="" ></div>
        <div class="linia2" /></div>
        <div class="linia2" /></div>
        <br /><br /><a href="index.php?id=<?php echo $id; ?><?php if($gc){ ?>&gc=<?php echo $gc; } ?>" style="margin-left:690px;"><img src="images/back.png" width="109" height="42" ></a>
        </form>
        </div>
<?php
}

if (!$idc){
	
	$lacz = lacz_bd();
	$q = $lacz->query("SELECT * FROM nta_message");
	for ($licznik = 0; $rzad = $q->fetch_row(); ++$licznik){ $tablica[$licznik] = $rzad; }
		
?>
<div class="top_txt">Messages to Users</div>
<div class="linia" /></div>
<div class="linia" /></div>
<div class="top_box">
<div class="top_box_txt" style="left:24px;">No.</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:62px;" />
<div class="top_box_txt" style="left:170px;">Name</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:325px;" />
<div class="top_box_txt" style="left:470px;">Title</div><img src="images/box_linia.png" width="2" height="25" class="box_linia" style="left:655px;" />
<div class="top_box_txt" style="left:720px;">Options</div>
</div>
<div class="center_box">
<table style="margin-bottom:7px; width:840px;">
  <tr>
<?php
	if ($q->num_rows>0){ 
	$lp =1; 
	foreach ($tablica as $wyswietl){
		
		$message = substr($wyswietl[3], 0, 40);
		$title = substr($wyswietl[4], 0, 40);
?>  
    <td width="55" height="60" align="center" class="tab_info_kreski"><div class="tab_info"><?php echo $lp; ?>.</div></td>
    <td width="260" align="center" class="tab_info_kreski"><div class="tab_info" title="Message name"><?php echo $message; if(strlen($message)==40){ echo "..."; } ?></div></td>
    <td align="center" class="tab_info_kreski"><div class="tab_info" title="Message title"><?php echo $title; if(strlen($title)==40){ echo "..."; } ?></div></td>
    <td width="183" align="center" class="tab_info_kreski">
        <table>
          <tr>
            <td width="50" align="center"><a href="index.php?id=<?php echo $id; ?>&idc=<?php echo $wyswietl[0]; ?>" title="edit"><img src="images/message.png" width="26" height="26"></a></td>

            <td width="83" align="right">
         <?php if($wyswietl[6]==1){ ?><a href="index.php?id=<?php echo $id; ?>&online=2&ido=<?php echo $wyswietl[0]; ?>" title="online/offline"><img src="images/online.png" width="78" height="33"></a><?php } else { ?>
                <a href="index.php?id=<?php echo $id; ?>&online=1&ido=<?php echo $wyswietl[0]; ?>" title="online/offline"><img src="images/offline.png" width="78" height="33"></a><?php } ?>
            </td>
          </tr>
        </table>   
    </td>
  </tr>
<?php $lp++; } ?>
</table>
</div>
<div class="linia" /></div>
<div class="linia" /></div>
<div class="pagination_bg">
<?php
       if($records >= 1){	
				
           $pag['posts'] = $records; 
           $pag['limit'] = $limit; 
           $pag['page'] = addslashes(strip_tags($_GET['page'])); 
          if($gc){ $pag['separator'] = '?id='.$id.'&gc='.$gc.'&'; } else { $pag['separator'] = '?id='.$id.'&'; } 
           $pag['url_class'] = 'pages'; 
           $pag['a_pg_class'] = 'active_pg'; 
           $pag['page_label'] = 'Page:'; 		

               ?><div style="width:840px; text-align:center;"><?php ECHO print_pagination($pag); ?></div><?php
    	}
?>
</div>
<?php } else { ?><div class="tytul_web"><br /> none</div><?php } ?>
<br /><br /><br />
<?php
	}
}
?>