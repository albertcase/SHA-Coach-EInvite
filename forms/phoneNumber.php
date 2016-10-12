<?php
namespace forms;

use Core\FormRequest;

class phoneNumber extends FormRequest{
  public function rule(){
    return array(
      'callnumber' => array('callnumber' => array()),
    );
  }

  public function doData(){
    if($this->Confirm() > 0){
      return array('code' => '11' ,'msg' => 'callnumber error');
    }
    return $this->dealData();
  }

  public function dealData(){
    
  }

  public function callnumber_Ckeck($key){
    return (bool)preg_match("/^[0-9]{6}+$/" ,trim($key))
  }
}
