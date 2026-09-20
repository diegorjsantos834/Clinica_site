-- Cria o banco de dados (se já não existir). Nome igual ao do conexao.php.
CREATE DATABASE IF NOT EXISTS clinica DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE clinica;

-- Tabela única que guarda os agendamentos = o "estoque" do nosso CRUD.
-- id            -> identificador único de cada linha (AUTO_INCREMENT soma sozinho: 1, 2, 3...)
-- paciente      -> nome de quem vai fazer a consulta
-- medico        -> médico escolhido (vem do dropdown predefinido)
-- especialidade -> especialidade escolhida (vem do dropdown predefinido)
-- data_consulta -> data da consulta no formato YYYY-MM-DD (padrão do MySQL)
CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente` varchar(120) NOT NULL,
  `medico` varchar(120) NOT NULL,
  `especialidade` varchar(80) NOT NULL,
  `data_consulta` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dados de exemplo para a tabela não abrir vazia (da para apagar depois).
INSERT INTO `agendamentos` (`paciente`, `medico`, `especialidade`, `data_consulta`) VALUES
('João Silva', 'Dra. Fernanda Lima', 'Cardiologia', '2026-09-20'),
('Maria Souza', 'Dr. Carlos Almeida', 'Dermatologia', '2026-09-22'),
('Pedro Santos', 'Dra. Renata Oliveira', 'Pediatria', '2026-09-25');