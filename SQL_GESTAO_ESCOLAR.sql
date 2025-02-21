


-- -----------------------------------------------------
-- Schema gestao_escolar
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestao_escolar` DEFAULT CHARACTER SET utf8 ;
USE `gestao_escolar` ;

-- Criação da tabela tipos_usuario
CREATE TABLE tipos_usuario (
    tipo_usuario_id INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(45) NOT NULL UNIQUE
);

-- Inserção dos tipos de usuário padrão
INSERT INTO tipos_usuario (tipo) VALUES ('administrador'), ('professor'), ('aluno');

-- Criação da tabela usuarios
CREATE TABLE usuarios (
    usuario_id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(90) NOT NULL,
    email VARCHAR(90) NOT NULL UNIQUE,
    login VARCHAR(45) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo_usuario_id INT NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tipo_usuario_id) REFERENCES tipos_usuario(tipo_usuario_id)
);


-- Criação da tabela turma
CREATE TABLE turma (
    turma_id INT PRIMARY KEY AUTO_INCREMENT,
    turma VARCHAR(45) NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Criação da tabela matricula
CREATE TABLE matricula (
    matricula_id INT PRIMARY KEY AUTO_INCREMENT,
    turma_id INT,
    matricula VARCHAR(45) NOT NULL,
    usuario_id INT,
    data_matricula DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (turma_id) REFERENCES turma(turma_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id)
);

-- Criação da tabela notas
CREATE TABLE notas (
    notas_id INT PRIMARY KEY AUTO_INCREMENT,
    bimestre INT NOT NULL,
    nota DECIMAL(5, 2) NOT NULL,
    aproveitamento DECIMAL(5, 2),
    situacao VARCHAR(25),
    matricula_id INT,
    data_lancamento DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (matricula_id) REFERENCES matricula(matricula_id)
);

-- Criação de índices adicionais para melhorar o desempenho das consultas
CREATE INDEX idx_usuarios_email ON usuarios(email);
CREATE INDEX idx_matricula_matricula ON matricula(matricula);
CREATE INDEX idx_notas_matricula_id ON notas(matricula_id);

 -- Adicione uma coluna ativo na tabela usuarios para controlar o status do usuário.
 -- *ativo = 1: Usuário ativo.
 -- *ativo = 0: Usuário inativo.

ALTER TABLE usuarios ADD COLUMN ativo TINYINT(1) DEFAULT 1;

/*
Explicação do Script:

    Tabela tipos_usuario:

        Armazena os tipos de usuários (administrador, professor, aluno).

        Permite a adição de novos tipos de usuários dinamicamente.

    Tabela usuarios:

        Armazena informações dos usuários, incluindo a referência ao tipo de usuário.

        Campos como data_criacao e data_atualizacao ajudam no rastreamento de atividades.

    Tabela turma:

        Armazena informações sobre as turmas.

        O campo data_criacao registra quando a turma foi criada.

    Tabela matricula:

        Relaciona usuários a turmas.

        O campo data_matricula registra quando a matrícula foi feita.

    Tabela notas:

        Armazena as notas dos alunos por bimestre.

        O campo aproveitamento pode ser usado para calcular o desempenho do aluno.

        O campo situacao pode armazenar a situação do aluno (aprovado, reprovado, etc.).

    Índices:

        Índices foram criados para campos frequentemente consultados, como usuarios.email, matricula.matricula e notas.matricula_id, para melhorar o desempenho das consultas.

Como Usar:

    Execute o script em um sistema de gerenciamento de banco de dados MySQL ou MariaDB.

    Após a execução, o banco de dados estará pronto para uso, com todas as tabelas, chaves primárias, chaves estrangeiras e índices configurados.

Essa estrutura é flexível, normalizada e pronta para escalar conforme necessário.


*/
/*
git init 
git add . 
git commit -m "primeiro commit"
git branch -M main 
git remote add origin (junto com o link do repositório) 
git push -u origin main 
*/