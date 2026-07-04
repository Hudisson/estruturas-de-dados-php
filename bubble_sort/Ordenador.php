<?php

class Ordenador
{
    // Método para ordenar um array | complexidade de tempo linear O(n)
    public static function bubbleSort(array $array): array
    {
        $n = count($array);

        // Laço que controla quantas passadas fará no array
        for ($i = 0; $i < $n - 1; $i++) {

            $houveTroca = false; // Reseta a bandeira a cada passada

            // Laço que faz as comparações par a par
            for ($j = 0; $j < $n - $i - 1; $j++) {

                /**
                 * Escreva a condição: Se o elemento atual ($array[$j]) for MAIOR que o próximo ($array[$j + 1])
                 * Faça a troca deles de lugar usando a lógica da variável $auxiliar.
                 */

                if ($array[$j] > $array[$j + 1]) {
                    $auxiliar = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $auxiliar;

                    $houveTroca = true; // Avisa que o array ainda estava bagunçado
                }
            }

            // Se terminou a passada sem nenhuma troca, o array já está ordenado!
            if (!$houveTroca) {
                break;
            }
        }

        return $array;
    }
}
