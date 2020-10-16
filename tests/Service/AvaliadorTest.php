<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorComLancesEmOrdemCrescente()
    {
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
        $this->assertEquals(2400, $avaliador->getMaiorValor());
    }

    public function testAvaliadorComLancesEmOrdemDecrescente()
    {
        // prepara, arruma a casa para os testes
        // arrange - given

        // cria usuários
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        // cria leilão
        $leilao = new Leilao('Fiat 147 0km');

        // cria lances
        $leilao->recebeLance(new Lance($joao, 2400));
        $leilao->recebeLance(new Lance($maria, 2000));

        // retorna avaliador
        $avaliador = new Avaliador();

        // executa o que se deseja testar
        // act - when

        $avaliador->avalia($leilao);

        // avalia-se o resultado
        // assert - then
        $this->assertEquals(2400, $avaliador->getMaiorValor());
    }

    public function testAvaliadorMenorValorComLancesEmOrdemCrescente()
    {
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
        $this->assertEquals(2000, $avaliador->getMenorValor());

    }

    public function testAvaliadorMenorValorComLancesEmOrdemDecrescente()
    {
        // prepara, arruma a casa para os testes
        // arrange - given

        // cria usuários
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        // cria leilão
        $leilao = new Leilao('Fiat 147 0km');

        // cria lances
        $leilao->recebeLance(new Lance($joao, 2400));
        $leilao->recebeLance(new Lance($maria, 2000));

        // retorna avaliador
        $avaliador = new Avaliador();

        // executa o que se deseja testar
        // act - when

        $avaliador->avalia($leilao);


        // avalia-se o resultado
        // assert - then
        $this->assertEquals(2000, $avaliador->getMenorValor());

    }
}