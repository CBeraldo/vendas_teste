<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Venda;

class VendasController extends Controller
{
    /**
     * Listar todos os vendedores.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $vendas = Venda::all();
        return response()->json($vendas, 200);
    }

    /**
     * Buscar vendas por vendedor.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, $id)
    {
        // $vendedor = Vendas::where('id_ven', $id)->first(['id', 'nome', 'email']);
        // return response()->json($vendedor, 200);
    }

    /**
     * Inserir um novo vendedor.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $rules = [
            'vendedor_id' => 'required|integer|exists:vendedores,id',
            'valor' => 'required|numeric',
        ];

        $messages = [
            'vendedor_id.required' => 'Código do vendedor deve ser informado.',
            'vendedor_id.integer' => 'Código de vendedor informado é inválido.',
            'vendedor_id.exists' => 'Vendedor não encontrado.',
            'valor.required' => 'Valor da venda deve ser informado.',
            'valor.numeric' => 'Valor informado é inválido.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $venda = Venda::create($request->all());
        return response()->json($venda, 200);
    }
}
