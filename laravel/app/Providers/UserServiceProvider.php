<?php
namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;

class AuthUserProvider extends EloquentUserProvider
{
  //Auth::user()の情報を追加する
	public function retrieveById($identifier) {
		$result = $this->createModel()->newQuery()
			->leftJoin('imege', 'users.imeage', '=', 'image')
			->leftJoin('comment', 'users.comment', '=', 'comment')
			->select(['users.*', 'users.imege as imege', 'users.comment as comment'])
			->find($identifier);
		return $result;
	}

}
