<?php

require_once __DIR__.'/Conjunto.php';

echo "=========================================\n";
echo "             TESTANDO SETS                \n";
echo "=========================================\n\n";

$conjuntoA = new Conjunto(10);
$conjuntoB = new Conjunto(10);

echo "------------------ Adicionando elementos no Conjunto A-------------------\n";
echo "Adicionou '1'? " . ($conjuntoA->adicionar("1") ? "Sim" : "Não") . "\n";
echo "Adicionou '2'? " . ($conjuntoA->adicionar("2") ? "Sim" : "Não") . "\n";
echo "Adicionou '1' novamente? " . ($conjuntoA->adicionar("1") ? "Sim" : "Não") . "\n";
echo "Adicionou '7'? " . ($conjuntoA->adicionar("7") ? "Sim" : "Não") . "\n";
echo "Adicionou '9'? " . ($conjuntoA->adicionar("9") ? "Sim" : "Não") . "\n\n";

echo "-------------------- Elementos no Conjunto A-----------------\n\n";
echo "Conjunto A: [ " . implode(", ", $conjuntoA->obterElementos())." ]\n";

echo "-------------------------- Contem no Conjunto A-----------------------\n";
echo "Contem '1'? " . ($conjuntoA->contem("1") ? "Sim" : "Não") . "\n";
echo "Contem '6'? " . ($conjuntoA->contem("6") ? "Sim" : "Não") . "\n\n";

echo "------------------ Adicionando elementos no Conjunto B-------------------\n";
echo "Adicionou '6'? " . ($conjuntoB->adicionar("6") ? "Sim" : "Não") . "\n";
echo "Adicionou '7'? " . ($conjuntoB->adicionar("7") ? "Sim" : "Não") . "\n";
echo "Adicionou '6' novamente? " . ($conjuntoB->adicionar("6") ? "Sim" : "Não") . "\n";
echo "Adicionou '8'? " . ($conjuntoB->adicionar("8") ? "Sim" : "Não") . "\n";
echo "Adicionou '9'? " . ($conjuntoB->adicionar("9") ? "Sim" : "Não") . "\n\n";

echo "-------------------- Elementos do Conjunto B-----------------\n";
echo "Conjunto B: [ " . implode(", ", $conjuntoB->obterElementos())." ]\n";


echo "-------------------------- Contem no Conjunto B-----------------------\n";
echo "Contem '7'? " . ($conjuntoB->contem("7") ? "Sim" : "Não") . "\n";
echo "Contem '4'? " . ($conjuntoB->contem("4") ? "Sim" : "Não") . "\n\n";


echo "---------------- União dos Conjuntos A e B -----------------\n";
$uniao = $conjuntoA->uniao($conjuntoB); // (A união B)
echo "União (A + B): [ " . implode(", ", $uniao->obterElementos()) . "] \n";

echo "---------------- Interseção dos Conjuntos A e B -----------------\n";
$intersecao = $conjuntoA->intersecao($conjuntoB); // ( A interseção B )
echo "Interseção (A e B): [ " . implode(", ", $intersecao->obterElementos()) . " ] \n";

echo "---------------- Diferença dos Conjuntos A - B -----------------\n";
$diferenca = $conjuntoA->diferenca($conjuntoB); // ( A - B )
echo "Diferença (A - B): [ " . implode(", ", $diferenca->obterElementos()) . " ] \n";

echo "---------------- Diferença dos Conjuntos B - A -----------------\n";
$diferenca = $conjuntoB->diferenca($conjuntoA); // ( B - A )
echo "Diferença (B - A): [ " . implode(", ", $diferenca->obterElementos()) . " ] \n";

echo "---------------------------Remover------------------------------\n";
echo "Removeu '1'? " . ($conjuntoA->remover("1") ? "Sim" : "Não") . "\n";
echo "Removeu '3'? " . ($conjuntoA->remover("3") ? "Sim" : "Não") . "\n";
echo "Removeu '1' novamente ? " . ($conjuntoA->remover("1") ? "Sim" : "Não") . "\n\n";

echo "---------------- Elementos no Conjunto A após remoção-----------------\n";
echo "Conjunto A: [ " . implode(", ", $conjuntoA->obterElementos()) . " ] \n";
echo "\n-----------------------------------------------------------------------\n\n";