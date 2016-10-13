<?php
namespace EInviteBundle;

use Core\Controller;


class ApiController extends Controller {

	public function submitAction() {
		$_db = new \forms\phoneNumber('POST');
		return $this->dataPrint($_db->doData());
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
