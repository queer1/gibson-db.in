---
layout: post
title: Ruby client released.
categories:
- Dev Diary
tags:
- client
- gem
- module
- rack
- rails
- ruby
- socket
status: publish
type: post
published: true
---

Recently I'm improving my knowledge of the Ruby programming language, so I've thought it could be a nice exercise to implement the client module for Gibson.
So yesterday I've pushed to github the [first version](https://github.com/evilsocket/ruby-gibson) of a pure Ruby client module, in a few days I will implement the Rack interface to use it as the main cache backend inside Ruby on Rails.

A small example:

    require 'gibson'

    gibson = Gibson::Client.new

    # will retrieve the 'key' value
    gibson.get 'key'

    # create ( or replace ) a value with a TTL of 3600 seconds.
    # set the TTL to zero and the value will never expire. 
    gibson.set 3600, 'key', 'value'

    # delete a key from cache.
    gibson.del 'key'

    # will print server stats
    gibson.stats.each do |name,value|
        puts "#{name}: #{value}"
    end
