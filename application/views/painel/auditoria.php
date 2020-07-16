<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

switch ($tela) :

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
            $modo = $this->uri->segment(3);
            if ($modo== 'all'):
                $limite = 0;
            else:
                $limite = 50;
                echo '<p>Mostrando os últimos 50 registros, para ver todo histórico '.anchor('auditoria/gerenciar/all', 'clique aqui.').'</p>';
            endif;
        ?>
            <table class="small-12 data-table">
               <thead>
                   <tr>
                       <th>Usuário</th>
                       <th>Data e Hora</th>
                       <th>Operação</th>
                        <th>Observarção</th>
                   </tr>
               </thead>
               <tbody>
                    <?php
                        $query = $this->auditoria->get_all($limite)->result();
                        foreach ($query as  $linha):
                            echo '<tr>';
                            printf('<td>%s</td>', $linha->usuario);
                            printf('<td>%s</td>', date('d/m/Y H:i:s', strtotime($linha->data_hora)));
                            printf('<td>%s</td>', '<span data-tooltip aria-haspopup="true" class="has-tip tip-top radius round" title=" '.$linha->query.' ">'.$linha->operacao.'</span>');
                            printf('<td>%s</td>', $linha->observacao);
                            echo '</tr>';
                        endforeach;
                    ?>
               </tbody>
           </table>
        </div>
        <?php
        break;
        default:
            echo '<div class="alert-box alert"><p>A tela solicitada não existe.</p></div>';
        break;
endswitch;