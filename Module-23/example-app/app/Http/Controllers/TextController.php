<?php

namespace App\Http\Controllers;

use App\Models\TelegraphText;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->get('id');
        $text = TelegraphText::find($id);
        $view = view('show', ['text' => $text]);
        return new Response($view);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $title = $request->get('title');
        $text = $request->get('text');
        $public = $request->get('public') === 'on';
        if (!$id) {
            $v = new TelegraphText();
            $v->title = $title;
            $v->text = $text;
            $v->public = $public;
            $v->save();
        } else {
            TelegraphText::find($id)->update(['title' => $title, 'text' => $text, 'public' => $public]);
        }


        return redirect('/text/list');
    }

    public function list()
    {
        $texts = TelegraphText::all();
        $view = view('list', ['texts' => $texts]);
        return new Response($view);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        TelegraphText::where('id', $id)->delete();
        return redirect('/text/list');
    }

    public function create(Request $request)
    {
        $view = view('create');
        return new Response($view);
    }


}
