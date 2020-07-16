<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

switch ($tela) :

    case 'grafico':

    ?>
        <div class="small-12 columns">
			<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
		</div>
    <?php
        break;
    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe.</p></div>';
        break;
endswitch;
