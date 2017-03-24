<?php

openlog('resume-pull', LOG_NDELAY, LOG_USER);

$secret = getenv('GITHUB_SECRET');
$body = file_get_contents('php://input');
$hash = "sha1=" . hash_hmac ('sha1', $body, $secret);
syslog(LOG_NOTICE, "URL called!");

if ($hash === $_SERVER['HTTP_X_HUB_SIGNATURE']) {
  $output = shell_exec ('cd /usr/share/nginx/html/resume && git pull');
  syslog(LOG_NOTICE, "Command executed, returned: " . $output);
} else {
  syslog(LOG_ERR, "didn't find the secret!");
}
