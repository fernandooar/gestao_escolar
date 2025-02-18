<?php
// Configurações do banco de dados
$host = 'localhost'; // Endereço do servidor MySQL
$dbname = 'gestao_escolar'; // Nome do banco de dados
$username = 'root'; // Usuário do banco de dados
$password = ''; // Senha do banco de dados

// Conexão com o banco de dados usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilita exceções para erros
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage()); // Exibe mensagem de erro
}
/*try { ... } catch { ... }: O bloco try é usado para tentar executar o código que pode gerar erros. Se ocorrer algum erro, ele será capturado pelo bloco catch.

new PDO(...): Aqui, é criada uma nova instância da classe PDO, que estabelece a conexão com o banco de dados. Os parâmetros passados são:

    mysql:host=$host;dbname=$dbname;charset=utf8: A string de conexão, que especifica o driver (mysql), o host, o nome do banco de dados e o charset (utf8 para suporte a caracteres especiais).

    $username: O nome do usuário do banco de dados.

    $password: A senha do banco de dados.

setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION): Configura o PDO para lançar exceções (PDOException) em caso de erros. Isso facilita a depuração, pois os erros serão capturados e exibidos.

catch (PDOException $e): Se ocorrer um erro durante a conexão, ele será capturado aqui. A função die interrompe a execução do script e exibe a mensagem de erro ($e->getMessage()).

die("Erro ao conectar ao banco de dados: " . $e->getMessage());

Se a conexão falhar, o script será interrompido (die), e uma mensagem de erro será exibida, contendo detalhes sobre o problema (obtidos através de $e->getMessage()).
*/
?>