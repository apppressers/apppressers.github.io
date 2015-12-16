<?php
//header('content-type: text/html; charset=iso-8859-1');
header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
require_once('function.php');

$id = addslashes(strip_tags($_GET['id']));
$art = addslashes(strip_tags($_GET['art']));

if ($id) {

    $connect = dataxnam_base();
    $qm1 = $connect->query("SET NAMES utf8");

    $qm = $connect->query("SELECT * FROM nta_message WHERE id = '3' AND online = '1'");
    if ($qm->num_rows > 0) {

        $sqm = $qm->fetch_row();
        ?>

        <a href="message.html?id=3" class="message_alert"
           style="background-color:#<?php echo $sqm[1]; ?>; color:#<?php echo $sqm[2]; ?>;">
            <div style="padding:20px;"><?php echo $sqm[3]; ?></div>
        </a>
        <?php
    }

    //$question = $connect->query("SELECT * FROM nta_article WHERE id = '$art' AND id_grid = '$id' AND online = '1' ORDER BY date DESC, id DESC");
    $question = $connect->query("SELECT id,post_author,ping_status, post_date, post_title, post_content FROM " . $table_prefix . "posts WHERE id = '$art' ORDER BY post_date DESC, id DESC");
    $article = $question->fetch_row();
    if ($question->num_rows > 0) {

        $y = substr($article[3], 0, 4);
        $m = substr($article[3], 5, 2);
        $d = substr($article[3], 8, 2);

        $que = $connect->query("SELECT guid FROM " . $table_prefix . "posts WHERE post_parent = '$article[0]' and post_type = 'attachment'");
        $aaa = $que->fetch_row();
        ?>

        <div class="article_bg">
            <div class="article_date"><?php echo $d; ?>.<?php echo $m; ?>.<?php echo $y; ?></div>
            <div class="article_title">
                <p style="font-family: 'Trebuchet MS', Helvetica, sans-serif">
                    <?php echo $article[4]; ?>
                </p>
            </div>
            <?php /* ?>
            <img src="<?php echo $plugin_url.'/server'; ?>/images/articles/<?php echo $article[2]; ?>" width="990" class="article_img">
			<?php */ ?>
            <img src="<?php echo $aaa[0]; ?>" width="990" class="article_img">

            <div style="width:990px;">
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.invedion.com"
                   data-lang="en"></a>
                <script>!function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "https://platform.twitter.com/widgets.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, "script", "twitter-wjs");</script>

                <iframe
                    src="http://www.facebook.com/plugins/like.php?href=http://invedion.com?id=<?php echo $article[0]; ?>&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=trebuchet+ms&amp;height=30"
                    scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:30px;"
                    class="fbl" allowTransparency="true"></iframe>

            </div>
            <div style="clear:both;"></div>
            <div class="article_txt">
                <p style="font-family: 'Trebuchet MS', Helvetica, sans-serif">
                    <?php //echo utf8_encode($article[5]);
                    ?>
                    <?php echo $article[5]; ?>
                </p>

                <div style="width:100%; height:30px;"></div>
                <?php
                define('AN', $art);

                class ImageFilter extends FilterIterator
                {
                    public function accept()
                    {
                        return preg_match('@\_' . AN . '_g.(gif|jpe?g|png)$@i', $this->current());
                    }
                }

                foreach (new ImageFilter(new DirectoryIterator('images/articles/')) as $img) {
                    ?>
                    <img
                        src="<?php echo $plugin_url . '/server'; ?>/images/articles/<?php echo $img; ?>"
                        style="margin-bottom:20px; width:100%;"/>
                <?php } ?>

            </div>
            <?php
            $catalo_id = $connect->query("SELECT term_taxonomy_id FROM " . $table_prefix . "term_relationships WHERE object_id = '$art'");
            $catalo_id_ = $catalo_id->fetch_row();
            ?>
            <?php /* ?>
			<a href="article_list.html?id=<?php echo $article[1]; ?>" class="article_back"></a>
			<?php */ ?>
            <a href="article_list.html?id=<?php echo $catalo_id_[0]; ?>" class="article_back"></a>

            <div style="clear:both;"></div>
            <div class="article_bg">
                <!-------------------------------------------------------------------------------------------------------->

                <?php
                $qm = $connect->query("SELECT * FROM nta_message WHERE id = '2' AND online = '1'");
                if ($qm->num_rows > 0) {

                    $sqm = $qm->fetch_row();
                    ?>
                    <a href="message.html?id=2" class="message_alert"
                       style="background-color:#<?php echo $sqm[1]; ?>; color:#<?php echo $sqm[2]; ?>;">
                        <div style="padding:20px;"><?php echo $sqm[3]; ?></div>
                    </a>
                    <?php
                }

                //$question = $connect->query("SELECT * FROM nta_article WHERE id_grid = '$id' AND online = '1' ORDER BY date DESC, id DESC LIMIT 10");
                $question = $connect->query("SELECT aa.id, bb.term_id,aa.post_status, aa.post_date, aa.post_title FROM " . $table_prefix . "posts aa, " . $table_prefix . "terms bb, " . $table_prefix . "term_relationships cc
		WHERE aa.id = cc.object_id 
		and cc.term_taxonomy_id = bb.term_id
		and aa.post_status = 'publish'
		and aa.post_type = 'post'
		and cc.term_taxonomy_id = '$id'
		ORDER BY RAND() LIMIT 10");
                for ($lp = 0; $rz = $question->fetch_row(); ++$lp) {
                    $tab[$lp] = $rz;
                }
                if ($question->num_rows > 0) {

                    $qe = $connect->query("SELECT article_effect FROM nta_grid WHERE id = '$id'");
                    $wqe = $qe->fetch_row();
                    ?>

                    <?php
                    foreach ($tab as $article) {

                        $title = substr($article[4], 0, 150);
                        $y = substr($article[3], 0, 4);
                        $m = substr($article[3], 5, 2);
                        $d = substr($article[3], 8, 2);

                        $que = $connect->query("SELECT guid FROM " . $table_prefix . "posts WHERE post_parent = '$article[0]' and post_type = 'attachment'");
                        $aaa = $que->fetch_row();
                        ?>


                        <div class='box'>
                            <div class="content"
                                 style="background:url(<?php echo $aaa[0]; ?>);background-size: 100% 100%;background-repeat: no-repeat;">
                                <a href="article.html?id=<?php echo $article[1]; ?>&art=<?php echo $article[0]; ?>">
                                    <div class="">
                                        <div class="category_bg_data"><?php echo $d; ?>.<?php echo $m; ?>.<?php echo $y; ?></div>
                                        <div class="category_bg_title">
                                            <p style="font-family: 'Trebuchet MS', Helvetica, sans-serif; width:50%;">
                                                <?php echo $title;
                                                if (strlen($title) == 150) {
                                                    echo "...";
                                                    echo $tab1[0];
                                                } ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div style="padding:20px 50px 20px 50px;"><p style="font-size:25em;">OOO</p></div>

                        <?php
                    }
                    ?>

                    <?php
                } else {
                    ?>
                    <div class="alert_bg">
                        <div style="padding:20px 50px 20px 50px;">No entries in this category</div>
                    </div>

                    <?php
                }
                ?>
                <!-------------------------------------------------------------------------------------------------------->
            </div>
        </div>
        <?php
    }
}
?>			
