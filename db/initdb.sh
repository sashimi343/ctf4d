#!/bin/bash

docker-compose exec db "/docker-entrypoint-initdb.d/_init.sh_"
