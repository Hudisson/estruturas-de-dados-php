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

    // Método principal do Merge Sort (Divisão)
    public static function mergeSort(array $array): array
    {
        $n = count($array); // Tamanho do array original

        // Se o array tem 1 ou 0 elementos, já está oedenado
        if($n <= 1){
            return $array;
        }

        // Acha o meio de divide o array em dois
        $meio = (int)($n/2);
        $esquerda = []; // Recebe a mentade esquerda do array original
        $direita = []; // Recebe a mentade direita do array original

        // Copia os elementos do início até o meio para o array da esquerda ($esquerda[])
        for($i = 0; $i < $meio; $i++){
            $esquerda[] = $array[$i];
        }

        // Copia os elementos do meio até o fim para o array da direita ($direita[])
        for($i = $meio; $i < $n; $i++){
            $direita[] = $array[$i];
        }

        // Continua a divisão recursiva
        $esquerda = self::mergeSort($esquerda);
        $direita = self::mergeSort($direita);

        return self:: merge($esquerda, $direita);
    }

    // Método auxiliar: Junta as duas metades ordenadas em um único array ordenado
    private static function merge(array $esquerda, array $direita): array
    {
        $resultado = []; // Array que irá guarda os elementos das duas metades
        $ponteiro_esquerda = 0; // Ponteiro para o array da esquerda
        $ponteiro_direita = 0; // Ponteiro para o array da direita

        // Enquanto houver elementos em abos os arrays
        while($ponteiro_esquerda < count($esquerda) && $ponteiro_direita < count($direita)){
            // Se o elemento de $esquerda[$ponteiro_esquerda] for MENOR ou IGUAL ao de $direita[$ponteiro_direita]:
            // Adicione o $esquerda[$ponteiro_esquerda] no array $resultado e incremente o $ponteiro_esquerda
            if($esquerda[$ponteiro_esquerda] <= $direita[$ponteiro_direita]){
                $resultado[] = $esquerda[$ponteiro_esquerda];
                $ponteiro_esquerda++;
            } else {
                // Caso contrário:
                // Adicione o $direita[$ponteiro_direita] no array $resultado e incremente o $ponteiro_direita
                $resultado[] = $direita[$ponteiro_direita];
                $ponteiro_direita++;
            }
        }

        // Se sobrarem elementos no array $esquerda, adicione o restante no $resultado
        while($ponteiro_esquerda < count($esquerda)){
            $resultado[] = $esquerda[$ponteiro_esquerda];
            $ponteiro_esquerda++;
        }

        // Se sobrarem elementos no array $direita, adicione o restante no $resultado
        while($ponteiro_direita < count($direita)){
            $resultado[]  = $direita[$ponteiro_direita];
            $ponteiro_direita++;
        }

        return $resultado;
    }
}
