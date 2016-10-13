<?php
namespace EInviteBundle;

use Core\Controller;


class SiteController extends Controller {

	public function __construct() {

	}

	public function oauth3Action(){
		$openid = isset($_GET['openid'])?$_GET['openid']:'';
		return $this->dataPrint(array('code' => '10', 'msg' => $openid));
	}

	public function oauth2Action(){
		if(isset($_GET['openid']))
			$_SESSION['openid'] = $_GET['openid'];
		if(isset($_SESSION['openid'])){
			return $this->redirect("/oauth3?openid=".$_SESSION['openid']);
		}
		return $this->redirect("http://coach.samesamechina.com/api/wechat/oauth/auth/0c6b3afb-b6bc-4dce-9f6b-8c1e812e4458");
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
