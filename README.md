# Meneame-CLI

This CLI application provides commands to download meneame news from 
its RSS and to display the front page and queued news. Build on top of Laravel Zero

## Installation

Once you has cloned this repository go into the new meneame-cli directory
 from a terminal and proceed as follows:

1. Enter in docker folder `cd docker`
2. Copy the .env.dist file `cp .env.dist .env` and edit its content as follows:
 
    ```plain
   PROJECT=path to your meneame-cli folder
   TIMEZONE=Europe/Madrid
   MYSQL_ROOT_PASSWORD=password
    ```
3. Start the docker environment `docker-compose up -d`. This command will build
and create all necessary containers.
4. Run `docker-compose exec php bash`
5. Install PHP dependencies `composer install`
6. News should be downloaded every minute, but if you don't want to wait you can
execute the next command: `php meneame-cli fetch:news`
7. Now to render a table with the news you can execute the command:
 
    ```bash 
    php meneame-cli news:show
   # Optionally to limit the amount of news:
   php meneame-cli news:show 10
   # And if you want to automatically select the kind of news:
   php meneame-cli news:show 10 published
   # ... OR
   php meneame-cli news:show 10 queued
   ```



    

## License

Laravel Zero is an open-source software licensed under the [MIT license](https://github.com/laravel-zero/laravel-zero/blob/stable/LICENSE.md).
