<?PHP
	session_start();
?>

<link rel="stylesheet" type="text/css" href="index.css" />

<div class="shop" >
    <?php
	$i = 0;
	if (count($_SESSION['cart']) < 1)
		exit(1);
    foreach($_SESSION['cart'] as $elem)
    {
        ?>
        <div class="objet" style="display:flex; justify-content: space-between">
            <div class="url">
                <img width="200px" height="200px" src="<?PHP echo $elem[3]; ?>" />
            </div>
            <div class="name" style="display:flex; flex-direction:column; justify-content: center; width:200px; height:200px">
                <p style="height:200px; width:200px"><?PHP echo $elem[1]; ?></p>
                <span style="height:200px; width:200px"><?PHP echo $elem[4]; ?></span>
                	<span style="height:200px; width:200px"><a href="index.php?item_id=<?php echo $elem[0]; ?>&remove=1&type=cart">Remove</a></span>
            </div>
            <div class="desc" >
                <span><?PHP echo $elem[2]; ?></span>
            </div>
        </div>
        <?php $i++;} ?>
    </div>
