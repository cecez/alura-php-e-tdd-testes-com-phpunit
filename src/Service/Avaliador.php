<?php

namespace Alura\Leilao\Service;


use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private $_maiorValor = -INF;
    private $_menorValor = INF;
    private $_maioresLances;

    public function avalia(Leilao $leilao): void
    {
        // laço para obter maior e menor valor
        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->_maiorValor) {
                $this->_maiorValor = $lance->getValor();
            }

            if ($lance->getValor() < $this->_menorValor) {
                $this->_menorValor = $lance->getValor();
            }
        }

        // código para retornar primeiros 3 lances
        $lances = $leilao->getLances();
        usort($lances, function(Lance $lance1, Lance $lance2) {
            return $lance2->getValor() - $lance1->getValor();
        });
        $this->_maioresLances = array_slice($lances, 0, 3);

    }

    /**
     * @return float
     */
    public function getMaiorValor(): float
    {
        return $this->_maiorValor;
    }

    /**
     * @return float
     */
    public function getMenorValor(): float
    {
        return $this->_menorValor;
    }

    /**
     * @return array
     */
    public function getMaioresLances(): array
    {
        return $this->_maioresLances;
    }

}
