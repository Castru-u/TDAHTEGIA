-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/08/2024 às 20:47
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tdahtegia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat`
--

CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL,
  `denuncia` varchar(50) DEFAULT NULL,
  `idespecialista` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chat`
--

INSERT INTO `chat` (`idchat`, `denuncia`, `idespecialista`, `idusuario`) VALUES
(1, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comunidades`
--

CREATE TABLE `comunidades` (
  `idcomunidade` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comunidade_usuario`
--

CREATE TABLE `comunidade_usuario` (
  `id` int(11) NOT NULL,
  `idcomunidade` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `role` enum('comum','admin') NOT NULL DEFAULT 'comum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `especialidade`
--

CREATE TABLE `especialidade` (
  `tipo` varchar(40) NOT NULL,
  `descricao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagem`
--

CREATE TABLE `mensagem` (
  `conteudo` varchar(500) NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `idusuario` int(11) DEFAULT NULL,
  `idchat` int(11) DEFAULT NULL,
  `idcomunidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mensagem`
--

INSERT INTO `mensagem` (`conteudo`, `data_envio`, `idusuario`, `idchat`, `idcomunidade`) VALUES
('Olá, tudo bem?', '2024-08-01 21:46:25', 1, 1, NULL),
('Tudo, e você?', '2024-08-01 21:47:05', 2, 1, NULL),
('Testando as mensagens do TDAHTEGIA!', '2024-08-01 21:47:39', 2, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `postagem`
--

CREATE TABLE `postagem` (
  `idpostagem` int(11) NOT NULL,
  `conteudo` varchar(500) DEFAULT NULL,
  `data_envio` date NOT NULL,
  `hora_envio` time NOT NULL,
  `idusuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `descricao` varchar(200) DEFAULT '',
  `role` enum('comum','especialista','admin') NOT NULL DEFAULT 'comum',
  `data_criacao` date DEFAULT curdate(),
  `foto` varchar(255) DEFAULT 'default_user.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `email`, `senha`, `descricao`, `role`, `data_criacao`, `foto`) VALUES
(1, 'joao pedro admin', 'joaopedrocs2020@gmail.com', '$2y$10$OtosDWvjsLEdzmAIL2KOeOBJyZXqF2pSc4/ykm.G.GxS3vDgI8zgW', 'Não aguento mais', 'especialista', '2024-07-21', '66a8eb3b8e86d_IMG_20170310_212610962_HDR.jpg'),
(2, 'joao', 'idontknow@gmail.com', '$2y$10$y0IYiG6BA6XPorU9hdj/TeWWPbgDRQI9yMRkbHgf8oqij7zYZ9jU6', 'nao sei', 'comum', '2024-07-22', 'default_user.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_especialidade`
--

CREATE TABLE `usuario_especialidade` (
  `id` int(11) NOT NULL,
  `tipo` varchar(40) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idchat`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idespecialista` (`idespecialista`);

--
-- Índices de tabela `comunidades`
--
ALTER TABLE `comunidades`
  ADD PRIMARY KEY (`idcomunidade`);

--
-- Índices de tabela `comunidade_usuario`
--
ALTER TABLE `comunidade_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcomunidade` (`idcomunidade`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Índices de tabela `especialidade`
--
ALTER TABLE `especialidade`
  ADD PRIMARY KEY (`tipo`);

--
-- Índices de tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idchat` (`idchat`),
  ADD KEY `idcomunidade` (`idcomunidade`);

--
-- Índices de tabela `postagem`
--
ALTER TABLE `postagem`
  ADD PRIMARY KEY (`idpostagem`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Índices de tabela `usuario_especialidade`
--
ALTER TABLE `usuario_especialidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo` (`tipo`),
  ADD KEY `idusuario` (`idusuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chat`
--
ALTER TABLE `chat`
  MODIFY `idchat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `comunidades`
--
ALTER TABLE `comunidades`
  MODIFY `idcomunidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comunidade_usuario`
--
ALTER TABLE `comunidade_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `postagem`
--
ALTER TABLE `postagem`
  MODIFY `idpostagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario_especialidade`
--
ALTER TABLE `usuario_especialidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`idespecialista`) REFERENCES `usuario` (`idusuario`);

--
-- Restrições para tabelas `comunidade_usuario`
--
ALTER TABLE `comunidade_usuario`
  ADD CONSTRAINT `comunidade_usuario_ibfk_1` FOREIGN KEY (`idcomunidade`) REFERENCES `comunidades` (`idcomunidade`),
  ADD CONSTRAINT `comunidade_usuario_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Restrições para tabelas `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `mensagem_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `mensagem_ibfk_2` FOREIGN KEY (`idchat`) REFERENCES `chat` (`idchat`),
  ADD CONSTRAINT `mensagem_ibfk_3` FOREIGN KEY (`idcomunidade`) REFERENCES `comunidades` (`idcomunidade`);

--
-- Restrições para tabelas `postagem`
--
ALTER TABLE `postagem`
  ADD CONSTRAINT `postagem_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Restrições para tabelas `usuario_especialidade`
--
ALTER TABLE `usuario_especialidade`
  ADD CONSTRAINT `usuario_especialidade_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `especialidade` (`tipo`),
  ADD CONSTRAINT `usuario_especialidade_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
