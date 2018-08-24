<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    // nome da tabela na base de dados.
    protected $table = 'vendas';

    // permitir automap.
    protected $fillable = ['vendedor_id', 'valor'];

    /**
     * Nome do vendedor
     * 
     * @property string required
     */
    public $vendedor_id = '';

    /**
     * Nome do vendedor
     * 
     * @property double required
     */
    public $valor = 0.00;

    /**
     * Busca os dados do vendedor.
     */
    public function vendedor()
    {
        return $this->belongsTo('App\Models\Vendedor');
    }
}
