<?php
ini_set('safe_mode',0);

class Server {
	protected $_domain;
	protected $_web_path;
	public function __construct($domain, $web_path = "/data/apache/www") {
		if (empty($web_path)) {
			$web_path = "/data/apache/www";
		}
		$this->_domain = $domain;
		$this->_web_path = $web_path;

		if (!file_exists($web_path)) {
			$cmd = "mkdir -p $web_path";
			$out = shell_exec($cmd);

			echo $out;
		}
	}

	public function apache($server_path = "/usr/local/apache") {
		if (empty($server_path)) {
			$server_path = "/usr/local/apache";
		}
		$this->_checkPath($server_path);
		$domain = $this->_domain;
		$web_path = $this->_web_path;

		$this->_createProject();

		$vh_conf = <<<EOF
<VirtualHost *:80>
    DocumentRoot "$web_path/$domain/Entry"
    ServerName $domain

    LogFormat "%{X-Real-Ip}i %l %u %t \"%r\" %>s %b" common
    ErrorLog logs/error_$domain.log
    CustomLog logs/access_$domain.log combined

    <Directory />
        Order Allow,Deny
        allow from all
        Options  FollowSymLinks
        AllowOverride none
    </Directory>


    #RewriteEngine on
    #RewriteCond $1 !^/(images|css|js|swf|upload|favicon|robots\.txt)
    #RewriteRule ^(.*)$ /index.php/$1 [L]
</VirtualHost>
EOF;
		
		$path = $server_path . "/conf/vhosts";
		if (file_exists($path)) {
			$cmd = "mkdir -p $path";
			$out = shell_exec($cmd);

			echo $out;
		}

		$conf_file = $path . "/$domain.conf";
		$fh = fopen($conf_file, "w");
		if (fwrite($fh, $vh_conf) === false) {
			$this->_error("Error: create virtual host '$domain' failed! config file:$conf_file");
		}	

		$cmd = $server_path . "/bin/apachectl stop";
		//$cmd = "killall -HUP httpd";
		$cmd = "ps aux| grep http;killall -HUP httpd";
		$this->_exec($cmd);
	}

	public function nginx($server_path = "/usr/local/nginx", $fcgi = "127.0.0.1:9001") {
		$this->_checkPath($server_path);
		$domain = $this->_domain;
		$web_path = $this->_web_path;

		$this->_createProject();

		$vh_conf = <<<EOF
server {
        listen          80;
        server_name     $domain;

        index index.html index.php;
        root  $web_path/$domain/Entry;

        location / {
                index  index.php;
                # If file not found, redirect to Zend handling, we can remove the (if) here and go directly rewrite
                if (!-f \$request_filename){
                        rewrite ^/(.+)$ /index.php?$1& last;
                }
        }

        location ~ .*\.(php|php5)?$ {
                fastcgi_pass  $fcgi;
                fastcgi_index index.php;
                include fastcgi.conf;
        }
        location ~* \.(html|shtml|htm|inc)$ {
            expires 60;
        }
        location ~* \.(css|js)$ {
            expires 2h;
        }
        location ~* ^.+\.(jpg|jpeg|gif|swf|mpeg|mpg|mov|flv|asf|wmv|avi)$ {
            expires 15d;
        }
        access_log logs/access_$domain.log access;

}
EOF;

		$path = $server_path . "/conf/vhosts";
		if (file_exists($path)) {
			$cmd = "mkdir -p $path";
			$this->_exec($cmd);
		}

		$fh = fopen($path . "/$domain.conf", "w");
		if (fwrite($fh, $vh_conf) === false) {
			$this->_error("Error: create virtual host '$domain' failed!");
		}

		$cmd = $server_path . "/sbin/nginx -s reload";
		echo $cmd;
		$out = shell_exec($cmd);

		$this->_exec($cmd);
	}

	private function _checkPath($path) {
		if (!file_exists($path)) {
			$this->_error("Error: The HTTP server path is not exists!");
		}
	}

	private function _createProject() {
		$web_path = $this->_web_path;
		$domain = $this->_domain;

		/*
		$src = BASE_PATH . "/res/project.zip";
		if (!file_exists($src)) {
			die ("Error: project.zip not found");
		}
		*/
		$dst = $web_path . "/" . $domain;
		
		if (file_exists($dst)) {
			return;
		}
		else {
			$cmd = "mkdir -p $dst";
			$this->_exec($cmd);
		}
		//$cmd = "unzip -n $src -d $dst";
		$cmd = "/usr/bin/git clone git@gitlab.mjutech.com:base/autophp-project-template.git $dst 2>&1";
		echo $cmd;
		$this->_exec($cmd);
	}

	private function _exec($cmd) {
		$out = shell_exec($cmd);
		echo "<pre>";
		echo $out;
		echo "</pre>";
	}

	private function _error($msg) {
		die("<p style='color:red'>$msg</p>");
	}
}
