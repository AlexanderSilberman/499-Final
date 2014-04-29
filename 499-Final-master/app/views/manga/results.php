<h1><?php echo $manga->alias; ?></h1>

<?php foreach ($chapters as $chapter) : ?>
    <p>
        Chapter <?php echo $chapter[0]; ?>
        -
        <?php echo $chapter[2]; ?>
    </p>
<?php endforeach; ?>