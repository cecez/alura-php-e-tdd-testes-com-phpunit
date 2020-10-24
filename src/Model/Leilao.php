<?php

namespace Alura\Leilao\Model;

class Leilao
{
    /** @var Lance[] */
    private $lances;
    /** @var string */
    private $descricao;

    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    public function recebeLance(Lance $lance)
    {
        // desconsidera lances consecutivos de um mesmo usuário
        if (!empty($this->lances) && $this->ehLanceDoUltimoUsuario($lance)) {
            return;
        }

        // desconsidera a partir do 6º lance de um usuário
        $quantidadeDeLancesDoUsuario = $this->quantidadeDeLancesDoUsuario($lance->getUsuario());

        if ($quantidadeDeLancesDoUsuario >= 5) {
            return;
        }

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
}
