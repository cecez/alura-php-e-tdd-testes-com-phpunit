<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

// cria usuários
$maria = new Usuario('Maria');
$joao = new Usuario('João');

// cria leilão
$leilao = new Leilao('Fiat 147 0km');

// cria lances
$leilao->recebeLance(new Lance($maria, 2000));
$leilao->recebeLance(new Lance($joao, 2400));

// retorna avaliador
$avaliador = new Avaliador();
$avaliador->avalia($leilao);

echo $avaliador->getMaiorValor();