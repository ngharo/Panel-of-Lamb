<?php
class Service {
	public $sheep = array();

	public function __construct() {
		@mysql_connect('localhost', 'username', 'password');
		@mysql_select_db('sheep');
	}

	public function getSheep() {
		$res = @mysql_query("SELECT * FROM sheep WHERE `show`=1 ORDER BY created_at DESC");
		while($row = @mysql_fetch_row($res, MYSQL_ASSOC)) {
			$row['password'] = substr($row['password'], 0, 2) . '******';
			$this->sheep[] = $row;
		}

		return json_encode($this->sheep);
	}

	public function saveSheep($service, $username, $password, $domain_ip, $comments) {
		$res = @mysql_query("SELECT * FROM sheep WHERE username = '$username' AND password = '$password'");
		if(@mysql_num_rows($res) > 0) {
			return json_encode(false);
		}
		$res = @mysql_query("INSERT INTO sheep (service, username, password, domain_ip, comments, `show`)
			VALUES ('$service', '$username', '$password', '$domain_ip', '$comments', 1)");
	
		return (! $res) ? json_encode(false) : json_encode(true);
	}

	public function showSheep($id) {
		$res = @mysql_query("UPDATE sheep SET show = 1 WHERE id = $id");
	
		return (! $res) ? json_encode(false) : json_encode(true);
	}

	public function autocompleteSvc() {
		$res = @mysql_query("SELECT DISTINCT(service) FROM sheep");
		$services = array();
		while($row = @mysql_fetch_row($res, MYSQL_NUM)) {
			$services[] = $row[0];
		}

		return json_encode($services);
	}
}

$svc = new Service();
$req = (isset($_GET['service'])) ? $_GET : $_POST;

switch($req['service']) {
	case 'get':
		echo $svc->getSheep();
		break;
	case 'save':
		if(empty($req['username']) && empty($req['password'])) {
			var_dump($_POST, $_GET);
			die();
		}

		$service = mysql_real_escape_string(htmlentities($req['svc']));
		$username = mysql_real_escape_string(htmlentities($req['username']));
		$password = mysql_real_escape_string(htmlentities($req['password']));
		$comments = mysql_real_escape_string(htmlentities($req['comments']));
		$dest     = mysql_real_escape_string(htmlentities($req['destination']));
		echo $svc->saveSheep($service, $username, $password, $dest, $comments);
		break;
	case 'show':
		if(! is_numeric($req['id'])) {
			throw new Exception('invalid paramenters');
		}

		$id = (int) $req['id'];
		//echo $svc->showSheep($id);
		break;
	case 'autocompleteSvc':
		echo $svc->autocompleteSvc();
		break;
	default:
		echo "valid services: get, save(svc, username, password, comments, destination) \n";
		die();
		break;
}

?>
