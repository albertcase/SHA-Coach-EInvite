<?php
namespace Lib;

class PublicFun {

 public function checkNeedSubscribe($openid, $city){
  if(!$this->needSubscribe($city))
    return FALSE;
  $url = "http://coach.samesamechina.com/v2/wx/users/{$openid}?access_token=zcBpBLWyAFy6xs3e7HeMPL9zWrd7Xy";
  $userinfo = file_get_contents($url);
  $userinfo = json_decode($userinfo, true);
  if(isset($userinfo['code']) && $userinfo['code'] == '200'){
    if(isset($userinfo['data']) && isset($userinfo['data']['subscribe']) && $userinfo['data']['subscribe'])
      return FALSE;
  }
  return TRUE;
 }

 public function needSubscribe($city){
   $needcitys = array();
   if(in_array($city, $needcitys))
    return TRUE;
  return FALSE;
 }

}