#!/usr/bin/env bash

php vendor/bin/phinx migrate -e prod
apache2-foreground