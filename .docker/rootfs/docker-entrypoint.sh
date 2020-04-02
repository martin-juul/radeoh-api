#!/usr/bin/env bash

set -xe

php artisan setup:prod

enable_service() {
    echo "Enabling service $1"
    sed -i -e 's/autostart=false/autostart=true/g' /etc/supervisor/conf.d/$1.conf
}

termination_handler() {
    case ${RUN_SERVICE} in
    "web")
        echo "Terminating"
        ;;
    "worker")
        echo "Terminating"
        # First we kill the supervisor, so it doesn't respawn the worker(s)
        pkill supervisord
        # Then we terminate them
        php /var/www/app/artisan horizon:terminate
        # Now we can exit
        exit
        ;;
    *) ;;

    esac
}

#case ${RUN_SERVICE} in
#"web")
#    enable_service webapp
#    ;;
#"worker")
#    enable_service worker
#
#    export PHPINI_MEMORY_LIMIT=1024m
#    ;;
#*)
#    echo "Unknown service ${RUN_SERVICE} allowed: web|worker"
#    exit 1
#    ;;
#esac

enable_service webapp

#trap termination_handler TERM

exec "$@"
