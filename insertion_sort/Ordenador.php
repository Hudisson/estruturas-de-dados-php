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

    } // Fim método bubbleSort

    

    // Método de ordenação por inserção
    public static function insertionSort(array $array): array
    {
        $n = count($array);

        // Começar no segundo elemento (indice 1), pois o primeiro já está ordenado
        for($i = 1; $i < $n; $i++){
            $chave = $array[$i]; // O valor atual para encaixar (deixar em ordem)
            $anterior = $i - 1; // O índice do elemento imediatamente à esquerda ( o anterior )

            // Enquanto não chegar no início do array E o elemento da esquerda for MAIOR que a chave
            while($anterior >= 0 &&  $array[$anterior] > $chave){

                // P-1: Desloque o elemento maior para a direita ($array[$anterior + 1] recebe $array[$anterior])
                $array[$anterior + 1] = $array[$anterior];

                // P-2: Decremente o $anterior ($anterior--) para continuar olhando para trás
                $anterior--;
            }

            // P-3: Após abrir o espaço, insira a 'chave' na posição correta ($array[$anterior + 1])
            $array[$anterior + 1] = $chave;
        }

        return $array;

    } // Fim método insertionSort
}
