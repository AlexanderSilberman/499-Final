<?php

class MangaController extends BaseController{
	
    public function GetChapters($title){
	  $mangasearch=new \ITP\API\MangaSearch();
	  $l=$mangasearch->cacheList($title);
	  if($l[1]==""){  return View::make('/manga/error', ['error'=>"couldn't find the manga"]);  }
  
	  $singlemanga=Cache::get('manga');
	  $tit=Cache::get('title');
	  if((!$singlemanga) || ($tit=$title)){
		$singlemanga=$mangasearch->getChapters($l[1]->i);
		Cache::put('manga',$singlemanga, 10);
		Cache::put('title',$title,10);
	  }
	return View::make('manga/displaymanga', ['title'=>$title, 'mangas'=>$l[1],'chapters'=>$singlemanga, 'index'=>$l[2]]);
  }
   
 
  public function GetPage($title,$tchapter,$numpage){
		//return;
	  //return View::make('/manga/error', ['error'=>'negative chapter or page number']);
	  if($tchapter<1 || $numpage<1){  return View::make('/manga/error', ['error'=>'negative chapter or page number']);  }
	  
	  //Making the MangaSearch object
	  $mangasearch=new \ITP\API\MangaSearch();
	  
	  $l=$mangasearch->cacheList($title);
	  if($l[1]==""){  return View::make('/manga/error', ['error'=>"couldn't find the manga"]);  }
	  
	  $m=$mangasearch->cacheManga($title,$tchapter,$l[1]);
	  if($m[1]==""){  return View::make('/manga/error', ['error'=>"couldn't find the chapter"]);  }
  
	  $c=$mangasearch->cacheChapter($tchapter,$numpage,$m[2],$m[1]);
	  
	  if($c[1]==""){  return View::make('/manga/error', ['error'=>"couldn't find the page"]);  }
	  
	  return View::make('manga/displaypage', ['thing' => $c[1], 'pages'=>$c[0], "mangas" => $l[1], 'chapters'=>$m[0], 'title'=>$title, 'tchapter'=>$tchapter, 'numpage'=>$numpage]);
	}

	public function GetFirst($title,$tchapter){
		$make=$this->GetPage($title,$tchapter,1);
		echo $make;
		
	}
	
	public function FavoriteManga($title){
	  $validation=Favorites::validating(Input::all());
	  
	  if($validation->passes()){
		  $user=new favorites();
		  $user->user_id=Input::get('user_id');
		  $user->manga_id=Input::get('manga_id');
		  $user->save();
		  
		  return Redirect::to($title)
			  ->with('success', 'Added to favorites!');	
	  }
	  return Redirect::to($title)
		  ->withInput()
		  ->with('errors', $validation->messages());
	}
	//return View::make('manga/displaypage', ['thing' => $img, 'pages'=>$singlechapter, "mangas" => $actualmanga, 'chapters'=>$singlemanga, 'title'=>$title, 'tchapter'=>$tchapter, 'numpage'=>$numpage]);
}