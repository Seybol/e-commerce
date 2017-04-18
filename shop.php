<?PHP
	session_start();
?>

<link rel="stylesheet" type="text/css" href="index.css" />

<div class="shop" >
    <form method="get" action="index.php">
        <select name="category">
            <option value="1">Post-it</option>
            <option value="2">Stabilo</option>
            <option value="3">Erasers</option>
            <option value="4">All</option>
        </select>
        <input type="submit" name="choice" value="OK"/>
    </form>
    <?php
	$i = 0;
	if ($_SESSION['category'] !== "")
	{
		$tab = get_items($_SESSION['category']);
	}
	else
		$tab = get_items(4);
    foreach($tab as $elem)
    {
        ?>
        <div class="objet" style="display:flex; justify-content: space-between">
            <div class="url">
                <img width="200px" height="200px" src="<?PHP echo $elem[3]; ?>" />
            </div>
            <div class="name" style="display:flex; flex-direction:column; justify-content: center; width:200px; height:200px">
                <p style="height:200px; width:200px"><?PHP echo $elem[1]; ?></p>
                <span style="height:200px; width:200px"><?PHP echo $elem[4]; ?></span>
                <span style="height:200px; width:200px"><a href="index.php?item_id=<?php echo $elem[0]."&type=shop&category=".$elem[5];?>">Add to cart</a></span>
            </div>
            <div class="desc" >
                <span><?PHP echo $elem[2]; ?></span>
            </div>
        </div>
        <?php $i++;} ?>
    </div>
