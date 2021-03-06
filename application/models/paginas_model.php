<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paginas_model extends CI_Model{

    public function do_insert($dados=NULL, $redir=TRUE){
        if ($dados != NULL):
            $this->db->insert('paginas', $dados);
            if ($this->db->affected_rows()>0):
                auditoria('Inclusao de pagina','Nova pagina cadastrada no sistema');
                set_msg('msgok', 'Cadastro efetuado com sucesso', 'sucesso');
            else:
                set_msg('msgerro','Erro ao inserir dados','erro');
            endif;
            if ($redir) redirect(current_url());
        endif;
    }

     public function do_update($dados=NULL, $condicao=NULL, $redir=TRUE){
        if ($dados != NULL && is_array($condicao)):
            $this->db->update('paginas', $dados, $condicao);
            if ($this->db->affected_rows()>0):
                auditoria('Alteração de pagina', 'A pagina de id " '.$condicao['id'].' " foi alterada.');
                set_msg('msgok', 'Alteração efetuada com sucesso', 'sucesso');
            else:
                set_msg('msgerro','Erro ao alterar dados','erro');
            endif;
            if ($redir) redirect(current_url());
        endif;
    }

    public function do_delete($condicao=NULL, $redir=TRUE){
        if ($condicao != NULL && is_array($condicao)):
            $this->db->delete('paginas', $condicao);
            if ($this->db->affected_rows()>0):
                auditoria('Exclusão de pagina', 'A pagina de id " '.$condicao['id'].' " foi excluida.');
                set_msg('msgok','Registro excluido com sucesso','sucesso');
            else:
                set_msg('msgerro','Erro ao excluir registro','erro');
            endif;
            if ($redir) redirect(current_url());
        endif;
    }

    public function get_all(){
        return $this->db->get('paginas');
    }

    public function get_byid($id=NULL){
        if ($id != NULL):
            $this->db->where('id', $id);
            $this->db->limit(1);
            return $this->db->get('paginas');
        else:
            return FALSE;
        endif;
    }

}


/* End of file paginas_model.php  */
/* Location: ./aplication/models/paginas_model.php */