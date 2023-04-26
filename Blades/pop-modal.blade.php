<div class="form-row">
    {{-- recebe o valor do offset pra paginacao --}}
    {!! Form::hidden('vl_offset', 0, ['id' => 'vlOffset'])!!}
</div>

<!-- Modal -->
<div class="modal" id="filtroPopModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-pop"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body" id="modal-body-pop"></div>
        </div>
    </div>
</div>

<script>
    //funcao que abre o modal, recebe o caminho do ajax e o nome do modal, chamado na pagina index.
    function abrirPop(caminho, nome) {
        var csrf_token = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url: caminho,
            method: "POST",
            data: {
                '_token': csrf_token,
            },
            beforeSend: openLoad('Abrindo Filtros...'),
            success: function(response){
                console.log(response);
                $('#filtroPopModal').modal();
                $('#modal-title-pop').html('<b>'+nome+'</b>');
                $('#modal-body-pop').html(response);
                closeLoad();
            },
            error: function(response){
                closeLoad();
                console.log('erro na funcao abirPop');
            }
        });
    }
    //funcao que posiciona o valor selecionado no fomulario.
    //chamada quando se clica no botao + da listagem
    function selecionarValor(codigo, valor, input, nome) {
        //$(nome).append('<option value=1>'+codigo+'</option>');
        console.log(input);
        $(nome).val(valor);
        $(input).val(codigo);
        $(nome).change();
        $('#filtroPopModal').modal('hide');
    }
</script>
