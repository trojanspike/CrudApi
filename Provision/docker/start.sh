#!/bin/bash

read pid cmd state ppid pgrp session tty_nr tpgid rest < /proc/self/stat
trap "kill -TERM -$pgrp; exit" EXIT TERM KILL SIGKILL SIGTERM SIGQUIT

sleep 30 # Wait for mysql to load and create the user / password
/var/www/CrudApi/Application/bin/schema up

source /etc/apache2/envvars
apache2 -D FOREGROUND
