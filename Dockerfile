FROM php:7.1-alpine as base
RUN apk update && apk upgrade && apk add --no-cache composer ${PHPIZE_DEPS}
RUN composer self-update
RUN wget https://phar.phpunit.de/phpunit-6.4.phar
RUN chmod +x phpunit-6.4.phar
RUN mv phpunit-6.4.phar /usr/local/bin/phpunit
