#!/usr/bin/env /usr/local/bin/ruby

require 'rubygems'
require 'daemons'

Daemons.run('/var/www/rails/travelerserv/lib/enduro/enduro_server.rb')
