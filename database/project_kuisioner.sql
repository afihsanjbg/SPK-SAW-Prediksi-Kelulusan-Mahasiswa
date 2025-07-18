-- MySQL dump 10.19  Distrib 10.3.39-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: afihsan_kuisioner
-- ------------------------------------------------------
-- Server version	10.3.39-MariaDB-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `datamain`
--

DROP TABLE IF EXISTS `datamain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datamain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `nim` bigint(20) NOT NULL,
  `prodi` varchar(75) NOT NULL,
  `semester` int(11) NOT NULL,
  `ipk_now` float NOT NULL,
  `jumlah_sks` int(11) NOT NULL,
  `kehadiran` int(11) NOT NULL,
  `jumlah_sp` int(11) NOT NULL,
  `aktivitas` varchar(100) NOT NULL,
  `pgrs_ta` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nim` (`nim`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datamain`
--

LOCK TABLES `datamain` WRITE;
/*!40000 ALTER TABLE `datamain` DISABLE KEYS */;
INSERT INTO `datamain` VALUES (1,'A&#039;af Fatihul Ihsan',2302050821,'Sistem Informasi',4,2.72,84,85,0,'Organisasi Eksternal','Belum'),(2,'Muhammad Hafizh Syamsuddin',2302050851,'Sistem Informasi',4,2.8,84,95,0,'Tidak ada','Belum'),(3,'Yusril',2302050829,'Sistem Informasi',4,3.57,84,98,0,'Tidak ada','Belum'),(4,'Puspita Yoga',2302050819,'Sistem Informasi',4,3.6,22,90,0,'Organisasi Internal Kampus','Belum'),(5,'Rahmat noval hidayat',2302050822,'Sistem Informasi',4,3.5,100,90,0,'Tidak ada','Belum'),(6,'Leni',2102050759,'Sistem Informasi',8,3.74,153,92,0,'Organisasi Eksternal','Hampir Selesai'),(7,'Ahmad yusuf sholikin',2302050840,'Sistem Informasi',4,3,100,80,1,'Tidak ada','Belum'),(8,'Rangga Adi Setiawan',2302041186,'Teknik Informatika',4,2.21,88,85,0,'Organisasi Internal Kampus','Belum'),(9,'Nava anna',242361201025,'manajemen',2,3.79,120,90,0,'Tidak ada','Belum'),(10,'Nadira Novika Aulia',242361201006,'manajemen',2,3.86,24,100,0,'Tidak ada','Belum'),(11,'machmud ansori rizqi',242361201024,'manajemen',2,3.8,21,95,0,'Tidak ada','Belum'),(12,'Linda istiqomah',2470233028,'Komunikasi dan penyiaran islam',2,4,40,99,0,'Tidak ada','Belum'),(13,'Aqilla Fadia Haya',242361201003,'Manajemen',2,3.45,20,90,2,'Organisasi Internal Kampus','Belum'),(14,'Nur Aida',2302050841,'Sistem Informasi',4,3.68,84,100,0,'Organisasi Internal Kampus','Belum'),(15,'anugrah yudha jaya pamungkas',2302050837,'Sistem Informasi',4,3.6,19,85,2,'Tidak ada','Belum'),(17,'erik',987897978,'Sistem Informasi',4,3.9,120,99,0,'Organisasi Internal Kampus','Hampir Selesai');
/*!40000 ALTER TABLE `datamain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'afihsan_kuisioner'
--

--
-- Dumping routines for database 'afihsan_kuisioner'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-18 22:35:37
