CREATE DATABASE  IF NOT EXISTS `fidetechnology` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `fidetechnology`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fidetechnology
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrito` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` bigint(20) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT 1,
  `FechaAgregado` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `IdUsuario` (`IdUsuario`),
  KEY `IdProducto` (`IdProducto`),
  CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`Id`),
  CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`IdProducto`) REFERENCES `productos` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
INSERT INTO `carrito` VALUES (6,1,1,'Rojo',1,'2025-04-21 07:50:01');
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Imagen` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Celulares','https://www.adntienda.com/web/image/332163/celulares-costa-rica.jpg?access_token=41e727ca-d9b8-4cc4-a6cd-16ad1092bc59'),(2,'Tablets','https://static.independent.co.uk/2024/11/01/16/best-tablets-1-november-2024.jpg?width=1200&height=900&fit=crop'),(3,'Accesorios','https://www.muvit.es/img/cms/1%20-%20Blog/Conjunto%20de%20accesorios%20blancos.jpeg');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfil` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'Cliente(a)'),(2,'Administrador(a)'),(3,'Vendedor(a)');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto_colores`
--

DROP TABLE IF EXISTS `producto_colores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto_colores` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdProducto` int(11) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `IdProducto` (`IdProducto`),
  CONSTRAINT `producto_colores_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `productos` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto_colores`
--

LOCK TABLES `producto_colores` WRITE;
/*!40000 ALTER TABLE `producto_colores` DISABLE KEYS */;
INSERT INTO `producto_colores` VALUES (1,1,'Rojo','../assets/img/img_subidas/s22red.png'),(2,1,'Verde','../assets/img/img_subidas/s22green.png'),(3,1,'Negro','../assets/img/img_subidas/s22black.png'),(4,2,'Negro','../assets/img/img_subidas/iphone13black.png'),(5,8,'Blanco','../assets/img/img_subidas/promax16blanco.png');
/*!40000 ALTER TABLE `producto_colores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Imagen` varchar(255) NOT NULL,
  `Disponibilidad` tinyint(1) DEFAULT 1,
  `IdCategoria` bigint(20) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_CategoriaProducto_idx` (`IdCategoria`),
  CONSTRAINT `FK_CategoriaProducto` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Samsung Galaxy S22','Telefono con Lapiz',999.99,'../assets/img/img_subidas/248911_0_xxhhxs.png',1,1),(2,'iPhone 13','Bordes de Titanio',1099.99,'../assets/img/img_subidas/apple-iphone-13-128gb-medianoche-.jpg',1,1),(3,'Xiaomi Mi 11','Gama Media',799.99,'../assets/img/img_subidas/imagen-principal17607-1-1618002938.png',1,1),(4,'Honor 50','Gama Media',799.99,'../assets/img/img_subidas/honor_50_listimg_parameter_silver-v1.png',0,1),(5,'iPhone 16 Plus','Bordes de Titanio',900.99,'../assets/img/img_subidas/233679-233684-233689-iphone-16-plus-ultramarine.png',1,1),(6,'Samsung Flip 3','Telefono Plegable',1200.99,'../assets/img/img_subidas/hncq4kchi5yktooxfmyx.png',0,1),(7,'Tablet Samsung A7','Tablet Samsung',1350.25,'../assets/img/img_subidas/SamsungA7.png',1,2),(8,'iPhone 16 PRO MAX','Gama alta',1000.00,'../assets/img/img_subidas/apple-iphone-16-pro-max.png',1,1);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(250) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Contrasenna` varchar(15) NOT NULL,
  `Activacion` varchar(64) DEFAULT NULL,
  `IdPerfil` bigint(20) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Uk_Correo` (`Correo`),
  UNIQUE KEY `Uk_Activacion` (`Activacion`),
  KEY `FK_UsuarioPerfil` (`IdPerfil`),
  CONSTRAINT `FK_UsuarioPerfil` FOREIGN KEY (`IdPerfil`) REFERENCES `perfil` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Fernando Chacón Zuñiga','chaconzunigafernando@gmail.com','F1603','fb82a4c3b232b84935c216819702636d8a6b94dfef59f9342b90e422274689d4',3),(2,'Daniel Mora Solano','dmora00668@ufide.ac.cr','123',NULL,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'fidetechnology'
--
/*!50003 DROP PROCEDURE IF EXISTS `SP_ActivarCuenta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ActivarCuenta`(
    IN p_idUsuario INT
)
BEGIN
    UPDATE usuario 
    SET Activacion = NULL
    WHERE Id = p_idUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ActualizarContrasenna` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ActualizarContrasenna`(
	pId 	bigint(20),
	pCodigo varchar(6)
)
BEGIN

	UPDATE 	usuario
    SET 	Contrasenna = pCodigo
    WHERE 	Id = pId;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ActualizarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ActualizarUsuario`(
										 pId bigint(20), 
										 pNombre varchar(250), 
                                         pCorreo varchar(100))
BEGIN

	UPDATE usuario
    SET 
		Nombre = pNombre,
        Correo = pCorreo
	WHERE Id = pId;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Actualizar_Cantidad_Carrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Actualizar_Cantidad_Carrito`(
    IN p_IdUsuario INT,
    IN p_IdProducto INT,
    IN p_Color VARCHAR(50),
    IN p_Cantidad INT
)
BEGIN
    DECLARE v_existe INT DEFAULT 0;
    DECLARE v_actual_cantidad INT DEFAULT 0;
    DECLARE v_total INT DEFAULT 0;
    
    -- Verificar si el producto existe en el carrito del usuario
    SELECT COUNT(*), IFNULL(Cantidad, 0) INTO v_existe, v_actual_cantidad
    FROM carrito
    WHERE IdUsuario = p_IdUsuario 
      AND IdProducto = p_IdProducto
      AND Color = p_Color;
      
    IF v_existe > 0 THEN
        -- Actualizar la cantidad si existe
        UPDATE carrito 
        SET Cantidad = p_Cantidad,
            FechaActualizado = NOW()
        WHERE IdUsuario = p_IdUsuario 
          AND IdProducto = p_IdProducto
          AND Color = p_Color;
          
        -- Obtener el total de items en el carrito para este usuario
        SELECT SUM(Cantidad) INTO v_total
        FROM carrito
        WHERE IdUsuario = p_IdUsuario;
        
        -- Retornar éxito, mensaje, la cantidad actualizada y el total
        SELECT 
            1 AS success,
            'Cantidad actualizada correctamente' AS message,
            p_Cantidad AS cantidad,
            v_total AS total;
    ELSE
        -- Si no existe, devolver error
        SELECT 
            0 AS success,
            'Producto no encontrado en el carrito' AS message,
            0 AS cantidad,
            0 AS total;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Actualizar_Producto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Actualizar_Producto`(
    IN P_ID bigint(20),
    IN P_NOMBRE varchar(255),
    IN P_DESCRIPCION varchar(255),
    IN P_PRECIO DECIMAL(10,2),
    IN P_IMAGEN VARCHAR(255),
    IN P_DISPONIBILIDAD tinyint(1),
    IN P_IDCATEGORIA bigint(20)
)
BEGIN
    UPDATE productos
    SET
        Nombre = P_NOMBRE,
        Descripcion = P_DESCRIPCION,
        Precio = P_PRECIO,
        Imagen = P_IMAGEN,
        Disponibilidad = P_DISPONIBILIDAD,
        IdCategoria = P_IDCATEGORIA
    WHERE Id = P_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Agregar_Al_Carrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Agregar_Al_Carrito`(
    IN p_IdUsuario INT,
    IN p_IdProducto INT,
    IN p_Color VARCHAR(50),
    IN p_Cantidad INT
)
BEGIN
    DECLARE existe INT;
    DECLARE disponible TINYINT;
    DECLARE max_cantidad INT DEFAULT 10;

    -- Verificar si el producto ya está en el carrito
    SELECT COUNT(*) INTO existe 
    FROM Carrito 
    WHERE IdUsuario = p_IdUsuario 
    AND IdProducto = p_IdProducto 
    AND Color = p_Color;

    -- Verificar si el producto está disponible
    SELECT Disponibilidad INTO disponible
    FROM Productos 
    WHERE Id = p_IdProducto;

    IF disponible = 0 THEN
        SELECT 0 AS total, 'Producto sin disponibilidad' AS Mensaje;
    ELSE
        -- Si ya existe, actualizar cantidad (sin exceder máximo)
        IF existe > 0 THEN
            UPDATE Carrito 
            SET Cantidad = LEAST(
                (SELECT Cantidad FROM Carrito 
                 WHERE IdUsuario = p_IdUsuario 
                 AND IdProducto = p_IdProducto 
                 AND Color = p_Color) + p_Cantidad,
                max_cantidad
            )
            WHERE IdUsuario = p_IdUsuario 
            AND IdProducto = p_IdProducto 
            AND Color = p_Color;

            SELECT 'Producto actualizado en el carrito' AS Mensaje;
        ELSE
            -- Si no existe, agregar nuevo (validando cantidad)
            INSERT INTO Carrito (IdUsuario, IdProducto, Color, Cantidad)
            VALUES (p_IdUsuario, p_IdProducto, p_Color, LEAST(p_Cantidad, max_cantidad));

            SELECT 'Producto agregado al carrito' AS Mensaje;
        END IF;

        -- Devolver conteo actualizado de productos en el carrito
        SELECT COUNT(*) AS total FROM Carrito WHERE IdUsuario = p_IdUsuario;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Agregar_Producto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Agregar_Producto`(
    IN P_NOMBRE varchar(255),
    IN P_DESCRIPCION varchar(255),
    IN P_PRECIO DECIMAL(10,2),
    IN P_IMAGEN VARCHAR(255),
    IN P_DISPONIBILIDAD tinyint(1),
    IN P_IDCATEGORIA bigint(20)
)
BEGIN
    INSERT INTO productos (
        Nombre,
        Descripcion,
        Precio,
        Imagen,
        Disponibilidad,
        IdCategoria
    ) VALUES (
        P_NOMBRE,
        P_DESCRIPCION,
        P_PRECIO,
        P_IMAGEN,
        P_DISPONIBILIDAD,
        P_IDCATEGORIA
    );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Buscar_Productos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Buscar_Productos`(IN keyword VARCHAR(100), IN categoria_id INT)
BEGIN
    DECLARE base_query TEXT;
    DECLARE final_query TEXT;

    -- Armar base de la consulta
    SET base_query = '
        SELECT 
            p.Id AS IdProducto,
            p.Nombre AS NombreProducto,
            p.Descripcion,
            p.Precio,
            p.Imagen,
            p.Disponibilidad,
            c.Id AS IdCategoria,
            c.Nombre AS NombreCategoria
        FROM productos p
        LEFT JOIN categoria c ON p.idCategoria = c.Id
        WHERE (LOWER(p.Nombre) LIKE CONCAT("%", LOWER(?), "%")
            OR LOWER(p.Descripcion) LIKE CONCAT("%", LOWER(?), "%"))';

    IF categoria_id IS NOT NULL AND categoria_id > 0 THEN
        SET base_query = CONCAT(base_query, ' AND p.idCategoria = ?');
    END IF;

    -- Preparar y ejecutar la consulta
    SET @query = base_query;
    PREPARE stmt FROM @query;

    IF categoria_id IS NOT NULL AND categoria_id > 0 THEN
        SET @kw1 = keyword;
        SET @kw2 = keyword;
        SET @cat = categoria_id;
        EXECUTE stmt USING @kw1, @kw2, @cat;
    ELSE
        SET @kw1 = keyword;
        SET @kw2 = keyword;
        EXECUTE stmt USING @kw1, @kw2;
    END IF;

    DEALLOCATE PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ConsultarProductos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsultarProductos`()
BEGIN
    SELECT 
        c.Nombre AS Categoria,
        p.Id AS IdProducto,
        p.Nombre AS NombreProducto,
        p.Descripcion,
        p.Precio,
        p.Imagen,
        p.Disponibilidad
    FROM 
        productos p
    INNER JOIN 
        categoria c ON p.IdCategoria = c.Id
    ORDER BY 
        c.Nombre, p.Nombre;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ConsultarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsultarUsuario`(pId bigint(20))
BEGIN

	SELECT	U.Id,
			U.Nombre 'NombreUsuario',
			Correo,
			Contrasenna,
            IdPerfil,
            P.Nombre 'NombrePerfil'
	FROM 	usuario U
    INNER JOIN perfil P ON U.IdPerfil = P.Id 
	WHERE 	U.Id = pId;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Consultar_Categorias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Consultar_Categorias`()
BEGIN
    SELECT Id, Nombre, Imagen FROM categoria ORDER BY Nombre ASC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Consultar_Colores_Por_Producto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Consultar_Colores_Por_Producto`(IN p_IdProducto INT)
BEGIN
    SELECT 
        Color, 
        Imagen 
    FROM 
        producto_colores
    WHERE 
        IdProducto = p_IdProducto;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Consultar_Productos_Por_Categoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Consultar_Productos_Por_Categoria`(IN categoria_id INT)
BEGIN
    IF categoria_id IS NULL OR categoria_id = 0 THEN
        CALL Consultar_Productos_Todos();
    ELSE
        SELECT p.Id as IdProducto, p.Nombre as NombreProducto, 
               p.Descripcion, p.Precio, p.Imagen, p.Disponibilidad, 
               c.Id as IdCategoria, c.Nombre as NombreCategoria 
        FROM productos p 
        LEFT JOIN categoria c ON p.idCategoria = c.Id
        WHERE p.idCategoria = categoria_id
        ORDER BY p.Id DESC;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Consultar_Productos_Todos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Consultar_Productos_Todos`()
BEGIN
    SELECT p.Id as IdProducto, p.Nombre as NombreProducto, 
           p.Descripcion, p.Precio, p.Imagen, p.Disponibilidad, 
           c.Id as IdCategoria, c.Nombre as NombreCategoria 
    FROM productos p 
    LEFT JOIN categoria c ON p.idCategoria = c.Id
    ORDER BY p.Id DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Consultar_Producto_Por_Id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Consultar_Producto_Por_Id`(IN p_id INT)
BEGIN
    SELECT * FROM productos WHERE Id = p_id AND Disponibilidad = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Eliminar_Producto_Carrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Eliminar_Producto_Carrito`(
    IN p_IdUsuario INT,
    IN p_IdProducto INT,
    IN p_Color VARCHAR(50)
)
BEGIN
    DECLARE v_conteo INT;
    
    DELETE FROM Carrito 
    WHERE IdUsuario = p_IdUsuario 
    AND IdProducto = p_IdProducto 
    AND Color = p_Color;
    
    -- Obtener conteo actualizado
    SELECT COUNT(*) INTO v_conteo FROM Carrito WHERE IdUsuario = p_IdUsuario;
    
    IF ROW_COUNT() > 0 THEN
        SELECT 1 AS success, 'Producto eliminado del carrito' AS message, v_conteo AS conteo;
    ELSE
        SELECT 0 AS success, 'No se encontró el producto en el carrito' AS message, v_conteo AS conteo;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GuardarTokenActivacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GuardarTokenActivacion`(
    IN p_idUsuario INT,
    IN p_token VARCHAR(64)
)
BEGIN
    UPDATE usuario 
    SET Activacion = p_token
    WHERE Id = p_idUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_IniciarSesion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_IniciarSesion`(
	pCorreo varchar(45),
	pContrasenna varchar(15)
)
BEGIN

	SELECT	U.Id,
			U.Nombre 'NombreUsuario',
			Correo,
			Contrasenna,
            IdPerfil,
            P.Nombre 'NombrePerfil'
	FROM 	usuario U
    INNER JOIN perfil P ON U.IdPerfil = P.Id 
	WHERE 	Correo = pCorreo
		AND Contrasenna = pContrasenna;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_NombreCategoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_NombreCategoria`(IN p_id INT)
BEGIN
	SELECT Nombre FROM categoria WHERE Id = p_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Nombre_Categoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Nombre_Categoria`(
    IN categoria_id INT
)
BEGIN
    SELECT 
        COALESCE((SELECT Nombre FROM categoria WHERE Id = categoria_id), 'Todas las categorías') AS Nombre;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ObtenerCategorias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ObtenerCategorias`()
BEGIN
    SELECT Id, Nombre FROM categoria ORDER BY Nombre ASC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Obtener_Carrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Obtener_Carrito`(
    IN p_IdUsuario INT
)
BEGIN
    SELECT 
        c.IdProducto AS Id,
        p.Nombre,
        p.Imagen,
        p.Precio,
        c.Color,
        c.Cantidad,
        (p.Precio * c.Cantidad) AS Subtotal
    FROM Carrito c
    JOIN Productos p ON c.IdProducto = p.Id
    WHERE c.IdUsuario = p_IdUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Obtener_Carrito_Detallado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Obtener_Carrito_Detallado`(IN p_id_usuario INT)
BEGIN
    SELECT 
        c.IdProducto AS id_producto,
        p.Nombre AS nombre,
        c.Color AS color,
        c.Cantidad AS cantidad,
        p.Precio AS precio,
        p.Stock AS stock_disponible,
        p.Imagen AS imagen
    FROM Carrito c
    JOIN Productos p ON c.IdProducto = p.IdProducto
    WHERE c.IdUsuario = p_id_usuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Obtener_Colores_Producto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Obtener_Colores_Producto`(
    IN P_IDPRODUCTO BIGINT
)
BEGIN
    SELECT Color, Imagen
    FROM producto_colores
    WHERE IdProducto = P_IDPRODUCTO;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Obtener_Conteo_Carrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Obtener_Conteo_Carrito`(
    IN p_IdUsuario INT
)
BEGIN
    SELECT IFNULL(SUM(Cantidad), 0) AS total
    FROM Carrito
    WHERE IdUsuario = p_IdUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_RegistrarCuenta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegistrarCuenta`(
	pNombre varchar(250),
	pCorreo varchar(100),
	pContrasenna varchar(15),
    pActivacion varchar(64)
)
BEGIN

	INSERT INTO usuario(Nombre,Correo,Contrasenna,Activacion,IdPerfil)
	VALUES(pNombre,pCorreo,pContrasenna,pActivacion,1);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ValidarToken` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ValidarToken`(
    IN pActivacion VARCHAR(64)
)
BEGIN
    SELECT Id, Nombre, Correo, IdPerfil
    FROM usuario
    WHERE Activacion = pActivacion
    LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ValidarUsuarioCorreo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ValidarUsuarioCorreo`(
	pCorreo varchar(100)
)
BEGIN

	SELECT	U.Id,
			U.Nombre 'NombreUsuario',
			Correo,
			Contrasenna,
            IdPerfil,
            P.Nombre 'NombrePerfil'
	FROM 	usuario U
    INNER JOIN perfil P ON U.IdPerfil = P.Id 
	WHERE 	Correo = pCorreo;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-22  5:50:15
