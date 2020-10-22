<?php


namespace Alura\Tests\Model;


use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{

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