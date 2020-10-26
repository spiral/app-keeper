# Build frontend
FROM node:15-alpine3.10 as build

RUN apk update \
    && apk add --no-cache  \
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

WORKDIR /var/www

COPY . /var/www

RUN yarn install --silent
RUN yarn build

# Prepare webserver
FROM nginx:1.19-alpine

RUN apk update && apk add --no-cache bash && rm -rf /var/lib/apt/lists/*

COPY --from=build /var/www/public /usr/share/nginx/html
COPY ./wait-for-it.sh .
RUN chmod +x wait-for-it.sh
