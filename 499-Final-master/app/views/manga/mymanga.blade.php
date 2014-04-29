<html>
<head>
<style>

body{font-family:Verdana,Helvetica,sans-serif;margin:0;padding:0;border:0;background:#1d1d1d url(http://cdn.mangaeden.com/images/bg.png);font-size:14px;color:#393939;}

table { border-collapse:collapse; }
table, td { border: 1px solid blue;margin:5px;padding:10px}
br { line-height:5px; }
</style>
</head>

<body>

<div style="background-color:white;width:800px;margin:auto">


	@if (Auth::user()->id==10)
    	Hey David! Welcome to your admin panel!
        {{ Form::open(array('url' => 'delete')) }}
        {{ Form::submit('Delete All Mangas!') }}
        {{ Form::close() }}
    	{{Form::open(array('url' => 'add')) }}
        {{ Form::submit('Add all the mangas back!') }}
    	{{ Form::close() }} 

    @endif
	


<table>
    <thead><a href="/"><td style="width:500px"><h2>Manga Title</h2></td></a><td><h2>Latest Chapter</h2></td></thead>
    
    <?php foreach ($favorites as $favorite) : ?>
        <tr><td style="width:300px">
		<?php  
		
		$chapters=$search->getChapters($favorite->siteID);
		$chapter=$chapters->chapters[0];
		
		echo '<a href="'.$favorite->alias.'">';
		echo $favorite->Title.'</a></td><td>';
		
		 echo '<a href="/'.$favorite->alias.'/'.$chapter[0].'/1'; ?>">
         
         
        
        
        
        
        
         <?php echo $chapter[0];?></a><?php echo' on '.date("F j, Y", $favorite->lastupdated);?></td></tr>
    <?php endforeach; ?>
    
    </table>

<div>

</body>

</html>