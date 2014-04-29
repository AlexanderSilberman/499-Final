<?php

class InputTest extends PHPUnit_Framework_TestCase {

  public function test_input()
  {
	  //Arrange
	 $mangasearch=new \ITP\API\MangaSearch();
	 
	 //Act
	 $m=$mangasearch->cacheList("ultrared");
	
	//$this->assertNull();
	
	//Assert
	$this->assertEquals($m[1]->a,'ultrared');
	//$this->asserFalse();
 
	
	//Act
	$c=$mangasearch->cacheManga('ultrared','32',$m[1]);
	
	
	$this->assertEquals($c[1][0],32);
  }



} 


?>