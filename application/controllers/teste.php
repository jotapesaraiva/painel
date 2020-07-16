<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teste extends CI_Controller {

    public function __construct(){
        parent::__construct();
        init_painel();
		esta_logado();
    }

    public function index(){
        $this->init();
    }

public function init(){

        set_tema('titulo', 'Configuração do sistema');
        set_tema('conteudo', load_modulo('teste', 'principal'));
        load_template();

}

}

/* End of file settings.php  */
/* Location: ./aplication/controllers/settings.php */