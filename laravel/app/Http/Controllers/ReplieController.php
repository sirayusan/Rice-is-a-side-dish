<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Replie;
use App\Models\Post;
use Auth;

class ReplieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      $post = Post::find($id);
      $replies = Post::find($id)->replies()->get();
      foreach ($replies as $replie) {
        $user = Post::find($replie->user_id)->user()->first();
        $replie->user_name = $user->name;
      }
      return view('replies',compact('post','replies'));
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
    public function store(Request $request , $id)
    {
        $validatedData = $request->validate([
            'Replie' => ['required', 'max:255'],
        ]);

        if (Auth::check() === false) {
            return view('auth/login');
        }

        $replies = new Replie();
        $replies->comment = $validatedData['Replie'];
        $replies->user_id = Auth::id();
        $replies->post_id = $id;
        $replies->save();

        return redirect('top');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
