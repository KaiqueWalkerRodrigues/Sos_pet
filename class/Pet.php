<?php

class Pet {

    public $pdo;

    public function __construct() {
        $this->pdo = Conexao::conexao();               
    }

    // Método para listar todos os pets não deletados de um usuário específico que não estão na sua lista de interesse
    public function listar($id_usuario, $tipo) {
        $sql = $this->pdo->prepare('
            SELECT p.* 
            FROM pets p
            LEFT JOIN lista_interesses li ON p.id_pet = li.id_pet AND li.id_usuario = :id_usuario
            WHERE p.tipo = :tipo 
            AND p.id_usuario != :id_dono
            AND p.deleted_at IS NULL
            AND li.id_pet IS NULL
            ORDER BY p.nome ASC
        ');

        $sql->bindParam(':id_dono', $id_usuario);
        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->bindParam(':tipo', $tipo);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    public function listarMeusPets($id_usuario, $tipo) {
        $sql = $this->pdo->prepare('
            SELECT p.* 
            FROM pets p
            LEFT JOIN lista_interesses li ON p.id_pet = li.id_pet AND li.id_usuario = :id_usuario
            WHERE p.tipo = :tipo 
            AND p.id_usuario = :id_dono
            AND p.deleted_at IS NULL
            AND li.id_pet IS NULL
            ORDER BY p.nome ASC
        ');

        $sql->bindParam(':id_dono', $id_usuario);
        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->bindParam(':tipo', $tipo);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    // Método para listar todos os pets na lista de interesse de um usuário específico
    public function listarInteresses($id_usuario) {
        $sql = $this->pdo->prepare('
            SELECT p.* 
            FROM pets p
            INNER JOIN lista_interesses li ON p.id_pet = li.id_pet
            WHERE li.id_usuario = :id_usuario 
            AND p.deleted_at IS NULL
            ORDER BY p.nome ASC
        ');

        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    public function cadastrar(array $dados, $arquivo) {
        $this->pdo->beginTransaction(); // Iniciar uma transação
    
        try {
            // Inserir o pet no banco de dados
            $sql = $this->pdo->prepare('INSERT INTO pets (tipo, nome, raca, castrado, idade, cor, sexo, descricao, id_usuario) 
                                        VALUES (:tipo, :nome, :raca, :castrado, :idade, :cor, :sexo, :descricao, :id_usuario)');
    
            $tipo = strtolower(trim($dados['tipo']));
            $nome = ucwords(strtolower(trim($dados['nome'])));
            $raca = ucwords(strtolower(trim($dados['raca'])));
            $idade = $dados['idade'];
            $sexo = $dados['sexo'];
            $castrado = $dados['castrado'];
            $cor = strtolower(trim($dados['cor']));
            $descricao = trim($dados['descricao']);
            $id_usuario = $dados['id_usuario'];
    
            $sql->bindParam(':tipo', $tipo);
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':castrado', $castrado);
            $sql->bindParam(':raca', $raca);
            $sql->bindParam(':sexo', $sexo);
            $sql->bindParam(':idade', $idade);
            $sql->bindParam(':cor', $cor);
            $sql->bindParam(':descricao', $descricao);
            $sql->bindParam(':id_usuario', $id_usuario);
    
            $sql->execute();
    
            // Pegar o ID do pet recém-cadastrado
            $id_pet = $this->pdo->lastInsertId();
    
            // Realizar o upload da imagem
            $nome_imagem = $this->uploadImagem($_FILES['imagem'], $id_pet);
            if (!$nome_imagem) {
                // Se o upload falhar, cancelar a transação
                $this->pdo->rollBack();
                echo "<script>alert('Erro ao fazer o upload da imagem!');</script>";
                return false;
            }

            // Atualizar o campo imagem com o nome da imagem no banco de dados
            $sql = $this->pdo->prepare('UPDATE pets SET imagem = :imagem WHERE id_pet = :id_pet');
            $sql->bindParam(':imagem', $nome_imagem);
            $sql->bindParam(':id_pet', $id_pet);
            $sql->execute();
    
            // Confirmar a transação
            $this->pdo->commit();
    
            if ($tipo == '1') {
                return header('Location:/sos_pet/cachorros');
            } else {
                return header('Location:/sos_pet/gatos');
            }
    
        } catch (Exception $e) {
            // Se ocorrer um erro, cancelar a transação
            $this->pdo->rollBack();
            echo "<script>alert('Erro ao cadastrar o pet: " . $e->getMessage() . "');</script>";
            return false;
        }
    }

    public function editar(array $dados) {
        $this->pdo->beginTransaction(); // Iniciar uma transação
    
        try {
            // Buscar a imagem atual do pet antes de fazer alterações
            $pet_atual = $this->mostrar($dados['id_pet']);
            $imagem_atual = $pet_atual->imagem;
    
            // Atualizar o pet no banco de dados
            $sql = $this->pdo->prepare('UPDATE pets SET tipo = :tipo, nome = :nome, sexo = :sexo, castrado = :castrado, raca = :raca, idade = :idade, cor = :cor, descricao = :descricao WHERE id_pet = :id_pet');
        
            $tipo = strtolower(trim($dados['tipo']));
            $nome = ucwords(strtolower(trim($dados['nome'])));
            $raca = ucwords(strtolower(trim($dados['raca'])));
            $idade = intval($dados['idade']);
            $cor = strtolower(trim($dados['cor']));
            $descricao = trim($dados['descricao']);
            $sexo = $dados['sexo'];
            $castrado = $dados['castrado'];
            $id_pet = $dados['id_pet'];
        
            $sql->bindParam(':tipo', $tipo);
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':raca', $raca);
            $sql->bindParam(':sexo', $sexo);
            $sql->bindParam(':idade', $idade);
            $sql->bindParam(':cor', $cor);
            $sql->bindParam(':castrado', $castrado);
            $sql->bindParam(':descricao', $descricao);
            $sql->bindParam(':id_pet', $id_pet);
        
            $sql->execute();
    
            // Verificar se uma nova imagem foi enviada
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
                // Limpar a imagem atual do banco de dados
                $sql = $this->pdo->prepare('UPDATE pets SET imagem = NULL WHERE id_pet = :id_pet');
                $sql->bindParam(':id_pet', $id_pet);
                $sql->execute();
    
                // Remover a imagem antiga do sistema de arquivos, se existir
                if ($imagem_atual && file_exists('imagens_pets/' . $imagem_atual)) {
                    unlink('imagens_pets/' . $imagem_atual);
                }
    
                // Fazer o upload da nova imagem
                $nova_imagem = $this->uploadImagem($_FILES['imagem'], $id_pet);
                if ($nova_imagem) {
                    // Atualizar o nome da nova imagem no banco de dados
                    $sql = $this->pdo->prepare('UPDATE pets SET imagem = :imagem WHERE id_pet = :id_pet');
                    $sql->bindParam(':imagem', $nova_imagem);
                    $sql->bindParam(':id_pet', $id_pet);
                    $sql->execute();
                } else {
                    // Se o upload falhar, cancelar a transação
                    $this->pdo->rollBack();
                    echo "<script>alert('Erro ao fazer o upload da imagem!');</script>";
                    return false;
                }
            }
        
            // Confirmar a transação
            $this->pdo->commit();
        
            if ($tipo == '1') {
                return header('Location:/sos_pet/cachorros');
            } else {
                return header('Location:/sos_pet/gatos');
            }
        
        } catch (Exception $e) {
            // Se ocorrer um erro, cancelar a transação
            $this->pdo->rollBack();
            echo "<script>alert('Erro ao editar o pet: " . $e->getMessage() . "');</script>";
            return false;
        }
    }
    

    public function mostrar(int $id_pet) {
        $sql = $this->pdo->prepare('SELECT * FROM pets WHERE id_pet = :id_pet LIMIT 1');
        $sql->bindParam(':id_pet', $id_pet);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_OBJ);
    }

    public function excluir(int $id_pet, $tipo) {
        $sql = $this->pdo->prepare('UPDATE pets SET deleted_at = :deleted_at WHERE id_pet = :id_pet');
        $deleted_at = date("Y-m-d H:i:s");
        $sql->bindParam(':deleted_at', $deleted_at);
        $sql->bindParam(':id_pet', $id_pet);
        $sql->execute();

        if($tipo == 1){
            return header('Location:/sos_pet/cachorros');
        } else {
            return header('Location:/sos_pet/gatos');
        }
    }

    public function adicionarInteresse($id_usuario, $id_pet) {
        $sql = $this->pdo->prepare('SELECT COUNT(*) as total FROM lista_interesses 
                                    WHERE id_usuario = :id_usuario AND id_pet = :id_pet');
        
        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->bindParam(':id_pet', $id_pet);
        $sql->execute();

        $resultado = $sql->fetch(PDO::FETCH_ASSOC);

        if ($resultado['total'] > 0) {
            echo "<script>alert('Já adicionado à sua lista de interesse!');</script>";
            return header('location: /sos_pets/lista_interesse');
        }

        $sql = $this->pdo->prepare('INSERT INTO lista_interesses (id_usuario, id_pet) 
                                    VALUES (:id_usuario, :id_pet)');

        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->bindParam(':id_pet', $id_pet);

        $sql->execute();

        return header('location: /sos_pet/lista_interesse?s=check');
    }

    public function uploadImagem($arquivo, $id_pet) {
        // Diretório onde as imagens serão salvas
        $diretorio = 'imagens_pets/';
        
        // Pegar a extensão do arquivo original
        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        
        // Verificar se a extensão é permitida
        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($extensao, $extensoes_permitidas)) {
            echo "<script>alert('Formato de arquivo inválido!');</script>";
            return false;
        }
        
        // Nomear o arquivo com o ID do pet e a extensão original
        $novo_nome = $id_pet . '.' . $extensao;
        $destino = $diretorio . $novo_nome;

        // Mover o arquivo para o destino com o novo nome
        if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
            return $novo_nome;
        } else {
            echo "<script>alert('Erro ao salvar a imagem!');</script>";
            return false;
        }
    }
}

?>
