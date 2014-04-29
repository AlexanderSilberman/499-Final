<?php

class DatabaseController extends BaseController{
	public function add(){
	  $mangasearch=new \ITP\API\MangaSearch();
	  
	  
	  $mangas=Cache::get('list');
		if(!$mangas){
			$mangas=$mangasearch->getList();
			Cache::put('list',$mangas, 200);
		}
	  
	  $mangas=$mangas->manga;
	  
	  foreach($mangas as $man){
		  $manga=new Manga();
		  if(isset( $man->t ) ){
			  $manga->Title=$man->t;
		  }
		  if(isset( $man->ld ) ){
			  $manga->lastupdated=$man->ld;
		  }
		  if(isset( $man->a ) ){
			  $manga->alias=$man->a;
		  }
		  if(isset( $man->i ) ){
			  $manga->siteID=$man->i;
		  }
		  $manga->save();	
	  }
	  
	  return View::make('naruto');
	}
	
	public function MakeHome(){
	  $mangasearch=new \ITP\API\MangaSearch();
	  
	  $newmangas= DB::table('LastUpdated')
	  ->take(50)
	  ->get();
	  
	  return View::make('manga/Home', ['newmangas' => $newmangas, 'search'=>$mangasearch]);
	}
	public function mymanga(){
		if (Auth::check())
		{
		  $userid=Auth::user()->id;
		  //$newmangas=
		  $mangasearch=new \ITP\API\MangaSearch();
		  $favorites=DB::table('favorites')
		  ->join('mangas', 'mangas.id', '=', 'manga_id')
		  ->join('users', 'users.id', '=', 'user_id')
		  ->where('users.id', '=', Auth::user()->id)
		  ->get();
		  return View::make('manga/mymanga', ['favorites'=>$favorites, 'search'=>$mangasearch]);
		}
	
		return View::make('/manga/error', ['error'=>"you aren't logged in"]);
	}
	public function deletemanga(){
		
		DB::table('manga')->truncate();
		return View::make('/manga/mymanga');
	}
	
}

?>