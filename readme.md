**baixando docker para usar composer**


`docker pull composer`

**executando composer**

`docker run --rm --interactive --tty --volume $PWD:/app composer dump`


**instalando phpunit**

`docker run --rm --interactive --tty --volume $PWD:/app composer require --dev phpunit/phpunit ^9`


**executando testes com phpunit**

`./vendor/bin/phpunit tests --colors`
