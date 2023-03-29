<?php

namespace App\Http\Controllers;

use App\Models\empresa;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    /**
     * Lista todos os empresas cadastrados
     */
    public function index()
    {
        // Pega todos os registos da tabela relacionada ao modelo empresa
        $empresas = empresa::all();

        // Manda os dados para uma view, no caso empresas.index
        return view('empresas.index', compact('empresas'));
    }

    /**
     * Mostra o formulário para criar um novo empresa
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Armazena um novo empresa
     */
    public function store(Request $requisicao)
    {
        // Cria um novo objeto do tipo empresa em branco
        $empresa = new empresa();

        // Preenche os campos do objeto com os dados da requisição
        $empresa->nome = $requisicao->nome;
        $empresa->raca = $requisicao->raca;
        $empresa->idade = $requisicao->idade;
        $empresa->sexo = $requisicao->sexo;
        $empresa->cor = $requisicao->cor;
        $empresa->empresagrafia = $requisicao->empresagrafia;

        // Salva o objeto no banco de dados
        $empresa->save();

        // Redireciona para a página de detalhes do empresa
        return redirect()->route('empresas.show', $empresa->id);
    }

    /**
     * Mostra um empresa específico
     *
     * O parametro $empresa é um objeto do tipo empresa que é passado automaticamente
     * pelo Laravel, pois o nome do parametro é o mesmo nome do parametro que
     * está na rota. O Laravel faz a busca no banco de dados e retorna o objeto
     * que corresponde ao id passado na rota.
     */
    public function show(empresa $empresa)
    {
        // Retorna a view empresas.view com o objeto $empresa
        return view('empresas.view', compact('empresa'));
    }

    /**
     * Mostra o formulário para editar um empresa específico
     */
    public function edit(empresa $empresa)
    {
        // Retorna a view empresas.edit com o objeto $empresa
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Atualiza um empresa específico
     */
    public function update(Request $requisicao, empresa $empresa)
    {
        // Atualiza o objeto com os dados da requisição
        $empresa->update($requisicao->all());

        // Redireciona para a página de detalhes do empresa
        return redirect()->route('empresas.show', $empresa->id);
    }

    /**
     * Remove um empresa específico
     */
    public function destroy(empresa $empresa)
    {
        $empresa->delete();

        return redirect()->route('empresas.index');
    }
}
