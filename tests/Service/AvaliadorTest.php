<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{

    /**
     * @dataProvider leilaoEmOrdemAleatoria
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @param  Leilao  $leilao
     */
    public function testAvaliadorMaiorValor(Leilao $leilao)
    {

        // retorna avaliador
        $avaliador = new Avaliador();

        // executa o que se deseja testar
        // act - when

        $avaliador->avalia($leilao);

        // avalia-se o resultado
        // assert - then
        $this->assertEquals(2500, $avaliador->getMaiorValor());
    }

    /**
     * @dataProvider leilaoEmOrdemAleatoria
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @param  Leilao  $leilao
     */
    public function testAvaliadorMenorValor(Leilao $leilao)
    {

        // retorna avaliador
        $avaliador = new Avaliador();

        // executa o que se deseja testar
        // act - when

        $avaliador->avalia($leilao);


        // avalia-se o resultado
        // assert - then
        $this->assertEquals(1700, $avaliador->getMenorValor());

    }

    /**
     * @dataProvider leilaoEmOrdemAleatoria
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @param  Leilao  $leilao
     */
    public function testAvaliador3MaioresLances(Leilao $leilao)
    {

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $this->assertCount(3, $leiloeiro->getMaioresLances());
        $this->assertEquals(2500, $leiloeiro->getMaioresLances()[0]->getValor());
        $this->assertEquals(2000, $leiloeiro->getMaioresLances()[1]->getValor());
        $this->assertEquals(1700, $leiloeiro->getMaioresLances()[2]->getValor());
    }

    public function leilaoEmOrdemAleatoria()
    {
        // prepara, arruma a casa para os testes
        // arrange - given

        // cria usuários
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');

        // cria leilão
        $leilao = new Leilao('Fiat 147 0km');

        // cria lances
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($maria, 1700));

        return [
            [$leilao]
        ];
    }

    public function leilaoEmOrdemDecrescente()
    {
        // prepara, arruma a casa para os testes
        // arrange - given

        // cria usuários
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');

        // cria leilão
        $leilao = new Leilao('Fiat 147 0km');

        // cria lances
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 1700));

        return [
            [$leilao]
        ];
    }

    public function leilaoEmOrdemCrescente()
    {
        // prepara, arruma a casa para os testes
        // arrange - given

        // cria usuários
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');

        // cria leilão
        $leilao = new Leilao('Fiat 147 0km');

        // cria lances
        $leilao->recebeLance(new Lance($maria, 1700));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));

        return [
            [$leilao]
        ];
    }
}