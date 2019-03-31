<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Books extends Controller
{
    use \App\Traits\SendMail;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('books');
    }

    public function data()
    {
        $books = DB::table('books')->orderByRaw('author ASC, title ASC')->get();
        return view('data', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'author' => htmlspecialchars($request->input('author')),
            'title' => htmlspecialchars($request->input('title')),
            'short_descr' => htmlspecialchars($request->input('short_descr'))
        ];
        DB::table('books')->insert($data);
        $data['action'] = 'Данные сохранены';
        $email_response = $this->html_email($data);
        echo 'Данные сохранены, '.$email_response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'author' => htmlspecialchars($request->input('author')),
            'title' => htmlspecialchars($request->input('title')),
            'short_descr' => htmlspecialchars($request->input('short_descr'))
        ];
        DB::table('books')->where('id', $id)->update($data);
        $data['action'] = 'Данные обновлены';
        $email_response = $this->html_email($data);
        echo 'Данные обновлены, '.$email_response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('books')->where('id', '=', $id)->delete();
        echo 'Данные удалены';
    }
}
