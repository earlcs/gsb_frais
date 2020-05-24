<div class ="erreur">
<ul>
<?php 
foreach($_REQUEST['erreurs'] as $erreur)
	{
    if(isset($type)){
        echo "<li style='background:#D5EF9A' color:#7EA12C>$erreur</li>";
    }
 else { 
        
      echo "<li>$erreur</li>";
 }
	}
?>
</ul></div>
