<?php

require_once __DIR__.'/TabelaHash.php';

echo "=========================================\n";
echo "        TESTANDO TABELA HASH             \n";
echo "=========================================\n\n";

$testehashTable = new TabelaHash(3); // Tamanho super reduzido para forçar muitas colisões!

echo "------------------ Inserindo dados --------------------------\n";
$testehashTable->inserir("nome", "AAAA");
$testehashTable->inserir("idade", 30);
$testehashTable->inserir("cidade", "Maceió");
$testehashTable->inserir("pais", "Brasil"); // Vai colidir com certeza

echo "-------------- Testando Hash individual ------------------------------\n";
echo "Hash da chave Nome:".$testehashTable->testarHash("nome")."\n";
echo "Hash da chave Idade:".$testehashTable->testarHash("idade")."\n";
echo "Hash da chave Cidade:".$testehashTable->testarHash("cidade")."\n";
echo "Hash da chave Pais:".$testehashTable->testarHash("pais")."\n";


echo "---------------------- Buscando dados -------------------------------\n";
echo "Nome: " . $testehashTable->buscar("nome") . "\n";
echo "Idade: " . $testehashTable->buscar("idade") . "\n";
echo "Chave Inexistente: " . ($testehashTable->buscar("senha") ?? "Não encontrada") . "\n\n";

echo "---------------------------------------------------------------------\n";

echo "--- Estado da tabela por dentro ---\n";
$testehashTable->exibirTabela();

echo "\n--- Deletando 'cidade' ---\n";
$testehashTable->deletar("cidade");

echo "\n--- Estado final da tabela ---\n";
$testehashTable->exibirTabela();
