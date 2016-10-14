<?php
namespace Lib;
/**
 * DatabaseAPI class
 */
class DatabaseAPI {

	private $db;

	/**
	 * Initialize
	 */
	public function __construct(){
		$connect = new \mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
		$this->db = $connect;
		$this->db->query('SET NAMES UTF8');
	}

	public function findFileByOpenid($openid){
		$sql = "SELECT coach_userinfo.trytimes,coach_award.awardcode FROM coach_userinfo LEFT JOIN coach_award ON coach_award.openid = coach_userinfo.openid WHERE coach_userinfo.openid = ?";
		// $sql = "SELECT `awardcode`, FROM `coach_einvite` WHERE `openid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $openid);
		$res->execute();
		$res->bind_result($trytimes,$awardcode);
		if($res->fetch()) {
			$result = new \stdClass();
			$result->trytimes = $trytimes;
			$result->awardcode = $awardcode;
			return $result;
		}
		return false;
	}

	public function registerAward($openid,$callnumber){
		if($this->insertTry($openid) === 'A')
			return 'E';//not have this openid
		if(!$res = $this->checkCallnumber($callnumber))
			return 'A';//not have this callnumber;
		if($res->openid)
			return 'B';//alread registered
		$sql = "UPDATE `coach_award` SET `openid` = ?,`awardcode` = ? WHERE `callnumber` LIKE '%{$callnumber}'";
		$res = $this->db->prepare($sql);
		$res->bind_param("ss", $openid,md5('openid'.$openid));
		if($res->execute())
			return 'C';//update success
		return 'D';//update errors
	}

	public function insertTry($openid){
		if(!$this->checkOpenid($openid))
			return 'A';//not have this user
		$sql = "UPDATE `coach_userinfo` SET `trytimes` = `trytimes` + 1 WHERE `openid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $openid);
		if($res->execute())
			return true;
		return false;
	}


	public function insertNewUser($data){
		if($this->checkOpenid($data['openid']))
			return false;
		$sql = "INSERT INTO `coach_userinfo` SET `openid` = ?,`username` = ? ,`userhandurl` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("sss", $data['openid'], $data['nickname'], $data['headimgurl']);
		if($res->execute())
			return $res->insert_id;
		return false;
	}

	public function checkOpenid($openid){
		$sql = "SELECT `trytimes` FROM `coach_userinfo` WHERE `openid` = ? ";
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $openid);
		$res->execute();
		$res->bind_result($trytimes);
		if($res->fetch()) {
			$result = new \stdClass();
			$result->trytimes = $trytimes;
			return $result;
		}
		return false;
	}

	public function checkAwardOpenid($openid){
		$sql = "SELECT `openid` FROM `coach_award` WHERE `openid` = ? ";
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $openid);
		$res->execute();
		$res->bind_result($ropenid);
		if($res->fetch()) {
			$result = new \stdClass();
			$result->openid = $ropenid;
			return $result;
		}
		return false;
	}

	public function checkCallnumber($number){
		$sql = "SELECT `openid`,`callnumber` FROM `coach_award` WHERE `callnumber` LIKE '%{$number}' ";
		$res = $this->db->prepare($sql);
		$res->execute();
		$res->bind_result($openid,$callnumber);
		if($res->fetch()) {
			$result = new \stdClass();
			$result->openid = $openid;
			$result->callnumber = $callnumber;
			return $result;
		}
		return false;
	}
	//////

	public function watchdog($type, $data){
		$nowtime = NOWTIME;
		$sql = "INSERT INTO `watchdog` SET `type` = ?, `data` = ?, `created` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("sss", $type, $data, $nowtime);
		if($res->execute())
			return $res->insert_id;
		else
			return FALSE;
	}

	public function findFileByFid($fid){
		$sql = "SELECT `fid`, `filename` FROM `file` WHERE `fid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $fid);
		$res->execute();
		$res->bind_result($fid, $filename);
		if($res->fetch()) {
			$file = new \stdClass();
			$file->fid = $fid;
			$file->filename = $filename;
			return $file;
		}
		return NULL;
	}

	public function findVideoByVid($vid){
		$sql = "SELECT `vid`, `fid`, `id` FROM `video` WHERE `vid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $vid);
		$res->execute();
		$res->bind_result($vid, $fid, $id);
		if($res->fetch()) {
			$video = new \stdClass();
			$video->vid = $vid;
			$video->fid = $fid;
			$video->id = $id;
			return $video;
		}
		return NULL;
	}

	public function findVideoById($id){
		$sql = "SELECT `vid`, `fid`, `id`, `ballot` FROM `video` WHERE `id` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $id);
		$res->execute();
		$res->bind_result($vid, $fid, $id, $ballot);
		if($res->fetch()) {
			$video = new \stdClass();
			$video->vid = $vid;
			$video->fid = $fid;
			$video->id = $id;
			$video->ballot = $ballot;
			return $video;
		}
		return NULL;
	}

	public function updateVideo($file){
		$sql = "UPDATE `video` SET `status` = 1 WHERE `fid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $file->fid);
		if($res->execute())
			return $file;
		else
			return FALSE;
	}

	public function getUserVideo($vid) {
		$sql = "SELECT uid FROM `user_video` WHERE `vid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $vid);
		$res->execute();
		$res->bind_result($uid);
		if($res->fetch()) {
			return $uid;
		}
		return 0;
	}

	public function bindVideo($uid, $vid) {
		$sql = "INSERT INTO `user_video` SET `uid` = ?, `vid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("ss", $uid, $vid);
		if ($res->execute()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function insertUser($openid) {
		$user = $this->findUserByOpenid($openid);
		if ($user) {
			return $user;
		}
		$sql = "INSERT INTO `user` SET `openid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $openid);
		if ($res->execute()) {
			return $this->findUserByOpenid($openid);
		} else {
			return FALSE;
		}
	}

	public function findUserByOpenid($openid) {
		$sql = "SELECT `id`, `openid`, `mobile` FROM `user` WHERE `openid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $openid);
		$res->execute();
		$res->bind_result($uid, $openid, $mobile);
		if($res->fetch()) {
			$user = new \stdClass();
			$user->uid = $uid;
			$user->openid = $openid;
			$user->mobile = $mobile;
			$_SESSION['user'] = $user;
			return $user;
		}
		return NULL;
	}

	public function userLoad(){
		if(isset($_SESSION['user'])){
			return $_SESSION['user'];
		}
		return NULL;

	}

	public function saveMobile($uid, $mobile) {
		$sql = "UPDATE `user` SET `mobile` = ? WHERE `id` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("ss", $mobile, $uid);
		if ($res->execute()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function ballot($uid, $vid) {
		$sql = "SELECT `id` FROM `ballot` WHERE `uid` = ? and `vid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("ss", $uid, $vid);
		$res->execute();
		$res->bind_result($id);
		if($res->fetch()) {
			return FALSE;
		}
		$sql = "INSERT INTO `ballot` SET `uid` = ?, `vid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("ss", $uid, $vid);
		if ($res->execute()) {
			//投票成功
			$sql = "UPDATE `video` SET `ballot` = ballot+1 WHERE `vid` = ?";
			$res2 = $this->db->prepare($sql);
			$res2->bind_param("s", $vid);
			$res2->execute();
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function isballot($uid, $vid) {
		$sql = "SELECT `id` FROM `ballot` WHERE `uid` = ? and `vid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("ss", $uid, $vid);
		$res->execute();
		$res->bind_result($id);
		if($res->fetch()) {
			return 1;
		}
		return 0;
	}

	public function getballot($vid) {
		$sql = "SELECT count(`id`) FROM `ballot` WHERE `vid` = ?";
		$res = $this->db->prepare($sql);
		$res->bind_param("s", $vid);
		$res->execute();
		$res->bind_result($num);
		if($res->fetch()) {
			return $num;
		}
		return 0;
	}
}
