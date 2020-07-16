<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct(){
        parent::__construct();
        init_painel();
        esta_logado();
        $this->load->model('settings_model', 'settings');
    }

    public function index(){
        $this->gerenciar();
    }

public function gerenciar(){

        if ($this->input->post('salvardados')):
            if ( is_admin(TRUE)):
                $settings = elements(array('nome_site', 'url_logomarca', 'email_adm'), $this->input->post());
                foreach ($settings as $nome_config => $valor_config) :
                    set_settings($nome_config, $valor_config);
                endforeach;
                set_msg('msgok', 'Configurações  atualizadas  com sucesso', 'sucesso');
                redirect('settings/gerenciar');
            else:
                redirect('settings/gerenciar');
            endif;
        endif;

        set_tema('titulo', 'Configuração do sistema');
        set_tema('conteudo', load_modulo('settings', 'gerenciar'));
        load_template();

}

}

/* End of file settings.php  */
/* Location: ./aplication/controllers/settings.php */