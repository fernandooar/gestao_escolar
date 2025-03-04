

/*
Explicação das alterações e organização:

    Adição da coluna ativo na tabela usuarios:

        A coluna ativo foi adicionada para controlar o status do usuário, onde 1 significa ativo e 0 significa inativo.

    Criação da tabela professor_turma:

        Essa tabela foi criada para armazenar o relacionamento entre professores e turmas. Ela contém:

            professor_turma_id: Chave primária autoincrementada.

            usuario_id: ID do professor (deve ser um usuário do tipo professor).

            turma_id: ID da turma à qual o professor está vinculado.

        As chaves estrangeiras garantem a integridade referencial com as tabelas usuarios e turma.

    Organização do script:

        O script foi dividido em seções claras para facilitar a leitura e manutenção.

        Comentários foram adicionados para explicar cada parte do código.

    Índices:

        Foram criados índices nas colunas email da tabela usuarios, matricula da tabela matricula e matricula_id da tabela notas para melhorar o desempenho das consultas.

Esse script está pronto para ser executado em um banco de dados MySQL para criar a estrutura completa do sistema de gestão escolar.
*/
-- -----------------------------------------------------
-- Schema gestao_escolar
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestao_escolar` DEFAULT CHARACTER SET utf8;
USE `gestao_escolar`;

-- -----------------------------------------------------
-- Tabela tipos_usuario
-- -----------------------------------------------------
CREATE TABLE tipos_usuario (
    tipo_usuario_id INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(45) NOT NULL UNIQUE
);

-- Inserção dos tipos de usuário padrão
INSERT INTO tipos_usuario (tipo) VALUES ('administrador'), ('professor'), ('aluno');

-- -----------------------------------------------------
-- Tabela usuarios
-- -----------------------------------------------------
CREATE TABLE usuarios (
    usuario_id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(90) NOT NULL,
    email VARCHAR(90) NOT NULL UNIQUE,
    login VARCHAR(45) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo_usuario_id INT NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ativo TINYINT(1) DEFAULT 1, -- Adicionada coluna ativo
    FOREIGN KEY (tipo_usuario_id) REFERENCES tipos_usuario(tipo_usuario_id)
);

-- -----------------------------------------------------
-- Tabela turma
-- -----------------------------------------------------
CREATE TABLE turma (
    turma_id INT PRIMARY KEY AUTO_INCREMENT,
    turma VARCHAR(45) NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Tabela matricula
-- -----------------------------------------------------
CREATE TABLE matricula (
    matricula_id INT PRIMARY KEY AUTO_INCREMENT,
    turma_id INT,
    matricula VARCHAR(45) NOT NULL,
    usuario_id INT,
    data_matricula DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (turma_id) REFERENCES turma(turma_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id)
);

-- -----------------------------------------------------
-- Tabela notas
-- -----------------------------------------------------
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

-- -----------------------------------------------------
-- Tabela professor_turma
-- -----------------------------------------------------
CREATE TABLE professor_turma (
    professor_turma_id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL, -- ID do professor
    turma_id INT NOT NULL,   -- ID da turma
    FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id),
    FOREIGN KEY (turma_id) REFERENCES turma(turma_id)
);

-- -----------------------------------------------------
-- Índices para melhorar o desempenho das consultas
-- -----------------------------------------------------
CREATE INDEX idx_usuarios_email ON usuarios(email);
CREATE INDEX idx_matricula_matricula ON matricula(matricula);
CREATE INDEX idx_notas_matricula_id ON notas(matricula_id);

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


