<?php

require_once __DIR__ . "/Grafo.php";

echo "=== Grafo Não-Direcionado Sem Ciclo ===\n";
// Alice - Bob - Charlie (Linha reta, sem fechamento)
$g1 = new Grafo(false);
$g1->adicionarAresta("Alice", "Bob");
$g1->adicionarAresta("Bob", "Charlie");

echo "Possui ciclo? " . ($g1->temCiclo() ? "SIM" : "NÃO") . "\n\n";

echo "=== Grafo Não-Direcionado Com Ciclo ===\n";
// Alice - Bob - Charlie - Alice (Triângulo fechado)
$g2 = new Grafo(false);
$g2->adicionarAresta("Alice", "Bob");
$g2->adicionarAresta("Bob", "Charlie");
$g2->adicionarAresta("Charlie", "Alice"); // Conexão que fecha o ciclo!

echo "Possui ciclo? " . ($g2->temCiclo() ? "SIM" : "NÃO") . "\n\n";

echo "=== Grafo Direcionado Com Ciclo ===\n";
// A -> B -> C -> A (Loop direcionado)
$g3 = new Grafo(true);
$g3->adicionarAresta("A", "B");
$g3->adicionarAresta("B", "C");
$g3->adicionarAresta("C", "A");

echo "Possui ciclo? " . ($g3->temCiclo() ? "SIM" : "NÃO") . "\n";