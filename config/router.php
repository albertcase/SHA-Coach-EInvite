<?php

$routers = array();
$routers['/register'] = array('EInviteBundle\Site', 'register');
$routers['/registercard'] = array('EInviteBundle\Site', 'registercard');
$routers['/oauth2'] = array('EInviteBundle\Site', 'oauth2');
// $routers['/test/%/aa/%'] = array('EInviteBundle\Site', 'test');
