<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private $produto;

    public function __construct(Produto $produto) {
        $this->produto = $produto;
    }

    public function index() {
        $produto = $this->produto->paginate('6');

        return response()->json($produto, 200);
    }

    public function show($id) {
        try {
            $produto = $this->produto->findOrFail($id);

            return response()->json([
                'data' =>  $produto
            ], 200);

        } catch(\Exception $err) {
            return response()->json([ 'Error' => $err->getMessage()], 404);
        }
    }

    public function store(Request $request) {
        $data = $request->all();

        try {
            $produto = $this->produto->create($data);

            if(isset($data['categoria']) && count($data['categoria'])) {
                $produto->categoria()->sync($data['categoria']);
            }

            return response()->json([
                'data' => [
                    'msg' => 'Produto cadastrado'
                ]
                ], 200);
        } catch(\Exception $err) {
            return response()->json([ 'Error' => $err->getMessage()], 404);
        }
    }

    public function update($id, Request $request) {
        $data = $request->all();
        $produto = $this->produto->findOrFail($id);
        $produto->update($data);

        if(isset($data['categoria']) && count($data['categoria'])) {
                $produto->categoria()->sync($data['categoria']);
            }

        return response()->json([
            'data' => [
                'msg' => 'Produto atualizado'
            ]
            ], 200);

        try {

        } catch(\Exception $err) {
            return response()->json([ 'Error' => $err->getMessage()], 404);
        }
    }

    public function destroy($id) {
        try {
            $produto = $this->produto->findOrFail($id);
            $produto->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Produto deletado'
                ]
                ], 200);

        } catch(\Exception $err) {
            return response()->json([ 'Error' => $err->getMessage()], 404);
        }
    }

}
