<html>
<head>
<title>Home</title>
<style>
body{font-family:Verdana,Helvetica,sans-serif;margin:0;padding:0;border:0;background:#1d1d1d url(http://cdn.mangaeden.com/images/bg.png);font-size:14px;color:#393939;}

table { border-collapse:collapse; }
table, td { border: 1px solid blue;}
br { display:block; margin-top:2px; line-height:5px; }

</style>
</head>

<body>
<div style="background-color:white;width:800px;margin:auto">
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

<?php $list[]; ?>
<table>
    <thead><a href="/"><td style="width:500px">Chapter Name</td></a><td>Date Added</td></thead>
    
    <?php foreach ($newmangas as $manga) : ?>
        <tr><td style="width:300px">
		<?php  
		
		$chapters=$search->getChapters($manga->siteID);
		$list[]=$chapters;
		$chapter=$chapters->chapters[0];
		
		echo '<a href="'.$manga->alias.'">';
		echo '<h5>'.$manga->Title.'<h5></a><br/>';
		
		 echo '<a href="/'.$manga->alias.'/'.$chapter[0].'/1'; ?>">
         
         
        
        
        
        
        
         <?php echo $manga->Title.' '; echo $chapter[0]." ";?><strong><?php if($chapter[0]!=$chapter[2]){ echo $chapter[2]; }?></strong></a></td><td><?php echo date("F j, Y", $manga->lastupdated);?></td></tr>
         
        
    <?php endforeach; ?>
   	
    <?php if(!(Cache::get('chapters'))){
    	Cache::put('chapters', $list);
    }
    ?>
    </table>

<div>

</body>
</html>