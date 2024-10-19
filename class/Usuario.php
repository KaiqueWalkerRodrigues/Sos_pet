<?php

class Usuario {

    public $pdo;

    public function __construct() {
        $this->pdo = Conexao::conexao();               
    }

    // Método para listar todos os usuários não deletados
    public function listar(){
        $sql = $this->pdo->prepare('SELECT * FROM usuarios WHERE deleted_at IS NULL ORDER BY nome ASC');        
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    // Método para cadastrar um novo usuário
    public function cadastrar(array $dados) {
        $salt = 'sos';

        // Verifica duplicidade de CPF
        $sql = $this->pdo->prepare('SELECT * FROM usuarios WHERE cpf = :cpf AND deleted_at IS NULL');
        $cpf = preg_replace('/[^0-9]/', '', $dados['cpf']);
        $sql->bindParam(':cpf', $cpf);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            echo '<script>alert("CPF já cadastrado!");</script>';
            return false;
        }

        // Verifica duplicidade de email
        $sql = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = :email AND deleted_at IS NULL');
        $email = strtolower(trim($dados['email']));
        $sql->bindParam(':email', $email);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            echo '<script>alert("Email já cadastrado!");</script>';
            return false;
        }

        $sql = $this->pdo->prepare('INSERT INTO usuarios (nome, email, cpf, celular, cep, senha) 
                                    VALUES (:nome, :email, :cpf, :celular, :cep, :senha)');

        $nome = ucwords(strtolower(trim($dados['nome'])));
        $celular = preg_replace('/[^0-9]/', '', $dados['celular']);
        $cep = preg_replace('/[^0-9]/', '', $dados['cep']);
        $senha = crypt($dados['senha'], $salt);

        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':cpf', $cpf);
        $sql->bindParam(':celular', $celular);
        $sql->bindParam(':cep', $cep);
        $sql->bindParam(':senha', $senha);

        $sql->execute();

        return header('Location:/sos_pet/logar');
    }

    // Método para mostrar um usuário específico pelo ID
    public function mostrar(int $id_usuario) {
        $sql = $this->pdo->prepare('SELECT * FROM usuarios WHERE id_usuario = :id_usuario LIMIT 1');
        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_OBJ);
    }

    // Método para editar um usuário
    public function editar(array $dados) {
        $salt = 'sos';
        if (!empty($dados['senha'])) {
            $senha = crypt($dados['senha'],$salt);
            $sql = $this->pdo->prepare('UPDATE usuarios SET nome = :nome, email = :email, cpf = :cpf, celular = :celular, cep = :cep, senha = :senha WHERE id_usuario = :id_usuario');
            $sql->bindParam(':senha', $senha);
        } else {
            $sql = $this->pdo->prepare('UPDATE usuarios SET nome = :nome, email = :email, cpf = :cpf, celular = :celular, cep = :cep WHERE id_usuario = :id_usuario');
        }

        $nome = ucwords(strtolower(trim($dados['nome'])));
        $email = strtolower(trim($dados['email']));
        $cpf = preg_replace('/[^0-9]/', '', $dados['cpf']);
        $celular = preg_replace('/[^0-9]/', '', $dados['celular']);
        $cep = preg_replace('/[^0-9]/', '', $dados['cep']);
        $id_usuario = $dados['id_usuario'];

        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':cpf', $cpf);
        $sql->bindParam(':celular', $celular);
        $sql->bindParam(':cep', $cep);
        $sql->bindParam(':id_usuario', $id_usuario);

        $sql->execute();

        return header('Location:/usuarios');
    }

    // Método para excluir um usuário (soft delete)
    public function excluir(int $id_usuario) {
        $sql = $this->pdo->prepare('UPDATE usuarios SET deleted_at = :deleted_at WHERE id_usuario = :id_usuario');
        $deleted_at = date("Y-m-d H:i:s");
        $sql->bindParam(':deleted_at', $deleted_at);
        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->execute();

        return header('Location:/usuarios');
    }

    public function logar($email, $senha) {
        $sql = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = :email AND deleted_at IS NULL');
        $sql->bindParam(':email', $email);
        $sql->execute();
    
        $usuario = $sql->fetch(PDO::FETCH_OBJ);
    
        if ($usuario) { // Verifica se um usuário foi encontrado
            $salt = 'sos';
            $senha = crypt($senha, $salt);
    
            if ($senha == $usuario->senha) {
                session_start();
                $_SESSION['logado'] = true;
                $_SESSION['nome'] = $usuario->nome;
                $_SESSION['id_usuario'] = $usuario->id_usuario;
                $_SESSION['cnpj'] = $usuario->cnpj;
    
                header('Location: /sos_pet/home');
                exit();
            } else {
                echo '<script>alert("Email ou senha incorretos!");</script>';
                return false;
            }
        } else {
            echo '<script>alert("Email ou senha incorretos!");</script>';
            return false;
        }
    }
    
    public function cadastrarEmpresa(array $dados) {
        // Verifica duplicidade de CNPJ
        $sql = $this->pdo->prepare('SELECT * FROM usuarios WHERE cnpj = :cnpj AND deleted_at IS NULL');
        $cnpj = preg_replace('/[^0-9]/', '', $dados['cnpj']);
        $sql->bindParam(':cnpj', $cnpj);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            echo '<script>alert("CNPJ já cadastrado!");</script>';
            return false;
        }
    
        $sql = $this->pdo->prepare('UPDATE usuarios SET nome_empresa = :nome_empresa, cnpj = :cnpj WHERE id_usuario = :id_usuario');
    
        $nome_empresa = ucwords(strtolower(trim($dados['nome_empresa'])));
        $id_usuario = $_SESSION['id_usuario'];
    
        $sql->bindParam(':nome_empresa', $nome_empresa);
        $sql->bindParam(':cnpj', $cnpj);
        $sql->bindParam(':id_usuario', $id_usuario);
    
        $sql->execute();
    
        echo "<script>
                alert('Registrado como Doador com Sucesso!');
                window.location.href = '/sos_pet/sair';
              </script>";
        exit();
    }
}
