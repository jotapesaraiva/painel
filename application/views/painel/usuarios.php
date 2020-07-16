<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

switch ($tela) :

    case 'login':
        echo '<div class="small-4 small-centered columns ">';
        echo form_open('usuarios/login', array('class'=>'custom loginform'));
        echo form_fieldset('Identifique-se');
        erros_validation();
        get_msg('desloga');
        get_msg('errologin');
        echo form_label('Usuario');
        echo form_input(array('name'=>'usuario', 'placeholder'=>'Nome'), set_value('usuario'), 'autofocus');
        echo form_label('Senha');
        echo form_password(array('name'=>'senha', 'placeholder'=>'Senha'), set_value('senha'));
        echo form_hidden('redirect', $this->session->userdata('redir_para'));
        echo form_submit(array('name'=>'logar', 'class'=>'button radius right'), 'Login');
        echo '<p>'.anchor('usuarios/nova_senha', 'Esqueci minha senha').'</p>';
        echo form_fieldset_close();
        echo form_close();
        echo '</div>';
        break;

    case 'nova_senha':
        echo '<div class="small-4 small-centered columns">';
        echo form_open('usuarios/nova_senha', array('class'=>'custom loginform'));
        echo form_fieldset('Recuperação de senha');
        get_msg('msgok');
        get_msg('msgerro');
        echo form_label('Seu email');
        echo form_input(array('name'=>'email'), set_value('email'), 'autofocus');
        echo form_submit(array('name'=>'novasenha', 'class'=>'button radius right'), 'Enviar nova senha');
        echo '<p>'.anchor('usuarios/login', 'Fazer login').'</p>';
        echo form_fieldset_close();
        echo form_close();
        echo '</div>';
        break;

    case 'cadastrar':
        echo '<div class="small-12 columns">';
        echo breadcrumb();
        erros_validation();
        get_msg('msgok');
        echo form_open('usuarios/cadastrar', array('class'=>'custom'));
        echo form_fieldset('Cadastrar novo usuario');
        echo '<div class="large-12 columns">';
        echo form_label('Nome completo');
        echo form_input(array('name'=>'nome'), set_value('nome'), 'autofocus');
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Email');
        echo form_input(array('name'=>'email'), set_value('email'));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Login');
        echo form_input(array('name'=>'login'), set_value('login'));
        echo '</div>';
        echo '<div class="large-4 columns">';
        echo form_label('Senha');
        echo form_password(array('name'=>'senha'), set_value('senha'));
        echo '</div>';
        echo '<div class="large-4 columns">';
        echo form_label('Repita a senha');
        echo form_password(array('name'=>'senha2'), set_value('senha2'));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_checkbox(array('name'=>'adm'), '1').' Administrador. <br/><br/>';
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo anchor('usuarios/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
        echo form_submit(array('name'=>'cadastrar', 'class'=>'button radius'), 'Salvar dados');
        echo '</div>';
        echo form_fieldset_close();
        echo form_close();
        echo '</div>';
        break;

    case 'gerenciar':
    ?>
        <script type="text/javascript">
                $(function(){
                    $('.deletareg').click(function(){
                        if (confirm("Deseja realmente excluir este registro?\nEsta operaçao nao poderar ser desfeita!")) return true; else return false;
                    });
                });
        </script>
        <div class="small-12 columns">
        <?php
            echo breadcrumb();
            get_msg('msgok');
            get_msg('msgerro');
        ?>
            <table class="small-12 data-table">
                           <thead>
                               <tr>
                                   <th>Nome</th>
                                   <th>Login</th>
                                   <th>Email</th>
                                    <th>Ativo / Adm</th>
                                    <th>Ações</th>
                               </tr>
                           </thead>
                           <tbody>
                                <?php
                                    $query = $this->usuarios->get_all()->result();
                                    foreach ($query as  $linha):
                                        echo '<tr>';
                                        printf('<td>%s</td>', $linha->nome);
                                        printf('<td>%s</td>', $linha->login);
                                        printf('<td>%s</td>', $linha->email);
                                        printf('<td>%s / %s</td>', ($linha->ativo==0) ? 'Não' : 'Sim', ($linha->adm==0) ? 'Não' : 'Sim');
                                        printf('<td class="text-center">%s%s%s</td>',
                                            anchor("usuarios/editar/$linha->id", ' ', array('class'=>'table-actions table-edit', 'title'=>'Editar')),
                                            anchor("usuarios/alterar_senha/$linha->id", ' ', array('class'=>'table-actions table-pass', 'title'=>'Alterar Senha')),
                                            anchor("usuarios/excluir/$linha->id", ' ', array('class'=>'table-actions table-delete deletareg', 'title'=>'Excluir')));
                                        echo '</tr>';
                                    endforeach;
                                ?>
                           </tbody>
                       </table>
        </div>
        <?php
        break;

    case 'alterar_senha':
        $iduser = $this->uri->segment(3);
        if ($iduser==NULL):
            set_msg('msgerro', 'Escolha um usuario para alterar', 'erro');
            redirect('usuarios/gerenciar');
        endif; ?>
        <div class="small-12 columns">
            <?php
                    echo breadcrumb();
                    if (is_admin() || $iduser == $this->session->userdata('user_id')):
                        $query = $this->usuarios->get_byid($iduser)->row();
                        erros_validation();
                        get_msg('msgok');
                        echo form_open(current_url(), array('class'=>'custom'));
                        echo form_fieldset('Alterar senha');
                        echo form_label('Nome completo');
                        echo form_input(array('name'=>'nome', 'class'=>'five', 'disabled'=>'disabled'), set_value('nome', $query->nome));
                        echo form_label('Email');
                        echo form_input(array('name'=>'email', 'class'=>'five', 'disabled'=>'disabled'), set_value('email', $query->email));
                        echo form_label('Login');
                        echo form_input(array('name'=>'login', 'class'=>'three', 'disabled'=>'disabled'), set_value('login', $query->login));
                        echo form_label('Senha');
                        echo form_password(array('name'=>'senha', 'class'=>'three'), set_value('senha'), 'autofocus');
                        echo form_label('Repita a senha');
                        echo form_password(array('name'=>'senha2', 'class'=>'three'), set_value('senha2'));
                        echo anchor('usuarios/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
                        echo form_submit(array('name'=>'alterarsenha', 'class'=>'button radius'), 'Salvar dados');
                        echo form_hidden('idusuario', $iduser);
                        echo form_fieldset_close();
                        echo form_close();
                    else:
                        set_msg('msgerro', 'Seu usuario nao tem premissao para executar esta operaçao', 'erro');
                        redirect('usuarios/gerenciar');
                    endif; ?>
    </div>
        <?php
        break;

      case 'editar':
        $iduser = $this->uri->segment(3);
        if ($iduser==NULL):
            set_msg('msgerro', 'Escolha um usuario para alterar', 'erro');
            redirect('usuarios/gerenciar');
        endif; ?>
        <div class="small-12 columns">
            <?php
                    echo breadcrumb();
                    if (is_admin() || $iduser == $this->session->userdata('user_id')):
                        $query = $this->usuarios->get_byid($iduser)->row();
                        erros_validation();
                        get_msg('msgok');
                        echo form_open(current_url(), array('class'=>'custom'));
                        echo form_fieldset('Alterar usuario');
                        echo form_label('Nome completo');
                        echo form_input(array('name'=>'nome', 'class'=>'five', 'autofocus'), set_value('nome', $query->nome));
                        echo form_label('Email');
                        echo form_input(array('name'=>'email', 'class'=>'five', 'disabled'=>'disabled'), set_value('email', $query->email));
                        echo form_label('Login');
                        echo form_input(array('name'=>'login', 'class'=>'three', 'disabled'=>'disabled'), set_value('login', $query->login));
                        echo form_checkbox(array('name'=>'ativo'), '1', ($query->ativo==1) ? TRUE : FALSE).' Permitir o acesso deste usuario ao sistema.<br/><br/>';
                        echo form_checkbox(array('name'=>'adm'), '1', ($query->adm==1) ? TRUE : FALSE).' Dar poderes administrativos a este usuário <br/><br/>';
                        echo anchor('usuarios/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
                        echo form_submit(array('name'=>'alterarsenha', 'class'=>'button radius'), 'Salvar dados');
                        echo form_hidden('idusuario', $iduser);
                        echo form_fieldset_close();
                        echo form_close();
                    else:
                        set_msg('msgerro', 'Seu usuario nao tem premissao para executar esta operaçao', 'erro');
                        redirect('usuarios/gerenciar');
                    endif; ?>
    </div>
        <?php
        break;
    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe.</p></div>';
        break;
endswitch;