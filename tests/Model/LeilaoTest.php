<?php


namespace Alura\Leilao\Tests\Model;


use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{

    public function testLeilaoNaoDeveReceberMaisDe5LancesPorUsuario()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuário não pode dar mais de 5 lances em um leilão.');

        $leilao = new Leilao('Mac Pro 2020');

        $ana = new Usuario('Ana');
        $bia = new Usuario('Bia');

        $leilao->recebeLance(new Lance($ana, 1000));
        $leilao->recebeLance(new Lance($bia, 1100));
        $leilao->recebeLance(new Lance($ana, 2000));
        $leilao->recebeLance(new Lance($bia, 2100));
        $leilao->recebeLance(new Lance($ana, 3000));
        $leilao->recebeLance(new Lance($bia, 3100));
        $leilao->recebeLance(new Lance($ana, 4000));
        $leilao->recebeLance(new Lance($bia, 4100));
        $leilao->recebeLance(new Lance($ana, 5000));
        $leilao->recebeLance(new Lance($bia, 5100));

        $leilao->recebeLance(new Lance($ana, 6000));
    }

    public function testLeilaoNaoDeveReceberLancesRepetidos()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuário não pode dar 2 lances consecutivos.');

        $leilao = new Leilao('Mac mini 2020');

        $ana = new Usuario('Ana');

        $valorEsperado = 1000;
        $leilao->recebeLance(new Lance($ana, $valorEsperado));
        $leilao->recebeLance(new Lance($ana, 2000));
    }
    
    /**
     * @dataProvider geraLances
     *
     * @param  int  $qtdLances
     * @param  Leilao  $leilao
     * @param $valoresEsperados
     */
    public function testLances(int $qtdLances, Leilao $leilao, $valoresEsperados)
    {
        $this->assertCount($qtdLances, $leilao->getLances());

        foreach ($valoresEsperados as $indice => $valorEsperado) {
            $this->assertEquals($valorEsperado, $leilao->getLances()[$indice]->getValor());
        }
    }

    public function geraLances()
    {
        $joao   = new Usuario('Johhny');
        $maria  = new Usuario('Mary');

        $leilaoCom2Lances = new Leilao('Celular');
        $leilaoCom2Lances->recebeLance(new Lance($joao, 1000));
        $leilaoCom2Lances->recebeLance(new Lance($maria, 2000));

        $leilaoCom1Lance = new Leilao('iPad');
        $leilaoCom1Lance->recebeLance(new Lance($joao, 3000));

        return [
            '2-lances'  => [2, $leilaoCom2Lances, [1000, 2000]],
            '1-lance'   => [1, $leilaoCom1Lance, [3000]]
        ];
    }

}