FROM php:7.4-cli-alpine

RUN apk update \
    && apk add --no-cache  \
        oniguruma \
        oniguruma-dev \
        libgcrypt \
        libgcrypt-dev \
        ca-certificates \
        pcre-dev \
        curl \
        libcurl \
        git \
        openssh-client \
        openssl-dev \
        wget \
        libmcrypt-dev \
        libpng-dev \
        icu-dev \
        libxslt-dev \
        zip \
        nano \
        patch \
        gnu-libiconv \
        tmux \
        bash \
        libzip-dev \
        ${PHPIZE_DEPS} \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
        mbstring opcache iconv pdo \
        gd dom exif intl json soap tokenizer xsl zip pcntl bcmath sockets \
        && docker-php-source delete \
        && apk del ${BUILD_DEPENDS}

ENV PATH "/composer/vendor/bin:$PATH"
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV COMPOSER_VERSION 1.10.16
ENV COMPOSER_MEMORY_LIMIT=1G
ENV TZ=Europe/Minsk

RUN EXPECTED_COMPOSER_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig) \
	&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
	&& php -r "if (hash_file('SHA384', 'composer-setup.php') === '${EXPECTED_COMPOSER_SIGNATURE}') { echo 'Composer.phar Installer verified'; } else { echo 'Composer.phar Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
	&& php composer-setup.php --no-ansi --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION} \
	&& php -r "unlink('composer-setup.php');" \
    && composer config --global repo.packagist composer https://packagist.org && \
       composer --ansi --version --no-interaction && \
       composer global require hirak/prestissimo && \
       composer clear-cache


WORKDIR /var/www
COPY ./ /var/www

RUN composer install --no-autoloader --no-suggest && \
        composer clear-cache && \
        composer dump --optimize

RUN composer run-script post-create-project-cmd
RUN mkdir /var/server
RUN mv spiral /var/server
RUN ln -s /var/www/.rr.yml /var/server/.rr.yml

ENTRYPOINT ["/var/server/spiral", "serve", "-v", "-d"]
