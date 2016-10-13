<?php
namespace EInviteBundle;

use Core\Controller;


class ApiController extends Controller {

	public function submitAction() {
		$_POST['openid'] = 'wwssssssssssssssssadawdawad';
	}

	public function demonloginAction() {
		$_SESSION['openid'] = 'wwssssssssssssssssadawdawad';
		return $this->Response('success');
	}

}
