<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use DomainException;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    private $_leiloeiro;

    protected function setUp(): void
    {
        $this->_leiloeiro = new Avaliador();
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @param  Leilao  $leilao
     */
    public function testAvaliadorMaiorValor(Leilao $leilao)
    {

        // executa o que se deseja testar
        // act - when

        $this->_leiloeiro->avalia($leilao);

        // avalia-se o resultado
        // assert - then
        $this->assertEquals(2500, $this->_leiloeiro->getMaiorValor());
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @param  Leilao  $leilao
     */
    public function testAvaliadorMenorValor(Leilao $leilao)
    {

        // executa o que se deseja testar
        // act - when

        $this->_leiloeiro->avalia($leilao);


        // avalia-se o resultado
        // assert - then
        $this->assertEquals(1700, $this->_leiloeiro->getMenorValor());

    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @param  Leilao  $leilao
     */
    public function testAvaliador3MaioresLances(Leilao $leilao)
    {

        $this->_leiloeiro->avalia($leilao);

        $this->assertCount(3, $this->_leiloeiro->getMaioresLances());
        $this->assertEquals(2500, $this->_leiloeiro->getMaioresLances()[0]->getValor());
        $this->assertEquals(2000, $this->_leiloeiro->getMaioresLances()[1]->getValor());
        $this->assertEquals(1700, $this->_leiloeiro->getMaioresLances()[2]->getValor());
    }

    public function testLeilaoVazioNaoPodeSerAvaliado()
    {
        // espera receber uma exceção em específico
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Não é possível avaliar um leilão sem lances.');

        $leilao = new Leilao('iPhone 2020');
        $this->_leiloeiro->avalia($leilao);
    }

    public function testLeilaoFinalizadoNaoPodeSerAvaliado()
    {
        // espera receber uma exceção em específico
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Não é possível avaliar um leilão finalizado.');

        $leilao = new Leilao('Carregador de pilha 2020');
        $leilao->recebeLance(new Lance(new Usuario('Joaquim'), 10));
        $leilao->finaliza();

        $this->_leiloeiro->avalia($leilao);
    }


    // Data providers

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
        $leilao->recebeLance(new Lance($ana, 2500));

        return [
            'ordem-crescente' => [$leilao]
        ];
    }
}