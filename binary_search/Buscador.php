<?php

class Buscador
{
    /**
     * Implementação da Busca Binária.
     * Retorna o ÍNDICE do elemento se for encontrado, ou -1 se não existir.
     */

    public static function buscaBinaria(array $arrayOrdenado, int $valor): int
    {
        $inicio = 0;
        $fim = count($arrayOrdenado) - 1;

        while ($inicio <= $fim) {

            // Encontrar o meio do array
            $meio = (int)(($inicio + $fim) / 2);

            // Se o valor do meio for igual ao valor que procudrado, retorna o índice do meio
            if ($arrayOrdenado[$meio] === $valor) {
                return $meio;
            }

            // Se o valor do meio for maior, busca na metade esquerda
            if ($arrayOrdenado[$meio] > $valor) {
                $fim = $meio - 1;
            } else {
                // Caso contrário (menor), busca na metade direita
                $inicio = $meio + 1;
            }
        }

        return -1;
    }
}
