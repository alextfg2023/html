-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2023 at 07:12 PM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timerlab`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendario_escolar`
--

CREATE TABLE `calendario_escolar` (
  `id` int NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  `dia_semana` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `calendario_escolar`
--

INSERT INTO `calendario_escolar` (`id`, `fecha`, `descripcion`, `tipo`, `dia_semana`) VALUES
(1337, '2022-09-01', 'None', 'Lectivo', 'Jueves'),
(1338, '2022-09-02', 'None', 'Lectivo', 'Viernes'),
(1339, '2022-09-03', 'None', 'No lectivo', 'Sábado'),
(1340, '2022-09-04', 'None', 'No lectivo', 'Domingo'),
(1341, '2022-09-05', 'None', 'Lectivo', 'Lunes'),
(1342, '2022-09-06', 'None', 'Lectivo', 'Martes'),
(1343, '2022-09-07', 'None', 'Lectivo', 'Miércoles'),
(1344, '2022-09-08', 'None', 'Lectivo', 'Jueves'),
(1345, '2022-09-09', 'None', 'Lectivo', 'Viernes'),
(1346, '2022-09-10', 'None', 'No lectivo', 'Sábado'),
(1347, '2022-09-11', 'None', 'No lectivo', 'Domingo'),
(1348, '2022-09-12', 'None', 'Lectivo', 'Lunes'),
(1349, '2022-09-13', 'None', 'Lectivo', 'Martes'),
(1350, '2022-09-14', 'None', 'Lectivo', 'Miércoles'),
(1351, '2022-09-15', 'None', 'Lectivo', 'Jueves'),
(1352, '2022-09-16', 'None', 'Lectivo', 'Viernes'),
(1353, '2022-09-17', 'None', 'No lectivo', 'Sábado'),
(1354, '2022-09-18', 'None', 'No lectivo', 'Domingo'),
(1355, '2022-09-19', 'None', 'Lectivo', 'Lunes'),
(1356, '2022-09-20', 'None', 'Lectivo', 'Martes'),
(1357, '2022-09-21', 'None', 'Lectivo', 'Miércoles'),
(1358, '2022-09-22', 'None', 'Lectivo', 'Jueves'),
(1359, '2022-09-23', 'None', 'Lectivo', 'Viernes'),
(1360, '2022-09-24', 'None', 'No lectivo', 'Sábado'),
(1361, '2022-09-25', 'None', 'No lectivo', 'Domingo'),
(1362, '2022-09-26', 'None', 'Lectivo', 'Lunes'),
(1363, '2022-09-27', 'None', 'Lectivo', 'Martes'),
(1364, '2022-09-28', 'None', 'Lectivo', 'Miércoles'),
(1365, '2022-09-29', 'None', 'Lectivo', 'Jueves'),
(1366, '2022-09-30', 'None', 'Lectivo', 'Viernes'),
(1367, '2022-10-01', 'None', 'No lectivo', 'Sábado'),
(1368, '2022-10-02', 'None', 'No lectivo', 'Domingo'),
(1369, '2022-10-03', 'None', 'Lectivo', 'Lunes'),
(1370, '2022-10-04', 'None', 'Lectivo', 'Martes'),
(1371, '2022-10-05', 'None', 'Lectivo', 'Miércoles'),
(1372, '2022-10-06', 'None', 'Lectivo', 'Jueves'),
(1373, '2022-10-07', 'None', 'Lectivo', 'Viernes'),
(1374, '2022-10-08', 'None', 'No lectivo', 'Sábado'),
(1375, '2022-10-09', 'None', 'No lectivo', 'Domingo'),
(1376, '2022-10-10', 'None', 'Lectivo', 'Lunes'),
(1377, '2022-10-11', 'None', 'Lectivo', 'Martes'),
(1378, '2022-10-12', 'Dia de la hispanidad', 'No lectivo', 'Miércoles'),
(1379, '2022-10-13', 'None', 'Lectivo', 'Jueves'),
(1380, '2022-10-14', 'None', 'Lectivo', 'Viernes'),
(1381, '2022-10-15', 'None', 'No lectivo', 'Sábado'),
(1382, '2022-10-16', 'None', 'No lectivo', 'Domingo'),
(1383, '2022-10-17', 'None', 'Lectivo', 'Lunes'),
(1384, '2022-10-18', 'None', 'Lectivo', 'Martes'),
(1385, '2022-10-19', 'None', 'Lectivo', 'Miércoles'),
(1386, '2022-10-20', 'None', 'Lectivo', 'Jueves'),
(1387, '2022-10-21', 'None', 'Lectivo', 'Viernes'),
(1388, '2022-10-22', 'None', 'No lectivo', 'Sábado'),
(1389, '2022-10-23', 'None', 'No lectivo', 'Domingo'),
(1390, '2022-10-24', 'None', 'Lectivo', 'Lunes'),
(1391, '2022-10-25', 'None', 'Lectivo', 'Martes'),
(1392, '2022-10-26', 'None', 'Lectivo', 'Miércoles'),
(1393, '2022-10-27', 'None', 'Lectivo', 'Jueves'),
(1394, '2022-10-28', 'None', 'Lectivo', 'Viernes'),
(1395, '2022-10-29', 'None', 'No lectivo', 'Sábado'),
(1396, '2022-10-30', 'None', 'No lectivo', 'Domingo'),
(1397, '2022-10-31', 'None', 'Festivo', 'Lunes'),
(1398, '2022-11-01', 'Dia de todos los santos', 'No lectivo', 'Martes'),
(1399, '2022-11-02', 'None', 'Lectivo', 'Miércoles'),
(1400, '2022-11-03', 'None', 'Lectivo', 'Jueves'),
(1401, '2022-11-04', 'None', 'Lectivo', 'Viernes'),
(1402, '2022-11-05', 'None', 'No lectivo', 'Sábado'),
(1403, '2022-11-06', 'None', 'No lectivo', 'Domingo'),
(1404, '2022-11-07', 'None', 'Lectivo', 'Lunes'),
(1405, '2022-11-08', 'None', 'Lectivo', 'Martes'),
(1406, '2022-11-09', 'None', 'Lectivo', 'Miércoles'),
(1407, '2022-11-10', 'None', 'Lectivo', 'Jueves'),
(1408, '2022-11-11', 'None', 'Lectivo', 'Viernes'),
(1409, '2022-11-12', 'None', 'No lectivo', 'Sábado'),
(1410, '2022-11-13', 'None', 'No lectivo', 'Domingo'),
(1411, '2022-11-14', 'None', 'Lectivo', 'Lunes'),
(1412, '2022-11-15', 'None', 'Lectivo', 'Martes'),
(1413, '2022-11-16', 'None', 'Lectivo', 'Miércoles'),
(1414, '2022-11-17', 'None', 'Lectivo', 'Jueves'),
(1415, '2022-11-18', 'None', 'Lectivo', 'Viernes'),
(1416, '2022-11-19', 'None', 'No lectivo', 'Sábado'),
(1417, '2022-11-20', 'None', 'No lectivo', 'Domingo'),
(1418, '2022-11-21', 'None', 'Lectivo', 'Lunes'),
(1419, '2022-11-22', 'None', 'Lectivo', 'Martes'),
(1420, '2022-11-23', 'None', 'Lectivo', 'Miércoles'),
(1421, '2022-11-24', 'None', 'Lectivo', 'Jueves'),
(1422, '2022-11-25', 'None', 'Lectivo', 'Viernes'),
(1423, '2022-11-26', 'None', 'No lectivo', 'Sábado'),
(1424, '2022-11-27', 'None', 'No lectivo', 'Domingo'),
(1425, '2022-11-28', 'None', 'Lectivo', 'Lunes'),
(1426, '2022-11-29', 'None', 'Lectivo', 'Martes'),
(1427, '2022-11-30', 'None', 'Lectivo', 'Miércoles'),
(1428, '2022-12-01', 'None', 'Lectivo', 'Jueves'),
(1429, '2022-12-02', 'None', 'Lectivo', 'Viernes'),
(1430, '2022-12-03', 'None', 'No lectivo', 'Sábado'),
(1431, '2022-12-04', 'None', 'No lectivo', 'Domingo'),
(1432, '2022-12-05', 'None', 'Festivo', 'Lunes'),
(1433, '2022-12-06', 'None', 'No lectivo', 'Martes'),
(1434, '2022-12-07', 'None', 'Festivo', 'Miércoles'),
(1435, '2022-12-08', 'None', 'No lectivo', 'Jueves'),
(1436, '2022-12-09', 'None', 'Lectivo', 'Viernes'),
(1437, '2022-12-10', 'None', 'No lectivo', 'Sábado'),
(1438, '2022-12-11', 'None', 'No lectivo', 'Domingo'),
(1439, '2022-12-12', 'None', 'Lectivo', 'Lunes'),
(1440, '2022-12-13', 'None', 'Lectivo', 'Martes'),
(1441, '2022-12-14', 'None', 'Lectivo', 'Miércoles'),
(1442, '2022-12-15', 'None', 'Lectivo', 'Jueves'),
(1443, '2022-12-16', 'None', 'Lectivo', 'Viernes'),
(1444, '2022-12-17', 'None', 'No lectivo', 'Sábado'),
(1445, '2022-12-18', 'None', 'No lectivo', 'Domingo'),
(1446, '2022-12-19', 'None', 'Lectivo', 'Lunes'),
(1447, '2022-12-20', 'None', 'Lectivo', 'Martes'),
(1448, '2022-12-21', 'None', 'Lectivo', 'Miércoles'),
(1449, '2022-12-22', 'None', 'Lectivo', 'Jueves'),
(1450, '2022-12-23', 'Navidad', 'No lectivo', 'Viernes'),
(1451, '2022-12-24', 'Navidad', 'No lectivo', 'Sábado'),
(1452, '2022-12-25', 'Navidad', 'No lectivo', 'Domingo'),
(1453, '2022-12-26', 'Navidad', 'No lectivo', 'Lunes'),
(1454, '2022-12-27', 'Navidad', 'No lectivo', 'Martes'),
(1455, '2022-12-28', 'Navidad', 'No lectivo', 'Miércoles'),
(1456, '2022-12-29', 'Navidad', 'No lectivo', 'Jueves'),
(1457, '2022-12-30', 'Navidad', 'No lectivo', 'Viernes'),
(1458, '2022-12-31', 'Navidad', 'No lectivo', 'Sábado'),
(1459, '2023-01-01', 'Navidad', 'No lectivo', 'Domingo'),
(1460, '2023-01-02', 'Navidad', 'No lectivo', 'Lunes'),
(1461, '2023-01-03', 'Navidad', 'No lectivo', 'Martes'),
(1462, '2023-01-04', 'Navidad', 'No lectivo', 'Miércoles'),
(1463, '2023-01-05', 'Navidad', 'No lectivo', 'Jueves'),
(1464, '2023-01-06', 'Navidad', 'No lectivo', 'Viernes'),
(1465, '2023-01-07', 'Navidad', 'No lectivo', 'Sábado'),
(1466, '2023-01-08', 'Navidad', 'No lectivo', 'Domingo'),
(1467, '2023-01-09', 'None', 'Lectivo', 'Lunes'),
(1468, '2023-01-10', 'None', 'Lectivo', 'Martes'),
(1469, '2023-01-11', 'None', 'Lectivo', 'Miércoles'),
(1470, '2023-01-12', 'None', 'Lectivo', 'Jueves'),
(1471, '2023-01-13', 'None', 'Lectivo', 'Viernes'),
(1472, '2023-01-14', 'None', 'No lectivo', 'Sábado'),
(1473, '2023-01-15', 'None', 'No lectivo', 'Domingo'),
(1474, '2023-01-16', 'None', 'Lectivo', 'Lunes'),
(1475, '2023-01-17', 'None', 'Lectivo', 'Martes'),
(1476, '2023-01-18', 'None', 'Lectivo', 'Miércoles'),
(1477, '2023-01-19', 'None', 'Lectivo', 'Jueves'),
(1478, '2023-01-20', 'None', 'Lectivo', 'Viernes'),
(1479, '2023-01-21', 'None', 'No lectivo', 'Sábado'),
(1480, '2023-01-22', 'None', 'No lectivo', 'Domingo'),
(1481, '2023-01-23', 'None', 'Lectivo', 'Lunes'),
(1482, '2023-01-24', 'None', 'Lectivo', 'Martes'),
(1483, '2023-01-25', 'None', 'Lectivo', 'Miércoles'),
(1484, '2023-01-26', 'None', 'Lectivo', 'Jueves'),
(1485, '2023-01-27', 'None', 'Lectivo', 'Viernes'),
(1486, '2023-01-28', 'None', 'No lectivo', 'Sábado'),
(1487, '2023-01-29', 'None', 'No lectivo', 'Domingo'),
(1488, '2023-01-30', 'None', 'Lectivo', 'Lunes'),
(1489, '2023-01-31', 'None', 'Lectivo', 'Martes'),
(1490, '2023-02-01', 'None', 'Lectivo', 'Miércoles'),
(1491, '2023-02-02', 'None', 'Lectivo', 'Jueves'),
(1492, '2023-02-03', 'None', 'Lectivo', 'Viernes'),
(1493, '2023-02-04', 'None', 'No lectivo', 'Sábado'),
(1494, '2023-02-05', 'None', 'No lectivo', 'Domingo'),
(1495, '2023-02-06', 'None', 'Lectivo', 'Lunes'),
(1496, '2023-02-07', 'None', 'Lectivo', 'Martes'),
(1497, '2023-02-08', 'None', 'Lectivo', 'Miércoles'),
(1498, '2023-02-09', 'None', 'Lectivo', 'Jueves'),
(1499, '2023-02-10', 'None', 'Lectivo', 'Viernes'),
(1500, '2023-02-11', 'None', 'No lectivo', 'Sábado'),
(1501, '2023-02-12', 'None', 'No lectivo', 'Domingo'),
(1502, '2023-02-13', 'None', 'Lectivo', 'Lunes'),
(1503, '2023-02-14', 'None', 'Lectivo', 'Martes'),
(1504, '2023-02-15', 'None', 'Lectivo', 'Miércoles'),
(1505, '2023-02-16', 'None', 'Lectivo', 'Jueves'),
(1506, '2023-02-17', 'None', 'Lectivo', 'Viernes'),
(1507, '2023-02-18', 'None', 'No lectivo', 'Sábado'),
(1508, '2023-02-19', 'None', 'No lectivo', 'Domingo'),
(1509, '2023-02-20', 'None', 'Lectivo', 'Lunes'),
(1510, '2023-02-21', 'None', 'Lectivo', 'Martes'),
(1511, '2023-02-22', 'None', 'Lectivo', 'Miércoles'),
(1512, '2023-02-23', 'None', 'Lectivo', 'Jueves'),
(1513, '2023-02-24', 'None', 'Festivo', 'Viernes'),
(1514, '2023-02-25', 'None', 'No lectivo', 'Sábado'),
(1515, '2023-02-26', 'None', 'No lectivo', 'Domingo'),
(1516, '2023-02-27', 'None', 'Festivo', 'Lunes'),
(1517, '2023-02-28', 'None', 'Lectivo', 'Martes'),
(1518, '2023-03-01', 'None', 'Lectivo', 'Miércoles'),
(1519, '2023-03-02', 'None', 'Lectivo', 'Jueves'),
(1520, '2023-03-03', 'None', 'Lectivo', 'Viernes'),
(1521, '2023-03-04', 'None', 'No lectivo', 'Sábado'),
(1522, '2023-03-05', 'None', 'No lectivo', 'Domingo'),
(1523, '2023-03-06', 'None', 'Lectivo', 'Lunes'),
(1524, '2023-03-07', 'None', 'Lectivo', 'Martes'),
(1525, '2023-03-08', 'None', 'Lectivo', 'Miércoles'),
(1526, '2023-03-09', 'None', 'Lectivo', 'Jueves'),
(1527, '2023-03-10', 'None', 'Lectivo', 'Viernes'),
(1528, '2023-03-11', 'None', 'No lectivo', 'Sábado'),
(1529, '2023-03-12', 'None', 'No lectivo', 'Domingo'),
(1530, '2023-03-13', 'None', 'Lectivo', 'Lunes'),
(1531, '2023-03-14', 'None', 'Lectivo', 'Martes'),
(1532, '2023-03-15', 'None', 'Lectivo', 'Miércoles'),
(1533, '2023-03-16', 'None', 'Lectivo', 'Jueves'),
(1534, '2023-03-17', 'None', 'Lectivo', 'Viernes'),
(1535, '2023-03-18', 'None', 'No lectivo', 'Sábado'),
(1536, '2023-03-19', 'None', 'No lectivo', 'Domingo'),
(1537, '2023-03-20', 'None', 'No lectivo', 'Lunes'),
(1538, '2023-03-21', 'None', 'Lectivo', 'Martes'),
(1539, '2023-03-22', 'None', 'Lectivo', 'Miércoles'),
(1540, '2023-03-23', 'None', 'Lectivo', 'Jueves'),
(1541, '2023-03-24', 'None', 'Lectivo', 'Viernes'),
(1542, '2023-03-25', 'None', 'No lectivo', 'Sábado'),
(1543, '2023-03-26', 'None', 'No lectivo', 'Domingo'),
(1544, '2023-03-27', 'None', 'Lectivo', 'Lunes'),
(1545, '2023-03-28', 'None', 'Lectivo', 'Martes'),
(1546, '2023-03-29', 'None', 'Lectivo', 'Miércoles'),
(1547, '2023-03-30', 'None', 'Lectivo', 'Jueves'),
(1548, '2023-03-31', 'Semana Santa', 'Festivo', 'Viernes'),
(1549, '2023-04-01', 'Semana Santa', 'No lectivo', 'Sábado'),
(1550, '2023-04-02', 'Semana Santa', 'No lectivo', 'Domingo'),
(1551, '2023-04-03', 'Semana Santa', 'No lectivo', 'Lunes'),
(1552, '2023-04-04', 'Semana Santa', 'No lectivo', 'Martes'),
(1553, '2023-04-05', 'Semana Santa', 'No lectivo', 'Miércoles'),
(1554, '2023-04-06', 'Semana Santa', 'No lectivo', 'Jueves'),
(1555, '2023-04-07', 'Semana Santa', 'No lectivo', 'Viernes'),
(1556, '2023-04-08', 'Semana Santa', 'No lectivo', 'Sábado'),
(1557, '2023-04-09', 'Semana Santa', 'No lectivo', 'Domingo'),
(1558, '2023-04-10', 'Semana Santa', 'Festivo', 'Lunes'),
(1559, '2023-04-11', 'None', 'Lectivo', 'Martes'),
(1560, '2023-04-12', 'None', 'Lectivo', 'Miércoles'),
(1561, '2023-04-13', 'None', 'Lectivo', 'Jueves'),
(1562, '2023-04-14', 'None', 'Lectivo', 'Viernes'),
(1563, '2023-04-15', 'None', 'No lectivo', 'Sábado'),
(1564, '2023-04-16', 'None', 'No lectivo', 'Domingo'),
(1565, '2023-04-17', 'None', 'Lectivo', 'Lunes'),
(1566, '2023-04-18', 'None', 'Lectivo', 'Martes'),
(1567, '2023-04-19', 'None', 'Lectivo', 'Miércoles'),
(1568, '2023-04-20', 'None', 'Lectivo', 'Jueves'),
(1569, '2023-04-21', 'None', 'Lectivo', 'Viernes'),
(1570, '2023-04-22', 'None', 'No lectivo', 'Sábado'),
(1571, '2023-04-23', 'None', 'No lectivo', 'Domingo'),
(1572, '2023-04-24', 'None', 'Lectivo', 'Lunes'),
(1573, '2023-04-25', 'None', 'Lectivo', 'Martes'),
(1574, '2023-04-26', 'None', 'Lectivo', 'Miércoles'),
(1575, '2023-04-27', 'None', 'Lectivo', 'Jueves'),
(1576, '2023-04-28', 'None', 'Lectivo', 'Viernes'),
(1577, '2023-04-29', 'None', 'No lectivo', 'Sábado'),
(1578, '2023-04-30', 'None', 'No lectivo', 'Domingo'),
(1579, '2023-05-01', 'None', 'No lectivo', 'Lunes'),
(1580, '2023-05-02', 'None', 'No lectivo', 'Martes'),
(1581, '2023-05-03', 'None', 'Lectivo', 'Miércoles'),
(1582, '2023-05-04', 'None', 'Lectivo', 'Jueves'),
(1583, '2023-05-05', 'None', 'Lectivo', 'Viernes'),
(1584, '2023-05-06', 'None', 'No lectivo', 'Sábado'),
(1585, '2023-05-07', 'None', 'No lectivo', 'Domingo'),
(1586, '2023-05-08', 'None', 'Lectivo', 'Lunes'),
(1587, '2023-05-09', 'None', 'Lectivo', 'Martes'),
(1588, '2023-05-10', 'None', 'Lectivo', 'Miércoles'),
(1589, '2023-05-11', 'None', 'Lectivo', 'Jueves'),
(1590, '2023-05-12', 'None', 'Lectivo', 'Viernes'),
(1591, '2023-05-13', 'None', 'No lectivo', 'Sábado'),
(1592, '2023-05-14', 'None', 'No lectivo', 'Domingo'),
(1593, '2023-05-15', 'None', 'No lectivo', 'Lunes'),
(1594, '2023-05-16', 'None', 'Lectivo', 'Martes'),
(1595, '2023-05-17', 'None', 'Lectivo', 'Miércoles'),
(1596, '2023-05-18', 'None', 'Lectivo', 'Jueves'),
(1597, '2023-05-19', 'None', 'Lectivo', 'Viernes'),
(1598, '2023-05-20', 'None', 'No lectivo', 'Sábado'),
(1599, '2023-05-21', 'None', 'No lectivo', 'Domingo'),
(1600, '2023-05-22', 'None', 'Lectivo', 'Lunes'),
(1601, '2023-05-23', 'None', 'Lectivo', 'Martes'),
(1602, '2023-05-24', 'None', 'Lectivo', 'Miércoles'),
(1603, '2023-05-25', 'None', 'Lectivo', 'Jueves'),
(1604, '2023-05-26', 'None', 'Lectivo', 'Viernes'),
(1605, '2023-05-27', 'None', 'No lectivo', 'Sábado'),
(1606, '2023-05-28', 'None', 'No lectivo', 'Domingo'),
(1607, '2023-05-29', 'None', 'Lectivo', 'Lunes'),
(1608, '2023-05-30', 'None', 'Lectivo', 'Martes'),
(1609, '2023-05-31', 'None', 'Lectivo', 'Miércoles'),
(1610, '2023-06-01', 'None', 'Lectivo', 'Jueves'),
(1611, '2023-06-02', 'None', 'Lectivo', 'Viernes'),
(1612, '2023-06-03', 'None', 'No lectivo', 'Sábado'),
(1613, '2023-06-04', 'None', 'No lectivo', 'Domingo'),
(1614, '2023-06-05', 'None', 'Lectivo', 'Lunes'),
(1615, '2023-06-06', 'None', 'Lectivo', 'Martes'),
(1616, '2023-06-07', 'None', 'Lectivo', 'Miércoles'),
(1617, '2023-06-08', 'None', 'Lectivo', 'Jueves'),
(1618, '2023-06-09', 'None', 'Lectivo', 'Viernes'),
(1619, '2023-06-10', 'None', 'No lectivo', 'Sábado'),
(1620, '2023-06-11', 'None', 'No lectivo', 'Domingo'),
(1621, '2023-06-12', 'None', 'Lectivo', 'Lunes'),
(1622, '2023-06-13', 'None', 'Lectivo', 'Martes'),
(1623, '2023-06-14', 'None', 'Lectivo', 'Miércoles'),
(1624, '2023-06-15', 'None', 'Lectivo', 'Jueves'),
(1625, '2023-06-16', 'None', 'Lectivo', 'Viernes'),
(1626, '2023-06-17', 'None', 'No lectivo', 'Sábado'),
(1627, '2023-06-18', 'None', 'No lectivo', 'Domingo'),
(1628, '2023-06-19', 'None', 'Lectivo', 'Lunes'),
(1629, '2023-06-20', 'None', 'Lectivo', 'Martes'),
(1630, '2023-06-21', 'None', 'Lectivo', 'Miércoles'),
(1631, '2023-06-22', 'None', 'Lectivo', 'Jueves'),
(1632, '2023-06-23', 'None', 'Lectivo', 'Viernes'),
(1633, '2023-06-24', 'None', 'No lectivo', 'Sábado'),
(1634, '2023-06-25', 'None', 'No lectivo', 'Domingo'),
(1635, '2023-06-26', 'None', 'Lectivo', 'Lunes'),
(1636, '2023-06-27', 'None', 'Lectivo', 'Martes'),
(1637, '2023-06-28', 'None', 'Lectivo', 'Miércoles'),
(1638, '2023-06-29', 'None', 'Lectivo', 'Jueves'),
(1639, '2023-06-30', 'None', 'Lectivo', 'Viernes'),
(1640, '2023-07-01', 'None', 'No lectivo', 'Sábado'),
(1641, '2023-07-02', 'None', 'No lectivo', 'Domingo'),
(1642, '2023-07-03', 'None', 'Lectivo', 'Lunes'),
(1643, '2023-07-04', 'None', 'Lectivo', 'Martes'),
(1644, '2023-07-05', 'None', 'Lectivo', 'Miércoles'),
(1645, '2023-07-06', 'None', 'Lectivo', 'Jueves'),
(1646, '2023-07-07', 'None', 'Lectivo', 'Viernes'),
(1647, '2023-07-08', 'None', 'No lectivo', 'Sábado'),
(1648, '2023-07-09', 'None', 'No lectivo', 'Domingo'),
(1649, '2023-07-10', 'None', 'Lectivo', 'Lunes'),
(1650, '2023-07-11', 'None', 'Lectivo', 'Martes'),
(1651, '2023-07-12', 'None', 'Lectivo', 'Miércoles'),
(1652, '2023-07-13', 'None', 'Lectivo', 'Jueves'),
(1653, '2023-07-14', 'None', 'Lectivo', 'Viernes'),
(1654, '2023-07-15', 'None', 'No lectivo', 'Sábado'),
(1655, '2023-07-16', 'None', 'No lectivo', 'Domingo'),
(1656, '2023-07-17', 'None', 'Lectivo', 'Lunes'),
(1657, '2023-07-18', 'None', 'Lectivo', 'Martes'),
(1658, '2023-07-19', 'None', 'Lectivo', 'Miércoles'),
(1659, '2023-07-20', 'None', 'Lectivo', 'Jueves'),
(1660, '2023-07-21', 'None', 'Lectivo', 'Viernes'),
(1661, '2023-07-22', 'None', 'No lectivo', 'Sábado'),
(1662, '2023-07-23', 'None', 'No lectivo', 'Domingo'),
(1663, '2023-07-24', 'None', 'Lectivo', 'Lunes'),
(1664, '2023-07-25', 'None', 'Lectivo', 'Martes'),
(1665, '2023-07-26', 'None', 'Lectivo', 'Miércoles'),
(1666, '2023-07-27', 'None', 'Lectivo', 'Jueves'),
(1667, '2023-07-28', 'None', 'Lectivo', 'Viernes'),
(1668, '2023-07-29', 'None', 'No lectivo', 'Sábado'),
(1669, '2023-07-30', 'None', 'No lectivo', 'Domingo'),
(1670, '2023-07-31', 'None', 'Lectivo', 'Lunes');

-- --------------------------------------------------------

--
-- Table structure for table `calendario_laboral`
--

CREATE TABLE `calendario_laboral` (
  `id` int NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  `dia_semana` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `calendario_laboral`
--

INSERT INTO `calendario_laboral` (`id`, `fecha`, `descripcion`, `tipo`, `dia_semana`) VALUES
(4381, '2023-01-01', 'None', 'No laborable', 'Domingo'),
(4382, '2023-01-02', 'None', 'Laborable', 'Lunes'),
(4383, '2023-01-03', 'None', 'Laborable', 'Martes'),
(4384, '2023-01-04', 'None', 'Laborable', 'Miércoles'),
(4385, '2023-01-05', 'None', 'Laborable', 'Jueves'),
(4386, '2023-01-06', 'Epifanía del Señor', 'Festivo', 'Viernes'),
(4387, '2023-01-07', 'None', 'Laborable', 'Sábado'),
(4388, '2023-01-08', 'None', 'No laborable', 'Domingo'),
(4389, '2023-01-09', 'None', 'Laborable', 'Lunes'),
(4390, '2023-01-10', 'None', 'Laborable', 'Martes'),
(4391, '2023-01-11', 'None', 'Laborable', 'miercoles'),
(4392, '2023-01-12', 'None', 'Laborable', 'Jueves'),
(4393, '2023-01-13', 'None', 'Laborable', 'Viernes'),
(4394, '2023-01-14', 'None', 'Laborable', 'Sábado'),
(4395, '2023-01-15', 'None', 'No laborable', 'Domingo'),
(4396, '2023-01-16', 'None', 'Laborable', 'Lunes'),
(4397, '2023-01-17', 'None', 'Laborable', 'Martes'),
(4398, '2023-01-18', 'None', 'Laborable', 'miercoles'),
(4399, '2023-01-19', 'None', 'Laborable', 'Jueves'),
(4400, '2023-01-20', 'None', 'Laborable', 'Viernes'),
(4401, '2023-01-21', 'None', 'Laborable', 'Sábado'),
(4402, '2023-01-22', 'None', 'No laborable', 'Domingo'),
(4403, '2023-01-23', 'None', 'Laborable', 'Lunes'),
(4404, '2023-01-24', 'None', 'Laborable', 'Martes'),
(4405, '2023-01-25', 'None', 'Laborable', 'miercoles'),
(4406, '2023-01-26', 'None', 'Laborable', 'Jueves'),
(4407, '2023-01-27', 'None', 'Laborable', 'Viernes'),
(4408, '2023-01-28', 'None', 'Laborable', 'Sábado'),
(4409, '2023-01-29', 'None', 'No laborable', 'Domingo'),
(4410, '2023-01-30', 'None', 'Laborable', 'Lunes'),
(4411, '2023-01-31', 'None', 'Laborable', 'Martes'),
(4412, '2023-02-01', 'None', 'Laborable', 'Miércoles'),
(4413, '2023-02-02', 'None', 'Laborable', 'Jueves'),
(4414, '2023-02-03', 'None', 'Laborable', 'Viernes'),
(4415, '2023-02-04', 'None', 'Laborable', 'Sábado'),
(4416, '2023-02-05', 'None', 'No laborable', 'Domingo'),
(4417, '2023-02-06', 'None', 'Laborable', 'Lunes'),
(4418, '2023-02-07', 'None', 'Laborable', 'Martes'),
(4419, '2023-02-08', 'None', 'Laborable', 'Miércoles'),
(4420, '2023-02-09', 'None', 'Laborable', 'Jueves'),
(4421, '2023-02-10', 'None', 'Laborable', 'Viernes'),
(4422, '2023-02-11', 'None', 'Laborable', 'Sábado'),
(4423, '2023-02-12', 'None', 'No laborable', 'Domingo'),
(4424, '2023-02-13', 'None', 'Laborable', 'Lunes'),
(4425, '2023-02-14', 'None', 'Laborable', 'Martes'),
(4426, '2023-02-15', 'None', 'Laborable', 'Miércoles'),
(4427, '2023-02-16', 'None', 'Laborable', 'Jueves'),
(4428, '2023-02-17', 'None', 'Laborable', 'Viernes'),
(4429, '2023-02-18', 'None', 'Laborable', 'Sábado'),
(4430, '2023-02-19', 'None', 'No laborable', 'Domingo'),
(4431, '2023-02-20', 'None', 'Laborable', 'Lunes'),
(4432, '2023-02-21', 'None', 'Laborable', 'Martes'),
(4433, '2023-02-22', 'None', 'Laborable', 'Miércoles'),
(4434, '2023-02-23', 'None', 'Laborable', 'Jueves'),
(4435, '2023-02-24', 'None', 'Laborable', 'Viernes'),
(4436, '2023-02-25', 'None', 'Laborable', 'Sábado'),
(4437, '2023-02-26', 'None', 'No laborable', 'Domingo'),
(4438, '2023-02-27', 'None', 'Laborable', 'Lunes'),
(4439, '2023-02-28', 'None', 'Laborable', 'Martes'),
(4440, '2023-03-01', 'None', 'Laborable', 'Miércoles'),
(4441, '2023-03-02', 'None', 'Laborable', 'Jueves'),
(4442, '2023-03-03', 'None', 'Laborable', 'Viernes'),
(4443, '2023-03-04', 'None', 'Laborable', 'Sábado'),
(4444, '2023-03-05', 'None', 'No laborable', 'Domingo'),
(4445, '2023-03-06', 'None', 'Laborable', 'Lunes'),
(4446, '2023-03-07', 'None', 'Laborable', 'Martes'),
(4447, '2023-03-08', 'None', 'Laborable', 'Miércoles'),
(4448, '2023-03-09', 'None', 'Laborable', 'Jueves'),
(4449, '2023-03-10', 'None', 'Laborable', 'Viernes'),
(4450, '2023-03-11', 'None', 'Laborable', 'Sábado'),
(4451, '2023-03-12', 'None', 'No laborable', 'Domingo'),
(4452, '2023-03-13', 'None', 'Laborable', 'Lunes'),
(4453, '2023-03-14', 'None', 'Laborable', 'Martes'),
(4454, '2023-03-15', 'None', 'Laborable', 'Miércoles'),
(4455, '2023-03-16', 'None', 'Laborable', 'Jueves'),
(4456, '2023-03-17', 'None', 'Laborable', 'Viernes'),
(4457, '2023-03-18', 'None', 'Laborable', 'Sábado'),
(4458, '2023-03-19', 'None', 'No laborable', 'Domingo'),
(4459, '2023-03-20', 'traslado de la festividad de San José', 'Festivo', 'Lunes'),
(4460, '2023-03-21', 'None', 'Laborable', 'Martes'),
(4461, '2023-03-22', 'None', 'Laborable', 'Miércoles'),
(4462, '2023-03-23', 'None', 'Laborable', 'Jueves'),
(4463, '2023-03-24', 'None', 'Laborable', 'Viernes'),
(4464, '2023-03-25', 'None', 'Laborable', 'Sábado'),
(4465, '2023-03-26', 'None', 'No laborable', 'Domingo'),
(4466, '2023-03-27', 'None', 'Laborable', 'Lunes'),
(4467, '2023-03-28', 'None', 'Laborable', 'Martes'),
(4468, '2023-03-29', 'None', 'Laborable', 'Miércoles'),
(4469, '2023-03-30', 'None', 'Laborable', 'Jueves'),
(4470, '2023-03-31', 'None', 'Laborable', 'Viernes'),
(4471, '2023-04-01', 'None', 'Laborable', 'Sábado'),
(4472, '2023-04-02', 'None', 'No laborable', 'Domingo'),
(4473, '2023-04-03', 'None', 'Laborable', 'Lunes'),
(4474, '2023-04-04', 'None', 'Laborable', 'Martes'),
(4475, '2023-04-05', 'None', 'Laborable', 'Miércoles'),
(4476, '2023-04-06', 'Jueves Santo', 'Festivo', 'Jueves'),
(4477, '2023-04-07', 'Viernes Santo', 'Festivo', 'Viernes'),
(4478, '2023-04-08', 'None', 'Laborable', 'Sábado'),
(4479, '2023-04-09', 'None', 'No laborable', 'Domingo'),
(4480, '2023-04-10', 'None', 'Laborable', 'Lunes'),
(4481, '2023-04-11', 'None', 'Laborable', 'Martes'),
(4482, '2023-04-12', 'None', 'Laborable', 'Miércoles'),
(4483, '2023-04-13', 'None', 'Laborable', 'Jueves'),
(4484, '2023-04-14', 'None', 'Laborable', 'Viernes'),
(4485, '2023-04-15', 'None', 'Laborable', 'Sábado'),
(4486, '2023-04-16', 'None', 'No laborable', 'Domingo'),
(4487, '2023-04-17', 'None', 'Laborable', 'Lunes'),
(4488, '2023-04-18', 'None', 'Laborable', 'Martes'),
(4489, '2023-04-19', 'None', 'Laborable', 'Miércoles'),
(4490, '2023-04-20', 'None', 'Laborable', 'Jueves'),
(4491, '2023-04-21', 'None', 'Laborable', 'Viernes'),
(4492, '2023-04-22', 'None', 'Laborable', 'Sábado'),
(4493, '2023-04-23', 'None', 'No laborable', 'Domingo'),
(4494, '2023-04-24', 'None', 'Laborable', 'Lunes'),
(4495, '2023-04-25', 'None', 'Laborable', 'Martes'),
(4496, '2023-04-26', 'None', 'Laborable', 'Miércoles'),
(4497, '2023-04-27', 'None', 'Laborable', 'Jueves'),
(4498, '2023-04-28', 'None', 'Laborable', 'Viernes'),
(4499, '2023-04-29', 'None', 'Laborable', 'Sábado'),
(4500, '2023-04-30', 'None', 'No laborable', 'Domingo'),
(4501, '2023-05-01', 'Fiesta del Trabajo', 'Festivo', 'Lunes'),
(4502, '2023-05-02', 'Fiesta de la Comunidad de Madrid', 'Laborable', 'Martes'),
(4503, '2023-05-03', 'None', 'Laborable', 'Miércoles'),
(4504, '2023-05-04', 'None', 'Laborable', 'Jueves'),
(4505, '2023-05-05', 'None', 'Laborable', 'Viernes'),
(4506, '2023-05-06', 'None', 'Laborable', 'Sábado'),
(4507, '2023-05-07', 'None', 'No laborable', 'Domingo'),
(4508, '2023-05-08', 'None', 'Laborable', 'Lunes'),
(4509, '2023-05-09', 'None', 'Laborable', 'Martes'),
(4510, '2023-05-10', 'None', 'Laborable', 'Miércoles'),
(4511, '2023-05-11', 'None', 'Laborable', 'Jueves'),
(4512, '2023-05-12', 'None', 'Laborable', 'Viernes'),
(4513, '2023-05-13', 'None', 'Laborable', 'Sábado'),
(4514, '2023-05-14', 'None', 'No laborable', 'Domingo'),
(4515, '2023-05-15', 'San Isidro Labrador', 'Festivo', 'Lunes'),
(4516, '2023-05-16', 'None', 'Laborable', 'Martes'),
(4517, '2023-05-17', 'None', 'Laborable', 'Miércoles'),
(4518, '2023-05-18', 'None', 'Laborable', 'Jueves'),
(4519, '2023-05-19', 'None', 'Laborable', 'Viernes'),
(4520, '2023-05-20', 'None', 'Laborable', 'Sábado'),
(4521, '2023-05-21', 'None', 'No laborable', 'Domingo'),
(4522, '2023-05-22', 'None', 'Laborable', 'Lunes'),
(4523, '2023-05-23', 'None', 'Laborable', 'Martes'),
(4524, '2023-05-24', 'None', 'Laborable', 'Miércoles'),
(4525, '2023-05-25', 'None', 'Laborable', 'Jueves'),
(4526, '2023-05-26', 'None', 'Laborable', 'Viernes'),
(4527, '2023-05-27', 'None', 'Laborable', 'Sábado'),
(4528, '2023-05-28', 'None', 'No laborable', 'Domingo'),
(4529, '2023-05-29', 'None', 'Laborable', 'Lunes'),
(4530, '2023-05-30', 'None', 'Laborable', 'Martes'),
(4531, '2023-05-31', 'None', 'Laborable', 'Miércoles'),
(4532, '2023-06-01', 'None', 'Laborable', 'Jueves'),
(4533, '2023-06-02', 'None', 'Laborable', 'Viernes'),
(4534, '2023-06-03', 'None', 'Laborable', 'Sábado'),
(4535, '2023-06-04', 'None', 'No laborable', 'Domingo'),
(4536, '2023-06-05', 'None', 'Laborable', 'Lunes'),
(4537, '2023-06-06', 'None', 'Laborable', 'Martes'),
(4538, '2023-06-07', 'None', 'Laborable', 'Miércoles'),
(4539, '2023-06-08', 'None', 'Laborable', 'Jueves'),
(4540, '2023-06-09', 'None', 'Laborable', 'Viernes'),
(4541, '2023-06-10', 'None', 'Laborable', 'Sábado'),
(4542, '2023-06-11', 'None', 'No laborable', 'Domingo'),
(4543, '2023-06-12', 'None', 'Laborable', 'Lunes'),
(4544, '2023-06-13', 'None', 'Laborable', 'Martes'),
(4545, '2023-06-14', 'None', 'Laborable', 'Miércoles'),
(4546, '2023-06-15', 'None', 'Laborable', 'Jueves'),
(4547, '2023-06-16', 'None', 'Laborable', 'Viernes'),
(4548, '2023-06-17', 'None', 'Laborable', 'Sábado'),
(4549, '2023-06-18', 'None', 'No laborable', 'Domingo'),
(4550, '2023-06-19', 'None', 'Laborable', 'Lunes'),
(4551, '2023-06-20', 'None', 'Laborable', 'Martes'),
(4552, '2023-06-21', 'None', 'Laborable', 'Miércoles'),
(4553, '2023-06-22', 'None', 'Laborable', 'Jueves'),
(4554, '2023-06-23', 'None', 'Laborable', 'Viernes'),
(4555, '2023-06-24', 'None', 'Laborable', 'Sábado'),
(4556, '2023-06-25', 'None', 'No laborable', 'Domingo'),
(4557, '2023-06-26', 'None', 'Laborable', 'Lunes'),
(4558, '2023-06-27', 'None', 'Laborable', 'Martes'),
(4559, '2023-06-28', 'None', 'Laborable', 'Miércoles'),
(4560, '2023-06-29', 'None', 'Laborable', 'Jueves'),
(4561, '2023-06-30', 'None', 'Laborable', 'Viernes'),
(4562, '2023-07-01', 'None', 'Laborable', 'Sábado'),
(4563, '2023-07-02', 'None', 'No laborable', 'Domingo'),
(4564, '2023-07-03', 'None', 'Laborable', 'Lunes'),
(4565, '2023-07-04', 'None', 'Laborable', 'Martes'),
(4566, '2023-07-05', 'None', 'Laborable', 'Miércoles'),
(4567, '2023-07-06', 'None', 'Laborable', 'Jueves'),
(4568, '2023-07-07', 'None', 'Laborable', 'Viernes'),
(4569, '2023-07-08', 'None', 'Laborable', 'Sábado'),
(4570, '2023-07-09', 'None', 'No laborable', 'Domingo'),
(4571, '2023-07-10', 'None', 'Laborable', 'Lunes'),
(4572, '2023-07-11', 'None', 'Laborable', 'Martes'),
(4573, '2023-07-12', 'None', 'Laborable', 'Miércoles'),
(4574, '2023-07-13', 'None', 'Laborable', 'Jueves'),
(4575, '2023-07-14', 'None', 'Laborable', 'Viernes'),
(4576, '2023-07-15', 'None', 'Laborable', 'Sábado'),
(4577, '2023-07-16', 'None', 'No laborable', 'Domingo'),
(4578, '2023-07-17', 'None', 'Laborable', 'Lunes'),
(4579, '2023-07-18', 'None', 'Laborable', 'Martes'),
(4580, '2023-07-19', 'None', 'Laborable', 'Miércoles'),
(4581, '2023-07-20', 'None', 'Laborable', 'Jueves'),
(4582, '2023-07-21', 'None', 'Laborable', 'Viernes'),
(4583, '2023-07-22', 'None', 'Laborable', 'Sábado'),
(4584, '2023-07-23', 'None', 'No laborable', 'Domingo'),
(4585, '2023-07-24', 'None', 'Laborable', 'Lunes'),
(4586, '2023-07-25', 'None', 'Laborable', 'Martes'),
(4587, '2023-07-26', 'None', 'Laborable', 'Miércoles'),
(4588, '2023-07-27', 'None', 'Laborable', 'Jueves'),
(4589, '2023-07-28', 'None', 'Laborable', 'Viernes'),
(4590, '2023-07-29', 'None', 'Laborable', 'Sábado'),
(4591, '2023-07-30', 'None', 'No laborable', 'Domingo'),
(4592, '2023-07-31', 'None', 'Laborable', 'Lunes'),
(4593, '2023-08-01', 'None', 'Laborable', 'Martes'),
(4594, '2023-08-02', 'None', 'Laborable', 'Miércoles'),
(4595, '2023-08-03', 'None', 'Laborable', 'Jueves'),
(4596, '2023-08-04', 'None', 'Laborable', 'Viernes'),
(4597, '2023-08-05', 'None', 'Laborable', 'Sábado'),
(4598, '2023-08-06', 'None', 'No laborable', 'Domingo'),
(4599, '2023-08-07', 'None', 'Laborable', 'Lunes'),
(4600, '2023-08-08', 'None', 'Laborable', 'Martes'),
(4601, '2023-08-09', 'None', 'Laborable', 'Miércoles'),
(4602, '2023-08-10', 'None', 'Laborable', 'Jueves'),
(4603, '2023-08-11', 'None', 'Laborable', 'Viernes'),
(4604, '2023-08-12', 'None', 'Laborable', 'Sábado'),
(4605, '2023-08-13', 'None', 'No laborable', 'Domingo'),
(4606, '2023-08-14', 'None', 'Laborable', 'Lunes'),
(4607, '2023-08-15', 'Asunción de la Virgen', 'Festivo', 'Martes'),
(4608, '2023-08-16', 'None', 'Laborable', 'Miércoles'),
(4609, '2023-08-17', 'None', 'Laborable', 'Jueves'),
(4610, '2023-08-18', 'None', 'Laborable', 'Viernes'),
(4611, '2023-08-19', 'None', 'Laborable', 'Sábado'),
(4612, '2023-08-20', 'None', 'No laborable', 'Domingo'),
(4613, '2023-08-21', 'None', 'Laborable', 'Lunes'),
(4614, '2023-08-22', 'None', 'Laborable', 'Martes'),
(4615, '2023-08-23', 'None', 'Laborable', 'Miércoles'),
(4616, '2023-08-24', 'None', 'Laborable', 'Jueves'),
(4617, '2023-08-25', 'None', 'Laborable', 'Viernes'),
(4618, '2023-08-26', 'None', 'Laborable', 'Sábado'),
(4619, '2023-08-27', 'None', 'No laborable', 'Domingo'),
(4620, '2023-08-28', 'None', 'Laborable', 'Lunes'),
(4621, '2023-08-29', 'None', 'Laborable', 'Martes'),
(4622, '2023-08-30', 'None', 'Laborable', 'Miércoles'),
(4623, '2023-08-31', 'None', 'Laborable', 'Jueves'),
(4624, '2023-09-01', 'None', 'Laborable', 'Viernes'),
(4625, '2023-09-02', 'None', 'Laborable', 'Sábado'),
(4626, '2023-09-03', 'None', 'No laborable', 'Domingo'),
(4627, '2023-09-04', 'None', 'Laborable', 'Lunes'),
(4628, '2023-09-05', 'None', 'Laborable', 'Martes'),
(4629, '2023-09-06', 'None', 'Laborable', 'Miércoles'),
(4630, '2023-09-07', 'None', 'Laborable', 'Jueves'),
(4631, '2023-09-08', 'None', 'Laborable', 'Viernes'),
(4632, '2023-09-09', 'None', 'Laborable', 'Sábado'),
(4633, '2023-09-10', 'None', 'No laborable', 'Domingo'),
(4634, '2023-09-11', 'None', 'Laborable', 'Lunes'),
(4635, '2023-09-12', 'None', 'Laborable', 'Martes'),
(4636, '2023-09-13', 'None', 'Laborable', 'Miércoles'),
(4637, '2023-09-14', 'None', 'Laborable', 'Jueves'),
(4638, '2023-09-15', 'None', 'Laborable', 'Viernes'),
(4639, '2023-09-16', 'None', 'Laborable', 'Sábado'),
(4640, '2023-09-17', 'None', 'No laborable', 'Domingo'),
(4641, '2023-09-18', 'None', 'Laborable', 'Lunes'),
(4642, '2023-09-19', 'None', 'Laborable', 'Martes'),
(4643, '2023-09-20', 'None', 'Laborable', 'Miércoles'),
(4644, '2023-09-21', 'None', 'Laborable', 'Jueves'),
(4645, '2023-09-22', 'None', 'Laborable', 'Viernes'),
(4646, '2023-09-23', 'None', 'Laborable', 'Sábado'),
(4647, '2023-09-24', 'None', 'No laborable', 'Domingo'),
(4648, '2023-09-25', 'None', 'Laborable', 'Lunes'),
(4649, '2023-09-26', 'None', 'Laborable', 'Martes'),
(4650, '2023-09-27', 'None', 'Laborable', 'Miércoles'),
(4651, '2023-09-28', 'None', 'Laborable', 'Jueves'),
(4652, '2023-09-29', 'None', 'Laborable', 'Viernes'),
(4653, '2023-09-30', 'None', 'Laborable', 'Sábado'),
(4654, '2023-10-01', 'None', 'No laborable', 'Domingo'),
(4655, '2023-10-02', 'None', 'Laborable', 'Lunes'),
(4656, '2023-10-03', 'None', 'Laborable', 'Martes'),
(4657, '2023-10-04', 'None', 'Laborable', 'Miércoles'),
(4658, '2023-10-05', 'None', 'Laborable', 'Jueves'),
(4659, '2023-10-06', 'None', 'Laborable', 'Viernes'),
(4660, '2023-10-07', 'None', 'Laborable', 'Sábado'),
(4661, '2023-10-08', 'None', 'No laborable', 'Domingo'),
(4662, '2023-10-09', 'None', 'Laborable', 'Lunes'),
(4663, '2023-10-10', 'None', 'Laborable', 'Martes'),
(4664, '2023-10-11', 'None', 'Laborable', 'Miércoles'),
(4665, '2023-10-12', 'Fiesta Nacional de España', 'Festivo', 'Jueves'),
(4666, '2023-10-13', 'None', 'Laborable', 'Viernes'),
(4667, '2023-10-14', 'None', 'Laborable', 'Sábado'),
(4668, '2023-10-15', 'None', 'No laborable', 'Domingo'),
(4669, '2023-10-16', 'None', 'Laborable', 'Lunes'),
(4670, '2023-10-17', 'None', 'Laborable', 'Martes'),
(4671, '2023-10-18', 'None', 'Laborable', 'Miércoles'),
(4672, '2023-10-19', 'None', 'Laborable', 'Jueves'),
(4673, '2023-10-20', 'None', 'Laborable', 'Viernes'),
(4674, '2023-10-21', 'None', 'Laborable', 'Sábado'),
(4675, '2023-10-22', 'None', 'No laborable', 'Domingo'),
(4676, '2023-10-23', 'None', 'Laborable', 'Lunes'),
(4677, '2023-10-24', 'None', 'Laborable', 'Martes'),
(4678, '2023-10-25', 'None', 'Laborable', 'Miércoles'),
(4679, '2023-10-26', 'None', 'Laborable', 'Jueves'),
(4680, '2023-10-27', 'None', 'Laborable', 'Viernes'),
(4681, '2023-10-28', 'None', 'Laborable', 'Sábado'),
(4682, '2023-10-29', 'None', 'No laborable', 'Domingo'),
(4683, '2023-10-30', 'None', 'Laborable', 'Lunes'),
(4684, '2023-10-31', 'None', 'Laborable', 'Martes'),
(4685, '2023-11-01', 'Todos los Santos', 'Festivo', 'Miércoles'),
(4686, '2023-11-02', 'None', 'Laborable', 'Jueves'),
(4687, '2023-11-03', 'None', 'Laborable', 'Viernes'),
(4688, '2023-11-04', 'None', 'Laborable', 'Sábado'),
(4689, '2023-11-05', 'None', 'No laborable', 'Domingo'),
(4690, '2023-11-06', 'None', 'Laborable', 'Lunes'),
(4691, '2023-11-07', 'None', 'Laborable', 'Martes'),
(4692, '2023-11-08', 'None', 'Laborable', 'Miércoles'),
(4693, '2023-11-09', 'Nuestra Señora de la Almudena', 'Festivo', 'Jueves'),
(4694, '2023-11-10', 'None', 'Laborable', 'Viernes'),
(4695, '2023-11-11', 'None', 'Laborable', 'Sábado'),
(4696, '2023-11-12', 'None', 'No laborable', 'Domingo'),
(4697, '2023-11-13', 'None', 'Laborable', 'Lunes'),
(4698, '2023-11-14', 'None', 'Laborable', 'Martes'),
(4699, '2023-11-15', 'None', 'Laborable', 'Miércoles'),
(4700, '2023-11-16', 'None', 'Laborable', 'Jueves'),
(4701, '2023-11-17', 'None', 'Laborable', 'Viernes'),
(4702, '2023-11-18', 'None', 'Laborable', 'Sábado'),
(4703, '2023-11-19', 'None', 'No laborable', 'Domingo'),
(4704, '2023-11-20', 'None', 'Laborable', 'Lunes'),
(4705, '2023-11-21', 'None', 'Laborable', 'Martes'),
(4706, '2023-11-22', 'None', 'Laborable', 'Miércoles'),
(4707, '2023-11-23', 'None', 'Laborable', 'Jueves'),
(4708, '2023-11-24', 'None', 'Laborable', 'Viernes'),
(4709, '2023-11-25', 'None', 'Laborable', 'Sábado'),
(4710, '2023-11-26', 'None', 'No laborable', 'Domingo'),
(4711, '2023-11-27', 'None', 'Laborable', 'Lunes'),
(4712, '2023-11-28', 'None', 'Laborable', 'Martes'),
(4713, '2023-11-29', 'None', 'Laborable', 'Miércoles'),
(4714, '2023-11-30', 'None', 'Laborable', 'Jueves'),
(4715, '2023-12-01', 'None', 'Laborable', 'Viernes'),
(4716, '2023-12-02', 'None', 'Laborable', 'Sábado'),
(4717, '2023-12-03', 'None', 'No laborable', 'Domingo'),
(4718, '2023-12-04', 'None', 'Laborable', 'Lunes'),
(4719, '2023-12-05', 'None', 'Laborable', 'Martes'),
(4720, '2023-12-06', 'Día de la Constitución Española', 'Festivo', 'Miércoles'),
(4721, '2023-12-07', 'None', 'Laborable', 'Jueves'),
(4722, '2023-12-08', 'Día de la Inmaculada Concepcion', 'Festivo', 'Viernes'),
(4723, '2023-12-09', 'None', 'Laborable', 'Sábado'),
(4724, '2023-12-10', 'None', 'No laborable', 'Domingo'),
(4725, '2023-12-11', 'None', 'Laborable', 'Lunes'),
(4726, '2023-12-12', 'None', 'Laborable', 'Martes'),
(4727, '2023-12-13', 'None', 'Laborable', 'Miércoles'),
(4728, '2023-12-14', 'None', 'Laborable', 'Jueves'),
(4729, '2023-12-15', 'None', 'Laborable', 'Viernes'),
(4730, '2023-12-16', 'None', 'Laborable', 'Sábado'),
(4731, '2023-12-17', 'None', 'No laborable', 'Domingo'),
(4732, '2023-12-18', 'None', 'Laborable', 'Lunes'),
(4733, '2023-12-19', 'None', 'Laborable', 'Martes'),
(4734, '2023-12-20', 'None', 'Laborable', 'Miércoles'),
(4735, '2023-12-21', 'None', 'Laborable', 'Jueves'),
(4736, '2023-12-22', 'None', 'Laborable', 'Viernes'),
(4737, '2023-12-23', 'None', 'Laborable', 'Sábado'),
(4738, '2023-12-24', 'None', 'No laborable', 'Domingo'),
(4739, '2023-12-25', 'Natividad del Señor', 'Festivo', 'Lunes'),
(4740, '2023-12-26', 'None', 'Laborable', 'Martes'),
(4741, '2023-12-27', 'None', 'Laborable', 'Miércoles'),
(4742, '2023-12-28', 'None', 'Laborable', 'Jueves'),
(4743, '2023-12-29', 'None', 'Laborable', 'Viernes'),
(4744, '2023-12-30', 'None', 'Laborable', 'Sábado'),
(4745, '2023-12-31', 'None', 'No laborable', 'Domingo');

-- --------------------------------------------------------

--
-- Table structure for table `passwords`
--

CREATE TABLE `passwords` (
  `id` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `fecha_cambio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `passwords`
--

INSERT INTO `passwords` (`id`, `email`, `token`, `codigo`, `fecha_cambio`, `id_user`) VALUES
(46, 'alexpalomo323@gmail.com', '9212256c43', 'IyBMvu7*sc*k7T$8koUh', '2023-05-24 20:02:46', 70);

-- --------------------------------------------------------

--
-- Table structure for table `tablas`
--

CREATE TABLE `tablas` (
  `id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_usuario` int NOT NULL,
  `horario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tablas`
--

INSERT INTO `tablas` (`id`, `nombre`, `id_usuario`, `horario`) VALUES
(44, 'Tablaº1', 69, '9:00-18:00'),
(45, 'Tablaº2', 69, '9:00-18:00');

-- --------------------------------------------------------

--
-- Table structure for table `tareas`
--

CREATE TABLE `tareas` (
  `id` int NOT NULL,
  `tarea` varchar(255) NOT NULL,
  `importancia` int NOT NULL,
  `fecha_tarea` date NOT NULL,
  `id_tabla` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tareas`
--

INSERT INTO `tareas` (`id`, `tarea`, `importancia`, `fecha_tarea`, `id_tabla`) VALUES
(160, 'Tarea1', 10, '2023-05-26', 44),
(163, 'Tarea2', 10, '2023-05-29', 45);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` enum('trabajador','estudiante','ambos') NOT NULL DEFAULT 'ambos',
  `confirmado` varchar(2) NOT NULL,
  `codigo` varchar(9) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `sexo` enum('hombre','mujer','otros') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `tipo`, `confirmado`, `codigo`, `imagen`, `fecha_registro`, `sexo`, `username`) VALUES
(69, 'Admin', 'fctcalderon@gmail.com', '1551e291a211798a2bb28be4a847908b', 'ambos', 'si', 'KKD6-B689', '../profilepictures/14bfa6bb14875e45bba028a21ed38046/68d5535b971d558f594f10a5affd0a71jpg', '2023-05-06 16:06:40', 'hombre', 'admincool'),
(70, 'Veli', 'alexpalomo323@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'trabajador', 'si', '8S83-CLIU', '../profilepictures/7cbbc409ec990f19c78c75bd1e06f215/9e044ea0ed5817381b189680f392bafejpg', '2023-05-22 18:21:56', 'mujer', 'veli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendario_escolar`
--
ALTER TABLE `calendario_escolar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendario_laboral`
--
ALTER TABLE `calendario_laboral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`id_user`);

--
-- Indexes for table `tablas`
--
ALTER TABLE `tablas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tabla` (`id_tabla`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendario_escolar`
--
ALTER TABLE `calendario_escolar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1671;

--
-- AUTO_INCREMENT for table `calendario_laboral`
--
ALTER TABLE `calendario_laboral`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4746;

--
-- AUTO_INCREMENT for table `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tablas`
--
ALTER TABLE `tablas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `passwords`
--
ALTER TABLE `passwords`
  ADD CONSTRAINT `usuario` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tablas`
--
ALTER TABLE `tablas`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `id_tabla` FOREIGN KEY (`id_tabla`) REFERENCES `tablas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
