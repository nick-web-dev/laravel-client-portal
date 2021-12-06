## Installation

## Technical requirements
- Web server (Nginx, Apache)
- Database server (Percona, Postgres, Mysql)
- PHP ^7.4
- NodeJs ^16

### Installation with LAMP stack
- Clone this repository
- Configure your database server - create empty db and if necessary db user
- Configure your web server's document/web root to point to project `public` directory
- Directories within the `storage` and the `bootstrap/cache` directories should be writable by web server
- Copy `.env.example` to `.env` and fill it according your configuration. Most important vars are:
  - `APP_URL`
  - `DB_CONNECTION`
  - `DB_HOST`
  - `DB_PORT`
  - `DB_DATABASE`
  - `DB_USERNAME`
  - `DB_PASSWORD`
  - `RUSHMORE_BASE_URI`
  - `RUSHMORE_KEY` ( @todo will be removed after auth impl)
  - `RUSHMORE_ACCOUNT_ID` ( @todo will be removed after auth impl)
- Run in console in project folder: 
  - `php artisan key:generate` to set application key
  - `composer install` to install application php dependencies
  - `php artisan migrate --seed` to create application database schema
  - `yarn install` or `npm install` to install application js dependencies
  - `npm run dev` or `npm run prod` to generate application`s js and css files
  - `php artisan db:seed --class=AnnouncementSeeder` to fill database with test announcements


### Local development with docker

You can start local development using Docker.
- install and setup docker + docker-compose
- add to host file `127.0.0.1  owd.local` entry
- Copy `.env.example` to `.env` and fill it according your configuration. Most important
- fill .env with necessary values. Possible variables with values are:
    - `DB_DATABASE=owd`
    - `DB_USERNAME=owd`
    - `DB_PASSWORD=secret`
    - `DOCKER_NETWORK_NAME=owd`
    - `DOCKER_NETWORK_SUBNET=192.4.250.0/24`
    - `DOCKER_IMAGE_NAME=owd`
    - `DOCKER_DB_IMAGE_NAME=owd`
    - `RUSHMORE_BASE_URI`
    - `RUSHMORE_KEY` ( @todo will be removed after auth impl)
    - `RUSHMORE_ACCOUNT_ID` ( @todo will be removed after auth impl)
- run in console in project folder 
  - `docker-compose up -d` to start docker images
  - `docker-compose exec app composer install` to install application php dependencies
  - `docker-compose exec app php artisan key:generate` to set application key
  - `docker-compose exec app php artisan migrate --seed` to prepare local database.
  - `docker-compose exec app php artisan db:seed --class=AnnouncementSeeder` to fill database with test announcements
- open in browser http://owd.local/
