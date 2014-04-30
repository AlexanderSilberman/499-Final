<html>
<head>
<title>{{$chapters->title}} Main Page </title>
<style>
body{font-family:Verdana,Helvetica,sans-serif;margin:0;padding:0;border:0;background:#1d1d1d url(//cdn.mangaeden.com/images/bg.png);font-size:14px;color:#393939;}

table { border-collapse:collapse; }
table, td { border: 1px solid blue;}

td a {
  display: inline-block;
  height:100%;
  width:100%;
  text-decoration:none;
  color: #0060B6;
}
td a:hover{ text-decoration:underline;}
tr:hover{background-color:#3399FF}

#leftContent{float:left;width:600px;margin-right:15px;padding:5px 10px;background-color:white}

.rightContent{width:200px;padding:10px;float:right;margin-bottom:15px;border: 1px solid blue;background-color:white}
.rightContent h3{margin-bottom:10px;color:#36c;font:bold 16px Arial,Helvetica,sans-serif;}
.rightContent img{max-width:200px;}



#chapterBlocks{margin-bottom:15px;margin-top:10px;width:100%;}
#chapterBlocks div{border:0;margin:5px;color:#0073EA;padding:0px;display:inline-block;border: 1px solid blue;height:30px;width:100px;background-color:#E8E8E8;}
#chapterBlocks div:hover{background-color:#0060B6;}
#chapterBlocks a{margin-right:5px;margin-top:5px;padding:0px;width:100%;text-decoration:none; display: inline-block;height:100%;}
#chapterBlocks a:visited{color:#0073EA}
#chapterBlocks a:hover{color:white;}
</style>
</head>
<body>

<div style="margin:auto;width:960">
	

	<div id="leftContent" style="width:700px">
    <h2 style="padding-left: 20px;margin-left: 5px;"> <?php echo $chapters->title;?> Manga <?php if(Auth::check()){ echo '<a href="mymanga">MY MANGA </a>'; } ?>
    @if (Auth::check())
        {{ Form::open(array('url' => $title)) }}
        <input type="hidden" name="user_id" value={{{ Auth::user()->id }}} />
        <input type="hidden" name="manga_id" value={{{ ($index+1) }}} />
        <input type="submit" value="Favorite!" />
        {{ Form::close() }}
    @endif
    @if (Auth::check())
    	{{Form::open(array('url' => 'logout')) }}
        {{ Form::submit('Log Out!') }}
    	{{ Form::close() }} 
    @else
    	{{Form::open(array('url' => 'login'))}}
        {{Form::submit('Make an account!')}}
       {{Form::close()}}
       {{Form::open(array('url' => 'signin'))}}
        {{Form::submit('Sign In!')}}
       {{Form::close()}}
    @endif
    </h2>
    <hr  />
    <?php foreach ($errors->all() as $message) : ?>
    <p style="background-color: red;" >
    <?php echo $message ?>
    </p>
<?php endforeach ?>


<?php if (Session::has('success')) : ?>
    <p style="background-color: green;">
        <?php echo Session::get('success') ?>
    </p>
<?php endif; ?>
    <?php echo $chapters->description; ?>
    
    <div id="chapterBlocks">
    <center>
    <?php 
		$count=50;
		while($count<$chapters->chapters[0][0]){
			$count+=50;
		}
		if(!($count==50)){
			echo '<div><a href="#c'.$chapters->chapters[0][0].'" role="button">'.$chapters->chapters[0][0].' - '.($count-49).'</span></a></div>';
			$count-=50;
			
			while($count>0){
				echo '<div><a href="#c'.$count.'" role="button">'.$count.' - '.($count-49).'</span></a></div>';
				$count-=50;
			}
		}
		
		//echo '<div><a href="#c'.$count.'" role="button">'.$chapters->chapters[0][0].' - '.($count-49).'</span></a></div>';
		
		//echo '<div><a href="#c'.$count.'" role="button">'.$count.' - '.($count-49).'</span></a></div>';
		//$count+=50;
		
	?>
    
    </center>
    </div>
    <hr />
    
	<table>
    <thead><a href="/"><td style="width:500px">Chapter Name</td></a><td>Date Added</td></thead>
    
    <?php foreach ($chapters->chapters as $chapter) : ?>
        <tr id="c<?php echo $chapter[0];?>"><td style="width:300px"><a href="<?php echo '/'.$title.'/'.$chapter[0].'/1'; ?>">
         <?php echo $chapters->title.' '; echo $chapter[0]." ";?><strong><?php if($chapter[0]!=$chapter[2]){ echo $chapter[2]; }?></strong></a></td><td><?php echo date("F j, Y", $chapter[1]);?></td></tr>
    <?php endforeach; ?>
    
    </table>
    </div>
    <div class="rightContent">
    	<img src="https://cdn.mangaeden.com/mangasimg/<?php echo $chapters->image;?>" />
    
    </div>
    <div class="rightContent">
    	Hits: <?php echo $chapters->hits;?>
        <br /> <br />
        
    
    	Author: <?php echo $chapters->author;?>
   		<br /><br/>
    	Artist: <?php echo $chapters->artist;?>
        <br /><br/>
        
        Genre:<?php foreach ($chapters->categories as $category): ?>
        	<?php echo $category ?>,
        <?php endforeach; ?>
        <br /><br />
        Status: <?php if($chapters->status==1){echo "Ongoing"; }else{ echo "Completed";} ?>
    </div>

</div>

</body>
</html>