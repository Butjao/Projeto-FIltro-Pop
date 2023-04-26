
@section('formulario')
    {!! Form::open(['route' => [$route, $combo->cd_combo], 'method'=>'POST', 'class' => 'needs-validation', 'novalidate']) !!}
        @include('combo.header')

        <div class="form-row">
            <div class="col-md-6">
                {!! Form::label('pessoa', 'Cliente*') !!}
                {!! Form::hidden('cd_pessoa', null, ['id'=>'inputCDCliente'])!!}
                {!! Form::text('pessoa', null, ['id'=>'inputCliente','autofocus', 'class' => 'form-control','tabindex'=>'-1', 'required', 'placeholder' => '', 'style'=>('background-color: #eee; pointer-events: none; cursor: default')]) !!}
            </div>
            <div style="padding-top: 30px">
                @component('components.searchButton', ['caminho' => "'/filtro-pop/filtrar-cliente'", 'nome' => "'Filtro Cliente'"])@endcomponent
            </div>
        </div>

        @component('components.saveButton', ['route' => $route]) @endcomponent

    {!! Form::close() !!}
     @include('filtro_pop.cliente.index')
@endsection

