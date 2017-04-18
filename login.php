<?PHP
	session_start();
    function check_login($login)
    {
    	$path_acc = "./database/private/accounts";
        if (file_exists($path_acc))
        {
            $file = file_get_contents($path_acc);
            $tab = unserialize($file);
            foreach($tab as $key => $elem)
            {
                if ($tab[$key]['login'] === $login)
                {
                    return TRUE;
                }
            }
        }
        return FALSE;
	}

	function check_account($login, $passwd)
    {
    	$path_acc = "./database/private/accounts";
		$passwd = hash("whirlpool", $passwd);
        if (file_exists($path_acc))
        {
            $file = file_get_contents($path_acc);
            $tab = unserialize($file);
            foreach($tab as $key => $elem)
            {
                if ($tab[$key]['login'] === $login)
				{
					if ($tab[$key]['passwd'] === $passwd)
					{
						$_SESSION['login'] = $tab[$key]['login'];
						$_SESSION['right'] = $tab[$key]['right'];
                    	return TRUE;
					}
                }
			}
        }
        return FALSE;
    }

    function create_account($login, $passwd)
    {
    	$path_acc = "./database/private/accounts";
		if (check_login($login) == FALSE)
		{
            $passwd = hash("whirlpool", $passwd);
            if (file_exists($path_acc))
            {
                $file = file_get_contents($path_acc);
                $tab = unserialize($file);
                $len = count($tab);
                $account = array();
                $account['login'] = $login;
				$account['passwd'] = $passwd;
				$account['right'] = "user";
				$tab[$len] = $account;
				$str = serialize($tab);
				file_put_contents($path_acc, $str);
				$_SESSION['login'] = $login;
				$_SESSION['right'] = "user";
				return TRUE;
            }
		}
		return FALSE;
	}

	function auth($login, $passwd)
	{
		check_account($login, $passwd);
	}

	function logout()
	{
		push_cart();
		$_SESSION['login'] = "";
		$_SESSION['right'] = "guest";
	}

	function get_items($id)
	{
		$i = 0;
		$obj = array();
		$path_csv = "./items.csv";
		$handler = fopen($path_csv, "r");
		while (($tab = fgetcsv($handler)))
		{
			if ($tab[5] == $id)
				$obj[$i] = $tab;
			else if ($id == 4)
				$obj[$i] = $tab;
			$i++;
		}
		return $obj;
	}

	function delete_account($login)
	{
    	$path_acc = "./database/private/accounts";
		$file = file_get_contents($path_acc);
		$tab = unserialize($file);
		foreach($tab as $key => $elem)
		{
			if ($tab[$key]['login'] === $login)
			{
				unset($tab[$key]);
				$tab = array_values($tab);
				$str = serialize($tab);
				file_put_contents($path_acc, $str);
				if ($_SESSION['login'] === $login)
				{
					$_SESSION['login'] = "";
					$_SESSION['right'] = "guest";
				}
			}
		}
	}

	function modify_passwd($login, $oldpw, $newpw)
	{
		$path_acc = "./database/private/accounts";
		$oldpw = hash("whirlpool", $oldpw);
		$newpw = hash("whirlpool", $newpw);
		$file = file_get_contents($path_acc);
		$tab = unserialize($file);
		foreach($tab as $key => $elem)
		{
			if ($tab[$key]['login'] === $login)
			{
				if ($tab[$key]['passwd'] === $oldpw)
				{
					$tab[$key]['passwd'] = $newpw;
					$str = serialize($tab);
					file_put_contents($path_acc, $str);
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
		}
		return FALSE;
	}

	function get_spec_items($id)
	{
		$i = 1;
		$obj = array();
		$path_csv = "./items.csv";
		$handler = fopen($path_csv, "r");
		$tab = fgetcsv($handler);
		while ($i != $id)
		{
			$tab = fgetcsv($handler);
			$i++;
		}
		return $tab;
	}

		function push_cart()
	{
		$path_acc = "./database/private/accounts";
		$file = file_get_contents($path_acc);
		$tab = unserialize($file);
		foreach($tab as $key => $elem)
		{
			if ($tab[$key]['login'] === $_SESSION['login'])
			{
				$tab[$key]['cart'] = $_SESSION['cart'];
				$str = serialize($tab);
				file_put_contents($path_acc, $str);
				return 0;
			}
		}
	}

	function add_cart($id)
	{

			$len = count($_SESSION['cart']);
			$item = get_spec_items($id);
			$_SESSION['cart'][$len] = $item;
	}

	function remove_cart($id)
	{
		$count = 0;
		foreach($_SESSION['cart'] as $elem)
	    {
			if($elem[0] != $id)
			{
				$count++;
			}
			else
			{
				if($count != count($_SESSION['cart']))
				{
					unset($_SESSION['cart'][$count]);
					$_SESSION['cart'] = array_values($_SESSION['cart']);
				}
				return;
			}
		}
	}

	function god($login)
	{
		$path_acc = "./database/private/accounts";
		$file = file_get_contents($path_acc);
		$tab = unserialize($file);
		foreach($tab as $key => $elem)
		{
			if ($tab[$key]['login'] === $login)
			{
				$tab[$key]['right'] = "admin";
				$str = serialize($tab);
				file_put_contents($path_acc, $str);
				return ;
			}
		}
	}
?>
