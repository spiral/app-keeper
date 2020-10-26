# Build frontend
FROM node:13.13-alpine as build

RUN apk update \
    && apk add --no-cache  \
        chromium \
        nss \
        freetype \
        freetype-dev \
        harfbuzz \
        ttf-freefont \
        ca-certificates \
        yarn \
        curl libcurl \
        git \
        bash \
        openssh-client \
        openssl-dev \
        wget \
    && rm -rf /var/lib/apt/lists/*

# Tell Puppeteer to skip installing Chrome. We'll be using the installed package.
ENV PUPPETEER_SKIP_CHROMIUM_DOWNLOAD true
ENV PUPPETEER_EXECUTABLE_PATH /usr/bin/chromium-browser

WORKDIR /var/www
COPY . /var/www

RUN yarn install --silent
RUN yarn build

# Prepare webserver
FROM nginx:1.19-alpine

RUN apk update && apk add --no-cache bash && rm -rf /var/lib/apt/lists/*

COPY --from=build /var/www/public /usr/share/nginx/html
COPY ./docker/wait-for-it.sh .
RUN chmod +x wait-for-it.sh
