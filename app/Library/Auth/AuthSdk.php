<?php
namespace APP\Library\Auth;
/**
 * AuthSdk for auth.joyport.com.cpp service
 */


use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

define('PROC_REMOTE_CHECK_IS_LOGIN', 101);
define('PROC_REMOTE_GET_USER_PROJECT', 102);
define('PROC_REMOTE_GET_PROJECT_MEMBER', 103);

define('APP_NAME', 'shouru');
define('PROC_REMOTE_SEND_TIPS_BY_USERID', 201);
define('PROC_REMOTE_SEND_TIPS_BY_CHSNAME', 202);
define('PROC_REMOTE_SEND_TIPS_BY_USERNAME', 203);

class AuthSdk extends SdkAbstract {
    const SDK_NAME = 'auth';
    private $_user;

    public function __construct() {
        parent::__construct(self::SDK_NAME);
    }

    static $_instance = NULL;
    static public function getInstance()
    {
        if (empty(AuthSdk::$_instance))
        {
            AuthSdk::$_instance = new AuthSdk();
        }
        return AuthSdk::$_instance;
    }
    //判断是否成功登录
    public function isLogin()
    {
        //$user_id = Cookie::get('user_id','');
		//$session_key = Cookie::get('session_key','');
        $user_id = isset($_COOKIE['user_id'])?$_COOKIE['user_id']:0;
        $session_key = isset($_COOKIE['session_key'])?$_COOKIE['session_key']:0;
        if (empty($user_id)||empty($session_key)) return false;
		$this->_user = $this->checkIsLoginFromService($user_id,$session_key);

        if (is_null($this->_user))
        {
            return false;
        }
        return true;
    }
    public function requireLogin()
    {
        $url = Request::getUri();

        return Response::make('',302)->header('location', config('auth.sdk.baseurl') . '/?forward='.urlencode($url));
	}

	public function getUserID(){
		return $this->_user->user_id();
	}

	public function getUserName(){
		return $this->_user->user_name();
	}

	public function getChsName(){
		return $this->_user->chs_name();
	}
	
	public function getUserProject($user_id){
        $data = AuthSocket::getInstance();
        $data->setProc(PROC_REMOTE_GET_USER_PROJECT);
        $data->writeInt32($user_id);
        $reply = AuthSocket::call($data);
        $status = $reply->readInt8();
        if (!$status)
        {
            $err_msg = $reply->readString();
            return null;
        }
        $user = new User();
        $user->_user_id($user_id);
        $user->unpackProjectList($reply);
        return $user;
    }
    public function getProjectMember($project_id){
        $data = AuthSocket::getInstance();
        $data->setProc(PROC_REMOTE_GET_PROJECT_MEMBER);
        $data->writeInt32($project_id);
        $reply = AuthSocket::call($data);
        $status = $reply->readInt8();
        if (!$status)
        {
            $err_msg = $reply->readString();
            return array();
        }
        $user = array();
        while($reply->readInt8())
        {
            $user_id = $reply->readInt32();
            $user_name = $reply->readString();
            $chs_name = $reply->readString();
            $role = $reply->readInt8();
            $user[$user_id] = array(
                'user_id' => $user_id,
                'user_name' => $user_name,
                'chs_name' => $chs_name,
                'role' => $role,
            );
        }
        return $user;
    }
    private function checkIsLoginFromService($user_id,$session_key)
    {
        $data = AuthSocket::getInstance();
        $data->setProc(PROC_REMOTE_CHECK_IS_LOGIN);
        $data->writeInt32($user_id);
        $data->writeString($session_key);
        $reply = AuthSocket::call($data);
        $status = $reply->readInt8();


        if (!$status)
        {
            $err_msg = $reply->readString();

            if (!empty(Cookie::get('backauthv20','')))
            {
                $backAuthCheck = $this->checkBackAuth(Cookie::get('backauthv20'))->value;
                if (!is_null($backAuthCheck) && isset($backAuthCheck['success']) && $backAuthCheck['success'])
                {
                    $user = new User();
                    $user->user_id((int) $backAuthCheck['data']['user_id']);
                    $user->user_name($backAuthCheck['data']['username']);
                    $user->chs_name($backAuthCheck['data']['chs_name']);

                    Cookie::queue("session_key",$backAuthCheck['data']['session_key'],-1,'/');
                    return $user;
                }
            }
            return null;
        }
        if ($reply->readInt8())
        {
            $user = new User();
            $user->unpackLoginData($reply);
            return $user;
        }
        return null;
    }


    function checkBackAuth($backAuth)
    {
        return parent::getClient()->Auth('checkBackAuth',array("backauthv20"=>$backAuth));
	}

    function sendTipsByUserID($user_id,$title,$content,$url='',$display_time=60)
    {
        $this->sendByUserId($user_id, $content, $title, $url);
	}

    function sendQQTipsByUserName($username,$title,$content,$url='',$display_time=10)
    {
        return parent::getClient()->Auth("sendTipsByUserName",array("username"=>$username,"title"=>$title,"content"=>$content,"url"=>$url,"display_time"=>$display_time));
	}

    function getAllUserAndDepartment()
    {
        return parent::getClient()->User("getAllUserAndDepartment");
	}

    function renameDir($pro_id, $rename){
        return parent::getClient()->Group("renameDir", array("pro_id"=>$pro_id,"rename"=>$rename));
    }

    public function getGroupsList(){
        return array(); // 对应使用的地方为一次性代码，故重构时放弃了本方法
	}

    public function getGroupList(){
        $tmp = $this->getUserProject($this->_user->user_id())->user_project_map();
        $return = array();
        foreach ($tmp as $project_id => $user_project)
        {
            $project = $user_project->project();
            $role = $user_project->role();
            $tmp_name = $user_project->tmp_name();
            $project_show = $project->project_show();
            if (!$project_show)
            {
                continue;
            }
            $return[$project_id] = array(
                'project_id' => $project->project_id(),
                'project_name' => $project->project_name(),
                'project_show' => $project->project_show(),
                'project_to_user' => $project->project_to_user(),
                'project_start' => $project->project_start(),
                'is_sync_task' => $project->is_sync_task(),
                'is_sync_doc' => $project->is_sync_doc(),
                'pusers' =>array(
                    'is_set' => 1,
                    'role' => $role,
                    'project_tmp_name' => $tmp_name,
                )
            );
        }
        return $return;
    }

    public function sendByUserId($user_id, $content, $title='', $url='')
    {
        $data = AuthSocket::getInstance();
        $data->setProc(PROC_REMOTE_SEND_TIPS_BY_USERID);
        $data->writeInt32($user_id);
        $data->writeString(APP_NAME);
        $data->writeString($title);
        $data->writeString($url);
        $data->writeString($content);
        AuthSocket::send($data);
    }

    public function sendByUserName($user_name, $content, $title='', $url='')
    {
        $data = AuthSocket::getInstance();
        $data->setProc(PROC_REMOTE_SEND_TIPS_BY_USERNAME);
        $data->writeString($user_name);
        $data->writeString(APP_NAME);
        $data->writeString($title);
        $data->writeString($url);
        $data->writeString($content);
        AuthSocket::send($data);
    }

    public function sendByChsName($chs_name, $content, $title='', $url='')
    {
        $data = AuthSocket::getInstance();
        $data->setProc(PROC_REMOTE_SEND_TIPS_BY_CHSNAME);
        $data->writeString($chs_name);
        $data->writeString(APP_NAME);
        $data->writeString($title);
        $data->writeString($url);
        $data->writeString($content);
        AuthSocket::send($data);
    }
    //quanxian
	function getPermissionByUserID($url, $secret_key, $user_id, $flag = 0)
    {
    	//var_dump($url.$secret_key.$user_id);exit;
        return parent::getClient()->Auth("getPermission", array("user_id" => $user_id, "secret_key" => $secret_key, "url" => $url, "flag" => $flag));
    }
    function getRoleAndUser($url, $secret_key)
    {
        return parent::getClient()->Auth("getRoleAndUserByPro", array("secret_key" => $secret_key, "url" => $url));
    }

    function createNewPermission($project_id,$project_key,$name,$permission_tax,$group)
    {
        return parent::getClient()->Permission("createNewPermission", array("project_id" => $project_id, "project_key" => $project_key,"name" => $name, "permission_tax" => $permission_tax,"group" => $group));
    }
    function createNewGroup($project_id, $project_key,$group_name, $group_tax)
    {
        return parent::getClient()->Permission("createNewGroup",  array("project_id" => $project_id,"project_key" => $project_key, "group_name" => $group_name, "group_tax" => $group_tax));
    }

}

class User extends BaseClass
{
    protected $_user_id;
    protected $_user_name;
    protected $_chs_name;
    protected $_user_project_map;

    public function unpackLoginData($reply)
    {
        $this->_user_id = $reply->readInt32();
        $this->_user_name = $reply->readString();
        $this->_chs_name = $reply->readString();
    }

    public function unpackProjectList($reply)
    {
        $project_count = $reply->readInt32();
        for($i = 0; $i< $project_count; $i++) {
            $user_project = new UserProject();
            $user_project->unpack($reply);
            $project_id = $user_project->project()->project_id();
            $this->_user_project_map[$project_id] = $user_project;
        }
    }
}

class Project extends BaseClass
{
    protected $_project_id;
    protected $_project_name;
    protected $_project_start;
    protected $_project_to_user;
    protected $_project_show;
    protected $_is_sync_task;
    protected $_is_sync_doc;

    public function unpack($reply)
    {
        $this->_project_id = $reply->readInt32();
        $this->_project_name = $reply->readString();
        $this->_project_start = $reply->readString();
        $this->_project_to_user = $reply->readInt32();
        $this->_project_show = $reply->readInt32();
        $this->_is_sync_task = $reply->readInt32();
        $this->_is_sync_doc = $reply->readInt32();
    }
}

class UserProject extends BaseClass
{
    protected $_project;
    protected $_role;
    protected $_tmp_name;

    public function unpack($reply)
    {
        $this->_project = new Project();
        $this->_project->unpack($reply);
        $this->_role = $reply->readInt8();
        $this->_tmp_name = $reply->readString();
    }
}

class BaseClass
{
    public function __call($function_name, $args)
    {
        $property_name = '_' . $function_name;
        if (property_exists($this, $property_name))
        {
            if (isset($args[0]) && !is_null($args[0]))
            {
                $this->$property_name = $args[0];
            }
            return $this->$property_name;
        }
    }
}
