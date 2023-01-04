<section class="w-75 mx-auto" style="min-height: 100vh;">
    <nav class="my-4 p-2 pt-3 px-4 bg-light rounded border">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/orcamentos/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </nav>
    <div class="d-block p-5 my-4 bg-white center rounded border">
        <?= Sessao::mensagem('orcamento') ?>
        <form action="<?= URL ?>/orcamentos/editar/<?= $dados['orcamento']->id ?>" method="post" autocomplete="off">
            <p class="fs-6 fw-semibold">Dados do orçamento:</p>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label class="form-label">Cliente<span class="mx-1 text-danger">*</span></label>
                    <input type="text" class="form-control <?= $dados['cliente_erro'] ? "is-invalid" : "" ?>" name="cliente" value="<?= $dados['orcamento']->cliente ?>">
                    <div class="invalid-feedback">
                        <?= $dados['cliente_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label class="form-label">Data<span class="mx-1 text-danger">*</span></label>
                    <input type="date" class="form-control <?= $dados['data_orc_erro'] ? "is-invalid" : "" ?>" name="data_orc" value="<?= $dados['orcamento']->data_orc ?>">
                    <div class="invalid-feedback">
                        <?= $dados['data_orc_erro'] ?>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <label class="form-label">Hora<span class="mx-1 text-danger">*</span></label>
                    <input type="time" class="form-control <?= $dados['hora_orc_erro'] ? "is-invalid" : "" ?>" name="hora_orc" value="<?= $dados['orcamento']->hora_orc ?>">
                    <div class="invalid-feedback">
                        <?= $dados['hora_orc_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label class="form-label">Vendedor<span class="mx-1 text-danger">*</span></label>
                    <input type="text" class="form-control <?= $dados['vendedor_erro'] ? "is-invalid" : "" ?>" name="vendedor" value="<?= $dados['orcamento']->vendedor ?>">
                    <div class="invalid-feedback">
                        <?= $dados['vendedor_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label class="form-label">Descrição<span class="mx-1 text-danger">*</span></label>
                    <textarea class="form-control <?= $dados['descricao_erro'] ? "is-invalid" : "" ?>" rows="5" name="descricao"><?= $dados['orcamento']->descricao ?></textarea>
                    <div class="invalid-feedback">
                        <?= $dados['descricao_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label class="form-label">Valor<span class="mx-1 text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">R$</span>
                        <input type="text" class="form-control <?= $dados['valor_erro'] ? "is-invalid" : "" ?>" name="valor" value="<?= $dados['orcamento']->valor ?>">
                        <div class="invalid-feedback">
                            <?= $dados['valor_erro'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <input type="submit" class="btn btn-dark" value="Editar">
            </div>
        </form>
    </div>
</section>