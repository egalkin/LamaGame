# LamaGame

This is simple web game, implemented using Symfony.

# Local Installation
To install project locally execute ```$ composer install``` in ```$ apps/lama_game``` folder

# Docker Installation

Before running you should check, if localhost not in use.

Run 
```
    $ docker-compose build
```
then 
```
    $ docker-compose up -d
```

# Routing

You can get access to the game on

`localhost/game/lama`

# Testing

To run test in docker image execute ```$ ./run_tests.sh``` \
To run test locally execute ```$ php bin/phpunit``` in ```$ apps/lama_game``` folder



