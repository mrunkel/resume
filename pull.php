<?php

openlog('resume-pull', LOG_NDELAY, LOG_USER);

$secret = $_ENV('GITHUB_SECRET');
$body = file_get_contents('php://input');
$hook = json_decode($body, true);
syslog(LOG_NOTICE, "URL called!");
syslog(LOG_NOTICE, "hook['hook'] = " . print_r($hook['hook'],true));
syslog(LOG_NOTICE, "hook['hook']['config'] = " . print_r($hook['hook']['config'],true));
syslog(LOG_NOTICE, "hook['hook']['config']['secret'] = " . $hook['hook']['config']['secret']);

if ($secure) {
  $output = shell_exec ('cd /usr/share/nginx/html/resume && git pull');
  syslog(LOG_NOTICE, "Command executed, returned " . $output);
} else {
  syslog(LOG_ERR, "didn't find the secret!");
}

  
