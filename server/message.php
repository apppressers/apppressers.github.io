<?php
//header('content-type: text/html; charset=iso-8859-2');
header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
require_once('function.php');

$id = addslashes(strip_tags($_GET['id']));
	
	if($id){
		
		$connect = data_base();
		$question = $connect->query("SELECT * FROM nta_message WHERE id = '$id' AND online = '1'");
		$article = $question->fetch_row();		
		if ($question->num_rows>0){
					
		?>
        <div class="article_bg">
        	<br /><br />
            <div class="article_title">
            <?php echo $article[4]; ?>
            </div>
            
			<div class="article_txt">
        	<?php echo $article[5]; ?>
        	</div>
        <a href="index.html" class="article_back"></a>
        <div style="clear:both;"></div>
        </div>  
        <?php
		}
	}