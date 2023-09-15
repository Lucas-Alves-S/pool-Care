<?php

class CRUD 
{
    private $connection;

    public function __construct()
    {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'pit';
        $this->connection = new mysqli($host, $username, $password, $database);

        if ($this->connection->connect_error) {
            die("Erro na conexão com o banco de dados: " . $this->connection->connect_error);
        }
    }

    public function cadastrouser($nome, $email, $senha)
    {
        $code = mt_rand(10000, 99999);
        $query = "INSERT INTO user (nome, email, senha, verify_cod) VALUES ('$nome', '$email', '$senha', $code)";
        $result = $this->connection->query($query);
        if ($result == true) {
            echo "<script>window.location.href='.././perfil.php';</script>";
            } else {
            print "<script>alert('Não foi possível cadastrar!')</script>";
        }
    }

    public function cadastroprofissional($nome, $email, $senha, $telefone)
    {
        $code = mt_rand(10000, 99999);
        $query = "INSERT INTO profissional (nome, email, senha, telefone, verify_cod) VALUES ('$nome', '$email', '$senha', '$telefone', $code)";
        $result = $this->connection->query($query);
        if ($result == true) {
            echo "<script>window.location.href='../profProfile.php';</script>";
            } else {
            print "<script>alert('Não foi possível cadastrar!')</script>";
        }
    }


    public function cadastropisicna($table, $nome, $largura, $altura, $comprimento, $proxima, $ultima, $fk)
    {
        $query = "INSERT INTO $table (nome, largura, altura, comprimento, proximaLimpeza, ultimaLimpeza, fk_user_id) VALUES ('$nome', $largura, $altura, $comprimento, '$proxima', '$ultima', $fk)";
        if ($this->connection->query($query) === true) {
            echo "<script>window.location.href='.././perfil.php';</script>";
            return true;
        } else {
            echo "<script>alert('Erro na criação do registro: {$this->connection->error}');</script>";
            return false;
        }
    }

    public function login($email, $senha)
    {
        $query = "SELECT * FROM user WHERE email = '$email' AND senha = '$senha'";
        $result = $this->connection->query($query);
        $quant = $result->num_rows;
        if($quant > 0){
            echo "<script>alert('Entrando...'); window.location.href='.././perfil.php';</script>";
            return true;
        }else{
            $query = "SELECT * FROM profissional WHERE email = '$email' AND senha = '$senha'";
            $result = $this->connection->query($query);
            $quant = $result->num_rows;
            if ($quant > 0){
                echo "<script>alert('Entrando...'); window.location.href='.././profProfile.php';</script>";
                return true;
            }
            else {
            print "<script>alert('Usuário não encontrado!');</script>;";
            return false;
            }
        }
    }

    public function selectuser($table, $email) 
    {
        $query = "SELECT * FROM $table WHERE email = '$email'";
        $result = $this->connection->query($query);
        $quant = $result->num_rows;
        
        if ($quant > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
        
    public function selectpiscina($column ,$id)
    {
        $query = "SELECT * FROM piscina WHERE $column = $id";
        $result = $this->connection->query($query);

        if ($result === false) {
            echo "Erro na consulta SQL: " . $this->connection->error;
            return false;
        }

        $primeiroResultado = $segundoResultado = $terceiroResultado = null;

        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($i == 0) {
                $primeiroResultado = $row;
            } elseif ($i == 1) {
                $segundoResultado = $row;
            } elseif ($i == 2) {
                $terceiroResultado = $row;
            }

            $i++;
            if ($i >= 3) {
                break;
            }
        
        }
        return [$primeiroResultado, $segundoResultado, $terceiroResultado];
    }

    public function updateuser($nome, $email, $telefone, $endereco, $id)
    {
        $sql = "UPDATE user SET nome='{$nome}',
                                            email='{$email}',
                                            telefone='{$telefone}',
                                            endereco='{$endereco}'
                                        WHERE
                                            user_id = $id";
        $result = $this->connection->query($sql);

        if ($result == true) {
            $_SESSION['email'] = $email;
            print "<script>alert('Edição concluída!');</script>";
            print "<script>location.href='../perfil.php';</script>";
        } else {
            print "<script>alert('ERRO: Não foi possível concluir a edição!');</script>";
            print "<script>location.href='../perfil.php';</script>";
        }
    }

    public function updatesenha($table, $senha, $verify_cod)
    {
        $sql = "UPDATE $table SET senha='{$senha}' WHERE verify_cod = '{$verify_cod}'";
        $result = $this->connection->query($sql);

        if ($result == true) {
            print "<script>alert('Senha alterada!');</script>";
            print "<script>location.href='../partials/login.php';</script>";
        } else {
            print "<script>alert('ERRO: Não foi possível alterar a senha!');</script>";
            print "<script>location.href='../perfil.php';</script>";
        }
    }

    public function updatePool($next, $last, $id)
    {
        $sql = "UPDATE piscina SET proximaLimpeza = '{$next}', ultimaLimpeza = '{$last}' WHERE piscina_id = {$id};";
        $result = $this->connection->query($sql);
        if ($result == true) {
            print "<script>alert('Edição concluída!');</script>";
            print "<script>location.href='../perfil.php';</script>";
        } else {
            print "<script>alert('ERRO: Não foi possível concluir a edição!');</script>";
        }
        
    }

    public function delete($id)
    {
        $query = "DELETE FROM user WHERE user_id = $id";
        $result = $this->connection->query($query);
        
        if ($result) {
            print "<script>alert('Usuário excluído'); window.location.href='../index.html';</script></script>";
            return false;
        } else {
            echo "Erro na exclusão do registro: " . $this->connection->error;
            return false;
        }
    }

    public function deletePool($poolId) {
        $query = "DELETE FROM piscina WHERE piscina_id = $poolId";
        $result = $this->connection->query($query);
        
    
        if ($result) {
            print "<script>alert('Piscina excluído');</script>";
            return true;
        } else {
            echo "Erro na exclusão do registro: " . $this->connection->error;
            return false;
        }
    }

    public function __destruct() {
        $this->connection->close();
    }
}
