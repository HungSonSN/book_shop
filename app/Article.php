<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	//
	protected $table ='articles';
	protected $fillabel = ['name','alias','intro','content','image','keyword','description','user_id'];
	public $timestamp = false;

	public function user(){
		return $this->belongsTo('App\User');
	}
}
