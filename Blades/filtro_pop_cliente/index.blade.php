@include('pop-modal')

<script>

    function testarDataCliente() {
        var csrf_token = $('meta[name="csrf-token"]').attr("content");
        $('#vlOffset').val(0);
        $.ajax({
            url: '/filtro-pop/testar-cliente',
            method: "POST",
            data: {
                '_token': csrf_token,
                'cdCliente': $('#cd_Cliente').val(),
                'nmCliente': $('#nm_Cliente').val(),
                'nmAtividade': $('#nm_Atividade').val(),
                'nmCidade': $('#nm_Cidade').val(),
            },
            success: function(response){
                console.log(response);
                $('#listagem').html(response);
            },
            error: function(response){
                console.log('erro na funcao testarData');
            }
        });
    }
    function anteriorCliente() {
        var vlOfsset = +$('#vlOffset').val();
        if(vlOfsset == 0) {
            console.log('nao tem mais paginas');
        } else {
            vlOfsset = vlOfsset - 5;
            var csrf_token = $('meta[name="csrf-token"]').attr("content");
            $.ajax({
                url:'/filtro-pop/paginar-cliente',
                method: "POST",
                data: {
                    '_token': csrf_token,
                    'offset': vlOfsset,
                    'nmPessoa':$('#nm_Cliente').val(),
                    'nmAtividade':$('#nm_Atividade').val(),
                },
                success: function(response){
                    $('#listagem').html(response);
                    $('#vlOffset').val(vlOfsset);
                },
                error: function(response){
                    console.log('erro na funcao anterior');
                }
            });
        }
    }
    function proximoCliente() {
        var vlOfsset = +$('#vlOffset').val();
        vlOfsset = vlOfsset + 5;
        var csrf_token = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url: '/filtro-pop/paginar-cliente',
            method: "POST",
            data: {
                '_token': csrf_token,
                'offset': vlOfsset,
                'nmPessoa':$('#nm_Cliente').val(),
                'nmAtividade':$('#nm_Atividade').val(),
            },
            success: function(response){
                $('#listagem').html(response);
                $('#vlOffset').val(vlOfsset);
            },
            error: function(response){
            }
        });
    }
</script>
