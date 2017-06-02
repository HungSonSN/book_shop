<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\User;
use App\Article;
use Auth;
use Request;
//use Carbon\Carbon;
use App\Http\Requests\ArticleRequest;
class ArticleController extends Controller {

	public function getAdd(){
		return view('backend.article.add');
	}
	public function postAdd(articleRequest $request){
		$article = new Article;
		$file_name = $request->file('fileimages')->getClientOriginalName();
		$article->name = $request->txtten;
		$article->alias = str_slug($request->txtten);
		$article->intro = $request->txtndhienthi;
		$article->content = $request->txtndchitiet;
		$article->image = $file_name;
		$article->keyword = $request->txtkeyword;
		$article->description = $request->txtmota;
		$article->user_id = Auth::user()->id;
		$request->file('fileimages')->move('public/upload/article/',$file_name);
		$article->save();
		return redirect()->route('admin.article.getList')->with(['flash_level' => 'success','flash_message' =>'Thêm bài viết thành công']);
	}
	public function getList(){
		$article = Article::all();
		return view('backend.article.list',compact('article'));
	}
	public function delete($id){
		$article = Article::find($id);
		$article->delete();
		return redirect()->route('admin.article.getList')->with(['flash_level' => 'success','flash_message' =>'Xóa bài viết thành công']);
	}
	public function getEdit($id){
		$article = Article::find($id)->first();
		return view('backend.article.edit',compact('article'));
	}
	public function postEdit($id,Request $request){
		$article = Article::find($id);
		$img_current = 'public/upload/article/'.Request::input('img_current');
		$article->name = Request::input('txtten');
		$article->alias = str_slug(Request::input('txtten'));
		$article->intro = Request::input('txtndhienthi');
		$article->content = Request::input('txtndchitiet');
		$article->keyword = Request::input('txtkeyword');
		$article->description = Request::input('txtmota');
		$article->user_id = Auth::user()->id;
		if(!empty(Request::file('fileimages'))){
			$file_name = Request::file('fileimages')->getClientOriginalName();
			$article->image = $file_name;
			Request::file('fileimages')->move('public/upload/article/',$file_name);
			if(File::exists($img_current)){
				File::delete($img_current);
			}
		}
		$article->save();
		return redirect()->route('admin.article.getList')->with(['flash_level' => 'success','flash_message' =>'Sữa bài viết thành công']);
	}
}
