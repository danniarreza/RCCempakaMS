

<!-- Script Sources Here -->

<?php foreach((empty($scriptsrc) ? array() : $scriptsrc) as $url){ 
  echo '<script src="'. $url .'"></script>'; 
}
?>