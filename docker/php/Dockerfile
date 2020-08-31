FROM php:7.4.9-fpm

RUN apt-get update -yqq && apt-get install -my wget gnupg

# Add APT repositories
RUN bash -c 'curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -' \
    && bash -c 'echo "deb https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list'

# Update and install dependencies
RUN apt-get install apt-transport-https

RUN apt-get -y install $PHPIZE_DEPS

RUN apt-get update -yqq && \
    apt-get install -yqq \
        bzip2 \
        libbz2-dev \
        git \
        libcurl4-gnutls-dev \
        libpcre3-dev \
        wget \
        mc \
        libzip-dev \
        zlib1g-dev \
        libicu-dev \
        libpng-dev \
        libxml2-dev \
        libmagickwand-dev \
        vim \
        htop \
        g++

RUN apt-get -y install locales \
&& printf 'en_GB.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && printf 'pl_PL.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && locale-gen

RUN apt-get install -y libc-client-dev libkrb5-dev && rm -r /var/lib/apt/lists/*
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl

RUN docker-php-ext-install pdo_mysql mysqli intl gd zip bz2 opcache bcmath imap
RUN pecl install xdebug-2.8.0 \
    && docker-php-ext-enable xdebug

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV TZ=Europe/Warsaw
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "Europe/Warsaw"\n' > /usr/local/etc/php/conf.d/tzone.ini
