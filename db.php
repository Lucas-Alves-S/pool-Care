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
        $query = "INSERT INTO profissional (nome, email, senha, telefone, verify_cod, dataCadastro) VALUES ('$nome', '$email', '$senha', '$telefone', $code, Now())";
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

    public function cadastroServico($desc, $nota, $fk) {
        $query = "INSERT INTO servico (descricao, nota, fk_profissional_id) VALUE ('$desc', $nota, $fk)";
        if ($this->connection->query($query) === true) {
            echo "<script>window.location.href='../profProfile.php';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar!')</script>";
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

    public function selectContratacao() {
        $query = 'select Pro.urlPhoto, Pro.nome, COALESCE(COUNT(S.servico_id), 0) as servicos, COALESCE(ROUND(AVG(S.nota), 1), "0 serviços realizados") as nota, DATEDIFF(CURRENT_DATE(), Pro.dataCadastro) as dias, Pro.telefone
                  from profissional as Pro
                  left join servico as S on Pro.profissional_id = S.fk_profissional_id
                  group by Pro.profissional_id;
                ';
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr class="border">';
                echo '<td> <img class="rounded-full h-[5rem] mr-3 p-2" src="' . ($row["urlPhoto"] === "" ? "./assets/picture.jpeg" : $row["urlPhoto"]) . '" alt=""> </td>';
                echo '<td class="text-center">' . $row["nome"] . '</td>';
                echo '<td class="text-center">' . $row["servicos"] . '</td>';
                echo '<td class="text-center">' . $row["nota"] . '</td>';
                echo '<td class="text-center">' . $row["telefone"] . '</td>';
                echo '<td class="text-center">' . $row["dias"] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="3">Nenhum registro encontrado</td></tr>';
        }
    }

    public function updateuser($nome, $email, $telefone, $endereco, $url, $id)
    {
        $sql = "UPDATE user SET nome='{$nome}',
                                            email='{$email}',
                                            telefone='{$telefone}',
                                            endereco='{$endereco}',
                                            urlPhoto='{$url}'
                                        WHERE
                                            user_id = $id";
        $result = $this->connection->query($sql);

        if ($result == true) {
            $_SESSION['email'] = $email;
            print "<script>alert('Edição concluída!');</script>";
            print "<script>location.href='./perfil.php';</script>";
        } else {
            print "<script>alert('ERRO: Não foi possível concluir a edição!');</script>";
            print "<script>location.href='./perfil.php';</script>";
        }
    }

    public function updateprofissional($nome, $email, $telefone, $url, $id)
    {
        $comm = "UPDATE profissional SET nome='{$nome}',
                                            email='{$email}',
                                            telefone='{$telefone}' ,
                                            urlPhoto='{$url}'
                                        WHERE
                                            profissional_id = $id";
        $result = $this->connection->query($comm);

        if ($result == true) {
            $_SESSION['email'] = $email;
            print "<script>alert('Edição concluída!');</script>";
            print "<script>location.href='./profProfile.php';</script>";
        } else {
            print "<script>alert('ERRO: Não foi possível concluir a edição!');</script>";
            print "<script>location.href='./profProfile.php';</script>";
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

    public function infoServices($id){
        $sql = "SELECT COUNT(*) AS SOMA, ROUND(AVG(nota), 1) AS MEDIA FROM servico WHERE fk_profissional_id = $id";
        $result = $this->connection->query($sql);

        if ($result === false) {
            echo "Erro na consulta SQL: " . $this->connection->error;
            return false;
        } else {
            return $result;
        }
    }

    public function delete($table, $id)
    {
        $query = "DELETE FROM $table WHERE ".$table."_id = $id";
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
