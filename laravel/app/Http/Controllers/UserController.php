<?php
use App\Http\Controllers\Controller;

class UserController extends Controller
{
  public function index($message)
  {
      $d = $message;
      return view('top', $d);
  }
}
 ?>
