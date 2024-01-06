CREATE TABLE ticket2 (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cliente_id BIGINT(20) UNSIGNED NOT NULL,
    tecnico_id BIGINT(20) UNSIGNED NOT NULL,
    dni VARCHAR(8) NOT NULL,
    nombres VARCHAR(15) NOT NULL,
    apellido_paterno VARCHAR(10) NOT NULL,
    apellido_materno VARCHAR(10) NOT NULL,
    cargo VARCHAR(25) NOT NULL,
    email VARCHAR(30) NOT NULL,
    asunto VARCHAR(195) NOT NULL,
    descripcion VARCHAR(195) NOT NULL,
    archivos_ruta VARCHAR(255) DEFAULT NULL,
    estado BOOLEAN DEFAULT 0,
    FOREIGN KEY (cliente_id) REFERENCES cliente(id),
    FOREIGN KEY (tecnico_id) REFERENCES tecnico(id)
);