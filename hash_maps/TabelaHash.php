<?php

class TabelaHash
{
    private array $tabela;
    private int $tamanho;

    // Construtor: define o tamanho e inicializa a tabela com posições vazias
    public function __construct(int $tamanho = 10)
    {
        $this->tamanho = $tamanho;
        $this->tabela = array_fill(0, $tamanho, []); // Cria o array preenchido com sub-arrays vazios
    }

    /**
     * Transforma uma string em um índice numérico válido para o array interno.
     */
    private function gerarHash(string $chave): int
    {
        $soma = 0;
        $comprimento = strlen($chave);

        // Alfabeto artesanal de caracteres válidos ASCII
        $alfabeto_ascii = " !\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~";
        $tamanhoAlfabeto = strlen($alfabeto_ascii);

        for ($i = 0; $i < $comprimento; $i++) {
            $caractereAtual = $chave[$i];
            $valorDoCaractere = 0;

            // Busca manual do índice do caractere dentro do nosso alfabeto
            for ($j = 0; $j < $tamanhoAlfabeto; $j++) {
                if ($alfabeto_ascii[$j] === $caractereAtual) {
                    $valorDoCaractere = $j + 1; // Usa a posição como o peso numérico
                    break;
                }
            }

            // Se for um caractere estranho fora do alfabeto, usa-se um peso padrão
            if ($valorDoCaractere === 0) {
                $valorDoCaractere = 99;
            }

            $soma = $soma + $valorDoCaractere;
        }

        return $soma % $this->tamanho;
    }

    /**
     * Insere ou atualiza um par chave/valor na tabela
     */
    public function inserir(string $chave, string $valor): void
    {
        $indice = $this->gerarHash($chave); // Obtem o indice

        
         // Verifique se a chave já existe dentro do sub-array daquele índice
         // Se existir, atualiza o valor e retorna para encerrar o método
        foreach($this->tabela[$indice] as $chaveAtual => $par){
            if($par['chave'] === $chave){
                $this->tabela[$indice][$chaveAtual]['valor'] = $valor;
                return;
            }
        }

        // Se o loop acima terminar sem dar 'return', significa que a chave é nova.
        // Adicione o novo par à tabela naquele índice:
        $this->tabela[$indice][] = [
            'chave' => $chave,
            'valor' => $valor
        ];
        
    }

    /**
     * Busca o valor associado a uma chave.
     * Retorna o valor se encontrar, ou null caso não exista.
     */
    public function buscar(string $chave)
    {
        $indice = $this->gerarHash($chave);

        // Varredura no sub-array contido em $this->tabela[$indice]
        foreach($this->tabela[$indice] as $par){
            // Se encontrar a chave procurada, retorne o 'valor' dela
            if($par['chave'] === $chave){
                return $par['valor'];
            }
        }

        // Se não encontrar, a chave não existe na tabela
        return null;
    }

    /**
     * Remove um par chave/valor da tabela.
     * Retorna true se removeu com sucesso, ou false se a chave não existia.
     */
    public function deletar(string $chave): bool
    {
        $indice = $this->gerarHash($chave);

        foreach ($this->tabela[$indice] as $chaveAtual => $par) {
            if ($par['chave'] === $chave) {
                // Remove o elemento do sub-array manualmente usando o unset do PHP
                unset($this->tabela[$indice][$chaveAtual]);
                
                // Reindexa o sub-array para não deixar buracos de índices numéricos internos
                $this->tabela[$indice] = array_values($this->tabela[$indice]);
                return true;
            }
        }

        return false;
    }

    # ===================== Métodos auxiliares ===================

    // Método auxiliar para visualizar como a tabela está por dentro
    public function exibirTabela(): void
    {
        print_r($this->tabela);
    }

    // Método para teste da função hash
    public function testarHash(string $chave): int
    {
        return $this->gerarHash($chave);
    }
}
