
<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

switch ($tela) :

    case 'cadastrar':
        echo '<div class="small-12 columns">';
        echo breadcrumb();
        erros_validation();
        get_msg('msgok');
        get_msg('msgerro');
        echo form_open_multipart('midia/cadastrar', array('class'=>'custom'));
        echo form_fieldset('Upload de midia');
        echo '<div class="large-12 columns">';
        echo form_label('Nome do arquivo');
        echo form_input(array('name'=>'nome'), set_value('nome'), 'autofocus');
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Descrição');
        echo form_input(array('name'=>'descricao'), set_value('descricao'));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Arquivo');
        echo form_upload(array('name'=>'arquivo'), set_value('arquivo'));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo anchor('midia/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
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
                    $('input').click(function(){
                        (this).select();
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
                       <th>Link</th>
                       <th>Miniatura</th>
                        <th>Ações</th>
                   </tr>
               </thead>
               <tbody>
                    <?php
                        $query = $this->midia->get_all()->result();
                        foreach ($query as  $linha):
                            echo '<tr>';
                            printf('<td>%s</td>', $linha->nome);
                            printf('<td><input type="text" value="%s" /></td>', base_url("uploads/$linha->arquivo"));
                            printf('<td>%s</td>', thumb($linha->arquivo));
                            printf('<td class="text-center">%s%s%s</td>',
                                            anchor("uploads/$linha->arquivo", ' ', array('class'=>'table-actions table-view', 'title'=>'Visualizar', 'target'=>'_blank')),
                                            anchor("midia/editar/$linha->id", ' ', array('class'=>'table-actions table-edit', 'title'=>'Editar')),
                                            anchor("midia/excluir/$linha->id", ' ', array('class'=>'table-actions table-delete deletareg', 'title'=>'Excluir')));
                            echo '</tr>';
                        endforeach;
                    ?>
               </tbody>
           </table>
        </div>
        <?php
        break;

case 'editar':
        $idmidia = $this->uri->segment(3);
        if ($idmidia==NULL):
            set_msg('msgerro', 'Escolha um midia para alterar', 'erro');
            redirect('midia/gerenciar');
        endif; ?>
        <div class="small-12 columns">
            <?php
                    echo breadcrumb();
                        $query = $this->midia->get_byid($idmidia)->row();
                        erros_validation();
                        get_msg('msgok');

                        echo form_open(current_url(), array('class'=>'custom'));
                        echo form_fieldset('Alteração de midia');
                        echo '<div class="row">';
                        echo '<div class="large-6 columns">';
                        echo form_label('Nome do arquivo');
                        echo form_input(array('name'=>'nome'), set_value('nome', $query->nome), 'autofocus');
                        echo form_label('Descrição');
                        echo form_input(array('name'=>'descricao'), set_value('descricao', $query->descricao));
                        echo '</div>';
                        echo '<div  class="large-5 large-offset-1 columns">';
                        echo thumb($query->arquivo, 300, 180);
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="large-12 columns">';
                        echo anchor('midia/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
                        echo form_submit(array('name'=>'editar', 'class'=>'button radius'), 'Salvar dados');
                        echo form_hidden('idmidia', $query->id);
                        echo '</div>';
                        echo form_fieldset_close();
                        echo form_close();
            ?>
    </div>
        <?php
        break;


        default:
            echo '<div class="alert-box alert"><p>A tela solicitada não existe.</p></div>';
        break;
endswitch;