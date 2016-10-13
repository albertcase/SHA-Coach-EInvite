<?php

$routers = array();
$routers['/registercard'] = array('EInviteBundle\Site', 'registercard');
$routers['/registernumber'] = array('EInviteBundle\Site', 'registernumber');
$routers['/awardcard'] = array('EInviteBundle\Site', 'awardcard');
$routers['/oauth2'] = array('EInviteBundle\Site', 'oauth2');

$routers['/api/demonlogin'] = array('EInviteBundle\Api', 'demonlogin');
// $routers['/test/%/aa/%'] = array('EInviteBundle\Site', 'test');
