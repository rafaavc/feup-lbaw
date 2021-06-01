FROM ubuntu:20.04

# Install dependencies

RUN apt-get update && \
      apt-get -y install sudo
RUN sudo apt-get remove --purge apache2 apache2-utils
RUN apt-get install -y --no-install-recommends composer npm unzip libpq-dev nginx php7.4-fpm php7.4-mbstring php7.4-xml php7.4-pgsql php7.4-curl cron

# Copy project code and install project dependencies
COPY . /var/www/
RUN chown -R www-data:www-data /var/www/

# Copy project configurations
COPY ./etc/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY ./etc/nginx/default.conf /etc/nginx/sites-enabled/default
#COPY ./etc/docker/daemon.json /etc/docker/daemon.json
COPY .env_production /var/www/.env
COPY docker_run.sh /docker_run.sh

WORKDIR /var/www
RUN composer install
RUN composer require pusher/pusher-php-server
RUN npm install --save laravel-echo pusher-js
WORKDIR /

RUN echo "* * * * * root php /var/www/artisan schedule:run >> /var/log/cron.log 2>&1" >> /etc/crontab

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

# Start command
CMD sh /docker_run.sh && cron
