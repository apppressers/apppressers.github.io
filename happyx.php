<?php
/*
Plugin Name: WPBlog 2 Android App Code Canyon
Plugin URI: http://easily-convert-wordpress-sites-into-mobile-apps.xyz
Description: Turn wp to Android
Version: 0.8.4
Author: MonleeCode Canyon
Author URI: http://easily-convert-wordpress-sites-into-mobile-apps.xyz
*/
// echo "<div class='updated'>Test Plugin Notice</div>";

register_activation_hook(__FILE__, 'myxname_plugin_activation');


function myxname_plugin_activation() {
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();

  /*create table*/
  
  /*if($wpdb->get_var("SHOW TABLES LIKE 'nta_admin'") != 'nta_admin') {
      $sql = "CREATE TABLE nta_admin (
        name varchar(20) NOT NULL PRIMARY KEY,
        pass varchar(255) NOT NULL
      ) $charset_collate ;";
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
      $wpdb->insert( 
        'nta_admin', 
        array( 
          'name' => 'admin', 
          'pass' => '7110eda4d09e062aa5e4a390b0a572ac0d2c0220' , 
        ) 
      );
  }

  if($wpdb->get_var("SHOW TABLES LIKE 'nta_article'") != 'nta_article') {
      $sql = "CREATE TABLE nta_article (
        id int(11) NOT NULL,
        id_grid int(11) NOT NULL,
        photo varchar(255) NOT NULL,
        date date NOT NULL,
        title varchar(255) NOT NULL,
        information text NOT NULL,
        online int(11) NOT NULL
      ) $charset_collate ;";
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );

  }*/


  $filename = plugin_dir_path( __FILE__ ).'sql.sql';
  $mysql_host = DB_HOST;
  $mysql_username = DB_USER;
  $mysql_password = DB_PASSWORD;
  $mysql_database = DB_NAME;
  mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
  mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());
  $templine = '';
  $lines = file($filename);
  foreach ($lines as $line)
  {
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;
    $templine .= $line;
    if (substr(trim($line), -1, 1) == ';')
    {
        mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
        $templine = '';
    }
  }





  /*END create table*/

  $content = '<?';
  $content .= ' function dataxnam_base(){ ';
  $content .= ' $iba = new mysqli("'.DB_HOST.'", "'.DB_USER.'","'.DB_PASSWORD.'" ,"'.DB_NAME.'" ); ';
  $content .= ' if (!$iba) ';
  $content .= ' throw new Exception("Error..."); ';
  $content .= ' else ';
  $content .= ' return $iba; ';
  $content .= ' } ';
  $content .= ' $base_url = "'.get_bloginfo('wpurl').'"; ';
  $content .= ' $table_prefix = "'.$wpdb->prefix.'"; ';
  $content .= ' ?> ';

   // write into function.php
  $myfile = fopen(plugin_dir_path( __FILE__ )."server/function.php", "w") or die("Unable to open file!");
  fwrite($myfile, $content);
  fclose($myfile);

  $db2 =' <?php 
  function lacz_bd()
  {
     $wynik = new mysqli("'.DB_HOST.'", "'.DB_USER.'", "'.DB_PASSWORD.'", "'.DB_NAME.'");
     if (!$wynik)
        throw new Exception("Error...Please try again later...");
     else
        return $wynik;
  }
  $base_url = "'.get_bloginfo('wpurl').'";
  $plugin_url = "'.plugin_dir_url( __FILE__ ).'";
      $table_prefix = "'.$wpdb->prefix.'";
   ';

  ;

  // write into admin_nta/db.php

  $myfile2 = fopen(plugin_dir_path( __FILE__ )."server/admin_nta/db.php", "w") or die("Unable to open file!");
  fwrite($myfile2, $db2);
  fclose($myfile2);


  // write for android html

  $js = 'var url = "'.plugin_dir_url( __FILE__ ).'";';
 
  $myfile3 = fopen(plugin_dir_path( __FILE__ )."android/base_url.js", "w") or die("Unable to open file!");
  fwrite($myfile3, $js);
  fclose($myfile3);

}

// function to drop extra table when deactive plugin
function my_plugin_deactivation(){
  global $wpdb;
  $table = ['nta_admin','nta_article','nta_grid','nta_grid_photo','nta_message'];
  foreach ($table as $t) {
    $wpdb->query("DROP TABLE IF EXISTS $t");
  }
}

function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}





add_action('admin_menu', 'register_my_custom_submenu_page');
function register_my_custom_submenu_page() {
  add_submenu_page( 'options-general.php', 'Turn WP to Android', 'Turn WP to Android', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' );
}

function my_custom_submenu_page_callback() {
  
    if(isset($_POST['createzip'])){
    Zip(plugin_dir_path( __FILE__ ).'android', plugin_dir_path( __FILE__ ).'android-'.date('d-m-Y').'.zip');
    echo '
    <div id="setting-error-settings_updated" class="updated settings-error"> 
<p><strong>Create success. <a href="'. plugin_dir_url( __FILE__ ).'android-'.date('d-m-Y').'.zip">Click here to download</a></strong></p></div>
    ';
  }
?>
  <div class="wrap"><div id="icon-tools" class="icon32"></div>
<h2>WPBlog 2 Android App Code Canyon</h2>

  Free version:<br>
- Support Only Uncategory, Upgrade to Pro to Get all category <br>
- Get 10 lastest post from Uncategory, Pro Version to Get all post <br>
<br>
Pro version:<br>
- Pro to Get all category<br>
- Pro Version to Get all post from your wordpress<br>
- Search Function <br>
- Abmod Ready    <br>
</p>

<h2>2. Create APK source code</h2>
<form action="" method="post">
      <input type="submit" class="btn" name="createzip" value="Create APK File">
    </form>
Click create apk file to create APK source code for your website. After Create apk .Zip File, upload to  <a href="https://build.phonegap.com/">Phonegap Free APP build tool</a> . Then you get your app, ready to upload to Google Play.
	
<br>
<br>	.<br>.	 <br>	 .<br>	 .<br>


1. Buy and download Plugin from webiste (By direct on http://wordpress-mobile-app-plugin.xyz )<br/>

2. Upload Plugin to your wordpress<br/>

3. Active Plugin <br/>

&nbsp;<br/>

4. Create APP File (Go to Wordpress setting&gt;turn WP to Android) - Click on Create apk zip file to create Androd code for your site)<br/>

Download Android source code<br/>

5. Build android app, by using PhoneGap Build, upload zip file that yous has just been download to PhoneGap ( see how to create account on phoneGap and how to build app on video)<br/>


&nbsp;<br/>

6. Press Build APP and download to get Adroid APK file.<br/>

7. Upload to google Play or test on your phone.<br/>

8.Finish<br/>
  </div>
<?php
}