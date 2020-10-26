# Rapid Admin Panel Application Skeleton [![Latest Stable Version](https://poser.pugx.org/spiral/app-keeper/version)](https://packagist.org/packages/spiral/app-keeper)

<img src="https://user-images.githubusercontent.com/796136/67560465-9d827780-f723-11e9-91ac-9b2fafb027f2.png" height="135px" alt="Spiral Framework" align="left"/>

Spiral Framework is a High-Performance PHP/Go Full-Stack framework and group of over sixty PSR-compatible components. The Framework execution model based on a hybrid runtime where some services (GRPC, Queue, WebSockets, etc.) handled by Application Server [RoadRunner](https://github.com/spiral/roadrunner) and the PHP code of your application stays in memory permanently (anti-memory leak tools included).

[App Skeleton](https://github.com/spiral/app) ([CLI](https://github.com/spiral/app-cli), [GRPC](https://github.com/spiral/app-grpc)) | [**Documentation**](https://spiral.dev/docs) | [Twitter](https://twitter.com/spiralphp) | [CHANGELOG](/CHANGELOG.md) | [Contributing](https://github.com/spiral/guide/blob/master/contributing.md)

<br/>

Server Requirements
--------
Make sure that your server is configured with following PHP version and extensions:
* PHP 7.2+, 64bit
* *mb-string* extension
* PDO Extension with desired database drivers (default SQLite)

Application Bundle
--------
Application bundle includes the following components:
* High-performance HTTP, HTTP/2 server based on [RoadRunner](https://roadrunner.dev)
* Console commands via Symfony/Console
* Translation support by Symfony/Translation
* Queue support for AMQP, Beanstalk, Amazon SQS, in-Memory
* Stempler template engine
* Security, validation, filter models
* PSR-7 HTTP pipeline, session, encrypted cookies
* DBAL and migrations support
* Monolog, Dotenv
* Prometheus metrics
* [Cycle DataMapper ORM](https://github.com/cycle)
* Keeper Admin panel

Demo Screenshot
--------
![Keeper Demo](https://user-images.githubusercontent.com/796136/81418518-79353800-9155-11ea-8266-e19fb2cce45a.png)

Installation
--------
```
composer create-project spiral/app-keeper --stability dev
```

> Application server will be downloaded automatically (`php-curl` and `php-zip` required).

Once the application is installed you can ensure that it was configured properly by executing:

```
$ php app.php configure -vv
```

Migrate the database:

```
$ php app.php migrate:init
$ php app.php migrate
```

Seed user accounts:

```
$ php app.php user:seed
```

Create super admin account:

```
$ php app.php user:create {First-Name} {Last-Name} {email-address} {password}
```

To start application server execute:

```
$ ./spiral serve -v -d
```

On Windows:

```
$ spiral.exe serve -v -d
```

Application will be available on `http://localhost:8080`. Keeper control panel available at `http://localhost:8080/keeper`.

> Read more about application server configuration [here](https://roadrunner.dev/docs). Make sure to turn `DEBUG` off in `.env` to enable view caching.

Testing:
--------
To test an application:

```bash
$ ./vendor/bin/phpunit
```

Cloning:
--------
Make sure to properly configure project if you cloned the existing repository.

```bash
$ copy .env.sample .env
$ php app.php encrypt:key -m .env
$ php app.php configure -vv
$ php app.php migrate:init
$ php app.php migrate
$ ./vendor/bin/spiral get
```

> Make sure to create super-admin account.

Docker:
--------

Requirements:  Docker engine 19.03.0+

To launch Keeper in Docker create env file if needed.

```bash
    copy .env.sample .env
```

Build and run for Linux and MacOS

```bash
./dockerInit.sh
```

Build and run for Windows

```
./dockerInit.bat
```

It will build a local container, configure encryption key and set up Sqlite database.


Docker scenarios
-----------

In this repository you can find several docker-compose files, you can use them in combination to handle different scenarios.

To launch Spiral application with Roadrunner in one container. No file sync, no worker reload:  will work with the code version you have on the moment of container build on http://localhost:8080

```
docker-compose -f docker-compose.yml up -d
```
Or just
```
docker-compose up -d
``` 

Docker local development
-----------

For local development you would like file changes to appear in a container, and make Roadrunner workers to re-launch with updated code.

```
docker-compose -f docker-compose.yml -f docker-compose-local.yml up -d
```

Custom Frontend Build
-----------

If developing with docker container, ensure to include custom-front part in build like so `docker-compose -f docker-compose.yml -f docker-compose-custom-front.yml up -d`

It will launch Spiral app in separate PHP container served by Roadrunner, Nginx container with frontend build (it will serve static files and proxy dynamic requests to application container) on http://localhost:8090

For local development add one more docker compose file to sync local files into Nginx container:

```
docker-compose -f docker-compose.yml -f docker-compose-custom-front.yml -f docker-compose-custom-front-local.yml up  -d
```

In this case you will need to run `yarn build` locally to create frontend build, otherwise empty directory public/generated will be mounted in nginx container

Frontend local development is supported in 2 modes:

**1. Watch mode.** 

Launch `yarn watch` to watch `./front` directory for changes and recompile them on go. Refresh page to see changes.

**2. Hot reload mode.**
 
Set up env variable `FRONT_END_PUBLIC_URL` to point at local server URL, this package is configured to use `http://localhost:3030` Change scripts in `webpack` and `server` folders to change that.

After that launch `yarn start`. This will start dev server at `http://localhost:3030`

If you are seeing 404 on your scripts, ensure they are included like so

```php
    @if(env('FRONT_END_PUBLIC_URL'))
        <script type="text/javascript" src="{{ env('FRONT_END_PUBLIC_URL') }}/generated/keeper.js"></script>
    @endif
    @if(!env('FRONT_END_PUBLIC_URL'))
        <script type="text/javascript" src="/generated/keeper.js"></script>
    @endif
```   



License:
--------
MIT License (MIT). Please see [`LICENSE`](./LICENSE) for more information. Maintained by [Spiral Scout](https://spiralscout.com).
