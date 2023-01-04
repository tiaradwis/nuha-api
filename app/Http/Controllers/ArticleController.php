<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'category' => ['required'],
            'content' => ['required'],
            'image_url' => ['required'],
            'author' => ['required'],
            'read_time' => ['required']
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $article = Article::create($request->all());
            $response = [
                'message' => 'Data created',
                'data' => $article
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e){
            return response()->json([
                'message' => 'Failed'. $e->errorInfo
            ]);
        }
    }

    public function show($id)
    {
        return Article::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'category' => ['required'],
            'content' => ['required'],
            'image_url' => ['required'],
            'author' => ['required'],
            'read_time' => ['required']
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $article = update($request->all());
            $response = [
                'message' => 'Data created',
                'data' => $article
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e){
            return response()->json([
                'message' => 'Failed'. $e->errorInfo
            ]);
        }
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        try {
            $article->delete();
            $response = [
                'message' => 'Data deleted',
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e){
            return response()->json([
                'message' => 'Failed'. $e->errorInfo
            ]);
        }
    }
}
