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
        // $vendas = Venda::all();
        // return response()->json($vendas, 200);

        //$headers  = 'MIME-Version: 1.0' . "\r\n";
        //$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= 'From: '.$nome.'<'.$destino.'>';
        $to = "caio.beraldo@fatec.sp.gov.br";
        $subject = "My subject";
        $txt = "Hello world!";
        $headers = "MIME-Version: 1.1" . "\r\n" .
        "From: caio.beraldo@fatec.sp.gov.br" . "\r\n" .
        "CC: cberaldo.desenvolvimento@outlook.com";

        $result = mail($to, $subject, $txt, $headers);

        if ($result) {
            return response()->json(array([ 'result' => 'E-mail enviado com sucesso.']), 200);
        } else {
            return response()->json(array([ 'result' => 'Não foi possível enviar o e-mail' ]), 404);
        }
    }

    /**
     * Buscar vendas por vendedor.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, $id)
    {
        $vendas = Vendas::where('vendedor_id', $id)->all();
        $result = array();

        foreach ($vendas as $venda) {
            $comissao = 0;

            $result.array_push(array([
                'id' => $venda->vendedor_id,
                'nome' => $venda->vendedor->nome,
                'email' => $venda->vendedor->email,
                'comissao' => $comissao,
                'valor' => $venda->valor,
                'data' => $venda->created_at // verificar nome do campo
            ]));
        }

        return $result;
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

        $inserted = array([
            'id' => $venda->vendedor_id,
            'nome' => $venda->vendedor->nome,
            'email' => $venda->vendedor->email,
            'comissao' => $comissao,
            'valor' => $venda->valor,
            'data' => $venda->created_at // verificar nome do campo
        ]);

        return response()->json($inserted, 200);
    }
}
