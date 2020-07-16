<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

switch ($tela) :

    case 'principal':
        echo 'TESTE OK';

        break;

    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe.</p></div>';
        break;
endswitch;