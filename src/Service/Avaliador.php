<?php


namespace Alura\Leilao\Service;


use Alura\Leilao\Model\Leilao;

class Avaliador
{

    private $_maiorValor;

    public function avalia(Leilao $leilao) : void
    {
        $lances = $leilao->getLances();
        $ultimoLance = $lances[count($lances) - 1];
        $this->_maiorValor = $ultimoLance->getValor();
    }

    /**
     * @return mixed
     */
    public function getMaiorValor() : float
    {
        return $this->_maiorValor;
    }

}