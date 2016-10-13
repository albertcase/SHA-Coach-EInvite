<?php
namespace EInviteBundle;

use Core\Controller;


class SiteController extends Controller {

	public function __construct() {

	}

	public function oauth2Action(){
		return $this->render('register');
	}

	public function registerAction() {
		$_db = new \Lib\DatabaseAPI();
		$_SESSION['openid'] = 'wwssssssssssssssssadawdawad';
		$openid = isset($_SESSION['openid'])?$_SESSION['openid']:'';
		if(!$info = $_db->findFileByOpenid($openid))
			return $this->render('register', array('trytimes' => '0'));
		if(!$info->awardcode)
			return $this->render('register', array('trytimes' => $info->trytimes));
		return $this->render('registercard', array('awardcode' => $info->awardcode));
	}

	public function registercardAction() {
		$_db = new \Lib\DatabaseAPI();
		$data = array(
			'openid' => '111111111111111111',
			'nickname' => 'qqqqqq',
			'headimgurl' => 'asdasdasdasdasdasd'
		);
		print_r($_db->registerAward('111111111111111111','18516180507'));
		return $this->render('registercard');
	}

	public function indexAction($id) {
		// $DatabaseAPI = new \Lib\DatabaseAPI();
		// $user = $DatabaseAPI->userLoad();
		// $parameterAry = $_GET;
		// if(count($parameterAry)>0)
		// 	$url = "/video/". $id . "?" . http_build_query($parameterAry);
		// else
		// 	$url = "/video/". $id;
		// if (!$user) {
		// 	//$_SESSION['redirect_url'] = $url;
		// 	$this->redirect("/wechat/ws/oauth2?redirect_uri=".urlencode("http://espritdance.samesamechina.com/callback?callback=".$url). "&scope=snsapi_base");
		// 	exit;
		// }
		// $video = $DatabaseAPI->findVideoById($id);
		// $file = $DatabaseAPI->findFileByFid($video->fid);
		// $ballot = $video->ballot;
		// $isballot = $DatabaseAPI->isballot($user->uid, $video->vid);
		// $user_video = $DatabaseAPI->getUserVideo($video->vid);
		// $mobile = 0;
		// $info = $DatabaseAPI->findUserByOpenid($user->openid);
		// if (!$user_video) {
		// 	//未绑定 直接绑定
		// 	$DatabaseAPI->bindVideo($user->uid, $video->vid);
		// 	$ismy = 1;
		// 	if ($info->mobile == '') {
		// 		$mobile = 1;
		// 	}
		// 	$this->render('index', array('shareurl' => 'http://espritdance.samesamechina.com' . $url, 'url' => $file->filename, 'vid' => $video->vid , 'mobile' => $mobile, 'isballot' => $isballot, 'ballot' => $ballot, 'ismy' => $ismy));
		// 	exit;
		// }
		// //已绑定
		// if ($user->uid == $user_video) {
		// 	$ismy = 1;
		// 	if ($info->mobile == '') {
		// 		$mobile = 1;
		// 	}
		// } else {
		// 	$ismy = 0;
		// }
		// $this->render('index', array('shareurl' => 'http://espritdance.samesamechina.com' . $url, 'url' => $file->filename, 'vid' => $video->vid , 'mobile' => $mobile, 'isballot' => $isballot, 'ballot' => $ballot, 'ismy' => $ismy));

	}

	public function testAction($a, $b) {
		//$DatabaseAPI = new \Lib\DatabaseAPI();
		$this->render('index', array('a' => $a, 'b' => $b));
	}



}
