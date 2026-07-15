<?php

require_once __DIR__.'/Conjunto.php';

echo "=========================================\n";
echo "             TESTANDO SETS                \n";
echo "=========================================\n\n";

$conjunto = new Conjunto(10);

echo "------------------ Adicionando elementos -------------------\n";
echo "Adicionou 'AAAA'? " . ($conjunto->adicionar("AAAA") ? "Sim" : "Não") . "\n";
echo "Adicionou 'BBBB'? " . ($conjunto->adicionar("BBBB") ? "Sim" : "Não") . "\n";
echo "Adicionou 'AAAA' novamente? " . ($conjunto->adicionar("AAAA") ? "Sim" : "Não") . "\n";
echo "Adicionou 'CCCC'? " . ($conjunto->adicionar("CCCC") ? "Sim" : "Não") . "\n";
echo "Adicionou 'DDDD'? " . ($conjunto->adicionar("DDDD") ? "Sim" : "Não") . "\n\n";


echo "-------------------------- Contem -----------------------\n";
echo "Contem 'AAAA'? " . ($conjunto->contem("AAAA") ? "Sim" : "Não") . "\n";
echo "Contem 'EEEE'? " . ($conjunto->contem("EEEE") ? "Sim" : "Não") . "\n\n";


echo "-------------------- Elementos no Conjunto -----------------\n";
print_r($conjunto->obterElementos());

echo "---------------------------Remover------------------------------\n";
echo "Removeu 'AAAA'? " . ($conjunto->remover("AAAA") ? "Sim" : "Não") . "\n";
echo "Removeu 'EEEE'? " . ($conjunto->remover("EEEE") ? "Sim" : "Não") . "\n";
echo "Removeu 'AAAA' novamente ? " . ($conjunto->remover("AAAA") ? "Sim" : "Não") . "\n\n";

echo "---------------- Elementos no Conjunto após remoção-----------------\n";
print_r($conjunto->obterElementos());