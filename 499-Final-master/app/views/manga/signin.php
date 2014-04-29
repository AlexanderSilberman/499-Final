<html>
<head>
<title>Log In </title>
<style>
body{font-family:Verdana,Helvetica,sans-serif;margin:0;padding:0;border:0;background:#1d1d1d url(http://cdn.mangaeden.com/images/bg.png);font-size:14px;color:#393939;min-width:600px;}
</style>
</head>
<body>
<div style="background-color:white;border:1px solid blue;margin:auto;width:800px;margin-top:40px" >
<h1>Log In:</h1>
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
<form action="<?php echo url('signin') ?>" method="post">
Username: <input type="text" name="username" /><br /><br />
Password: <input type="password" name="password"  /><br /><br />
<input type="submit" value="Create Account">
</form>
</div>

</body>
</html>