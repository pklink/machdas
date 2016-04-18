#!/usr/bin/env bash

MIGRATION="php vendor/bin/phinx migrate -e prod"
i=1
while [ ${i} -le 10 ]; do
    eval ${MIGRATION}
    if [ $? -eq 0 ]; then
        break
    fi
    i=`expr ${i} + 1`
    sleep 3
done

if [ ${i} -gt 10 ]; then
    echo "can't check migration status. is the mysql running"
    exit 1
fi

apache2-foreground