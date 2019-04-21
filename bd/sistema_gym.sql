-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Mar-2019 às 00:14
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistema_gym`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncio`
--

CREATE TABLE `anuncio` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nome_img` text COLLATE utf8_unicode_ci NOT NULL,
  `situacao` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `anuncio`
--

INSERT INTO `anuncio` (`id`, `nome`, `nome_img`, `situacao`) VALUES
(14, 'Internet Banda Larga', '95f6116cad1f3b24f9a864a2b301027d..png', 'ativo'),
(15, 'Fitness Rio', '6ccf6c38f3f766b991a1a2c42a90b187..jpg', 'ativo'),
(16, 'Dentista Zona Sul', '49b5ab52daf8a80bf2301f9e4789b6f3..jpg', 'ativo'),
(17, 'Netflix', 'd82936e6d077203f3df01916ac0b13fd..jpg', 'ativo'),
(18, 'Mercado Livre', '92ed213f154e1bab2101ee3207b8aa0b..jpg', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `depoimento`
--

CREATE TABLE `depoimento` (
  `id` int(11) NOT NULL,
  `img_nome` text COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `depoimento` varchar(430) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dias_semana`
--

CREATE TABLE `dias_semana` (
  `id` int(11) NOT NULL,
  `semana` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `abreviacao` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `posicao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `dias_semana`
--

INSERT INTO `dias_semana` (`id`, `semana`, `abreviacao`, `posicao`) VALUES
(1, 'Domingo', 'Dom.', 1),
(2, 'Segunda', 'Seg.', 2),
(3, 'Terça', 'Ter.', 3),
(4, 'Quarta', 'Qua.', 4),
(5, 'Quinta', 'Qui.', 5),
(6, 'Sexta', 'Sex.', 6),
(7, 'Sábado', 'Sab.', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado_br`
--

CREATE TABLE `estado_br` (
  `id` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `uf` varchar(2) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `estado_br`
--

INSERT INTO `estado_br` (`id`, `estado`, `uf`) VALUES
(1, 'Acre', 'AC'),
(2, 'Alagos', 'AP'),
(3, 'Amazonas', 'AM'),
(4, 'Bahia', 'BA'),
(5, 'Ceára', 'CE'),
(6, 'Distrito Federal', 'DF'),
(7, 'Espirito Santo', 'ES'),
(8, 'Goiás', 'GO'),
(9, 'Maranhão', 'MA'),
(10, 'Mato Grosso do Sul', 'MS'),
(11, 'Mato Grosso', 'MT'),
(12, 'Minas Gerais', 'MG'),
(13, 'Pará', 'PA'),
(14, 'Paraiba', 'PB'),
(15, 'Paraná', 'PR'),
(16, 'Pernambuco', 'PE'),
(17, 'Piauí', 'PI'),
(18, 'Rio de Janeiro', 'RJ'),
(19, 'Rio Grande do Norte', 'RN'),
(20, 'Rio Grande do Sul', 'RS'),
(21, 'Rondônia', 'RO'),
(22, 'Roraima', 'RR'),
(23, 'Santa Catarina', 'SC'),
(24, 'São Paulo', 'SP'),
(25, 'Sergipe', 'SE'),
(26, 'Tocantins', 'TO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `planos`
--

CREATE TABLE `planos` (
  `id` int(11) NOT NULL,
  `img_plano` text COLLATE utf8_unicode_ci NOT NULL,
  `tipo_plano` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `semana` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `horario` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `acao` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `planos`
--

INSERT INTO `planos` (`id`, `img_plano`, `tipo_plano`, `semana`, `horario`, `preco`, `acao`) VALUES
(5, 'f04dae10ee4be0d9fd683864dc7e37e4..png', 'Musculação', 'Segunda a Sábado', '08:00 as 23:00', '60.00', 'ativo'),
(6, 'a429cefe9550a27d28c700b34666cf20..jpg', 'Alongamento', 'Segunda e Terça', '10:00 até 10:45', '45.00', 'ativo'),
(7, 'ee832e006762127e47954304eaffa57c..png', 'Personal Training', 'Segunda a Segunda', '08:00 as 09:00', '120.00', 'ativo'),
(8, '3cc0ecb260ed9b7d4a67fbf9547f7f8b..png', 'Aula de Dança', 'Quarta e Sexta', '08:00 as 09:30', '60.00', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `primeiro_nome` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `sobrenome` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `rg` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nascimento` date NOT NULL,
  `tipo_aula` int(11) NOT NULL,
  `telefone` text COLLATE utf8_unicode_ci NOT NULL,
  `endereco` text COLLATE utf8_unicode_ci NOT NULL,
  `situacao` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_usuario` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `img_usuario` text COLLATE utf8_unicode_ci NOT NULL,
  `id_serie` int(11) NOT NULL,
  `id_crip` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `primeiro_nome`, `sobrenome`, `usuario`, `senha`, `email`, `cpf`, `rg`, `sexo`, `nascimento`, `tipo_aula`, `telefone`, `endereco`, `situacao`, `tipo_usuario`, `img_usuario`, `id_serie`, `id_crip`) VALUES
(1, 'Usuário', 'Administrador', 'admin', 'admin', 'admin@gmail.com', '11111111111', '111111111', 'Masculino', '1998-02-02', 5, '', '', 'Ativo', 'Administrador', 'perfil.png', 0, '21232f297a57a5a743894a0e4a801fc3'),
(15, 'Diogo', 'Guimaraes', 'tec.diogo', '123', 'tec.diogoguima@gmail.com', '11111111111', '111111111', 'Masculino', '2019-03-01', 6, 'a:1:{i:0;s:23:\"(11) 11111-1111-Celular\";}', 'a:0:{}', 'Ativo', 'Administrador', 'perfil.png', 0, 'e3e9db9063085531d270fc6b9600e781');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depoimento`
--
ALTER TABLE `depoimento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dias_semana`
--
ALTER TABLE `dias_semana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estado_br`
--
ALTER TABLE `estado_br`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planos`
--
ALTER TABLE `planos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `depoimento`
--
ALTER TABLE `depoimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dias_semana`
--
ALTER TABLE `dias_semana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `estado_br`
--
ALTER TABLE `estado_br`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `planos`
--
ALTER TABLE `planos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
