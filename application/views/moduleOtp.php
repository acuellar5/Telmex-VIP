<h1 id="como_vamos">¿Cómo vamos?</h1>

<?php 
// header('Content-Type: text/plain');
// print_r($ingenieros);
for ($i=0; $i < count($ingenieros); $i++) { 
    echo "<button class='accordion' data-iduser='".$ingenieros[$i]->k_id_user."'>".$ingenieros[$i]->nombre." <span class='glyphicon glyphicon-plus rigth'></span></button>";
    echo "<div class='panel'></div>";
}
 ?>


