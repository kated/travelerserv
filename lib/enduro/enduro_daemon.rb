#!/usr/bin/env ruby

require 'rubygems'
require 'daemons'

dir = File.dirname(__FILE__)
Daemons.run("#{dir}/enduro_server.rb",
       :dir_mode   => :script,
       :dir        => '../../tmp/pids'
)
