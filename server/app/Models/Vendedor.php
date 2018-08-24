<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    // nome da tabela na base de dados.
    protected $table = 'vendedores';

    // permitir automap.
    protected $fillable = ['nome', 'email'];

    /**
     * Nome do vendedor
     * 
     * @property string required
     */
    public $nome = '';

    /**
     * Nome do vendedor
     * 
     * @property string required
     */
    public $email = '';

    public function vendas()
    {
        return $this->hasMany('App\Models\Venda');
    }

    // remover datas de criação e alteração.
    public $timestamps = false;
}
