<?php

class Orcamento
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function orcamentos($where, $p_inicio=null, $quantidade=null){
        $this->db->query("SELECT * FROM orcamentos $where ORDER BY data_orc DESC, hora_orc DESC LIMIT $p_inicio, $quantidade");
        return $this->db->resultados();
    }

    public function numeroOrcamentos($where){
        $this->db->query("SELECT * FROM orcamentos $where");
        return count($this->db->resultados());
    }

    public function orcamentoPeloId($id){
        $this->db->query("SELECT * FROM orcamentos WHERE id = :id");
        $this->db->bind("id", $id);
        return $this->db->resultado();
    }

    public function incluir($dados)
    {
        $this->db->query("INSERT INTO orcamentos (cliente, data_orc, hora_orc, vendedor, descricao, valor) VALUES (:cliente, :data_orc, :hora_orc, :vendedor, :descricao, :valor)");
        
        $this->db->bind("cliente", $dados['cliente']);
        $this->db->bind("data_orc", $dados['data_orc']);
        $this->db->bind("hora_orc", $dados['hora_orc']);
        $this->db->bind("vendedor", $dados['vendedor']);
        $this->db->bind("descricao", $dados['descricao']);
        $this->db->bind("valor", $dados['valor']);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }

    public function editar($dados)
    {
        $this->db->query("UPDATE orcamentos SET cliente = :cliente, data_orc = :data_orc, hora_orc = :hora_orc, vendedor = :vendedor, descricao = :descricao, valor = :valor WHERE id = :id");

        $this->db->bind("cliente", $dados['cliente']);
        $this->db->bind("data_orc", $dados['data_orc']);
        $this->db->bind("hora_orc", $dados['hora_orc']);
        $this->db->bind("vendedor", $dados['vendedor']);
        $this->db->bind("descricao", $dados['descricao']);
        $this->db->bind("valor", $dados['valor']);
        $this->db->bind("id", $dados['id']);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }

    public function remover($id)
    {
        $this->db->query("DELETE FROM orcamentos WHERE id = :id");
        $this->db->bind("id", $id);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }
}
