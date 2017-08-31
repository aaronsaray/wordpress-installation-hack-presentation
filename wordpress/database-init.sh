#!/usr/bin/env bash

/usr/bin/mysqld_safe &
sleep 5
mysql -e "CREATE DATABASE wordpress"