FROM alpine:3.10

#----------------------------------
# PHP INI Config
#----------------------------------

# [PHP]
ENV PHPINI_ENGINE_ON="On" \
    PHPINI_EXPOSE_PHP="Off" \
    PHPINI_SHORT_OPEN_TAG="Off" \
    PHPINI_PRECISION="17" \
    PHPINI_OUTPUT_BUFFERING="4096" \
    PHPINI_ZLIB_OUTPUT_COMPRESSION="Off" \
    PHPINI_IMPLICIT_FLUSH="Off" \
    PHPINI_SERIALIZE_PRECISION="-1" \
    PHPINI_ZEND_ENABLE_GC="On" \
    # Resource Limits
    PHPINI_MAX_EXECUTION_TIME="30" \
    PHPINI_MAX_INPUT_TIME="60" \
    PHPINI_MEMORY_LIMIT="650M" \
    # Error handling and logging
    PHPINI_ERROR_REPORTING="E_ALL & ~E_DEPRECATED & ~E_STRICT" \
    PHPINI_DISPLAY_ERRORS="Off" \
    PHPINI_DISPLAY_STARTUP_ERRORS="Off" \
    PHPINI_LOG_ERRORS="On" \
    PHPINI_LOG_ERRORS_MAX_LEN="1024" \
    PHPINI_IGNORE_REPEATED_ERRORS="Off" \
    PHPINI_IGNORE_REPEATED_SOURCE="Off" \
    PHPINI_REPORT_MEMLEAKS="On" \
    PHPINI_HTML_ERRORS="Off" \
    PHPINI_ERROR_LOG="stderr" \
    # Data handling
    PHPINI_VARIABLES_ORDER="GPCS" \
    PHPINI_REQUEST_ORDER="GP" \
    PHPINI_REGISTER_ARGC_ARGV="Off" \
    PHPINI_AUTO_GLOBALS_JIT="On" \
    PHPINI_POST_MAX_SIZE="50M" \
    PHPINI_DEFAULT_MIMETYPE="text/html" \
    PHPINI_DEFAULT_CHARSET="UTF-8" \
    # Paths and Directories
    PHPINI_ENABLE_DL="Off" \
    PHPINI_CGI_FIX_PATHINFO="0" \
    PHPINI_INCLUDE_PATH=".:/usr/share/php7" \
    # File Uploads
    PHPINI_FILE_UPLOADS="On" \
    PHPINI_UPLOAD_MAX_FILESIZE="50M" \
    PHPINI_MAX_FILE_UPLOADS="20" \
    PHPINI_UPLOAD_TMP_DIR="20" \
    # Fopen wrappers
    PHPINI_ALLOW_URL_FOPEN="On" \
    PHPINI_ALLOW_URL_INCLUDE="Off" \
    PHPINI_DEFAULT_SOCKET_TIMEOUT="60" \
    # [opcache]
    PHPINI_OPCACHE_VALIDATE_TIMESTAMPS="1" \
    PHPINI_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHPINI_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHPINI_OPCACHE_MAX_WASTED_PERCENTAGE="10" \
    PHPINI_OPCACHE_INTERNED_STRINGS_BUFFER="16" \
    PHPINI_OPCACHE_FAST_SHUTDOWN="1" \
    # [PostgreSQL]
    PHPINI_POSTGRES_ALLOW_PERSISTENT="On" \
    PHPINI_POSTGRES_AUTO_RESET_PERSISTENT="Off" \
    PHPINI_POSTGRES_MAX_PERSISTENT="-1" \
    PHPINI_POSTGRES_MAX_LINKS="-1" \
    PHPINI_POSTGRES_IGNORE_NOTICE="0" \
    PHPINI_POSTGRES_LOG_NOTICE="0" \
    # [Session]
    PHPINI_SESSON_SID_LENGTH="64" \
    # Composer
    COMPOSER_ALLOW_SUPERUSER="1"

ADD https://dl.bintray.com/php-alpine/key/php-alpine.rsa.pub /etc/apk/keys/php-alpine.rsa.pub

RUN set -xe \
    && apk --update --no-cache add \
        bash \
        ca-certificates \
        curl \
        icu-libs \
        libxml2 \
        libsodium \
        musl \
        nginx \
        postgresql-client \
        procps \
        strace \
        supervisor \
        sudo \
        su-exec \
    && echo "https://dl.bintray.com/php-alpine/v3.10/php-7.4" >> /etc/apk/repositories \
    && apk --update --no-cache add \
        php \
        php-bz2 \
        php-bcmath \
        php-ctype \
        php-common \
        php-curl \
        php-dom \
        php-enchant \
        php-exif \
        php-fpm \
        php-gd \
        php-gettext \
        php-iconv \
        php-intl \
        php-json \
        php-mbstring \
        php-opcache \
        php-openssl \
        php-pcntl \
        php-pdo \
        php-pdo_pgsql \
        php-pdo_sqlite \
        php-pear \
        php-phar \
        php-shmop \
        php-snmp \
        php-sockets \
        php-sqlite3 \
        php-sysvmsg \
        php-sysvsem \
        php-xml \
        php-xmlreader \
        php-xsl \
        php-zip \
        php-redis \
        php-zlib \
        argon2 \
        libargon2 \
    && ln -s /usr/bin/php7 /usr/bin/php \
    && ln -s /usr/bin/php7-fpm /usr/bin/php-fpm \
    && rm -rf /var/cache/apk/* \
    # install composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && addgroup -S app \
    && adduser -S app -G app -s /bin/bash \
    # make sure root login is disabled
    && sed -i -e 's/^root::/root:!:/' /etc/shadow \
    && sed -e 's/# %wheel ALL=(ALL) NOPASSWD: ALL/%wheel ALL=(ALL) NOPASSWD: ALL/g' -i /etc/sudoers \
    && sed -e 's/^wheel:\(.*\)/wheel:\1,app/g' -i /etc/group

ADD .docker/rootfs /

EXPOSE 8000

ENTRYPOINT ["/docker-entrypoint.sh"]
