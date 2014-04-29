<?php
/**
 * Created by PhpStorm.
 * User: AlexSilberman
 * Date: 3/5/14
 * Time: 2:49 AM
 */

namespace ITP\API;

class MangaSearch {

    public function getList(){
        $endpoint= "https://www.mangaeden.com/api/list/0/";
        $json = file_get_contents($endpoint);
        return json_decode($json);
    }

    public function getChapters($id){
        $endpoint ="https://www.mangaeden.com/api/manga/".$id;
        $json = file_get_contents($endpoint);
        return json_decode($json);

    }
	
	public function getPages($id){
		$endpoint ="https://www.mangaeden.com/api/chapter/".$id;
        $json = file_get_contents($endpoint);
        return json_decode($json);

	}
	
	
	
	//If there is a list in the cache then use that.
	//If not pull the whole list from the API and put it in the cache for ten minutes.
	public function cacheList($title){
		$actualmanga="";
	 $mangas=\Cache::get('list');
	 if(!$mangas){
		  $mangas=$this->getList();
		  \Cache::put('list',$mangas,200);
	   }
	  $in=-1;
	//For each manga in the whole json object check if the title is the same as in the link
	foreach($mangas->manga as $index=>$manga){
		if($manga->a==$title){
				$actualmanga=$manga;
				$in=$index;
				break;
		}
	}
	  return [$mangas,$actualmanga,$in];	
	}



	public function cacheManga($title, $tchapter,$actualmanga){
		$different="";
		$actualchapter="";
		//Check if there is any manga objects in the cache
		$singlemanga=\Cache::get('manga');
		//Check if there is a title in the cache
		$tit=\Cache::get('title');
	  
	  	
		//If there isn't a manga object or if the titles are different (looking at new manga) make a new manga object.
		if((!$singlemanga) || ($tit=$title)){
		  $singlemanga=$this->getChapters($actualmanga->i);
		  \Cache::put('manga',$singlemanga, 10);
		  \Cache::put('title',$title,10);
		  $different=true;
	  }
	  //For each chapter in the manga object, check if the chapter number is the same as the link
	  foreach($singlemanga->chapters as $chapter){
		  if($chapter[0]==$tchapter){
				  $actualchapter=$chapter;
				  break;
		  }
		}
		
		return [$singlemanga,$actualchapter,$different];
	}


	public function cacheChapter($tchapter,$numpage,$different,$actualchapter){
		$img="";
		//Check if there is a chapter object in the cache
		$singlechapter=\Cache::get('chapter');
		//Check if there is a chapter number in the cache
		$chp=\Cache::get('chapternumber');
		//If there isn't a chapter object or if the chapter numbers are different (looking at new chapter) make a new chapter object
		if(!$singlechapter || $tchapter!=$chp || $different){
			$singlechapter=$this->getPages($actualchapter[3]);
			\Cache::put('chapter',$singlechapter, 10);
			\Cache::put('chapternumber',$tchapter, 10);
		}
		
		
		//For each page in the manga object, check if the page number is the same as the link
		foreach($singlechapter->images as $image){
			if($image[0]+1==$numpage){
					$img=$image;
					break;
			}
		}
		return [$singlechapter,$img];
	}


}