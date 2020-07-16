<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

switch ($tela) :

    case 'instalar':
        echo '<div class="small-6 columns centered">';
        echo '<h4 class="text-center">Instalação do Sistema</h4>';
        erros_validation();
        echo form_open('instalar', array('class'=>'custom'));
        echo form_fieldset('Configurações gerais');
        echo '<div class="large-12 columns">';
        echo form_label('URL de instalação');
        echo form_input(array('name'=>'url_base'), set_value('url_base', str_replace('instalar', ' ', current_url())), 'autofocus');
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Chave de segurança');
        echo form_input(array('name'=>'chave_seguranca'), set_value('chave_seguranca', md5(time())));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Tempo da sessão');
        echo form_input(array('name'=>'tempo_sessao'), set_value('tempo_sessao', 3600));
        echo '</div>';
        echo form_fieldset_close();


        echo form_fieldset('Banco de dados');
        echo '<div class="large-12 columns">';
        echo form_label('Servidor');
        echo form_input(array('name'=>'hostname'), set_value('hostname', 'localhost'));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Usuario');
        echo form_input(array('name'=>'username'), set_value('username', 'root'));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Senha');
        echo form_input(array('name'=>'password'), set_value('password'));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Nome do BD');
        echo form_input(array('name'=>'database'), set_value('databse'));
        echo '</div>';
        echo form_fieldset_close();


        echo form_fieldset('Usuario administrador');
        echo '<div class="large-12 columns">';
        echo form_label('Nome completo');
        echo form_input(array('name'=>'use_nome'), set_value('use_nome'));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Email');
        echo form_input(array('name'=>'user_email'), set_value('user_email'));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Login');
        echo form_input(array('name'=>'user_login'), set_value('user_login'));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Senha');
        echo form_input(array('name'=>'user_senha'), set_value('user_senha'));
        echo '</div>';
        echo form_fieldset_close();


        echo '<div class="large-12 columns">';
        echo form_submit(array('name'=>'instalar', 'class'=>'button radius right'), 'Instalar o Sistema');
        echo '</div>';
        echo form_close();
        echo '</div>';
        break;

    case 'sucesso':
    ?>
        <div class="small-6 columns centered" style="margin-top: 50px;">
            <div class="panel">
                <h6>Instalação concluida!</h6>
                <p>O sistema foi instalado com sucesso.</p>
                <a href="<?php echo base_url('usuarios/login') ?>" class="button radius success">Fazer login</a>
            </div>
        </div>
        <?php
        break;

    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe.</p></div>';
        break;
endswitch;