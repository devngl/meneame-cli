FROM php:7.3-fpm
ARG TIMEZONE

RUN apt-get update && apt-get install -yqq \
    apt-utils \
    git \
    openssl \
    libzip-dev zip unzip && \
    docker-php-ext-configure zip --with-libzip && \
    # Install the zip extension
    docker-php-ext-install zip && \
    php -m | grep -q 'zip'


RUN apt-get update && apt-get install -yqq zlib1g-dev \
	&&  pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Install opCache
RUN docker-php-ext-install opcache

# Copy opcache configration
COPY ./opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Install xDebug
RUN pecl install xdebug; \
    docker-php-ext-enable xdebug

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# for more speed
RUN composer global require hirak/prestissimo

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
&& printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-install pdo pdo_mysql


RUN apt-get update && apt-get install -yqq cron \
    supervisor

COPY ./supervisord.conf /etc/supervisor/docker.conf
COPY crontab /etc/cron.d/laravel

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

# Final tweaks
COPY ./laravel.ini /usr/local/etc/php/conf.d
COPY ./xlaravel.pool.conf /usr/local/etc/php-fpm.d/

USER root

# Clean up
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

RUN usermod -u 1000 www-data

WORKDIR /project

EXPOSE 9000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/docker.conf"]
