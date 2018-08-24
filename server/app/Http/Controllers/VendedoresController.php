<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vendedor;

class VendedoresController extends Controller
{
    /**
     * Listar todos os vendedores.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $vendedores = Vendedor::all(['id', 'nome', 'email']);

        // incluir vendas na consulta.
        foreach ($vendedores as $vendedor) {
            $vendedor->vendas;
        }

        return response()->json($vendedores, 200);
    }

    /**
     * Buscar um vendedor.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, $id)
    {
        $vendedor = Vendedor::where('id', $id)->first(['id', 'nome', 'email']);
        $vendedor->vendas; // incluir as vendas na consulta.
        return response()->json($vendedor, 200);
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
            'nome' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:vendedores'
        ];

        $messages = [
            'nome.required' => 'Nome do vendedor deve ser informado.',
            'email.required' => 'E-mail do vendedor deve ser informado.',
            'email.email'  => 'E-mail informado é inválido.',
            'email.unique'  => 'E-mail já cadastrado.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $vendedor = Vendedor::create($request->all());
        return response()->json($vendedor, 200);
    }

}
