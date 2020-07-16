<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auditoria extends CI_Controller {

    public function __construct(){
        parent::__construct();
        init_painel();
        esta_logado();
        $this->load->model('auditoria_model', 'auditoria');
    }

    public function index(){
        $this->gerenciar();
    }

public function gerenciar(){

        set_tema('footerinc', load_js(array('dataTable', 'table')), FALSE);
        set_tema('titulo', 'Registro de auditoria');
        set_tema('conteudo', load_modulo('auditoria', 'gerenciar'));
        load_template();

}

}

/* End of file auditoria.php  */
/* Location: ./aplication/controllers/auditoria.php */