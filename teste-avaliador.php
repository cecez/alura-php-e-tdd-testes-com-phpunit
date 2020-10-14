<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

// prepara, arruma a casa para os testes
// arrange - given

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


// executa o que se deseja testar
// act - when

$avaliador->avalia($leilao);


// avalia-se o resultado
// assert - then

$valorEsperado = 2400;

if ($valorEsperado == $avaliador->getMaiorValor()) {
    echo "TESTES OK.";
} else {
    echo "TESTE FALHOU.";
}