Search a manga and find out the number of chapters and what the chapter names are <br />
(if applicable. UQ-holder is one of the few examples with it).


<form action="<?php echo url('manga/results') ?>" method="get">
    <select name="chapterid">
        /**
        <?php foreach ($mangas as $manga) : ?>
            <option value="<?php echo $manga->i ?>"> <?php echo $manga->t ?> </option>
        <?php endforeach; ?>
        */
    </select>
<br />

    <input type="submit" value="Search Chapters">
</form>