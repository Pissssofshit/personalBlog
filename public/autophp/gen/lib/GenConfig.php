<?php

    class GenConfig
    {
		private $_dom;
		public function __construct($dom)
		{
			$this->_dom = $dom;
		}
        
		public function code(){
			$db_host = $this->_dom['host'];
			$db_port = $this->_dom['port'];
            $db_name = $this->_dom['name'];
			$db_user = $this->_dom['user'];
			$db_pass = $this->_dom['password'];

			$db_host = empty($db_host) ? "mysql" : $db_host;
			$db_port = empty($db_port) ? "3306" : $db_port;

			$app_name = str_replace(" ", "", ucwords(str_replace("_", " ", $db_name))); 

			$code = <<<EOF
APP_NAME={$app_name}
APP_ENV=local
APP_KEY=base64:DjelKioVau/C/OUN3PFoIxNCHTwKWNGIpqDf7Y4D9Sc=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION={$db_name}
DB_HOST={$db_host}
DB_PORT={$db_port}
DB_DATABASE={$db_name}
DB_USERNAME={$db_user}
DB_PASSWORD={$db_pass}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

EOF;
         
            return $code;
        }
        

		public function admin() {
			foreach ($this->_dom->table as $tableNode) {
				$navi_name = $tableNode['comment'];
				$navi_url = $tableNode['name'];
				if ($tableNode['group']) {
					$navi_group = "{$tableNode['group']}";
					$navi_group_key = "g_" . substr(md5($navi_group), 0, 6);
				}
				else 
					$navi_group = "default";

				$bar_tree["$navi_group_key"]["sub"][]=array("name"=>"{$navi_name}", "url"=>"/autophp/{$navi_url}", "privilege"=>true);
				$bar_tree["$navi_group_key"]['name'] = $navi_group;
				$bar_tree["$navi_group_key"]['url'] = "";
				$bar_tree["$navi_group_key"]['privilege'] = true;

				$power_tree["$navi_group_key"]["sub"][]=array("name"=>"{$navi_name}", "url"=>"{$navi_url}/*", "privilege"=>true);
				$power_tree["$navi_group_key"]['name'] = $navi_group;
				$power_tree["$navi_group_key"]['url'] = "";
				$power_tree["$navi_group_key"]['privilege'] = true;
			}

			$power_tree["no_valide"] = array("index/*", "login/*");

			$tree = ["bar_tree"=>$bar_tree, "power_tree"=>$power_tree];

			$menu = var_export($tree, true);
			$menu = "<?php
return $menu;";

			return $menu;
		}
    }
?>
