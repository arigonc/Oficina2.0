<section class="m-4 w-75 mx-auto" style="min-height: 100vh;">
    <?= Sessao::mensagem('orcamento') ?>
    <div class="my-5 mb-3">
        <p class="fs-5 fw-semibold d-inline-block">Orçamentos:</p>
        <a class="btn btn-primary btn-sm d-inline-block float-end" type="button" href="<?= URL ?>/orcamentos/cadastrar"><i class="bi bi-plus-circle-fill mx-1"></i>Cadastrar novo orçamento</a>
    </div>
    <form action="<?= URL ?>/orcamentos/dashboard" method="get" autocomplete="off" class="my-4 border rounded p-3">
        <div class="row">
            <div class="col">
                <label class="form-label">Data inicial:</label>
                <input type="date" class="form-control" name="inicio" value="<?= $dados['inicio'] ?>">
            </div>
            <div class="col">
                <label class="form-label">Data final:</label>
                <input type="date" class="form-control" name="fim" value="<?= $dados['fim'] ?>">
            </div>
            <div class="col">
                <label class="form-label">Cliente:</label>
                <input type="text" class="form-control" name="cliente" value="<?= $dados['cliente'] ?>">
            </div>
            <div class="col">
                <label class="form-label">Vendedor:</label>
                <input type="text" class="form-control" name="vendedor" value="<?= $dados['vendedor'] ?>">
            </div>
            <div class="col d-flex align-items-end">
                <input type="submit" class="btn btn-dark mt-3" value="Filtrar">
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Data</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Vendedor</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($dados['orcamentos'] == null) : ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum orçamento encontrado!</td>
                    </tr>
                <?php endif ?>
                <?php foreach ($dados['orcamentos'] as $orcamento) : ?>
                    <tr>
                        <th scope="row"><?= $orcamento->id ?></th>
                        <td><?= $orcamento->cliente ?></td>
                        <td><?= date('d/m/Y', strtotime($orcamento->data_orc)) ?></td>
                        <td><?= date('h:i', strtotime($orcamento->hora_orc)) ?></td>
                        <td><?= $orcamento->vendedor ?></td>
                        <td>
                            <a type="button" class="btn btn-outline-success" href="<?= URL ?>/orcamentos/ver/<?= $orcamento->id ?>" class="m-1"><i class="bi bi-eye-fill"></i></a>
                            <a type="button" class="btn btn-outline-dark" href="<?= URL ?>/orcamentos/editar/<?= $orcamento->id ?>" class="m-1"><i class="bi bi-pencil-fill"></i></a>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#removerModal<?= $orcamento->id ?>">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </td>
                    </tr>
                    <div class="modal fade" id="removerModal<?= $orcamento->id ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Remover orçamento</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Você tem certeza que deseja remover o orçamento #<?= $orcamento->id ?>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="<?= URL ?>/orcamentos/remover/<?= $orcamento->id ?>" type="button" class="btn btn-danger">Remover</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination justify-content-end">
                <?php
                if($dados['pagina'] > 3){
                    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"" . URL . "/orcamentos/dashboard?inicio=" . $dados['inicio'] . "&fim=" . $dados['fim'] . "&cliente=" . $dados['cliente'] . "&vendedor=" . $dados['vendedor'] . "&pagina=". ($dados['pagina']-1) ."\">Anterior</a></li>";
                }

                for ($i = 1; $i <= $dados['totalPaginas']; $i++) {
                    if($i >= ($dados['pagina']-2) && $i <= ($dados['pagina']+2)){
                        if ($i == $dados['pagina']) {
                            echo "<li class=\"page-item active\"><a class=\"page-link\" href=\"#\">$i</a></li>";
                        } else {
                            echo "<li class=\"page-item\"><a class=\"page-link\" href=\"" . URL . "/orcamentos/dashboard?inicio=" . $dados['inicio'] . "&fim=" . $dados['fim'] . "&cliente=" . $dados['cliente'] . "&vendedor=" . $dados['vendedor'] . "&pagina=". $i ."\">$i</a></li>";
                        }
                    }
                }

                if($dados['pagina'] < ($dados['totalPaginas']-2)){
                    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"" . URL . "/orcamentos/dashboard?inicio=" . $dados['inicio'] . "&fim=" . $dados['fim'] . "&cliente=" . $dados['cliente'] . "&vendedor=" . $dados['vendedor'] . "&pagina=". ($dados['pagina']+1) ."\">Próximo</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>
</section>