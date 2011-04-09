#!/bin/sh
/usr/bin/env PATH=/usr/local/bin/:$PATH ruby /var/www/rails/travelerserv/current/lib/enduro/enduro_daemon.rb start >> /tmp/enduro.out 2>>/tmp/enduro.err
