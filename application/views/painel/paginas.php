
<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

switch ($tela) :

    case 'cadastrar':
        echo '<div class="small-12 columns">';
        echo breadcrumb();
        erros_validation();
        get_msg('msgok');
        get_msg('msgerro');
        echo form_open('paginas/cadastrar', array('class'=>'custom'));
        echo form_fieldset('Cadastrar nova pagina');
        echo '<div class="large-12 columns">';
        echo form_label('Titulo');
        echo form_input(array('name'=>'titulo'), set_value('titulo'), 'autofocus');
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo form_label('Slug');
        echo form_input(array('name'=>'slug'), set_value('slug'));
        echo form_label('Conteudo');
        echo form_textarea(array('id'=>'elm1', 'name'=>'conteudo', 'class'=>'htmleditor', 'rows'=>20), set_value('conteudo'));
        echo '</div>';
        echo '<div class="large-12 columns">';
        echo anchor('midia/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
        echo form_submit(array('name'=>'cadastrar', 'class'=>'button radius'), 'Publicar pagina');
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
                       <th>Título</th>
                       <th>Slug</th>
                       <th>Resumo</th>
                        <th>Ações</th>
                   </tr>
               </thead>
               <tbody>
                    <?php
                        $query = $this->paginas->get_all()->result();
                        foreach ($query as  $linha):
                            echo '<tr>';
                            printf('<td>%s</td>', $linha->titulo);
                            printf('<td>%s</td>', $linha->slug);
                            printf('<td>%s</td>', resumo_post($linha->conteudo, 10));
                            printf('<td class="text-center">%s%s</td>',
                             anchor("paginas/editar/$linha->id", ' ', array('class'=>'table-actions table-edit', 'title'=>'Editar')),
                             anchor("paginas/excluir/$linha->id", ' ', array('class'=>'table-actions table-delete deletareg', 'title'=>'Excluir')));
                            echo '</tr>';
                        endforeach;
                    ?>
               </tbody>
           </table>
        </div>
        <?php
        break;

case 'editar':
        $idpagina = $this->uri->segment(3);
        if ($idpagina==NULL):
            set_msg('msgerro', 'Escolha um pagina para alterar', 'erro');
            redirect('paginas/gerenciar');
        endif; ?>
        <div class="small-12 columns">
            <?php
                        $query = $this->paginas->get_byid($idpagina)->row();
                        echo breadcrumb();
                        erros_validation();
                        get_msg('msgok');
                        get_msg('msgerro');
                        echo form_open(current_url(), array('class'=>'custom'));
                        echo form_fieldset('Cadastrar nova pagina');
                        echo '<div class="large-12 columns">';
                        echo form_label('Titulo');
                        echo form_input(array('name'=>'titulo'), set_value('titulo', $query->titulo), 'autofocus');
                        echo '</div>';
                        echo '<div class="large-12 columns">';
                        echo form_label('Slug');
                        echo form_input(array('name'=>'slug'), set_value('slug', $query->slug));
                        echo anchor('#', 'Inserir imagens', 'data-reveal-id="myModal" class="addimg button tiny radius" ');
                        echo anchor('midia/cadastrar', 'Upload de imagens', 'target="_blank" class="button tiny secondary radius" ');
                        echo form_label('Conteudo');
                        echo form_textarea(array('id'=>'elm1', 'name'=>'conteudo', 'class'=>'htmleditor', 'rows'=>20), set_value('conteudo', to_html($query->conteudo)));
                        echo '</div>';
                        echo '<div class="large-12 columns">';
                        echo anchor('paginas/gerenciar', 'Cancelar', array('class'=>'button radius alert espaco'));
                        echo form_submit(array('name'=>'editar', 'class'=>'button radius'), 'Salvar dados');
                        echo form_hidden('idpagina', $query->id);
                        echo '</div>';
                        echo form_fieldset_close();
                        echo form_close();
            ?>
    </div>
        <?php
        incluir_arquivo('insertimg');
        break;


        default:
            echo '<div class="alert-box alert"><p>A tela solicitada não existe.</p></div>';
        break;
endswitch;