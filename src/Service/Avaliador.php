<?php


namespace Alura\Leilao\Service;


use Alura\Leilao\Model\Leilao;

class Avaliador
{

    private int $_maiorValor = -INF;

    public function avalia(Leilao $leilao) : void
    {

        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->_maiorValor) {
                $this->_maiorValor = $lance->getValor();
            }
        }

    }

    /**
     * @return mixed
     */
    public function getMaiorValor() : float
    {
        return $this->_maiorValor;
    }

}