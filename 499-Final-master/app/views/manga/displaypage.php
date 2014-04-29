<html>
<head>
<title><?php echo $chapters->title . ' page '. $numpage; ?></title>
<style>
.hint {border:5px solid #a9a9a9;border-right:0;border-left:0;background:#444;color:white;font-size:10px;padding:5px;margin:0;}
#content{text-align:center;background-image:url(https://cdn.mangaeden.com/images/bg.png)}
body{font-family:Verdana,Helvetica,sans-serif;margin:0;padding:0;border:0;background:#1d1d1d url(http://cdn.mangaeden.com/images/bg.png);font-size:14px;color:#393939;min-width:600px;}
#top{font-size:16px;font-weight:bold;background-color:#4d4d4d;color:#cccccc;border:5px darkGray solid}#top a{color:gray;text-decoration:none;}
</style>
</head>

<body>

<div style="margin:auto;width:1000px">


<div id="top" style="width:<?php echo $thing[2];?>">
<header><a href="/">Manga Site </a> >> <a href="/<?php echo $title;?>"> <?php echo $chapters->title; ?> </a> >> <?php echo $tchapter;?></header>
<br />
<select id="chaptertitle" style="width:350px">
	
       
	<?php foreach ($chapters->chapters as $i=>$chapter) : ?>
        <option value="<?php echo '/'.$title.'/'.$chapter[0].'/1'; ?>"<?php if($chapter[0]==$tchapter){echo "selected";}?>> 
         Chapter: <?php echo $chapter[0]." "?><?php if($chapter[0]!=$chapter[2]){ echo $chapter[2]; }?></option>
    <?php endforeach; ?>
    </select>
    
    <a href="/<?php
	if($numpage==1 && $tchapter>1){
	    echo $title.'/'.($tchapter-1).'/'; 
   }
   else if($numpage==1 && $tchapter==1){
	   echo $title;
   }
   else{
	   echo $title.'/'.$tchapter.'/'.($numpage-1);
	  
   }
    ?>">
	
	
    <button style="margin-left:<?php echo ($thing[2]-500).'px"'?>>Prev </button></a>
    <select id="pagenumbers">
    
    <?php $images=array_reverse($pages->images) ?>
    <?php foreach ($images as $image) : ?>
        <option value="<?php echo '/'.$title.'/'.$tchapter.'/'.($image[0]+1) ?>" <?php if($image[0]+1==$numpage){echo "selected";}?>> <?php echo $image[0]+1 ?></option>
    <?php endforeach; ?>
        
    </select>
    
    
        

    
   <a href="/<?php
   if($numpage==($pages->images[0][0]+1)){
	    echo $title.'/'.($tchapter+1).'/1'; 
   }
   else{
	   echo $title.'/'.$tchapter.'/'.($numpage+1);
	  
   }
    ?>">  <button> Next </button> </a>
    
   <br clear="all" />
    </div>
    <div id="content">
      <div id="image" style="width:<?php echo $thing[2]; ?>px;border-left:5px solid darkGray;border-right:5px solid darkGray;">
        <div style="width:<?php echo $thing[2]; ?>px;height:90px;border-bottom:5px solid darkGray;background-color:#4d4d4d"> </div>
        <a href="/<?php
   if($numpage==($pages->images[0][0]+1)){
	    echo $title.'/'.($tchapter+1).'/1'; 
   }
   else{
	   echo $title.'/'.$tchapter.'/'.($numpage+1);
	  
   }
    ?>">
        
        <img src="https://cdn.mangaeden.com/mangasimg/<?php echo $thing[1] ?>"></a>
        
        <div class="hint"><b>Hint</b>: click on the image to go to the next page or use the select drop downs to change page or chapter. <br /> Copyrights and trademarks for the manga, and other promotional materials are held by their respective owners and their use is allowed under the fair use clause of the Copyright Law. </div>
        
        <div style="width:<?php echo $thing[2]; ?>;height:200px;border-bottom:5px solid darkGray;background-color:#4d4d4d"> </div>
      </div>
   </div>
</div>
  
  
 
  
  
<script>
    document.getElementById("chaptertitle").onchange = function() {
            window.location.href = this.value;      
    };
	document.getElementById("pagenumbers").onchange = function() {
            window.location.href = this.value;      
    };
</script>  

</body>
</html>