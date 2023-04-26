{{-- Formulario com todos os inputs do filtro --}}
<div class="form-row">
    <div class="col-6">
        {!! Form::label('cd_Cliente', 'Código') !!}
        {!! Form::number('cd_Cliente', null, ['class' => 'form-control numeric','autofocus', 'min'=>1, 'id' => 'cd_Cliente']) !!}
    </div>
    <div class="col-6">
        {!! Form::label('nm_Cliente', 'Nome') !!}
        {!! Form::text('nm_Cliente', null, ['class' => 'form-control', 'id' => 'nm_Cliente']) !!}
    </div>
    <div class="col-6">
        {!! Form::label('nm_Atividade', 'Atividade') !!}
        {!! Form::text('nm_Atividade', null, ['class' => 'form-control', 'id' => 'nm_Atividade']) !!}
    </div>
    <div class="col-6">
        {!! Form::label('nm_Cidade', 'Cidade') !!}
        {!! Form::text('nm_Cidade', null, ['class' => 'form-control', 'id' => 'nm_Cidade']) !!}
    </div>
    <div class="col-12">
        <div style="float: left">
            {{-- Botao que vai buscar os valores na lista --}}
            <button class="btn btn-primary" type="button" style="width: 150px; margin-top: 10px" id="testar_negociacao"
                    onclick="testarDataCliente()">Buscar</button>
        </div>
    </div>
</div>
<br>
{{-- Div na qual vao aparecer os valores resultados --}}
<div id="listagem"></div>


