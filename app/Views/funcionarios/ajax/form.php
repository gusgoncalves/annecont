<form
    action="<?= base_url('funcionarios/storeAjax') ?>"
    method="post"
    id="formFuncionario">

    <input
        type="hidden"
        name="id_cliente"
        value="<?= $cliente_id ?>">

    <div class="form-group">

        <label>Nome</label>

        <input
            type="text"
            name="nome"
            class="form-control">

    </div>

    <div class="form-group">

        <label>Whatsapp</label>

        <input
            type="text"
            name="whatsapp"
            class="form-control">

    </div>

    <button
        type="submit"
        class="btn btn-success">

        SALVAR

    </button>

</form>