<?php


namespace Alura\Leilao\Tests\Model;


use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{

    public function testLeilaoNaoDeveReceberLancesRepetidos()
    {
        $leilao = new Leilao('Mac mini 2020');

        $ana = new Usuario('Ana');

        $valorEsperado = 1000;
        $leilao->recebeLance(new Lance($ana, $valorEsperado));
        $leilao->recebeLance(new Lance($ana, 2000));

        $this->assertCount(1, $leilao->getLances());
        $this->assertEquals($valorEsperado, $leilao->getLances()[0]->getValor());
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