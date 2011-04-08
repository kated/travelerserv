#!/bin/sh
/usr/bin/env PATH=/usr/local/bin/:$PATH
/var/www/rails/travelerserv/lib/enduro/enduro_daemon.rb start > tmp.out
