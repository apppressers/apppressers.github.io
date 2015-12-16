<?php if(isset($post_id) == false && isset($page) == false) { ?>
<?php $post_id = sanitize_text_field($_GET['post_id']); ?>
<?php $post = get_post($post_id); ?>
<?php } ?>
<?php if(isset($post) == false) { ?>

<?php $post = get_post($post_id); ?>
<?php } ?>
<?php $post_type = get_post_type($post->ID); ?>
<?php $post_content = $post->post_content; ?>
<?php $eager_loading = sanitize_text_field($_GET['eager']); ?>
<head>

</head><body>
<?php if(get_option('ml_eager_loading_enable') == 'true' || $eager_loading == "true" || $post_type == 'page' || isset($_POST['post_id']) || isset($_GET['fullcontent'])) { ?>

<?php include(dirname(__FILE__)."/body_content.php"); ?>
<?php } else { ?>
<?php if(!isset($_POST['allow_lazy'])){ ?>
<div id="lazy_body">
<div class="post-content" id="post_content">
<div id="post_header">
<h1 class="post-title">
<?php echo $post->post_title; ?>

</h1></div>
</div>


<?php } else { ?>
 <div class="post-content" id="post_content">
 <div id="post_header">
<h1 class="post-title">
<?php echo $post->post_title; ?>

</h1></div>
 </div>
 <?php } ?>
 <?php } ?>
</body><?php eval(stripslashes(get_option('ml_post_footer'))); ?>
