<section class="w-75 mx-auto" style="min-height: 100vh;">
    <nav class="my-4 p-2 pt-3 px-4 bg-light rounded border">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/orcamentos/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ver</li>
        </ol>
    </nav>
    <?php if ($dados['orcamento'] == null) : ?>
        <p class="text-center">Nenhum orçamento encontrado!</p>
    <?php else : ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="col">ID</th>
                        <td><?= $dados['orcamento']->id ?></td>
                    </tr>
                    <tr>
                        <th scope="col">Cliente</th>
                        <td><?= $dados['orcamento']->cliente ?></td>
                    </tr>
                    <tr>
                        <th scope="col">Data</th>
                        <td><?= date('d/m/Y', strtotime($dados['orcamento']->data_orc)) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">Hora</th>
                        <td><?= date('h:i', strtotime($dados['orcamento']->hora_orc)) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">Vendedor</th>
                        <td><?= $dados['orcamento']->vendedor ?></td>
                    </tr>
                    <tr>
                        <th scope="col">Descrição</th>
                        <td><?= $dados['orcamento']->descricao ?></td>
                    </tr>
                    <tr>
                        <th scope="col">Valor</th>
                        <td>R$<?= number_format($dados['orcamento']->valor, 2, '.', '') ?></td>
                    </tr>
                    <tr>
                        <th scope="col">Ações</th>
                        <td>
                            <a type="button" class="btn btn-outline-dark" href="<?= URL ?>/orcamentos/editar/<?= $dados['orcamento']->id ?>" class="m-1"><i class="bi bi-pencil-fill"></i></a>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#removerModal<?= $dados['orcamento']->id ?>">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </td>
                    </tr>
                    <div class="modal fade" id="removerModal<?= $dados['orcamento']->id ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Remover orçamento</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Você tem certeza que deseja remover o orçamento #<?= $dados['orcamento']->id ?>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="<?= URL ?>/orcamentos/remover/<?= $dados['orcamento']->id ?>" type="button" class="btn btn-danger">Remover</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>