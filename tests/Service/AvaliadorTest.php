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

    public function testAvaliador3MaioresLances()
    {
        $ana = new Usuario('Ana');
        $bia = new Usuario('Bia');
        $carlos = new Usuario('Carlos');
        $diana = new Usuario('Diana');

        $leilao = new Leilao('Edifício Copacabana');

        $leilao->recebeLance(new Lance($ana, 1000));
        $leilao->recebeLance(new Lance($bia, 5000));
        $leilao->recebeLance(new Lance($carlos, 10000));
        $leilao->recebeLance(new Lance($diana, 4000));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $this->assertCount(3, $leiloeiro->getMaioresLances());
        $this->assertEquals(10000, $leiloeiro->getMaioresLances()[0]->getValor());
        $this->assertEquals(5000, $leiloeiro->getMaioresLances()[1]->getValor());
        $this->assertEquals(4000, $leiloeiro->getMaioresLances()[2]->getValor());
    }
}