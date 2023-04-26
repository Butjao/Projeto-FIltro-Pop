<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class FiltroPopClienteController extends Controller
{
    public $nomeCampo = '#inputCliente';
    public $cliente = '';

    public function filtrar(Request $request)
    {
        return view('filtro_pop.cliente.filtro');
    }

    public function testar(Request $request)
    {
        $cdCliente   = $request->cdCliente;
        $nmCliente   = $request->nmCliente;
        $nmAtividade = $request->nmAtividade;
        $nmCidade    = $request->nmCidade;

        $pesquisa = Cliente::paginarInicial($cdCliente, $nmCliente, $nmAtividade, $nmCidade);

        if (!isset($cdCliente) && !isset($nmCliente)  && !isset($nmAtividade) && !isset($nmCidade)) {
            return view('filtro_pop.cliente.listagem')
                ->with('data', $pesquisa)
                ->with('nome', $this->nomeCampo)
                ->with('paginate', 1);
        }

        if (sizeof($pesquisa) < 1) {
            return ('<b>Nenhum Resultado Encontrado.</b>');
        }

        if (sizeof($pesquisa) >= 5) {
            return view('filtro_pop.cliente.listagem')
            ->with('data', $pesquisa)
            ->with('nome', $this->nomeCampo)
            ->with('paginate', 1);
        }
        return view('filtro_pop.cliente.listagem')
            ->with('data', $pesquisa)
            ->with('nome', $this->nomeCampo)
            ->with('paginate', 0);
    }

    public function paginar(Request $request)
    {
        $offset      = $request->offset;
        $nmPessoa    = $request->nmPessoa;
        $nmAtividade = $request->nmAtividade;
        $nmCidade    = $request->nmCidade;

        $data = Cliente::paginarSecundario($offset, $nmPessoa, $nmAtividade, $nmCidade);

        return view('filtro_pop.cliente.listagem')
            ->with('paginate', 1)
            ->with('nome', $this->nomeCampo)
            ->with('data', $data);
    }
}
