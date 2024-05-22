<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    function create(){
        return view('endereco.create');
    }

    public function store(Request $request)
    {
        Endereco::create([
            'USUARIO_ID' => Auth()->user()->USUARIO_ID,
            'ENDERECO_NOME'=>$request->ENDERECO_NOME,
            'ENDERECO_LOGRADOURO'=>$request->ENDERECO_LOGRADOURO,
            'ENDERECO_NUMERO'=>$request->ENDERECO_NUMERO,
            'ENDERECO_COMPLEMENTO'=>$request->ENDERECO_COMPLEMENTO,
            'ENDERECO_CEP'=>$request->ENDERECO_CEP,
            'ENDERECO_CIDADE'=>$request->ENDERECO_CIDADE,
            'ENDERECO_ESTADO'=>$request->ENDERECO_ESTADO,
            'ENDERECO_APAGADO'=>0
        ]);
        return redirect(route('profile.edit'));
    }
    
    public function update(Request $request, Endereco $endereco)
    {
        $endereco->update([
            'USUARIO_ID' => Auth()->user()->USUARIO_ID,
            'ENDERECO_NOME'=>$request->ENDERECO_NOME,
            'ENDERECO_LOGRADOURO'=>$request->ENDERECO_LOGRADOURO,
            'ENDERECO_NUMERO'=>$request->ENDERECO_NUMERO,
            'ENDERECO_COMPLEMENTO'=>$request->ENDERECO_COMPLEMENTO,
            'ENDERECO_CEP'=>$request->ENDERECO_CEP,
            'ENDERECO_CIDADE'=>$request->ENDERECO_CIDADE,
            'ENDERECO_ESTADO'=>$request->ENDERECO_ESTADO,
            'ENDERECO_APAGADO'=>0
        ]);
        return back(); 
}
public function delete(Request $request, Endereco $endereco)
    {
        $endereco->update([
            'ENDERECO_APAGADO'=>1
        ]);
        return back(); 
}

}