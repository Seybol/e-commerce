<?php
	session_start();
	include("login.php");
	if (isset($_POST['delete']))
	{
		delete_account($_POST['pseudo']);
	}
	if (isset($_POST['god']))
	{
		god($_POST['pseudo']);
	}
	if (isset($_POST['change']))
	{
		modify_passwd($_SESSION['login'], $_POST['oldpw'], $_POST['newpw']);
	}
	if (isset($_POST['autodelete']))
	{
		delete_account($_SESSION['login']);
	}
	if (!isset($_SESSION['right']))
	{
		$_SESSION['right'] = "guest";
	}
	if ($_GET['category'] != "")
	{
		$_SESSION['category'] = $_GET['category'];
		$_GET['type'] = "shop";
	}
	else
	{
		$_SESSION['category'] = 4;
	}
	if ($_GET['item_id'] != "" && !isset($_GET['remove']))
	{
		add_cart($_GET['item_id']);
	}
	if ($_POST['login'] !== "" && $_POST['passwd'] !== "" && $_POST['submit'] === "login")
	{
		auth($_POST['login'], $_POST['passwd']);
	}
	else if ($_POST['login'] !== "" && $_POST['passwd'] !== "" && $_POST['submit'] === "signin")
	{
		create_account($_POST['login'], $_POST['passwd']);
	}
	else if ($_GET['type'] === "logout")
	{
		logout();
		$_SESSION['cart'] = array();
	}
	else if ($_SESSION['right'] === "guest")
	{
		$_SESSION['login'] = "";
		$_SESSION['right'] = "guest";
	}
	if ($_GET['remove'] === "1" && $_GET['item_id'] != "")
	{
		remove_cart($_GET['item_id']);
	}

	function calcul_cart()
	{
		if (isset($_SESSION['cart']))
		{
			$total = 0;
			foreach($_SESSION['cart'] as $elem)
			{
				$total += $elem[4];
			}
			return $total;
		}
		return 0;
	}
?>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="index.css" />
</head>
<body>
    <div class="tab">
        <a href="index.php">
            <div class="big_post_it"></div>
        </a>
            <div class="bonjour">
                Hi <?php if ($_SESSION['login'] !== ""){ echo $_SESSION['login'];} ?> !
            </div>
		<a href="index.php?type=shop">
        <div id='pink' class="pink">
            <span style="position: inherit; margin-top:40px; margin-left: 18px; font-size: 0.5em">Shop</span>
        </div>
	</a>
	<?php
	 if ($_SESSION['login'] !== "")
	 {
		 ?>
        <a href="index.php?type=manage"><div class="purple"></div></a>
		<?php }?>
            <?php if ($_SESSION['login'] != "") {
                ?>
        <a href="index.php?type=logout"><div class="blue">
                <span style="position: inherit; margin-top:50px; margin-left:10px; font-size: 0.5em">Log out</span>
            </div></a>
                <?php }?>

		<?php if ($_SESSION['login'] === "guest" || $_SESSION['login'] === ""){
			include("form.php");
 }?>
		<a href="index.php?type=cart">
            <div class="panier" >
                <span style="margin-top: 50px">CART</span>
                <span><?php echo calcul_cart(); ?> euros</span>
            </div>
		</a>
	<?php
		if ($_GET['type'] === "shop")
			include("shop.php");
		else if ($_GET['type'] === "cart")
			include("cart.php");
			else if ($_GET['type'] === "manage")
			{
				if ($_SESSION['right'] === "admin")
					include("admin.php");
				else
					include("user.php");
			}
			?>
		</div>
	</body>
	</html>
