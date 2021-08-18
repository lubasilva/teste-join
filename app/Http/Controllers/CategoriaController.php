<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProduto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    private $categoria;

    public function __construct(CategoriaProduto $categoria) {
        $this->categoria = $categoria;
    }

    public function index() {
        $categoria = $this->categoria->paginate('6');

        return response()->json($categoria, 200);
    }

    public function show($id) {
        try {
            $categoria = $this->categoria->findOrFail($id);

            return response()->json([
                'data' =>  $categoria
            ], 200);

        } catch(\Exception $err) {
            return response()->json([ 'Error' => $err->getMessage()], 404);
        }
    }

    public function store(Request $request) {
        $data = $request->all();

        try {
            $categoria = $this->categoria->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'categoria cadastrada'
                ]
                ], 200);
        } catch(\Exception $err) {
            return response()->json([ 'Error' => $err->getMessage()], 404);
        }
    }

    public function update($id, Request $request) {
        $data = $request->all();
        $categoria = $this->categoria->findOrFail($id);
        $categoria->update($data);

        return response()->json([
            'data' => [
                'msg' => 'categoria atualizada'
            ]
            ], 200);

        try {

        } catch(\Exception $err) {
            return response()->json([ 'Error' => $err->getMessage()], 404);
        }
    }

    public function destroy($id) {
        try {
            $categoria = $this->categoria->findOrFail($id);
            $categoria->delete();

            return response()->json([
                'data' => [
                    'msg' => 'categoria deletada'
                ]
                ], 200);

        } catch(\Exception $err) {
            return response()->json([ 'Error' => $err->getMessage()], 404);
        }
    }
}
