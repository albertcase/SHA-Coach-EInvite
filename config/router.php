<?php

$routers = array();
$routers['/'] = array('EInviteBundle\Site', 'registercard');
$routers['/registernumber'] = array('EInviteBundle\Site', 'registernumber');
$routers['/awardcard'] = array('EInviteBundle\Site', 'awardcard');
$routers['/oauth2'] = array('EInviteBundle\Site', 'oauth2');
$routers['/oauth3'] = array('EInviteBundle\Site', 'oauth3');

$routers['/api/demonlogin'] = array('EInviteBundle\Api', 'demonlogin');
$routers['/api/submit'] = array('EInviteBundle\Api', 'submit');
$routers['/api/userinfocallback'] = array('EInviteBundle\Api', 'userinfocallback');
$routers['/api/register'] = array('EInviteBundle\Api', 'register');
$routers['/api/logindinner'] = array('EInviteBundle\Api', 'logindinner');
$routers['/api/loginmeets1'] = array('EInviteBundle\Api', 'loginmeets1');
$routers['/api/loginmeets2'] = array('EInviteBundle\Api', 'loginmeets2');
$routers['/api/guestinfo'] = array('EInviteBundle\Api', 'guestinfo');
// $routers['/test/%/aa/%'] = array('EInviteBundle\Site', 'test');
