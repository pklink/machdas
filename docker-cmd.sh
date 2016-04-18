#!/usr/bin/env bash

STATUS_CHECK="php vendor/bin/phinx status -e prod"
i=1
while [ ${i} -le 10 ]; do
    echo "check migration status. ${i}/10"
    eval ${STATUS_CHECK}
    if [ $? -eq 0 ]; then
        echo "run migration"
        php vendor/bin/phinx migrate -e prod
        break
    fi
    i=`expr ${i} + 1`
    sleep 3
done

if [ ${i} -gt 10 ]; then
    echo "can't check migration status. is the mysql running"
fi

apache2-foreground