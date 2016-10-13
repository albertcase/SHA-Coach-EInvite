<?php
namespace EInviteBundle;

use Core\Controller;


class SiteController extends Controller {

	public function __construct() {

	}

	public function oauth2Action(){
		return $this->render('register');
	}

	public function registercardAction() {
		$_db = new \Lib\DatabaseAPI();
		$openid = isset($_SESSION['openid'])?$_SESSION['openid']:'';
		if(!$info = $_db->findFileByOpenid($openid))
			return $this->render('registernumber', array('trytimes' => '0'));
		if(!$info->awardcode)
			return $this->render('registernumber', array('trytimes' => $info->trytimes));
		return $this->render('awardcard', array('awardcode' => $info->awardcode));
	}

	public function registernumberAction() {
		return $this->render('registernumber', array('trytimes' => 2));
	}

	public function awardcardAction() {
		return $this->render('awardcard', array('awardcode' => 'wwwwwwwwwwwwwwwoooooooooooo'));
	}

}
