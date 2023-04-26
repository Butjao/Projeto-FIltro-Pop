<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $primaryKey = 'cd_pessoa';

    public $incrementing = false;

    public static function paginarInicial($cdPessoa, $nmPessoa, $nmAtividade, $nmCidade)
    {
        $arrBindings = [];
        $whereExtra = "";

        if ($cdPessoa) {
            $whereExtra .= "AND p.cd_pessoa = :cdPessoa ";
            $arrBindings = array_merge($arrBindings, ["cdPessoa" => $cdPessoa]);
        }
        if ($nmPessoa) {
            $whereExtra .= "AND UPPER(p.nm_pessoa) LIKE '%' || UPPER(:nmPessoa) || '%'";
            $arrBindings = array_merge($arrBindings, ["nmPessoa" => $nmPessoa]);
        }
        if ($nmAtividade) {
            $whereExtra .= "AND UPPER(a.nm_atividade) LIKE '%' || UPPER(:nmAtividade) || '%'";
            $arrBindings = array_merge($arrBindings, ["nmAtividade" => $nmAtividade]);
        }
        if ($nmCidade) {
            $whereExtra .= "AND UPPER(ci.nm_cidade) LIKE '%' || UPPER(:nmCidade) || '%'";
            $arrBindings = array_merge($arrBindings, ["nmCidade" => $nmCidade]);
        }

        $sql = <<<SQL
            SELECT p.cd_pessoa as codigo, p.nm_pessoa as nome,
                   a.nm_atividade as atividade, ci.nm_cidade as cidade
              FROM pessoa p
              join cliente c on c.cd_pessoa = p.cd_pessoa
              join atividade a on a.cd_atividade = c.cd_atividade
              join cidade ci on ci.cd_cidade = p.cd_cidade
             WHERE p.cd_pessoa is not null
             {$whereExtra}
             ORDER BY p.cd_pessoa
             LIMIT 5
SQL;

        return DB::select($sql, $arrBindings);
    }

    public static function paginarSecundario($offset, $nmPessoa, $nmAtividade, $nmCidade)
    {
        $arrBindings = [];
        $whereExtra = "";

        if ($nmPessoa) {
            $whereExtra .= "AND UPPER(p.nm_pessoa) LIKE '%' || UPPER(:nmPessoa) || '%'";
            $arrBindings = array_merge($arrBindings, ["nmPessoa" => $nmPessoa]);
        }
        if ($nmAtividade) {
            $whereExtra .= "AND UPPER(a.nm_atividade) LIKE '%' || UPPER(:nmAtividade) || '%'";
            $arrBindings = array_merge($arrBindings, ["nmAtividade" => $nmAtividade]);
        }
        if ($nmCidade) {
            $whereExtra .= "AND UPPER(ci.nm_cidade) LIKE '%' || UPPER(:nmCidade) || '%'";
            $arrBindings = array_merge($arrBindings, ["nmCidade" => $nmCidade]);
        }

        $sql = <<<SQL
            SELECT p.cd_pessoa as codigo, p.nm_pessoa as nome,
                   a.nm_atividade as atividade, ci.nm_cidade as cidade
            FROM pessoa p
            join cliente c on c.cd_pessoa = p.cd_pessoa
            join atividade a on a.cd_atividade = c.cd_atividade
            join cidade ci on ci.cd_cidade = p.cd_cidade
            WHERE p.cd_pessoa is not null
            {$whereExtra}
            ORDER BY p.cd_pessoa
            OFFSET ({$offset})
            LIMIT 5
SQL;

        return DB::select($sql, $arrBindings);
    }
}
