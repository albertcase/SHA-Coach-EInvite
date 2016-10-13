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
// $routers['/test/%/aa/%'] = array('EInviteBundle\Site', 'test');
