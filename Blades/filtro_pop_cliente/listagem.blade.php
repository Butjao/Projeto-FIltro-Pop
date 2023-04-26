<table style="width: 100%;" id="example" class="table table-sm" >
    <thead style="background-color:#663399; color: #fff">
        <tr style="text-align: center">
            <th class="th-sm">Código</th>
            <th class="th-sm">Nome</th>
            <th class="th-sm">Atividade</th>
            <th class="th-sm">Cidade</th>
            <th class="th-sm">Selecionar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $obj)
        <tr style="text-align: center; font-family: 'helvetica', sans-serif; font-size: 15px;">
            @php
            $valorCampo = $obj->codigo . ' / ' . $obj->nome;
            $input = '#inputCDCliente';
        @endphp
        <td>{{$obj->codigo}}</td>
        <td style="text-align: left">{{$obj->nome}}</td>
        <td style="text-align: left">{{$obj->atividade}}</td>
        <td style="text-align: left">{{$obj->cidade}}</td>
        <td><i class="fa fa-plus" style=" color: #663399; font-size: 25px;  cursor: pointer; margin-left: 40%" onClick="selecionarValor('{{$obj->codigo}}','{{$valorCampo}}','{{$input}}','{{$nome}}')"id="botaosearch"></i></td>
    </tr>

@endforeach
    </tbody>
</table>

@if ($paginate == 1)
    <div style="text-align: center; ">
        <button onclick="anteriorCliente()" type='button' style="margin-right: 30px"><b>Anterior</b></button>
        <button onclick="proximoCliente()" type='button'  style="margin-left: 15px"><b>Próximo</b></button>
    </div>
@endif
