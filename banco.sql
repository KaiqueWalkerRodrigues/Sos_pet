-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: skillhub
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cursos` (
  `id_curso` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `imagem` text NOT NULL,
  `descricao` text NOT NULL,
  `n_slides` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'Introdução ao Computador','https://img.freepik.com/fotos-gratis/mulher-jovem-e-bonita-no-escritorio-em-casa-trabalhando-em-casa-conceito-de-teletrabalho_144627-46787.jpg?t=st=1726439545~exp=1726443145~hmac=3b666837e5d1dd0fe61bbc46b623450be09369c3bf8705024be793c32870a558&w=1380','<p>Apresentar aos alunos uma visão geral sobre o que é um computador, como ele</p>',8),(2,'Introdução ao Sistema Operacional','https://img.freepik.com/fotos-gratis/conceito-de-colagem-de-html-e-css-com-pessoa_23-2150062008.jpg?t=st=1726440314~exp=1726443914~hmac=344642fb5264392a676fe3bce2b64ebf99fdd4fdb38755dc820c40afc4985f62&w=1380','<p>Um sistema operacional (SO) é um software fundamental que gerencia o hardware do computador e fornece serviços para os programas de aplicação.</p>',9),(3,'Gerenciamento de Arquivos e Pastas','https://img.freepik.com/fotos-gratis/pasta-de-anel-usada-para-documentos-armazenados_23-2149512192.jpg?t=st=1726440347~exp=1726443947~hmac=1a9020df89cf9b0879f19df45f9df1c47c93a35f06cc0718b7caf4cca38b1e3a&w=1380','<p>Introdução ao módulo sobre gerenciamento de arquivos e pastas</p>',9),(4,'Introdução à Internet','https://img.freepik.com/fotos-gratis/homem-usando-tecnologia-inteligente-de-maquete-psd-de-tablet-digital_53876-110815.jpg?t=st=1726440839~exp=1726444439~hmac=a3a81e762095988c21d3a61bc4414bc3f61af21720d8cf2a1dcadebd7982c592&w=1380','<p>Nesta aula, vamos explorar o mundo da internet</p>',7),(5,'Segurança na Internet para Iniciantes','https://img.freepik.com/fotos-gratis/conceito-de-colagem-de-controle-de-qualidade-padrao_23-2149595831.jpg?t=st=1726441190~exp=1726444790~hmac=29a26137c5349ce085fe8768fdcd3eb341796a63929e63bbdb7314622204d29e&w=1380','<p>Protegendo seus dados e dispositivos.</p>',8);
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perguntas`
--

DROP TABLE IF EXISTS `perguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perguntas` (
  `id_pergunta` int NOT NULL AUTO_INCREMENT,
  `id_quiz` int NOT NULL,
  `pergunta` text NOT NULL,
  PRIMARY KEY (`id_pergunta`),
  KEY `fk_perguntas_quizzes_idx` (`id_quiz`),
  CONSTRAINT `fk_perguntas_quizzes` FOREIGN KEY (`id_quiz`) REFERENCES `quizzes` (`id_quiz`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perguntas`
--

LOCK TABLES `perguntas` WRITE;
/*!40000 ALTER TABLE `perguntas` DISABLE KEYS */;
INSERT INTO `perguntas` VALUES (1,1,'O que é um sistema operacional e qual a sua função principal?\n'),(2,1,'Quais são as principais partes da área de trabalho (desktop) que ajudam na navegação?\n'),(3,1,'Quais são algumas funções comuns do mouse e do teclado que facilitam o uso do computador?\n'),(4,1,'Como você pode personalizar a área de trabalho para melhorar a organização e a estética?\n'),(5,1,'Quais são as principais formas de gerenciar janelas e arquivos no sistema operacional?\n'),(6,2,'Qual é a função principal da CPU em um computador?\n'),(7,2,'Qual componente do computador é utilizado para inserir dados através de letras e\nnúmeros?\n'),(8,2,'Qual é a sequência correta para desligar um computador?\n'),(9,2,'Qual dos seguintes cuidados NÃO é necessário para a manutenção básica de um\ncomputador?'),(10,2,'O que é necessário fazer antes de ligar o computador?\n'),(11,3,'Qual a tecla do teclado para excluir uma pasta ou arquivo?\n'),(12,3,'Como renomear uma pasta ou arquivo?\n'),(13,3,'Qual a combinação de teclas de atalho para abrir o Explorador de Arquivos?\n'),(14,3,'Para criar uma pasta com o título “Exercício” e dentro dela uma subpasta com o título “Exercício 1” e um arquivo de texto com o título “Teste”, qual é o procedimento correto?\n'),(15,3,'Qual é o processo para mover uma pasta para outro local?\n'),(16,4,'O que é a internet?\n'),(17,4,'O que é um navegador?\n'),(18,4,'O que é um URL?\n'),(19,4,'Como realizar uma pesquisa na internet?\n'),(20,4,'Como identificar se um site é seguro?\n'),(21,5,'Qual é a principal razão para usar senhas seguras na internet?\n'),(22,5,'O que você deve fazer se receber um e-mail inesperado que pede para você clicar em um link e fornecer informações pessoais?\n'),(23,5,'Qual das seguintes práticas ajuda a proteger seu computador contra vírus e malware?\n'),(24,5,'Você percebe que um site que está acessando não possui o \"https://\" no início da URL e está solicitando informações pessoais. Qual é o risco e o que você deve fazer?\n'),(25,5,'Qual é a função de um firewall no computador?\n');
/*!40000 ALTER TABLE `perguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quizzes` (
  `id_quiz` int NOT NULL AUTO_INCREMENT,
  `id_curso` int DEFAULT NULL,
  PRIMARY KEY (`id_quiz`),
  KEY `fk_quizzes_cursos_idx` (`id_curso`),
  CONSTRAINT `fk_quizzes_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizzes`
--

LOCK TABLES `quizzes` WRITE;
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
INSERT INTO `quizzes` VALUES (1,1),(2,2),(3,3),(4,4),(5,5);
/*!40000 ALTER TABLE `quizzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respostas`
--

DROP TABLE IF EXISTS `respostas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `respostas` (
  `id_resposta` int NOT NULL AUTO_INCREMENT,
  `id_pergunta` int NOT NULL,
  `resposta` text NOT NULL,
  `correta` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_resposta`),
  KEY `fk_respostas_perguntas_idx` (`id_pergunta`),
  CONSTRAINT `fk_respostas_perguntas` FOREIGN KEY (`id_pergunta`) REFERENCES `perguntas` (`id_pergunta`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respostas`
--

LOCK TABLES `respostas` WRITE;
/*!40000 ALTER TABLE `respostas` DISABLE KEYS */;
INSERT INTO `respostas` VALUES (1,1,'Um software que gerencia exclusivamente a internet.',0),(2,1,'Um software que gerencia o hardware do computador e fornece serviços para os programas de aplicação.\n',1),(3,1,'Um software de segurança que protege o computador contra vírus.\n',0),(4,1,'Um programa que serve apenas para rodar jogos.\n',0),(5,2,'Teclas de função, relógio e gerenciador de tarefas.\n',0),(6,2,'Ícones, barra de tarefas e menus.\n',1),(7,2,'Memória, CPU e disco rígido.\n',0),(8,2,'Caixa de entrada, botão de energia e aplicativos em segundo plano.\n',0),(9,3,'Apenas clicar com o botão direito do mouse.\n',0),(10,3,'Clique simples, clique duplo, teclas de função e atalhos como Ctrl + C (copiar) e Ctrl + V (colar).\n',1),(11,3,'Arrastar e soltar somente no teclado.\n',0),(12,3,'Apertar todas as teclas ao mesmo tempo para maior eficiência.\n',0),(13,4,'Alterando o papel de parede, organizando ícones e modificando as configurações da barra de tarefas.\n',1),(14,4,'Usando apenas um tema padrão sem modificações.\n',0),(15,4,'Removendo todos os ícones e desativando a barra de tarefas.\n',0),(16,4,'Instalando aplicativos extras que não estejam no sistema operacional.',0),(17,5,'Usar o botão de desligar para fechar janelas.\n',0),(18,5,'Apagar todos os arquivos automaticamente.\n',0),(19,5,'Maximizar, minimizar e redimensionar janelas; navegar e criar pastas no explorador de arquivos.',1),(20,5,'Utilizar apenas a tecla Shift para mover janelas.',0),(21,6,'Exibir imagens e vídeos.\n',0),(22,6,'Processar informações e executar instruções.\n',1),(23,6,'Armazenar arquivos e documentos.\n',0),(24,6,'Conectar o computador à internet.\n',0),(25,7,'Monitor\n',0),(26,7,'CPU\n',0),(27,7,'Teclado\n',1),(28,7,'Mouse\n',0),(29,8,'Acessar o menu \'Iniciar\' e selecionar \'Desligar\'.\n',1),(30,8,'Fechar todos os programas e desconectar da energia.\n',0),(31,8,'Pressionar o botão de energia até o computador desligar.\n',0),(32,8,'Desligar o estabilizador e depois o computador.\n',0),(33,9,'Limpar o monitor, teclado e mouse regularmente.\n',0),(34,9,'Desligar o computador corretamente pelo menu \'Iniciar\'.\n',0),(35,9,'Manter o computador sempre ligado para evitar falhas.\n',1),(36,9,'Usar protetores contra surtos elétricos.\n',0),(37,10,' Ligar o monitor primeiro.\n',0),(38,10,'Verificar se todas as conexões estão corretas e ligar o estabilizador ou nobreak.\n',1),(39,10,'Apertar o botão do mouse.\n',0),(40,10,'Desconectar todos os cabos para evitar sobrecarga.',0),(41,11,'Enter\n',0),(42,11,'Delete\n',1),(43,11,'Shift\n',0),(44,11,'Esc\n',0),(45,12,'Clicar duas vezes no nome da pasta ou arquivo\n',0),(46,12,'Clicar com o botão direito e selecionar \"Renomear\"\n',1),(47,12,'Ambas as alternativas anteriores\n',0),(48,12,'Pressionar Ctrl + Alt\n',0),(49,13,'WIN + R\n',0),(50,13,'Ctrl + E\n',0),(51,13,'WIN + E\n',1),(52,13,'Alt + Tab\n',0),(53,14,'Criar a pasta “Exercício”, depois criar a subpasta “Exercício 1” e arrastar um arquivo para dentro dela\n',0),(54,14,'Criar a pasta “Exercício”, criar a subpasta “Exercício 1” e criar um novo arquivo de texto dentro da subpasta\n',1),(55,14,'Criar a subpasta “Exercício 1” diretamente na área de trabalho e renomear o arquivo para \"Teste\"\n',0),(56,14,'Criar todas as pastas e o arquivo diretamente na área de trabalho\n',0),(57,15,'Arrastar e soltar a pasta no novo local desejado\n',0),(58,15,'Clicar com o botão direito e escolher a opção \"Mover para\"\n',0),(59,15,'Recortar a pasta e colar no novo local\r ',0),(60,15,'Todas as alternativas anteriores',1),(61,16,'Um software de edição de texto\n',0),(62,16,'Uma rede global de conexões que permite o compartilhamento de dados\n',1),(63,16,'Um programa para ver vídeos\n',0),(64,16,'Uma máquina que processa informações\n',0),(65,17,'Um dispositivo de entrada de dados\n',0),(66,17,'Um programa usado para acessar a internet e visualizar páginas da web\n',1),(67,17,'Um aplicativo de mensagens instantâneas\n',0),(68,17,'Uma ferramenta de edição de fotos\n',0),(69,18,'Um tipo de vírus de computador\n',0),(70,18,'Um sistema operacional\n',0),(71,18,'O endereço de um recurso na web, como uma página ou arquivo\n',1),(72,18,'Um atalho de teclado para abrir pastas\n',0),(73,19,'Abrir o programa pesquisa do windows e pesquisar',0),(74,19,'Clicar em qualquer link disponível na tela\n',0),(75,19,'Abrir o navegador, digitar o que deseja buscar na barra de pesquisa e pressionar Enter\n',1),(76,19,'Fazer o download de um programa para realizar pesquisas\n',0),(77,20,'Verificando a presença de um cadeado ao lado do URL e o nome da empresa\n',1),(78,20,'Clicando no primeiro link que aparece nos resultados da busca\n',0),(79,20,'Conferindo se o site tem muitas imagens coloridas\n',0),(80,20,'Lendo os comentários na página principal do site',0),(81,21,'Para garantir que você consiga lembrar a senha mais facilmente.',0),(82,21,'Para proteger suas informações pessoais contra acessos não autorizados.',1),(83,21,'Para que a senha se pareça mais elegante.',0),(84,21,'Para que o computador fique mais rápido.',0),(85,22,'Ignorar o e-mail e excluí-lo.',1),(86,22,'Clicar no link para ver o que acontece.',0),(87,22,'Responder ao e-mail fornecendo as informações solicitadas.',0),(88,22,'Ligar para o remetente usando um número de telefone encontrado na mensagem.',0),(89,23,'Manter o antivírus desativado para não consumir recursos do sistema.',0),(90,23,'Usar um gerenciador de senhas para armazenar senhas de forma segura.',0),(91,23,'Atualizar o sistema operacional e o software de antivírus regularmente.',1),(92,23,'Desativar o firewall para permitir conexões mais rápidas.',0),(93,24,'O site é seguro, mas você deve ter cuidado com informações pessoais. Continue preenchendo as informações, mas com cuidado.',0),(94,24,'O site pode não ser seguro. Não forneça informações pessoais e considere sair do site imediatamente.',1),(95,24,'O site é seguro, mas você deve entrar em contato com o suporte para confirmar.',0),(96,24,'A ausência do \"https://\" não é um problema, mas você deve usar uma senha forte para proteger suas informações.',0),(97,25,'Aumentar a velocidade de internet.',0),(98,25,'Proteger contra acessos não autorizados ao seu computador.',1),(99,25,'Desativar programas em segundo plano.',0),(100,25,'Melhorar o desempenho do hardware.',0);
/*!40000 ALTER TABLE `respostas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(80) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cpf` char(11) NOT NULL,
  `nota_quiz_geral` tinyint DEFAULT NULL,
  `gabarito_geral` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'administrador','SkouAn3lDcE7c','Administrador','97928794047',6,'B,B,B,A,B,A,D,D,C,C,');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_quizzes`
--

DROP TABLE IF EXISTS `usuarios_quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios_quizzes` (
  `id_usuario_quiz` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_quiz` int NOT NULL,
  `nota` int NOT NULL,
  `gabarito` varchar(45) NOT NULL,
  PRIMARY KEY (`id_usuario_quiz`),
  KEY `fk_usuarios_quizzes_usuarios_idx` (`id_usuario`),
  KEY `fk_usuarios_quizzes_quizzes_idx` (`id_quiz`),
  CONSTRAINT `fk_usuarios_quizzes_quizzes` FOREIGN KEY (`id_quiz`) REFERENCES `quizzes` (`id_quiz`),
  CONSTRAINT `fk_usuarios_quizzes_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_quizzes`
--

LOCK TABLES `usuarios_quizzes` WRITE;
/*!40000 ALTER TABLE `usuarios_quizzes` DISABLE KEYS */;
INSERT INTO `usuarios_quizzes` VALUES (1,1,1,0,'1,7,11,15,18,');
/*!40000 ALTER TABLE `usuarios_quizzes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-18 21:38:57
