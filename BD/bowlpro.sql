-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/05/2024 às 15:27
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
-- Banco de dados: `bowlpro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm`
--

CREATE TABLE `adm` (
  `id` int(11) NOT NULL,
  `senha` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `adm`
--

INSERT INTO `adm` (`id`, `senha`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `tel` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `tel`, `email`, `senha`) VALUES
(2, 'Cleitin Oliveira', '(75) 987654569', 'cleitin1@gmail.com', 123),
(4, 'Cleitin', '(75) 987654567', 'cleitin@gmail.com', 123),
(5, 'Kelel', '(75) 987654599', 'kalel@gmail.com', 321);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_fun` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `tel` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `cpf` int(11) NOT NULL,
  `cargo` varchar(45) NOT NULL,
  `cad_unico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_fun`, `nome`, `tel`, `email`, `cpf`, `cargo`, `cad_unico`) VALUES
(1, 'Damares', '(75) 987654655', 'dam@gmail.com', 123456789, 'Gerente', 1414);

-- --------------------------------------------------------

--
-- Estrutura para tabela `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `horario` varchar(45) NOT NULL,
  `data_horario` varchar(45) NOT NULL,
  `email_cliente` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `horarios`
--

INSERT INTO `horarios` (`id_horario`, `horario`, `data_horario`, `email_cliente`) VALUES
(13, '17:02', '2024-05-11', 'cleitin@gmail.com'),
(15, '15:42', '1972-06-13', 'kalel@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expira` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expira`) VALUES
(1, 'kalel@gmail.com', '9fd4cb010242bb0b6bd13898c7bf7e23c5e5ff80361b090545e970ce61195eb0b22b63022c9affbcf82bbf025355a8597920', '2024-05-28 14:25:52'),
(2, 'kalel@gmail.com', 'f38540c34136b591881f0a77e64daec84d9b9e2a5162cb22f4d258b8e145e7a0fcb283619367a63560c34c2990b82e441440', '2024-05-28 14:33:50'),
(3, 'kalel@gmail.com', 'fdaaa7814984657a0d0ede8820ae239b', '2024-05-28 14:40:15'),
(4, 'kalel@gmail.com', 'db80f7ec160e09c3d856b2036af66963', '2024-05-28 14:41:40'),
(5, 'kalel@gmail.com', 'eb900b862c30e92f41f640272327d23d', '2024-05-28 14:41:46');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_fun`);

--
-- Índices de tabela `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adm`
--
ALTER TABLE `adm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_fun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
