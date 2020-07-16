<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

switch ($tela) :

    case 'gerenciar':
        echo '<div class="small-12 columns">';
        echo breadcrumb();
        erros_validation();
        get_msg('msgok');
        get_msg('msgerro');
        echo form_open('settings/gerenciar', array('class'=>'custom'));
        echo form_fieldset('Configuração do sistema');
        echo '<div class="large-12 columns">';
        echo form_label('Nome do site');
        echo form_input(array('name'=>'nome_site'), set_value('nome_site', get_setting('nome_site')), 'autofocus');
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('URL da logomarca');
        echo form_input(array('name'=>'url_logomarca'), set_value('url_logomarca', get_setting('url_logomarca')));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Email do administrador');
        echo form_input(array('name'=>'email_adm'), set_value('email_adm', get_setting('email_adm')));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_submit(array('name'=>'salvardados', 'class'=>'button radius'), 'Salvar Configuração');
        echo '</div>';
        echo form_fieldset_close();
        echo form_close();
        echo '</div>';
        break;

    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe.</p></div>';
        break;
endswitch;