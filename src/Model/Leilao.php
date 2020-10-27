<?php

namespace Alura\Leilao\Model;

class Leilao
{
    /** @var Lance[] */
    private $lances;
    /** @var string */
    private $descricao;
    /** @var bool */
    private $finalizado;

    public function __construct(string $descricao)
    {
        $this->descricao    = $descricao;
        $this->lances       = [];
        $this->finalizado   = false;
    }

    public function recebeLance(Lance $lance)
    {

        if ($this->estaFinalizado()) {
            throw new \DomainException('Não é possível dar lance em um leilão finalizado.');
        }

        // desconsidera lances consecutivos de um mesmo usuário
        if (!empty($this->lances) && $this->ehLanceDoUltimoUsuario($lance)) {
            throw new \DomainException('Usuário não pode dar 2 lances consecutivos.');
        }

        // desconsidera a partir do 6º lance de um usuário
        $quantidadeDeLancesDoUsuario = $this->quantidadeDeLancesDoUsuario($lance->getUsuario());

        if ($quantidadeDeLancesDoUsuario >= 5) {
            throw new \DomainException('Usuário não pode dar mais de 5 lances em um leilão.');
        }

        // TODO, lance tem que ser maior que o último lance

        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }

    /**
     * Finaliza um leilão.
     */
    public function finaliza()
    {
        $this->finalizado = true;
    }

    /**
     * @param  Lance  $lance
     * @return bool
     */
    private function ehLanceDoUltimoUsuario(Lance $lance): bool
    {
        $ultimoUsuario = $this->lances[array_key_last($this->lances)]->getUsuario();

        return $lance->getUsuario() === $ultimoUsuario;
    }

    /**
     * @param  Usuario  $usuario
     * @return int
     */
    private function quantidadeDeLancesDoUsuario(Usuario $usuario): int
    {
        return array_reduce(
            $this->lances,

            function ($totalAcumulado, $lanceAtual) use ($usuario) {
                if ($lanceAtual->getUsuario() == $usuario) {
                    return $totalAcumulado + 1;
                } else {
                    return $totalAcumulado;
                }
            },

            0
        );
    }

    public function estaFinalizado()
    {
        return $this->finalizado;
    }


}
