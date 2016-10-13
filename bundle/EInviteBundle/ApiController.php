<?php
namespace EInviteBundle;

use Core\Controller;


class ApiController extends Controller {

	public function submitAction() {
		$_db = new \forms\phoneNumber('POST');
		return $this->dataPrint($_db->doData());
	}

	public function userinfocallbackAction(){
		$postStr = json_decode($GLOBALS["HTTP_RAW_POST_DATA"], true);
		if(!is_array($postStr))
			return $this->dataPrint(array('code' => '11', 'msg' => 'no data'));
		if(isset($postStr['code']) && $postStr['code'] == '200' && isset($postStr['data'])){
			$insql = array(
				'openid' => isset($postStr['data']['openid'])?$postStr['data']['openid']:'',
				'nickname' => isset($postStr['data']['nickname'])?$postStr['data']['nickname']:'',
				'headimgurl' => isset($postStr['data']['headimgurl'])?$postStr['data']['headimgurl']:'',
			);
			$_db = new \Lib\DatabaseAPI();
			$_db->insertNewUser($insql);
		}
		return $this->dataPrint(array('code' => '10', 'msg' => 'success'));
	}

	public function registerAction(){
		$data = array(
			'callback_url' => 'http://vipinvitation.samesamechina.com/api/userinfocallback',
			'redirect_url' => 'http://vipinvitation.samesamechina.com/oauth2',
			"scope" => "userinfo"
		);
		// $data = array(
		// 	'code' => 200,
		// 	'data' => array(
		// 		'openid' => '1qazxsw23edc',
		// 		'nickname' => 'dirc',
		// 		'headimgurl' => 'asdasdasdasdasdasdasd'
		// 	)
		// );
		return $this->dataPrint($data);
	}

	public function demonloginAction() {
		$_SESSION['openid'] = 'wwssssssssssssssssadawdawad';
		$data = array(
			'openid' => 'wwssssssssssssssssadawdawad',
			'nickname' => 'nickname',
			'headimgurl' => 'http://test.com/asdasdawdawdawdawdawdawdawd'
		);
		$_db = new \Lib\DatabaseAPI();
		$_db->insertNewUser($data);
		return $this->Response('success');
	}

}
