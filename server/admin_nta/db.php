 <?php 
  function lacz_bd()
  {
     $wynik = new mysqli("127.0.0.1", "root", "", "wepro");
     if (!$wynik)
        throw new Exception("Error...Please try again later...");
     else
        return $wynik;
  }
  $base_url = "http://example.com";
  $plugin_url = "http://example.com";
      $table_prefix = "wp_";
   