<?php
namespace App\Http\Controllers;

class UserController extends Controller
{
  public function index($message)
  {
    $a = 'message';
    $d = $message;
    return view('top', compact('a','d'));
  }
}
