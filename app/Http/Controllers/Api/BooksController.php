<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    public function index(){
        $data = null;
        $errors = null;
        $code = 200;
        $success = true;

        try{
            $data = DB::table('books')->orderByRaw('author ASC, title ASC')->get();
        }
        catch (\Exception $ex){
            $errors = $ex->getMessage();
            $code = 404;
            $success = false;
        }
        $response = [
            'success' => $success,
            'data' => $data,
            'errors' => $errors
        ];
        return response()->json($response, $code);
    }
}
