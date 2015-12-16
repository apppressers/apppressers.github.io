<?php
session_start();
require_once('function.php');
require_once('plugins/pagination.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Administrator Panel</title>

<?php  ?>
</head>
<body>
<div class="wrapper">

<center>
<div style="height:60px;"></div>
<?php
$login = addslashes(strip_tags(trim($_POST['login'])));
$haslo = addslashes(strip_tags(trim($_POST['haslo'])));
$logout_admin = addslashes(strip_tags($_GET['logout_admin']));


 if($logout_admin==1){ logout();}

 if (!$_SESSION['authorization_nta_admin'] && !$login && !$haslo) {   
	logowanie(); 
 }
 if ($login && $haslo) {
	
$lacz = lacz_bd();

 $wynik_logowanie = $lacz->query("SELECT * FROM nta_admin WHERE name ='$login' and pass = sha1('$haslo') ");
 
 if (!$wynik_logowanie)
 echo 'Login failed';
 if ($wynik_logowanie->num_rows>0)
 $_SESSION['authorization_nta_admin'] = $login;
 else{
 echo '<div class="tytul_web" style="color:#ff0000; font-size:18px;">Incorrect password or login</div><br />';
 echo '<a href="index.php" class="tytul_web" style="text-decoration:none; color:#141413;">back...</a>';
 }
}
if ($_SESSION['authorization_nta_admin']){
	
?>
<img src="images/sign_pa.png" width="347" height="70" style="margin-bottom:20px;" />
<div class="menu_bg">
<div class="menu_center">
	<a href="index.php" title="Home" class="menu_txt">Home</a>
	<a href="index.php?id=1" title="Settings" class="menu_txt">Settings</a>
    <a href="index.php?id=2" title="Tiles" class="menu_txt">Tiles</a>
    <a href="index.php?id=3" title="Articles" class="menu_txt">Articles</a>
    <a href="index.php?id=4" title="Message to Users" class="menu_txt">Messages to Users</a>
</div>
<a href="index.php?logout_admin=1" title="Logout" class="logout"></a>				
</div>
<?php
$id = addslashes(strip_tags(trim($_GET['id'])));

if(!$id){statistic();}
if($id==1){change_password();}
if($id==2){tails($id);}
if($id==3){articles($id);}
if($id==4){messages($id);}
if($id==9){images($id);}

}
?>
<br /><br />
 
<div class="push"></div>
 
</center>
</div>
<div class="stopka"><?php stopka(); ?></div>
</body>
</html>
