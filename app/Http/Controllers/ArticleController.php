<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(Request $request)
	{
		try {
			// return Str::random(32);
			$password = $request->input("password");
			if ($password && $password != env('password')) {
				return 'fail';
			}
			DB::transaction(function () use ($request) {
				$title = $request->input('title');
				$body = $request->input('body');
				$tags = $request->input('tags');


				$article = Article::updateOrCreate(['title' => $title,], ['body' => $body]);
				if (!$article) {
					return '文章写入失败';
				}
				$article->udid = bcadd(date('ymd'), $article->id, 0);
				$article->save();

				$tagIds = [];
				if ($tags) {
					foreach ($tags as $tag) {
						$item = Tag::firstOrCreate(['name' => $tag]);
						$tagIds[] = $item->id;
					}
				}
				if (count($tagIds) > 0) {
					$article->tags()->sync($tagIds);
				}
			});

			Cache::del('tags');

			return 'ok';
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
