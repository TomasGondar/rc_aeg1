<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    public function index()
    {
        // Retorna todas as notas do usuário autenticado
        $grades = Grade::where('user_id', Auth::id())->get();
        return response()->json($grades, 200);
    }

    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'modalidade' => 'required|string|max:255',
            'nota' => 'required|string|max:255',
        ]);

        // Verifica se houve falha na validação
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cria uma nova nota associada ao usuário autenticado
        $grade = Grade::create([
            'modalidade' => $request->modalidade,
            'nota' => $request->nota,
            'user_id' => Auth::id(),
        ]);

        // Retorna a nota criada com o código de status 201 (created)
        return response()->json($grade, 201);
    }

    public function show($id)
    {
        // Busca uma nota específica associada ao usuário autenticado
        $grade = Grade::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return response()->json($grade, 200);
    }

    public function update(Request $request, $id)
    {
        // Busca a nota a ser atualizada
        $grade = Grade::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'modalidade' => 'required|string|max:255',
            'nota' => 'required|string|max:255',
        ]);

        // Verifica se houve falha na validação
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Atualiza a nota com os novos dados
        $grade->update($request->all());

        // Retorna a nota atualizada com o código de status 200 (OK)
        return response()->json($grade, 200);
    }

    public function destroy($id)
    {
        // Busca a nota a ser deletada
        $grade = Grade::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Deleta a nota
        $grade->delete();

        // Retorna uma resposta vazia com o código de status 204 (No Content)
        return response()->json(null, 204);
    }
}
