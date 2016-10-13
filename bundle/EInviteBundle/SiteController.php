<?php
namespace EInviteBundle;

use Core\Controller;


class SiteController extends Controller {

	public function __construct() {

	}

	public function oauth3Action(){
		if(isset($_SESSION['openid'])){
			unset($_SESSION['oauthuser']);
			$callback_url = isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'/';
			return $this->redirect('/oauth2?callback='.urlencode($callback_url));
		}
		return $this->dataPrint("\nsuccess");
	}

	public function oauth2Action(){
		if(!isset($_SESSION['oauthuser']))
			$_SESSION['oauthuser'] = '0';
		if(isset($_GET['openid']))
			$_SESSION['openid'] = $_GET['openid'];
		if(isset($_GET['callback'])){
			$_SESSION['callback'] = ($_GET['callback'])?$_GET['callback']:'/';
		}
		$oau = isset($_SESSION['oauthuser'])?$_SESSION['oauthuser']:'0';
		if(intval($oau) > 1){
			if(isset($_SESSION['openid'])){
				unset($_SESSION['oauthuser']);
				$callback_url = isset($_SESSION['callback'])?urlencode($_SESSION['callback']):'/';
				return $this->redirect($callback_url);
			}
			if(intval($oau) > 4){//the more oauth error times;
				unset($_SESSION['oauthuser']);
				return $this->dataPrint('Oauth Error');
			}
		}
		return $this->redirect("http://coach.samesamechina.com/api/wechat/oauth/auth/7e172a57-ee93-4d02-bc85-7c9b3fcd28cb");
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
