-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2023 a las 00:40:58
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ticket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admin` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `nombre_admin` varchar(60) NOT NULL,
  `clave` text NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `cargo` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_admin`, `nombre_completo`, `nombre_admin`, `clave`, `email_admin`, `cargo`) VALUES
(1, 'Super Administrador', 'Administrador', '2a2e9a58102784ca18e2605a4e727b5f', 'administrador@gmail.com', 'Super Admin'),
(5, 'Cristian', 'csv', '202cb962ac59075b964b07152d234b70', 'csv@gmail.com', 'Desarrollador Web'),
(7, 'Carola Campos ', 'ccampos', '96626642cd0fcabd85a58a2b11ea6d12', 'ccampos@gmail.com', 'Secretaria'),
(8, 'Jaime Aragon', 'jaragon', '96626642cd0fcabd85a58a2b11ea6d12', 'jaime97j@gmail.com', 'Admin'),
(9, 'Milagros linares', 'mlinares', '96626642cd0fcabd85a58a2b11ea6d12', 'mlinares@munimagdalena.gob.pe', 'OYM '),
(10, 'Alberto Ayarza Flores', 'ayarza', '96626642cd0fcabd85a58a2b11ea6d12', 'layarza@munimagdalena.gob.pe', 'Jefe de Oficina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre_completo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_usuario` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `email_cliente` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` text COLLATE utf8_spanish2_ci NOT NULL,
  `area` varchar(191) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_completo`, `nombre_usuario`, `email_cliente`, `clave`, `area`) VALUES
(1, 'Prueba', 'Prueba', 'csv1930@gmail.com', '202cb962ac59075b964b07152d234b70', 'Inf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `fecha` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `serie` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `estado_ticket` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `email_cliente` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `departamento` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `asunto` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `mensaje` text COLLATE utf8_spanish2_ci NOT NULL,
  `solucion` text COLLATE utf8_spanish2_ci NOT NULL,
  `tecnico` varchar(191) COLLATE utf8_spanish2_ci NOT NULL,
  `mes` varchar(191) COLLATE utf8_spanish2_ci NOT NULL,
  `area` varchar(191) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_solucion` varchar(191) COLLATE utf8_spanish2_ci NOT NULL,
  `codequipo` varchar(191) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id`, `fecha`, `serie`, `estado_ticket`, `nombre_usuario`, `email_cliente`, `departamento`, `asunto`, `mensaje`, `solucion`, `tecnico`, `mes`, `area`, `fecha_solucion`, `codequipo`) VALUES
(3, '20/03/2023   08:45:50  am', 'TK84N1', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacicion, mantenimiento y actualizacion de software', 'Problemas con SIGA', 'Problemas con SIGA', 'Se soluciono el Programa SIGA, y se verifico.', 'JAIME ARAGON ESCOBAR', 'marzo', 'Informatica', '20/03/2023 12:36', '001'),
(4, '20/03/2023   08:56:50  am', 'TK86N2', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Mantenimiento correctivo', 'Revisi?n de l?neas telef?nicas', 'Se dirigi? a Central Telef?nica a revisar   el tel?fono de la Sra. Vilma.', 'Se soluciono el problema de desconfiguracion, y el usuario comprob? que esta solucionado.', 'CESAR MU?OZ BERROCAL', '', 'Informatica', '20/03/2023 09:02', '002'),
(5, '20/03/2023   09:04:44  am', 'TK72N3', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de servicio de red', 'No tiene acceso a internet', 'Esta bloqueado', 'Se hizo cambio de Ip y configuraci?n Red , (log?stica)', 'CESAR MUOZ BERROCAL', '', 'Informatica', '20/03/2023 10:29', '003'),
(6, '20/03/2023   09:08:49  am', 'TK79N4', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de equipo', 'Instalaci?n de equipo para Asesor?a jur?dica', '.', 'Se instalo correctamente el equipo.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '20/03/2023 10:42', '004'),
(7, '20/03/2023   09:14:07  am', 'TK29N5', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de equipo', 'Instalaci?n de equipo para Fiscalizaci?n, Sr. Hugo', '.', '.Se instalo el equipo correctamente y lo verifico el usuario.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '20/03/2023 11:18', '005'),
(9, '20/03/2023   09:22:56  am', 'TK09N7', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de accesorios', 'Instalaci?n del SIAF', 'Instalar el SIAF en log?stica en la PC de Daniela ', 'Se realizo la instalaci?n del SIAF, para la Oficina de Log?stica.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '20/03/2023 13:01', '007'),
(12, '20/03/2023   09:43:44  am', 'TK66N10', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'Cambio de clave a usuario David Ordo?ez', 'Cambio de clave a usuario David Ordo?ez', 'Se cambio la contrase?a de Usuario a un password por default.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '20/03/2023 09:45', '00'),
(14, '20/03/2023   09:50:39  am', 'TK82N10', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'No enciende la CPU', 'No prende el CPU del Dr. al?n del ?rea de administraci?n.', 'DIAGNOSTICO\r\n- Se realizo pruebas de los componentes del CPU y se puede determino que existen problemas de Placa Madre;\r\n- SE PROCEDE A INFORMAR AL JEFE DE AREA PARA SOLUCION DEL CPU AVERIADO', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '21/03/2023 09:46', '00'),
(15, '20/03/2023   09:54:43  am', 'TK54N11', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de equipo', 'Instalar  un proyector', 'Instalar un proyector en sala de Sesiones a las 2:30 pm.', 'Se instalo el proyector para la Reunin.', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '20/03/2023 16:33', '00'),
(16, '20/03/2023   09:57:54  am', 'TK12N12', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de servicio de red', 'Restablecer contrase?a', 'Restablecer contrase?a ', 'se restableci? la contrase?a al usuario y este lo verifico.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '20/03/2023 10:03', '00'),
(17, '20/03/2023   10:18:41  am', 'TK52N13', 'Resuelto', 'Prueba', 'csv1930@gmail.com', 'Mantenimiento preventivo', 'sa', 'sa', 'listo', 'CRISTIAN SANCHEZ VIVAR', '', 'Inf', '20/03/2023 10:19', '12'),
(18, '20/03/2023   10:40:40  am', 'TK63N14', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'No puede abrir su correo de la Municipalidad', 'No puede abrir su correo de la Municipalidad', 'Se solucion? el problema del ?rea de Informes', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '20/03/2023 11:19', '00'),
(19, '20/03/2023   10:53:40  am', 'TK68N15', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'necesita un permiso administrador', 'necesita un permiso administrador del ?rea de comunicaciones, el Sr. Luigi', 'Habilito permisos como administrador, para la instalacin de una aplicacin de edicin.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '20/03/2023 11:25', '00'),
(20, '20/03/2023   11:27:35  am', 'TK56N16', 'En proceso', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'Varios cambios', 'Instalar Windows 10, mas memoria y un procesador mas potente.', '.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '23/03/2023 08:30', '00'),
(21, '20/03/2023   11:32:59  am', 'TK56N17', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'No tiene acceso a internet', 'No tiene acceso a internet la Sra. Patricia Wong, Area de Desarrollo Humano', 'Se dio acceso al internet.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '20/03/2023 11:42', '00'),
(23, '20/03/2023   08:20:45  am', 'TK04N19', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de red', 'Instalaci?n de Red', 'Apoyo de instalaci?n a la Oficina  Administrativa del Mercado', '.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '20/03/2023 14:16', '00'),
(24, '20/03/2023   08:20:16  am', 'TK84N20', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de red', 'Instalaci?n de Red', 'Para apoyo a la Oficina Administrativa del mercado. ', '.', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '20/03/2023 14:17', '00'),
(26, '20/03/2023   08:20:46  am', 'TK61N21', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de equipo', 'Instalaci?n de Equipo', 'Apoyo de instalaci?n de c?mara fija en la playa del distrito.', 'Se instalo correctamente la camara en la playa del distrito.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '20/03/2023 16:34', '00'),
(27, '20/03/2023   08:20:02  am', 'TK21N22', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de equipo', 'Instalaci?n de equipo', 'Apoyo a la instalaci?n de c?mara fija en la playa del distrito.', 'Se instalo la c?mara en la playa del distrito correctamente.', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '20/03/2023 14:23', '00'),
(28, '20/03/2023   02:12:23  pm', 'TK62N21', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'No funciona sus impresora', 'No funciona sus impresora en el ?rea de Presupuesto', 'Desconfiguracion impresora e instalaci?n de Driver, configuraci?n de Scan, ', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '20/03/2023 14:34', '00'),
(29, '20/03/2023   02:25:24  pm', 'TK75N22', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'Acceso a Internet', 'Solicita habilitaci?n ,a la locadora Henma Quezada, al WhatsApp web.', ' Se instalo las aplicaciones solicitadas.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '22/03/2023 10:15', '00'),
(30, '20/03/2023   02:36:29  pm', 'TK38N23', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'apoyo al jefe', 'apoyo al jefe', 'SE BRINDO LOS ACCESOS CPANEL DEL PORTAL WEB MUNICPAL', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '20/03/2023 14:51', '00'),
(31, '20/03/2023   02:37:45  pm', 'TK71N24', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'soporte tecnico', 'soporte t?cnico', 'Se procedi? hacerle el cambio de  memoria Ram, quedando en perfectos condiciones.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '20/03/2023 15:12', '00'),
(32, '20/03/2023   02:50:29  pm', 'TK41N25', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'Instalaci?n de SATMU', 'Instalaci?n de SATMU , EN EL SERVIDOR DE APLICACIONES.', ', YA ESTA INSTALADO, Y VERIFICADO.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '22/03/2023 10:54', '00'),
(33, '20/03/2023   02:59:04  pm', 'TK04N26', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Creaci?n de Correos', 'Para la oficina de log?stica , para el usuario Juan Carlos Coutter', 'SE REALIZO LA CREACION DE CORREO PARA EL PERSONAL DE LOGISTICA', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '20/03/2023 16:16', '00'),
(34, '20/03/2023   03:33:57  pm', 'TK02N27', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'Revisi?n de Impresora para el area de plataforma', 'Revisi?n de Impresora para el area de plataforma', 'SE DERIVO A LA EMPRESA FERJ/LOGISTIC', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '21/03/2023 14:13', '00'),
(35, '20/03/2023   03:43:46  pm', 'TK58N28', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Actualizaci?n de certificados del SIAF', 'Actualizaci?n de certificados del SIAF', 'SE REALIZO LA ACTUALIZACION DEL SIAF AL USUARIO JOSE ANOTNIO CANTALICIO, DE LA OFICINA DE RECURSOS HUMANOS.', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '20/03/2023 17:10', '00'),
(36, '20/03/2023   03:49:08  pm', 'TK86N29', 'Resuelto', 'Antonio Quintana', 'aquintana@munimagdalena.gob.pe', 'Otros', 'SIAF', 'SIAF', 'resuelto', '', '', 'Informtica', '20/03/2023 15:51', 'sa'),
(37, '20/03/2023   04:01:15  pm', 'TK15N30', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'modificaci?n de fecha en el SIGA', 'modificaci?n de fecha en el SIGA, para la oficina de ESTADO CIVIL, Usuario BELEN', 'SE REALIZO LA MODIFICACION DE FECHA.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '20/03/2023 16:15', '00'),
(38, '20/03/2023   04:35:41  pm', 'TK31N30', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Respuesta para el informe 001-2023', 'Respuesta para el informe 001-2023', 'CON EL APOYO DE LA SRA MILAGROS LINARES SE DIO RESPUESTA A LO INDICADO PARA LA SOCIEDAD AUDITORA ARCE Y ASOCIADOS CIVIL', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '21/03/2023 09:26', '00'),
(39, '20/03/2023   04:49:15  pm', 'TK48N31', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de servicio de red', 'VERIFICACION DE PUNTOS DE RED, OFC. DE  RUTTE # 722', 'VERIFICACION DE PUNTOS DE RED, OFC. DE  RUTTE # 722, la oficina sera ocupada por la sociedad arce y asociados.', 'SE VERIFICO LOS PUNTOS DE RED DEL AREA DE RODOLFO RUTTE PARA LA EMPRESA DE AUDITORIA\r\n', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '21/03/2023 09:21', '00'),
(40, '20/03/2023   05:07:54  pm', 'TK92N32', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION DEL PLAME', 'INSTALACION DEL PLAME, PARA EL AREA DE RECURSOS HUMANOS.', 'SE ACTUALIZO EL PROGRAMA PLAME, PARA LA OFICINA DE RECURSOS HUMANOS.', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '20/03/2023 17:09', '00'),
(41, '20/03/2023   05:15:24  pm', 'TK35N33', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'LECTOR DEL TENIENTE ALCALDE', 'LECTOR DEL TENIENTE ALCALDE ', 'SE HIZO LA INSTALACION.', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '21/03/2023 12:17', '00'),
(42, '21/03/2023   08:40:17  am', 'TK44N34', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CAMBIO DE FECHA DEL SIGA', 'CAMBIO DE FECHA DEL SIGA, PARA EL USUARIO MARLENE DEL AREA DEL VASO DE LECHE', 'ATENDIDO', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '21/03/2023 09:47', '00'),
(43, '21/03/2023   08:42:17  am', 'TK17N35', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CREAR CARPETA COMPARTIDA', 'CREAR CARPETA COMPARTIDA PARA EL AREA DE RIESGOS Y DESASTRES, PARA EL USUARIO DAGHELY ESPINOZA', 'SE LE OTORGO ACCESO A LA CARPETA COMPRTIDA USUARIO \"RIESGOS\" A PETICION  LA ASISTENTE DE LA OFICINA', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '21/03/2023 09:41', '.00'),
(44, '21/03/2023   08:51:29  am', 'TK87N36', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de red', 'INSTALCION DE CABLE DE RED', 'SE INSTALO CORRECTAMENTE EN EL AREA DE COMUNICACIONES', 'SE INSTALO EL CABLE DE RED, Y SE VERIFICO CON EL USUSARIO.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '21/03/2023 08:52', '00'),
(45, '21/03/2023   08:54:04  am', 'TK59N37', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'REVISISON DE ANEXOS', 'REVISISON DE ANEXOS DE TODA LA MUNICIPALIDAD.', 'SE HIZO EL CHEQUE GENERAL DE LOS ANEXOS DE LA MUNICIPALIDAD.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '21/03/2023 11:29', '00'),
(46, '21/03/2023   09:13:22  am', 'TK96N38', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Mantenimiento preventivo', 'REVISION DE LA CENTRAL TELEFONICA', 'REVISION DE LA CENTRAL TELEFONICA, NO TIENE SALIDA DE LLAMADAS AFUERA', 'SE VERIFICO LA CENTRAL CENTRAL TELEFONICA Y SE HABILITO LLAMADAS AL EXTERIOR.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '21/03/2023 12:21', '00'),
(47, '21/03/2023   09:17:53  am', 'TK82N39', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'MANTENIMIENTO EN BIBLIOTECA', 'MANTENIMIENTO EN BIBLIOTECA ARREGLAR PARA QUE LOS CODIGOS SE PUEDAN VER. AREA DE DESARROLLO SOSTENIBLE.', 'Se indico comovincular el codigo de cms con caja', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '21/03/2023 10:56', '00'),
(48, '21/03/2023   09:21:20  am', 'TK28N40', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'VALIDACION DE ACCESOS A PAGINA DE INTERNET', 'VALIDACION DE ACCESOS A PAGINA DE INTERNET, A AREA DE PRESUPUESTO,.', 'SE PROCEDIO A VALIDAR EL USUARIO DE LA OFICINA DE PRESUPUESTO USUARIO \"DURQUIZO\"', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '21/03/2023 09:43', '00'),
(49, '21/03/2023   09:24:08  am', 'TK58N41', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'No tiene acceso a internet', 'No tiene acceso a internet EN Huaca Huantille , usuario Miluska Reategui', 'se le puso el acceso a internet. y se verifico.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '21/03/2023 09:46', '.'),
(50, '21/03/2023   09:28:39  am', 'TK48N42', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'ACCESO AL ANYDESK', 'ACCESO AL ANYDESK AL AREA DE CONTABLIDAD, AL USUARIO RICARDO GONZALES', 'SE DIO ACCESO AL ANYDESK CORRECTAMENTE.', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '21/03/2023 09:43', '00'),
(51, '21/03/2023   09:30:14  am', 'TK61N43', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CONFIGURACION DEL AUTOCAD', 'CONFIGURACION DEL AUTOCAD PARA EL AREA DE OBRAS PRIVADAS PARA EL USUARIO CLAUDIA ROJAS', 'SE CONFIGURO EL AUTOCAD Y SE CONFIGURO.', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '21/03/2023 17:27', '00'),
(52, '21/03/2023   09:31:25  am', 'TK71N44', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'HABILITAR USUSARIO DE SIAF', 'HABILITAR USUSARIO DE SIAF EN EL AREA DE LOGISTICA AL USUARIO DANIELA BUSTAMANTE', 'SE HABILITO CORRECTAMENETE EL SIAF AL AREA DE LOGISTICA.', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '21/03/2023 17:26', '00'),
(53, '21/03/2023   09:51:51  am', 'TK13N45', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'No tiene acceso a internet', 'No tiene acceso a internet, Usuario. Henna de Log?stica', 'SE RESTAURO EL IP , Y SE VERIFICO CORRECTAMENTE LOS ACCESOS A INTERNET.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '21/03/2023 10:38', '00'),
(57, '21/03/2023   10:25:10  am', 'TK56N48', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CONFIGURACION DE IMPRESORA COMPARTIDA', 'CONFIGURACION DE IMPRESORA COMPARTIDA DE ALCALDIA', 'SE COMPARTIO LA IMPRESORA DE KEIKO A SOLICITUS DEL USUARIO.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '27/03/2023 11:18', '00'),
(58, '21/03/2023   10:41:38  am', 'TK50N49', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'soporte tecnico', 'soporte t?cnico,  de la CPU de Limpieza Publica y Ornato y se encuentra inoperativo', 'SE ENCUENTRA INOPERATIVO, SE DARA DE BAJ.A', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '21/03/2023 12:09', '0'),
(59, '21/03/2023   10:52:04  am', 'TK27N50', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'RESOLUCIONES DE ALCALDIA DEL 2,010', 'ESCANEAR RESOLUCIONES DE ALCALDIA DEL 2,010', 'SE ESCANEOA LAS RESOLUCIONES DE ALCALDIA DEL 001 AL 399 DEL 2010.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '21/03/2023 10:53', '00'),
(60, '21/03/2023   10:53:59  am', 'TK89N51', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'ACUERDOS DE CONCEJO', 'ACUERDOS DE CONCEJO DEL 2010 ', 'SE ESCANEO LOS ACUERDOS DE CONCEJO CORRECTAMENTE DEL AO 2010. 001-046', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '21/03/2023 11:12', '00'),
(61, '21/03/2023   10:55:34  am', 'TK07N52', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'HACER PEDIDO DE SERVICIO', 'HACER PEDIDO DE SERVICIO DE LA CENTRAL TELEFONICA', 'SE REALIZO EL PEDIDO DE SERVICIO DE LOS EQUIPOS TELEFONICOS PARA LA MUNICIPALIDAD DE MDMM', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '24/03/2023 14:10', '00'),
(62, '21/03/2023   11:25:42  am', 'TK63N53', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'MANTENIMIENTO DE EQUIPO', 'MANTENIMIENTO DE EQUIPO', 'SE PROCEDIO A HACER EL MANTENIMIENTOA UNA CPU, Y QUEDO TODO CORRECTO, ESTA HABILITADO.', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '21/03/2023 11:26', '00'),
(63, '21/03/2023   11:27:51  am', 'TK01N54', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'RESOLUCION DE ALCALDIA', 'RESOLUCION DE ALCALDIA N? 075-2023-MDMM, PUBLICAR EN PORTAL DE TRANSPARENCIA', 'SE PUBLICO LA RESOLUCION EN EL PORTAL DE TRANSPARENCIA.', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '21/03/2023 14:36', '0'),
(64, '21/03/2023   11:32:03  am', 'TK00N55', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION DEL SIGA', 'INSTALACION DEL SIGA USUARIO JULIETA DEL AREA DE DESARROLLO HUMANO', '., SE INSTALO EL PROGRAMA SIGA, PARA EL USUSARIO DE DESARROLLO HUMANA. (JULIETA)', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '21/03/2023 12:08', '00'),
(65, '21/03/2023   12:45:04  pm', 'TK71N54', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'ACTUALIZACION DEL SISTEMA DE PLANILLAS', 'ACTUALIZACION DEL SISTEMA DE PLANILLAS, PARA EL AREA DE RECURSOS HUMANOS.', 'SE ACTUALIZACION DEL SISTEMA DE PLANILLAS, RESUELTO, PARA EL AREA DE RECURSOS HUMANOS..', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '21/03/2023 14:33', '00'),
(66, '21/03/2023   12:46:22  pm', 'TK74N55', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CORRECCION DEL SISTEMA DE TRAMITE DOCUMENTARIO .', 'CORRECCION DEL SISTEMA DE TRAMITE DOCUMENTARIO PARA EL AREA DE ESTADO CIVIL, PARA EL USUARIO BELEN', 'SE HIZO CORRECION DEL TRAMITE DOCUMENTARIO Y SOLUCIONO', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '21/03/2023 15:19', '00'),
(67, '21/03/2023   02:24:32  pm', 'TK86N56', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'ASESORIA', 'ASESORIA, PARA SABER MODEL DE TONER, PARA HACER REQUERIMIENTO , EN LA GERENCIA MUNICIPAL, USUARIO, SRA. CLARA.', '.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '21/03/2023 16:11', '00'),
(68, '21/03/2023   02:37:14  pm', 'TK66N57', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALAR EL SIGA', 'INSTALAR EL SIGA, EN SEDE PLAYA PARA EL USUARIO JOSEPH OLIVOS', 'SE INSTALO CORRECTAMENTE EL SIGA, EN SEDE PLAYA, PARA DICHO USUARIO.', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '21/03/2023 14:42', '00'),
(69, '21/03/2023   02:43:10  pm', 'TK54N58', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de equipo', 'INSTALACION DE EQUIPO', 'INSTALACION DE EQUIPO AL AREA DE ADMINISTRACION AL USUSARIO DR. ALAN. ', 'SE INSTALO CORRECTAMENTE EL EQUIPO', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '22/03/2023 08:23', '00'),
(70, '21/03/2023   03:11:04  pm', 'TK73N59', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Mantenimiento preventivo', 'REVISION DE IMPRSORA', 'REVISION DE IMPRSORA AL AREA DE TESORERIA, USUARIO MELISSA.', ' YA SE RESOLVIO EL TEMA DE LA IMPRESORA EN EL AREA DE TESORERIA.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '21/03/2023 16:15', '00'),
(71, '21/03/2023   03:13:19  pm', 'TK59N60', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'PROBLEMAS CON EL SIGA', 'PROBLEMAS CON EL SIGA, NO PUEDE CAMBIAR FECHA Y NO TIEN OPCION DE VB?, RENTAS 1ER PISO, USUARIO GIULIANA', 'SE RESOLVIO EL SIGA Y SE PUSO VB?', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '22/03/2023 11:22', '00'),
(72, '21/03/2023   03:31:59  pm', 'TK95N61', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE EQUIPO Y BACKUPS, PARA EL AREA DE ADMINISTRACION, PARA EL USUARIO', '.', 'ANTONIO QUINTANA PAETAN', '', 'Informatica', '25/03/2023 13:20', '00'),
(73, '21/03/2023   03:56:55  pm', 'TK38N62', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de equipo', 'Instalaci?n de equipo .', 'Instalaci?n de equipo . EN LA COMISARIA DE MAGDALENA DEL MAR SITO: Jr. Cuzco 756 , A LAS 8:30 AM.', 'SE REALIZO INSTALACION DE ANTIVIRUS, MICROSOFT OFFICE, INSTALACION DE IMPRESORAS (3) SOPORTE Y MANTENIMIENTO DE UN EQUIPO.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '22/03/2023 12:22', '00'),
(74, '21/03/2023   04:01:14  pm', 'TK34N63', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Revisi?n de Impresora', 'Revisi?n de Impresora EN EL AREA DE COACTIVO-RENTAS', 'LIMPIEZA DEL TONER RESIDUAL, Y QUEDO CONFORME.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '21/03/2023 16:16', '00'),
(75, '21/03/2023   04:05:12  pm', 'TK54N64', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'Revisi?n de l?neas telef?nicas', 'Revisi?n de l?neas telef?nicas AL AREA DE RECEPCION', 'SE REALIZO LA REVISION DE LA LINEA TELEFONICA Y QUEDO CONFORME.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '21/03/2023 16:08', '00'),
(76, '21/03/2023   04:17:39  pm', 'TK19N65', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'VERIFICACION DE CAJA', 'VERIFICACION DE CAJA DEL AREA DE TESORERIA', 'SE VERIFICO LA CAJA, Y QUEDO CORRECTAMENTE.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '22/03/2023 10:01', '00'),
(77, '21/03/2023   04:38:20  pm', 'TK04N66', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION', 'INSTALACION DE: ESCANER, Y LA CARPETA COMPARTIDA. PARA RECAUDACION AL USUARIO DE SARA SEGURA.', 'SE RESOLVIO EL PROBLEMA CON EL ESCANER Y LA CARPETA COMPARTIDA.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '22/03/2023 11:21', '00'),
(78, '21/03/2023   04:45:37  pm', 'TK63N67', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'TELEFONOS AVERIADOS', 'TELEFONOS AVERIADOS EN EL AREA DE CECOM -SEGURIDAD CIUDADANA SE COMUNICO LUIS HERBIAS.', 'SE HIZO EL CAMBIO DE CABLES, Y SE CAMBIO UN AURICULAR., PARA EL AREA DE CECOM.', 'EDWIN PEREZ RENDON', '', 'Informatica', '22/03/2023 15:25', '00'),
(79, '21/03/2023   05:01:14  pm', 'TK94N68', 'Resuelto', 'Jaime Aragon', 'jaime97j@gmail.com', 'Instalacion de equipo', 'Revisi?n de Equipos de Computo de Fiscalizaci?n', 'Usuario Thal?a comunica que los equipos de su ?rea de Fiscalizaci?n tienes problemas ', 'SE SOLUCIONO E\r\nLA CPU DE FISCALIZACION Y  CONTROL ', 'EDWIN PEREZ RENDON', '', 'Informatica', '23/03/2023 09:25', '.'),
(80, '22/03/2023   08:14:07  am', 'TK41N69', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de accesorios', 'instalacion del word', 'instalaci?n del Word en la oficina de administraci?n, al usuario Dr. Alan', 'SE ACTIVO EL TEMA DE LICENCIA WORD. SOLUCIONADO.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '22/03/2023 08:33', '.'),
(81, '22/03/2023   08:30:18  am', 'TK59N70', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de equipo', 'CONFIGURACION DE TV.', 'CONFIGURACION DE TV. PARA EL AREA DE GERENCIA MUNICIPAL', 'SE CONFIGURO EL TELEVISOR SATISFACTORIAMENTE.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '22/03/2023 08:33', '00'),
(82, '22/03/2023   08:45:12  am', 'TK03N71', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'No tiene acceso a internet', 'No tiene acceso a internet, EN LA HUACA HUANTILLE\r\n', 'Se soluciono el tema del internet,  cable mal colocado.', 'EDWIN PEREZ RENDON', '', 'Informatica', '22/03/2023 09:51', '00'),
(83, '22/03/2023   08:50:57  am', 'TK63N72', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Revisi?n de Impresora', 'Revisi?n de Impresora, EN EL AREA DE COACTIVO, SE ATRACA EL PAPEL', 'SE REVISO Y SE RESOLVIO EL PROBLEMA CON LA IMPRESORA.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '22/03/2023 12:47', '00'),
(84, '22/03/2023   09:35:33  am', 'TK25N73', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Actualizaci?n de horario', 'Actualizaci?n de horario para el Sistema de Tramite Documentario.', 'SE ACTUALIZO CORRECTAMENTE EL HORARIO PARA TRAMITE DOCUMENTARIO.', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '22/03/2023 12:49', '00'),
(85, '22/03/2023   10:06:49  am', 'TK64N74', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Bloqueado', 'Bloqueado  la pc del Usuario Giovanna de Contabilidad', 'HABILITACION DE MACRO', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '22/03/2023 10:53', '00'),
(86, '22/03/2023   10:38:31  am', 'TK15N75', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION DE UNA IMPRESORA', 'INSTALACION DE UNA IMPRESORA, YA ESTA VERIFICADA.', 'INSTALACION DE UNA IMPRESORA, YA ESTA VERIFICADA PARA EL AREA DE FISCALIZACION.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '22/03/2023 10:53', '.'),
(88, '22/03/2023   11:00:09  am', 'TK37N76', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'HABILITAR EL SIAF', 'HABILITAR EL SIAF, PARA EL AREA DE PRESUPUESTO PARA EL USUARIO C.ARAUSO', 'SE HABILITO EL USUARIO.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '23/03/2023 10:34', '00'),
(90, '22/03/2023   12:32:53  pm', 'TK22N78', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'HABILITAR CAMARA VIDEO', 'HABILITAR CAMARA VIDEO PARA EL AREA DE LOGISTICA, AL USUARIO SAID', 'INSTALACION DE APLICACION PARA HACER UN VIDEO.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '22/03/2023 12:48', '00'),
(91, '22/03/2023   02:52:19  pm', 'TK58N79', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Problemas en caja', 'Problemas en caja, en el ?rea de Tesorer?a.', 'SE REGISTRO EL SATMU EN CAJA 2 Y CAJA3.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '22/03/2023 17:13', '.'),
(92, '22/03/2023   04:31:12  pm', 'TK05N80', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'No puede imprimir', 'No puede imprimir, , en el ?rea de tesorer?a, con el Usuario Maruja.', 'CONFIGURACION DE IMPRESORA.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '22/03/2023 17:12', '00\r\n'),
(93, '22/03/2023   05:15:32  pm', 'TK03N80', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'BACKUPS', 'BACKUPS DE BASE DE DATOS DEL SISTEMA WEB', 'SE HIZO BACKUPS A LA BASE DE DATOS  DEL SISTEMA WEB', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '22/03/2023 17:16', '00'),
(94, '22/03/2023   05:18:29  pm', 'TK25N81', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'ESCANEAR RESOLUCIONES', 'ESCANEAR RESOLUCIONES  DEL A?O 2010', 'SE ESCANEO RESOLUCIONES DEL 400 AL 499 DEL A?O 2010', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '22/03/2023 17:20', '.'),
(95, '22/03/2023   05:55:47  pm', 'TK84N82', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'ESCANEAR DOCUMENTOS', 'ESCANEAR DOCUMENTOS DE PROYECTOS  PARA CONCEJO', 'SE ESCANEO RESOLUCIONES DE 400 AL 499, DEL A?O 2010', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '23/03/2023 08:28', '00'),
(96, '23/03/2023   08:20:38  am', 'TK36N83', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CREACION DE USUSARIO Y CONTRASE?A', 'CREACION DE USUSARIO Y CONTRASE?A, PARA EL AREA DE COMUNICACION AL USUSARIO KAMILA WENINGER\r\n', 'SE CREO EL USUSARIO Y CLAVE CORRECTAMENTE.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '23/03/2023 08:27', '.'),
(97, '23/03/2023   09:02:29  am', 'TK34N84', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CONFIGURACION', 'CONFIGURACION, DEL SISTEMA SATMU, EN EL AREA DE COACTIVO AL USUSARIO SR. LESMA.', 'SE INSTALO EL SATMU.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '23/03/2023 10:35', '.'),
(98, '23/03/2023   09:06:50  am', 'TK86N85', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de red', 'NO HAY INTERNET', 'NO HAY INTERNET EN SEDE PLAYA, USUARIO CAROLINA', '.', 'EDWIN PEREZ RENDON', '', 'Informatica', '23/03/2023 14:44', '.'),
(99, '23/03/2023   09:27:55  am', 'TK96N86', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de accesorios', 'INSATALACION DEL MEET', 'INSATALACION DEL MEET A LA GERENCIA MUNICIPAL', 'CONFIGURACION DEL MEET, EN GERENCIA MUNICIPAL', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '23/03/2023 14:26', '00'),
(100, '23/03/2023   09:31:13  am', 'TK81N87', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'NO ENCIENDE EL EQUIPO', 'NO ENCIENDE EL EQUIPO, DEL AREA DE SECRETARIA TECNICA', 'SE HIZO SOPORTE TECNICO, LIMPIEZA DE RAM, LIMPIEZA DE PLACA Y MANTENIMIENTO DE PLACA.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '23/03/2023 13:34', '00'),
(101, '23/03/2023   09:34:32  am', 'TK91N88', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSATALACION DEL ANYDESK', 'INSATALACION DEL ANYDESK, EN EL AREA DE CONTABILIDAD, AL USUARIO CLARISSA', 'SE INSTALO LA APLICACION ANYIDESK, CON LA AUTORIZACION DEL ING. LUIS AYARZA, PARA FINES CORRESPONDIENTES.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '23/03/2023 10:31', '00'),
(102, '23/03/2023   10:14:04  am', 'TK89N89', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'PROBLEMAS CON EL CPU', 'PROBLEMAS CON EL CPU, EN EL AREA DE DESARROLLO URBANO, USUARIO ELIZABETH', 'SE SOLUCIONO LO DEL CPU DE DESARROLLO URBANO.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '23/03/2023 10:20', '00'),
(103, '23/03/2023   10:37:53  am', 'TK40N90', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION WIFI', 'INSTALACION WIFI EN EL AREA DE OCI', 'SE INSTALO CORRECTAMENTE EL WIFI\r\n', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '23/03/2023 10:58', '0'),
(104, '23/03/2023   10:59:10  am', 'TK79N91', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CAMBIO DE FECHA EN SIGA', 'CAMBIO DE FECHA EN SIGA', 'SE PROCEDIO A CAMBIAR LA FECHA, Y SE HIZO INSTALACION DE IMPRESORA, EN EL AREA DE RECURSOS HUMANOS.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '23/03/2023 13:36', '00'),
(105, '23/03/2023   11:44:30  am', 'TK71N92', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Configuraci?n del Scanner', 'Configuraci?n del Scanner, en el ?rea de administraci?n, usuario Natty', 'Se hizo la configuraci?n del scanner en el ?rea de administraci?n, en el usuario de Natty', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '24/03/2023 10:59', '00'),
(106, '23/03/2023   12:57:50  pm', 'TK79N93', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CAMBIO DE FECHA DEL SIGA', 'CAMBIO DE FECHA DEL SIGA, PARA EL AREA DE COMERCIALIZACION\r\n', 'SE CAMBIO LA FECHA, Y SE CONFIGURO EL SCANNER PARA EL AREA DE COMERCIALIZACION.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '23/03/2023 13:32', '00'),
(107, '23/03/2023   02:24:52  pm', 'TK43N94', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE CAJA DEL AREA DE TESORERIA.', 'SE CONFIGURO LA CAJA DEL AREA DE TESORERIA.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '23/03/2023 14:26', '..'),
(108, '23/03/2023   02:28:03  pm', 'TK73N95', 'Anulado', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'No tiene acceso a internet', 'No tiene acceso a internet', '.', '', '', 'Informatica', '24/03/2023 08:58', '.'),
(109, '23/03/2023   02:29:01  pm', 'TK71N96', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'No tiene acceso a internet', 'NO TIENE ACCESO A INTERNET EN  GERENCIA MUNICIPAL', 'SE PUSO ACCESO A INTERNET, EN EL AREA DE GERENCIA MUNICIPAL', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '23/03/2023 14:32', '00'),
(110, '23/03/2023   02:37:59  pm', 'TK07N97', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CAMBIO DE MONITOR', 'CAMBIO DE MONITOR EN EL AREA DE CONTABILIDAD, AL USUARIO DE ANGELA MORI', 'SE HIZO EL CAMBIO CORRECTO DEL MONITOR.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '23/03/2023 15:21', '00'),
(111, '23/03/2023   03:24:30  pm', 'TK15N98', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'APOYO DE DIFUSION ', 'APOYO DE DIFUSION PARA CONVOCATORIA DEL PROCESO DE PRESUPUESTO PARTICIPATIVO 2024, PARA EL AREA DE PLANEAMIENTO Y PRESUPUESTO', 'Se creo la pestaa para los anexos de Presupuesto Participativo', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '24/03/2023 17:02', '00'),
(113, '23/03/2023   04:04:48  pm', 'TK72N100', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'PARAMETROS', 'PARAMETROS, ANULACION DEL NRO.83', 'SE ANULO EL  NRO. 83', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '23/03/2023 16:08', '.'),
(114, '23/03/2023   04:41:26  pm', 'TK86N101', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION DE OFFICE', 'INSTALACION DE OFFICE, EN LA OFICINA DE FISCALIZACION, AL USUARIO HECTOR', 'SE HIZO LA INSTALACION DEL OFFICE AL AREA DE FISCALIZACION.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '23/03/2023 17:08', '00'),
(115, '24/03/2023   08:08:50  am', 'TK27N102', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de equipo', 'instalaci?n de equipo', 'Instalaci?n de equipo en el ?rea de Desarrollo Humano, al usurario SERGIO TAPIA.', 'SE INSTALO EL EQUIPO EN DESARROLLO HUMANO.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '24/03/2023 08:49', '00'),
(116, '24/03/2023   08:11:18  am', 'TK14N103', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION DEL SATMU', 'INSTALACION DEL SATMU, EN EL AREA DE RENTAS, AL USUARIO GIULIANA\r\n', 'SE PROCEDIO ACTUALIZAR EL SATMU.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '24/03/2023 09:21', '00'),
(117, '24/03/2023   08:29:11  am', 'TK50N104', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION', 'CONFIGURACION DE EQUIPO DE IMPRESORA, DEL AREA DE PLATAFORMA-RENTAS\r\n', 'SE CONFIGURO CORRECTAMENTE LA IMPRESORA DE RENTAS.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '24/03/2023 09:23', '00'),
(118, '24/03/2023   09:24:53  am', 'TK13N105', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'CAMBIO DE IDIOMA', 'CAMBIO DE IDIOMA, SE REALIZO EN RECEPCION, USUARIO MARIA ESTHER.', 'SE CAMBIO CORRECTAMENTE EL IDIOMA', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '24/03/2023 11:06', '.'),
(119, '24/03/2023   09:30:32  am', 'TK81N106', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CARPETA COMPARTIDA', 'CARPETA COMPARTIDA (BUSCAR) ', 'SE BUSCO E INSTALO LA CARPETA COMPARTIDA', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '24/03/2023 10:09', '.'),
(120, '24/03/2023   10:10:55  am', 'TK34N107', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE EQUIPO A OTRA IMPRESORA, EN EL AREA DE PRESUPUESTO, USUARIO KATHY', 'SE CONFIGURO LA IMRESORA', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '24/03/2023 12:26', '00'),
(121, '24/03/2023   11:35:37  am', 'TK43N108', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'PROYECCION EN LA TELE', 'PROYECCION EN LA TELE EN ALCALDIA', 'SE HIZO LA CONEXION DE LA PROYEECION AL TELEVISOR', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '24/03/2023 11:36', '.'),
(122, '24/03/2023   11:41:59  am', 'TK49N109', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION DE APLICACION', 'INSTALACION DE APLICACION, SATMU,  EN EL AREA DE COACTIVO, USUARIO SRA. CECILIA', 'SE CONFIGURO EL SISTEMA SATMU.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '24/03/2023 12:26', '00'),
(124, '24/03/2023   12:27:33  pm', 'TK66N111', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE IMPRESORA Y SATMU, PARA EL AREA DE RECAUDACION, AL USUARIO KATHERINE DEXTRE', 'SE CONFIGURO CORRECTAMENTE.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '24/03/2023 12:28', '.'),
(125, '24/03/2023   12:29:19  pm', 'TK79N112', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE IMPRESORA Y SATMU', 'CONFIGURACION DE IMPRESORA Y SATMU EN LE AREA DE RECAUDACION', 'CONFIGURO CORRECTAMENTE LA IMPRESORA Y EL SATMU, USUARO HECTOR SANCHEZ', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '24/03/2023 12:33', '.'),
(126, '24/03/2023   12:29:58  pm', 'TK22N113', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'DESCARGAS DE ARCHIVOS PDF', 'DESCARGAS DE ARCHIVOS PDF EN EL AREA DE RECAUDACION, AL USUARIO SARA SEGURA', 'SE DESCARGO LOS ARCHIVOS CORRECTAMENTE.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '24/03/2023 12:34', '.'),
(127, '24/03/2023   01:42:42  pm', 'TK72N114', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE IMPRESORA EN EL AREA DE COMUNICACIONES.', 'SE CONFIGURO CORRECTAMENTE LA IMPRESORA', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '24/03/2023 14:18', '00'),
(128, '24/03/2023   02:07:50  pm', 'TK17N115', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CAMBIO DE FECHA DEL SIGA', 'CAMBIO DE FECHA DEL SIGA, PARA EL AREA DE COMERCIALIZACION USUARIO MAGDA TERRY', 'SE PROCEDIO HACER CAMBIO DE FECHA EN EL SIGA', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '24/03/2023 14:45', '00'),
(129, '24/03/2023   02:54:16  pm', 'TK84N116', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INGRESO EL DOMINIO', 'INGRESO EL DOMINIO, PARA EL AREA DE FISCALIZACION  CONTROL SANITARIO Y SANCIONES.', 'SE SOLUCIONO EL TEMA DEL DOMINIO.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '24/03/2023 14:55', '.'),
(130, '24/03/2023   03:11:53  pm', 'TK83N117', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CORRECCION DE LA BASE DE DATOS DE LOS PARAMETROS', 'CORRECCION DE LA BASE DE DATOS DE LOS PARAMETROS', '.', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '25/03/2023 13:20', '00'),
(131, '24/03/2023   03:13:47  pm', 'TK26N118', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CORRECION DE DOCUMENTOS', 'CORRECION DE DOCUMENTOS DE LA OFICINA DE CONTABILIDAD', 'Se corrigio la derivacion del documento', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '24/03/2023 17:00', '00'),
(132, '25/03/2023   01:15:39  pm', 'TK74N118', 'Resuelto', 'Jaime Aragon', 'jaime97j@gmail.com', 'Configuracion de equipo', 'Verificaci?n de las Pc de Caja Tesorer?a', 'Verificaci?n de las Pc de Caja Tesorer?a', 'Se procedio a revisar que las 05 Computadoras de Caja Ingresen al Sistemas SatmunXp', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '25/03/2023 13:16', '0000'),
(133, '25/03/2023   01:19:01  pm', 'TK42N119', 'Resuelto', 'Jaime Aragon', 'jaime97j@gmail.com', 'Configuracion de equipo', 'Verificaci?n de las Pc de Biblioteca', 'Verificaci?n de las Pc de Biblioteca', 'SE PROCEDIO A VALIDAR EL ACCESO A INTERNET DE LAS 10 COMPUTADORAS DEL AREA DE BIBLIOTECA CON CONEXION A INTERNET ', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '25/03/2023 13:20', '0000'),
(134, '27/03/2023   08:43:44  am', 'TK43N120', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'instalaci?n de aplicaci?n', 'instalaci?n de aplicaci?n para el ?rea de Contabilidad', 'se hizo instalaci?n KMS TICO, para office.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '27/03/2023 09:45', '00'),
(135, '27/03/2023   09:03:05  am', 'TK15N121', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'la contrase?a se ha vencido', 'la contrase?a se ha vencido , actualizar en el ?rea de Recursos Humanos.', '..', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '28/03/2023 17:06', '00'),
(136, '27/03/2023   09:04:37  am', 'TK71N122', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'configuraci?n de aplicaci?n', 'configuraci?n de aplicaci?n,  en el ?rea de administraci?n.', ' aplicacin,  en el rea de administracin, fue correctamente configurado.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '28/03/2023 09:53', '00'),
(137, '27/03/2023   09:06:02  am', 'TK81N123', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'no enciende la PC', 'no enciende la PC, en Sala de Regidores', 'ya se soluciono el tema', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '27/03/2023 10:32', '00'),
(138, '27/03/2023   09:06:31  am', 'TK87N124', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'configurar aplicacion', 'configurar aplicaci?n en  administraci?n\r\n\r\n', 'Se configuro correctamente ', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '27/03/2023 10:33', '00'),
(139, '27/03/2023   09:40:13  am', 'TK13N125', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'No tiene acceso a internet', 'No tiene acceso a internet, en la oficina de Rutte', '.Se  dio acceso al internet.', 'EDWIN PEREZ RENDON', '', 'Informatica', '27/03/2023 17:19', '00'),
(140, '27/03/2023   10:37:47  am', 'TK13N126', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de accesorios', 'NO TIENE ACCESO AL SATMU', 'NO TIENE ACCESO AL SATMU', 'ACTUALIZACION DEL SATMU', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '27/03/2023 11:16', '00'),
(141, '27/03/2023   11:43:11  am', 'TK85N127', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'PROBLEMAS CON EL SIAF', 'PROBLEMAS CON EL SIAF EN TESORERIA', 'SE SOLUCIONO EL TEMA DEL SIAF', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '28/03/2023 08:54', '.'),
(142, '27/03/2023   11:43:51  am', 'TK01N128', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO TELEFONICO ', 'CONFIGURACION DE EQUIPO TELEFONICO , EL ANEXO 714, EN RENTAS', 'Se dio soluci?n al anexo 714 en Plataforma -Rentas', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '27/03/2023 11:51', '.'),
(143, '27/03/2023   05:12:20  pm', 'TK73N129', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CAMBIO DE FECHA DEL SIGA', 'CAMBIO DE FECHA DEL SIGA', 'SE HIZO EL CAMBIO DE FECHA , PARA EL AREA DE RECURSOS HUMANOS.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '27/03/2023 17:14', '.'),
(144, '28/03/2023   08:50:02  am', 'TK16N130', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE EQUIPO, AREA DE RECURSOS HUMANOS', 'CONFIGURACION DE EQUIPO, AREA DE RECURSOS HUMANOS, DEL USUARIO ', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '28/03/2023 08:50', '.'),
(145, '28/03/2023   09:54:10  am', 'TK18N131', 'Anulado', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'se solicita baja de equipo', 'se solicita baja de equipo de impresora en el ?rea de Desarrollo Urbano y Obras\r\n', '.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '30/03/2023 16:06', '00'),
(146, '28/03/2023   11:06:39  am', 'TK67N132', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE EQUIPO SCANER EN EL AREA DE COACTIVO', 'SE CONFIGURO EL SCANER', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '30/03/2023 12:28', '00'),
(147, '28/03/2023   11:08:27  am', 'TK47N133', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'VALIDACION', 'VALIDACION DEL ANUYDESK EN CONTABILIDAD', 'VALIDACION DEL ANYDESK EN CONTABILIDAD', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '28/03/2023 11:10', '.'),
(148, '28/03/2023   03:45:15  pm', 'TK01N134', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'Revisi?n de equipo', 'Revisi?n de equipo, en el ?rea de Contabilidad.', 'Se soluciono el tema de Contabilidad, se puso un cable.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '28/03/2023 15:47', '.'),
(150, '28/03/2023   05:10:24  pm', 'TK73N135', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'configurar el scanner', 'configurar el scanner, en el ?rea de coactiva.', 'cambiar de ftp a fmb', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '28/03/2023 18:03', '0'),
(151, '29/03/2023   08:37:55  am', 'TK36N136', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'No tiene acceso a internet', 'No tiene acceso a internet en el ?rea de desarrollo humano, una laptop, usuaria Ver?nica.\r\n\r\n', 'SE PUSO INTERNERT A LA LAPTOP DEL USUARIO.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '30/03/2023 09:25', '00'),
(152, '29/03/2023   10:47:14  am', 'TK95N137', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION DE EQUIPO', 'INSTALACION DE EQUIPOS , CAJAS EN EL MERCADO', '.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '29/03/2023 10:49', '00'),
(153, '29/03/2023   10:49:24  am', 'TK60N138', 'En proceso', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'ACTUALIZACION EN EL SISTEMA DE TICKETS.', 'ACTUALIZACION EN EL SISTEMA DE TICKETS.', '.', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '29/03/2023 10:51', '0'),
(154, '29/03/2023   10:51:47  am', 'TK68N139', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'TABLA DE DOCUMENTOS EN P.T.', 'TABLA DE DOCUMENTOS SUBIR EN EL P.T.', 'TABLA DE DOCUMENTOS SUBIDO EN EL PORTAL DE TRANSPARENCIA.', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '29/03/2023 10:53', '.'),
(156, '29/03/2023   10:53:29  am', 'TK22N141', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'MODULO DE PRESUSPUESTO PARTICIPATIVO', 'MODULO DE PRESUSPUESTO PARTICIPATIVO 2024', 'MODULO DE PRESUSPUESTO PARTICIPATIVO 2024, esta correcto.', '', '', 'Informatica', '29/03/2023 12:38', '.'),
(157, '29/03/2023   12:37:40  pm', 'TK90N142', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Instalaci?n de equipos', 'Instalaci?n de equipos en el mercado', 'Instalaci?n de equipos en el mercado para el cobro de arbitrios del dia lunes 27', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '29/03/2023 12:39', '.'),
(158, '29/03/2023   12:40:41  pm', 'TK48N143', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Instalaci?n de equipos', 'Instalaci?n de equipos, en Marbella, para el cobro de arbitrios del d?a s?bado 25/03', 'Instalacin de equipos, en Marbella, para el cobro de arbitrios del dia sbado 25/03, ', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '29/03/2023 12:46', '.'),
(159, '29/03/2023   12:41:32  pm', 'TK90N144', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Instalaci?n de equipos', 'Instalaci?n de equipos en mercado para el cobro de arbitrios del dia martes 28', 'Instalacin de equipos en mercado para el cobro de arbitrios del da martes 28', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '29/03/2023 12:43', '.'),
(160, '29/03/2023   04:52:34  pm', 'TK09N145', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE IMPRESORA EN EL AREA DE ESTADO CIVIL,', 'SE SOLUCIONO LA IMPRESORA DEL AREA DE ESTADO CIVIL.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '30/03/2023 08:51', '0'),
(161, '30/03/2023   08:32:53  am', 'TK86N146', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Clave de usuario', 'CLAVE DE USUARIO', 'CLAVE DE USUARIO, EN EL AREA DE RECURSOSO HUMANOS, AL USUARIO , MERCEDES.', 'SE CAMBIO LA CONTARSE?A DEL USUARIO A PETICION .', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '30/03/2023 08:33', '.'),
(162, '30/03/2023   08:34:40  am', 'TK72N147', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'MANTENIMIENTO DE EQUIPO ', 'MANTENIMIENTO DE EQUIPO  PREVENTIVOS DE LAS CAJAS DEL MERCADO', 'SE HIZO CORRECTAMENTE EL MANTENIMIENTO PREVENTIVO EN EL MERCADO DE MAGDALENA DEL MAR.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '30/03/2023 08:38', '.'),
(163, '30/03/2023   08:35:43  am', 'TK42N148', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO', 'MANTENIMIENTO DE IMPRESORA, EN EL AREA DE RENTAS ( 1ER PISO), USUARIA PATRICIA.', 'SE HIZO EL MANTENIMIENTO PREVENTIVO.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '30/03/2023 09:25', '0'),
(164, '30/03/2023   08:39:04  am', 'TK03N149', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE EQUIPO, EN EL ARAE DE RIESGOS Y DESASTRES, NO ENCIENDE EL CPU, DEL USUARIO DAYELI. ', 'SE CONFIGURO IMPRESORA Y SE HIZO TRASLADO DE EQUIPO.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '30/03/2023 15:10', '0'),
(165, '30/03/2023   08:41:23  am', 'TK50N150', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de accesorios', 'INSTALACION DEL SATMU', 'INSTALACION DEL SATMU, EN EL AREA DE FISCALIZACION, CONTROL SANITARIO Y SANCIONES.', 'SE INSTALO CORRECTAMENTE EL SATMU EN DOS CPU.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '30/03/2023 09:57', '0'),
(166, '30/03/2023   08:53:12  am', 'TK32N151', 'Pendiente', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CREACION DE USUARIO', 'CREACION DE USUARIO PARA BIBLIOTECA A LOS USUARIOS, SUASAN Y RICHARD', '.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '30/03/2023 08:57', '0'),
(167, '30/03/2023   08:57:45  am', 'TK11N152', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de equipo', 'Instalaci?n de Equipo', 'INSTALACION DE IMPRESORA Y SCANNER, PARA LA BIBLIOTECA.', 'SE INSTALO LA IMPRESORA Y EL SCANER, N BIBLIOTECA, USUARIO SUSANA ESPINOZA.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '30/03/2023 11:44', '0'),
(168, '30/03/2023   09:19:45  am', 'TK85N153', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CORRECION DE TRAMITE DOCUMENTARIO', 'CORRECION DE TRAMITE DOCUMENTARIO', 'CORRECION DE TRAMITE DOCUMENTARIO, EN EL AREA DE PRESUPUESTO DEL USUARIO GEORGE', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '30/03/2023 09:23', '.'),
(169, '30/03/2023   09:26:33  am', 'TK74N154', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE IMPRESORA, SE ATASCA EL PAPEL., ( PLATAFORMA)', 'IMPRESORA CONFIGURADA', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '30/03/2023 09:57', '0'),
(170, '30/03/2023   10:47:44  am', 'TK45N155', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'PROBLEMAS CON TRAMITE DOCUMENTARIO', 'PROBLEMAS CON TRAMITE DOCUMENTARIO, EN EL AREA DE GERENCIA MUNICIPAL.', 'ESTA SOLUCIONADO LO DEL SISTEMA DE TRAMITE.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '30/03/2023 10:51', '.');
INSERT INTO `ticket` (`id`, `fecha`, `serie`, `estado_ticket`, `nombre_usuario`, `email_cliente`, `departamento`, `asunto`, `mensaje`, `solucion`, `tecnico`, `mes`, `area`, `fecha_solucion`, `codequipo`) VALUES
(171, '30/03/2023   10:51:34  am', 'TK79N156', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CREACION DE REUNION VIRTUAL', 'CREACION DE REUNION VIRTUAL,  PARA SESION DE CONCEJO.', 'SE CREO LA SALA VIRTUAL PARA SESION DE CONCEJO.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '30/03/2023 10:52', '.'),
(172, '30/03/2023   10:53:40  am', 'TK69N157', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacicion, mantenimiento y actualizacion de software', 'INSTALACION DE SOFTWARE ', 'INSTALACION DE SOFTWARE SIGA-MEF-USUARIOS PATRIMONIO- ARONI, CHAVEZ.', '.\r\nINSTALACION DE SOFTWARE SIGA-MEF-USUARIOS PATRIMONIO- ARONI, CHAVEZ., SE HIZO TODO BIEN.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '30/03/2023 11:20', '0'),
(173, '30/03/2023   11:30:08  am', 'TK80N158', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'APOYO A MERCADO', 'APOYO A LAS CAJAS DE MERCADO', 'APOYO A LAS CAJAS DE MERCADO, SOLUCIONADO', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '30/03/2023 11:46', '.'),
(174, '30/03/2023   11:47:17  am', 'TK86N159', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'REVISAR UN EQUIPO', 'REVISAR UN EQUIPO, DEL AREA DE DESARROLLO URBANO Y OBRAS', 'SE REVISO Y ESTA PAEA DARLE DE BAJA.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '30/03/2023 15:10', '0'),
(175, '30/03/2023   12:00:11  pm', 'TK59N160', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CAMBIO DE FECHA DEL SIGA', 'CAMBIO DE FECHA DEL SIGA AREA PRESUPUESTO, USUARIO, DZAMORA', 'SE SOLUCIONO EL TEMA DEL SIGA', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '30/03/2023 12:14', '.'),
(176, '30/03/2023   12:17:50  pm', 'TK34N161', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Instalaci?n de DE SOTFWARE', 'Instalaci?n de DE SOTFWARE SIAF, PARA EL AREA DE CONTABILIDAD. ', 'INSTALACION DEL SIAF\r\n\r\n', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '30/03/2023 12:26', '0'),
(177, '30/03/2023   12:23:23  pm', 'TK57N162', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de red', 'No tiene acceso a internet', 'No tiene acceso a internet EN LA HUACA', 'SE INSTALO EL INTERNET EN LA HUACA HUANTYLLE', 'EDWIN PEREZ RENDON', '', 'Informatica', '30/03/2023 12:23', '.'),
(178, '30/03/2023   12:46:32  pm', 'TK42N161', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'Acceso a Internet', 'Acceso a Internet', 'SE DIO ACCESO DE INTERNET, PARA EL PROGRAMA DE VACACIONES UTILES, Y SE CREO USUARIO.', 'CRISTIAN SANCHEZ VIVAR', '', 'Informatica', '30/03/2023 14:07', '.'),
(179, '30/03/2023   02:23:29  pm', 'TK73N162', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION DEL SATMU', 'NSTALACION DEL SATMU EN EL AREA DE COACTIVA', 'SE HIZO LA INSTALACION DEL SATMU .', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '30/03/2023 15:11', '0'),
(180, '30/03/2023   03:12:03  pm', 'TK02N163', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'APOYO EN EL MERCADO', 'APOYO EN EL MERCADO PARA EL COBRO DE ARBITRIOS.', 'SE APOYO EN REMOTO A LAS CAJAS DEL MERCADO.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '30/03/2023 15:13', '.'),
(181, '30/03/2023   03:22:21  pm', 'TK49N164', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Clave de usuario', 'CAMBIO DE CLAVE A USUARIO', 'CAMBIO DE CLAVE  Y CONTRASE?A A USUARIO.', 'CAMBIO DE CLAVE  Y CONTRASEA A USUARIO, DEL AREA DE TRAMITE DOCUMENTARIO.-', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '30/03/2023 15:48', '.'),
(182, '30/03/2023   03:42:46  pm', 'TK79N165', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO TELEFONICO ', 'CONFIGURACION DE EQUIPO, EN EL AREA DE COMUNICACIONES', 'SE REINICIO EL EQUIPO , PARA LA CONFIGURACION RESPECTIVA.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '30/03/2023 15:55', '0'),
(183, '30/03/2023   03:48:31  pm', 'TK28N166', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE IMPRESORA Y USUARIO', 'CONFIGURACION DE IMPRESORA Y USUARIO PARA EL AREA DE RECURSOS HUMANOS.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '30/03/2023 15:49', '.'),
(184, '30/03/2023   03:50:37  pm', 'TK16N167', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'VALIDACION DEL INTERNET', 'VALIDACION DEL INTERNET PARA EL AREA DE OMAPED.', 'SE HIZO LA VALIDACION, PARA EL AREA DE OMAPED DE INTERNET.', '', '', 'Informatica', '30/03/2023 15:53', '.'),
(185, '30/03/2023   03:56:20  pm', 'TK42N168', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO TELEFONICO ', 'SE CONFIGURO EL TECLADO Y MOUSE DEL  AREA DE RECURSOS HUMANOS , DEL USUARIO TERESA ROJAS.', 'SE CONFIGURO EL TECLADO Y MOUSE DEL  AREA DE RECURSOS HUMANOS , DEL USUARIO TERESA ROJAS.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '30/03/2023 15:58', '.'),
(186, '30/03/2023   03:59:08  pm', 'TK58N169', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE  IMPRESORA TERMICA ', 'SE CONFIGURO CORRECTAMENTE LA IMPRESORA TERMICA, UBICADA EN LEL MERCADO.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '30/03/2023 16:00', '.'),
(187, '30/03/2023   04:01:28  pm', 'TK99N170', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION DE CABLE', 'INSTALACION DE CABLE, EN SALA DE REGIDORES, PARA SESION VIRTUAL DE CONCEJO.', 'SE INSTALO EL CABLE PARA LA SESION VITUAL DE UNA REGIDORA.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '31/03/2023 09:25', '00'),
(188, '30/03/2023   04:04:20  pm', 'TK92N171', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALAR PROYECTOR', 'INSTALAR PROYECTOR, EN LA SALA DE SESIONES PARA CONCEJO', 'SE INSTALO EL PROYECTOR PARA LA SESION DE CONCEJO,HASTA LA HORA REQUERIDA POR EL USUARIO.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '31/03/2023 08:46', '0'),
(189, '31/03/2023   09:15:06  am', 'TK58N172', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Configuracion de equipo', 'CONFIGURACION DE EQUIPO', 'CONFIGURACION DE EQUIPO, DE TESORERIA.', 'CONFIGURACION DE EQUIPO, DE TESORERIA., DOS CAJAS', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '31/03/2023 10:25', '.'),
(190, '31/03/2023   09:26:06  am', 'TK41N173', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'No tiene acceso a internet', 'No tiene acceso a internet, UN CPU DEL AREA DE PATRIMONIO.', 'SE PUSO EL ACCESO A LA CPU DE PATRIMONIO.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '31/03/2023 10:27', '0'),
(191, '31/03/2023   09:26:45  am', 'TK21N174', 'Pendiente', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'APOYO LOGISTICO', 'APOYO LOGISTICO PARA INSTALAR UN PROYECTOR Y UNA LAPTOP , PARA LOS DIA 11,14,18 DE ABRIL  Y 05 DE MAYO, EN EL TALLER DEL PILAR, UBICADO EN JIRON SAN MARTIN # 275 MDMM.', '.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '31/03/2023 09:33', '0'),
(192, '31/03/2023   09:34:06  am', 'TK75N175', 'Pendiente', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'SOLICITA ESPECIFICACIONES TECNICAS ', 'PARA ADQUISICION DE COMPUTADORAS PARA EL AREA DE ADULTO MAYOR, OMAPED, DEMUNA.', '.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '31/03/2023 09:36', '0'),
(193, '31/03/2023   09:38:45  am', 'TK39N176', 'Pendiente', 'Carola Campos ', 'ccampos@gmail.com', 'Escoja una opcion', 'PRESTAMO DE EQUIPO MULTIMEDIA.', 'PRESTAMO DE EQUIPO MULTIMEDIA, UN PROYECTOR UNA LAPTOP , PARA EL AREA DE GESTION DE RIESGOS DE DESASTRES, PARA EL DIA MARTES 04 DE ABRIL DE 08 : 00 A 17:00 HORAS EN SALA DE SESIONES .', '.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '31/03/2023 09:42', '0'),
(194, '31/03/2023   09:42:51  am', 'TK59N177', 'Pendiente', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'ACCESO A LAS PAGINAS WEB Y COMPARTIDO', 'ACCESO A LAS PAGINAS WEB Y COMPARTIDO, PARA EL AREA DE GESTION DEL RIESGO DE DESASTRES.', '.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '31/03/2023 09:44', '0'),
(195, '31/03/2023   10:44:05  am', 'TK16N178', 'Pendiente', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CAMBIO DE FECHA DEL SIGA', 'CAMBIO DE FECHA DEL SIGA', '.', 'JOSE GUERRERO', '', 'Informatica', '31/03/2023 10:45', '0'),
(196, '31/03/2023   10:49:17  am', 'TK44N179', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'ACTUALIZACION DEL SIGA', 'ACTUALIZACION DEL SIGA, EN EL AREA DE PATRIMONIO, RECONFIGURACION DE DISPOSITIVOS, ( TECLADO , MOUSSE). AL USUARIO CLARA.', 'SE ACTUALIZO EL SIGA, Y SE RECONFIGURO CORRECTAMENTE LOS DISPOSITIVOS.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '31/03/2023 10:54', '.'),
(197, '31/03/2023   10:56:09  am', 'TK24N180', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Instalacion de equipo', 'INSTALACION Y SUPERVISION DE EQUIPOS ', 'PARA EL CORRECTO FUNCIONAMIENTO DE LAS CAJAS HABILITADAS EN EL MERCADO, PARA EL COBRO DE LOS ARBITRIOS.', 'SE HIZO INSTALACION Y SUPERVISION DE EQUIPOS .', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '31/03/2023 11:38', '.'),
(198, '31/03/2023   11:25:03  am', 'TK52N181', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'COPIAR EL EJECUTABLE', 'COPIAR EL EJECUTABLE AL ESCRITORIO EN CAJA-TESORERIA.', 'COPIAR EL EJECUTABLE AL ESCRITORIO EN CAJA-TESORERIA. SE HIZO CORRECTAMENTE .', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '31/03/2023 11:26', '.'),
(199, '31/03/2023   11:39:03  am', 'TK56N182', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CONFIGURACION DE SOFTWARE', 'CONFIGURACION DE SOFTWARE (SIGA) EN EL AREA DE COACTIVO, USUARIO CECILIA.', 'SE CONFIGURO CORRECTAMENTE EL SATMU.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '31/03/2023 12:47', '0'),
(200, '31/03/2023   11:44:47  am', 'TK61N183', 'Pendiente', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION DE COMPARTIDO, Y PAGINAS WEB.', 'INSTALACION DE COMPARTIDO, Y PAGINAS WEB., PARA EL AREA DE RIESGOS DE DESASTER, AL USUARIO ARQ. ROMINA.', '.', 'JAIME ARAGON ESCOBAR', '', 'Informatica', '31/03/2023 12:49', '0'),
(201, '31/03/2023   11:56:35  am', 'TK77N184', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CAMBIO DE FECHA DEL SIGA', 'CAMBIO DE FECHA DEL SIGA, PARA EL AREA DE FISCALIZACION CONTROL SANITARIO Y SANCIONES.', 'SE CAMBIO LA FECHA DEL SIGA A PEDIDO DEL USUARIO.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '31/03/2023 11:57', '.'),
(202, '31/03/2023   11:59:01  am', 'TK18N185', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CONFIGURACION DEL SATMU', 'CONFIGURACION DEL SATMU, PARA 5 CPU,  PARA EL AREA DE FISCALIZACION CONTROL SANITARIO Y SANCIONES', 'SE INSTALO EL SATMU PARA 5 CPU.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '31/03/2023 12:00', '.'),
(203, '31/03/2023   12:50:07  pm', 'TK95N186', 'Pendiente', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'INSTALACION DEL SATMU', 'INSTALACION DEL SATMU, EN EL AREA DE RECAUDACION, USUARIO HECTOR.', '.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '31/03/2023 12:51', '0'),
(204, '31/03/2023   12:52:06  pm', 'TK89N187', 'Pendiente', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'SOPORTE EN RENTAS', 'SOPORTE EN RENTAS, USUARIO RAQUEL .', '.', 'ANCEL JULCAMORO CELMI', '', 'Informatica', '31/03/2023 15:22', '0'),
(205, '31/03/2023   03:19:54  pm', 'TK41N188', 'Resuelto', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'CONFIGURACION DE SCANNER', 'CONFIGURACION DE SCANNER, EN OFICNA DE OCI, USUARIO DIEGO HURTADO', 'CONFIGURACION DE SCANNER, EN OFICNA DE OCI, USUARIO DIEGO HURTADO', '', '', 'Informatica', '31/03/2023 15:22', '.'),
(206, '31/03/2023   03:20:58  pm', 'TK09N189', 'En proceso', 'Carola Campos ', 'ccampos@gmail.com', 'Otros', 'HABILITACION DEL SITRADOC', 'HABILITACION DEL SITRADOC, USUARIO CAMILA', '.', 'CESAR MUNOZ BERROCAL', '', 'Informatica', '31/03/2023 15:22', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `correo` (`email_admin`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `id_num` (`email_cliente`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serie` (`serie`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
