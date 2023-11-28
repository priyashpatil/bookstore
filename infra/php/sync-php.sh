#!/bin/bash

# Enable stop on errors and treat unset variables as errors
set -eu

ssh ubuntu@bookstore 'bash -s' < ./tools/php/php-cli-config.sh

ssh ubuntu@bookstore 'bash -s' < ./tools/php/php-fpm-config.sh
