<?php

class Orcamentos extends Controller
{
    public function __construct()
    {
        $this->orcamentoModel = $this->model('Orcamento');
    }

    public function dashboard()
    {
        $inicio = filter_input(INPUT_GET, 'inicio');
        $fim = filter_input(INPUT_GET, 'fim');
        $cliente = filter_input(INPUT_GET, 'cliente', FILTER_SANITIZE_STRING);
        $vendedor = filter_input(INPUT_GET, 'vendedor', FILTER_SANITIZE_STRING);

        $cliente_sql = strlen($cliente) ? 'cliente LIKE "%' . str_replace(' ', '%', $cliente) . '%"' : 'cliente LIKE "%%"';
        $vendedor_sql = strlen($vendedor) ? 'vendedor LIKE "%' . str_replace(' ', '%', $vendedor) . '%"' : 'vendedor LIKE "%%"';

        $where = 'WHERE ' . $cliente_sql . ' AND ' . $vendedor_sql . ($inicio ? ' AND data_orc >= "' . $inicio . '"' : null) . ($fim ? ' AND data_orc <= "' . $fim . '"' : null);

        $quantidade = 10;
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $p_inicio = $quantidade * $pagina - $quantidade;

        $dados = [
            'pagina' => $pagina,
            'numero' => $this->orcamentoModel->numeroOrcamentos($where),
            'orcamentos' => $this->orcamentoModel->orcamentos($where, $p_inicio, $quantidade),
            'inicio' => $inicio,
            'fim' => $fim,
            'cliente' => $cliente,
            'vendedor' => $vendedor,
        ];

        $dados += [
            'totalPaginas' => ceil(($dados['numero']) / $quantidade)
        ];

        $this->view('orcamentos/dashboard', $dados);
    }

    public function ver($id)
    {
        $orcamento = $this->orcamentoModel->orcamentoPeloId($id);

        $dados = [
            'orcamento' => $orcamento
        ];

        $this->view('orcamentos/ver', $dados);
    }

    public function remover($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($this->orcamentoModel->remover($id)) :
            Sessao::mensagem('orcamento', 'bi bi-check-circle-fill flex-shrink-0 me-1', 'Orçamento removido com sucesso!', 'alert alert-success d-flex align-items-center alert-dismissible fade show');
        else :
            Sessao::mensagem('orcamento', null, 'Ocorreu um erro ao remover esse orçamento. Tente novamente!', null);
        endif;

        URL::redirecionar('orcamentos/dashboard');
    }

    public function editar($id)
    {
        $orcamento = $this->orcamentoModel->orcamentoPeloId($id);
        $dados = [
            'orcamento' => $orcamento
        ];

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $erro = 0;
            $dados = [
                'cliente' => trim($formulario['cliente']),
                'data_orc' => trim($formulario['data_orc']),
                'hora_orc' => trim($formulario['hora_orc']),
                'vendedor' => trim($formulario['vendedor']),
                'descricao' => trim($formulario['descricao']),
                'valor' => trim($formulario['valor']),
                'id' => $id,
            ];

            if (empty($formulario['cliente'])) :
                $dados['cliente_erro'] = 'Preencha o campo cliente.';
                $erro++;
            elseif (strlen($formulario['cliente']) > 255) :
                $dados['cliente_erro'] = 'Limite de caracteres excedido.';
                $erro++;
            endif;

            if (empty($formulario['data_orc'])) :
                $dados['data_orc_erro'] = 'Preencha o campo data.';
                $erro++;
            endif;

            if (empty($formulario['hora_orc'])) :
                $dados['hora_orc_erro'] = 'Preencha o campo hora.';
                $erro++;
            endif;

            if (empty($formulario['vendedor'])) :
                $dados['vendedor_erro'] = 'Preencha o campo vendedor.';
                $erro++;
            elseif (strlen($formulario['vendedor']) > 255) :
                $dados['vendedor_erro'] = 'Limite de caracteres excedido.';
                $erro++;
            endif;

            if (empty($formulario['descricao'])) :
                $dados['descricao_erro'] = 'Preencha o campo descrição.';
                $erro++;
            endif;

            if (empty($formulario['valor'])) :
                $dados['valor_erro'] = 'Preencha o campo valor.';
                $erro++;
            endif;

            if ($erro == 0) :
                if ($this->orcamentoModel->editar($dados)) :
                    Sessao::mensagem('orcamento', 'bi bi-check-circle-fill flex-shrink-0 me-1', 'Orçamento editado com sucesso!', 'alert alert-success d-flex align-items-center alert-dismissible fade show');
                    $orcamento = $this->orcamentoModel->orcamentoPeloId($id);
                    $dados = [
                        'orcamento' => $orcamento
                    ];
                else :
                    Sessao::mensagem('orcamento', null, 'Oocrreu um erro ao editar esse orçamento. Tente novamente!', null);
                endif;
            else :
                $dados += [
                    'orcamento' => $orcamento
                ];
            endif;
        endif;

        $this->view('orcamentos/editar', $dados);
    }

    public function cadastrar()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $erro = 0;
            $dados = [
                'cliente' => trim($formulario['cliente']),
                'data_orc' => trim($formulario['data_orc']),
                'hora_orc' => trim($formulario['hora_orc']),
                'vendedor' => trim($formulario['vendedor']),
                'descricao' => trim($formulario['descricao']),
                'valor' => trim($formulario['valor']),
            ];

            if (empty($formulario['cliente'])) :
                $dados['cliente_erro'] = 'Preencha o campo cliente.';
                $erro++;
            elseif (strlen($formulario['cliente']) > 255) :
                $dados['cliente_erro'] = 'Limite de caracteres excedido.';
                $erro++;
            endif;

            if (empty($formulario['data_orc'])) :
                $dados['data_orc_erro'] = 'Preencha o campo data.';
                $erro++;
            endif;

            if (empty($formulario['hora_orc'])) :
                $dados['hora_orc_erro'] = 'Preencha o campo hora.';
                $erro++;
            endif;

            if (empty($formulario['vendedor'])) :
                $dados['vendedor_erro'] = 'Preencha o campo vendedor.';
                $erro++;
            elseif (strlen($formulario['vendedor']) > 255) :
                $dados['vendedor_erro'] = 'Limite de caracteres excedido.';
                $erro++;
            endif;

            if (empty($formulario['descricao'])) :
                $dados['descricao_erro'] = 'Preencha o campo descrição.';
                $erro++;
            endif;

            if (empty($formulario['valor'])) :
                $dados['valor_erro'] = 'Preencha o campo valor.';
                $erro++;
            elseif (is_numeric($formulario['valor']) == false) :
                $dados['valor_erro'] = 'Preencha um valor válido. Utilize ponto para separar as casas decimais.';
                $erro++;
            endif;

            if ($erro == 0) :
                if ($this->orcamentoModel->incluir($dados)) :
                    Sessao::mensagem('orcamento', 'bi bi-check-circle-fill flex-shrink-0 me-1', 'Orçamento cadastrado com sucesso!', 'alert alert-success d-flex align-items-center alert-dismissible fade show');
                    
                else :
                    Sessao::mensagem('orcamento', null, 'Oocrreu um erro ao cadastrar esse orçamento. Tente novamente!', null);
                endif;
            endif;

        else :
            $dados = [
                'id' => '',
                'cliente' => '',
                'data' => '',
                'hora' => '',
                'vendedor' => '',
                'descricao' => '',
                'valor' => '',
            ];
        endif;

        $this->view('orcamentos/cadastrar', $dados);
    }
}
