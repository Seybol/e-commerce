<?PHP
    $acc_path = "./database/private/accounts";
    if (!file_exists("./database"))
    {
        mkdir("./database");
        mkdir("./database/private");
    }
    else if (!file_exists("./database/private"))
    {
        mkdir("./database/private");
	}
	else if (!file_exists($acc_path))
	{
		file_put_contents($acc_path, "");
	}
    $tab = array();
    $account = array();
    $account['login'] = "admin";
    $account['passwd'] = hash("whirlpool", "admin");
    $account['right'] = "admin";
    $tab[0] = $account;
    $file = serialize($tab);
    file_put_contents($acc_path, $file);
?>
