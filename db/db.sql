CREATE TABLE usuario
(
	idUsuario		INT AUTO_INCREMENT PRIMARY KEY,
    nome			VARCHAR(100),
    email			VARCHAR(100),
    perfil			VARCHAR(100),
    saldo			INT,
    situacao		INT,
    senha			VARCHAR(100)
);

CREATE TABLE categoria
(
	idCategoria			INT AUTO_INCREMENT PRIMARY KEY,
    nome				VARCHAR(100),
    valor				INT
);

CREATE TABLE item
(
	idItem			INT AUTO_INCREMENT PRIMARY KEY,
    quantidade		INT,
    dtEntrega		DATETIME DEFAULT CURRENT_TIMESTAMP,
    idUsuario		INT,
    idCategoria		INT,
    CONSTRAINT fkItemUsuario FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario),
    CONSTRAINT fkItemCategoria FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria)    
);

CREATE TABLE venda
(
	idVenda			INT AUTO_INCREMENT PRIMARY KEY,
    dtVenda			DATETIME DEFAULT CURRENT_TIMESTAMP,
    quantidade		INT,
    idCategoria		INT,
    idVendedor		INT,
    idComprador		INT,
    CONSTRAINT fkVendaCategoria FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria),
    CONSTRAINT fkVendaVendedor FOREIGN KEY (idVendedor) REFERENCES usuario (idUsuario),
    CONSTRAINT fkVendaComprador FOREIGN KEY (idComprador) REFERENCES usuario (idUsuario)
);

CREATE VIEW vwitens
AS
SELECT 
	c.nome AS nomeItem,
    i.quantidade,
    u.nome AS nomeUsuario,
    i.dtEntrega
FROM item i 
JOIN usuario u ON u.idUsuario = i.idUsuario
JOIN categoria c ON c.idCategoria = i.idCategoria

CREATE VIEW vwvendas
AS
SELECT 
	v.dtVenda,
	v.quantidade,
	c.nome AS categoria,
	vnd.nome AS vendedor,
	cmp.nome AS compradora
FROM venda v
JOIN categoria c ON c.idCategoria = v.idCategoria
JOIN usuario vnd ON vnd.idUsuario = v.idVendedor
JOIN usuario cmp ON cmp.idUsuario = v.idComprador

DELIMITER //
CREATE PROCEDURE piItem
(
	IN	_quantidade		INT,
    IN	_usuario		INT,
    IN	_categoria		INT
)
BEGIN
	INSERT INTO item (quantidade, idUsuario, idCategoria, dtEntrega)
    VALUES (_quantidade, _usuario, _categoria, CURRENT_TIMESTAMP);
    
   SELECT valor INTO @valor FROM categoria WHERE idCategoria = _categoria;
    
    UPDATE usuario 
    	SET saldo = saldo + (@valor * _quantidade)
    WHERE idUsuario = _usuario;
END //

DELIMITER //
CREATE PROCEDURE piVenda
(
	IN _vendedor	INT,
    IN _comprador	INT,
    IN _quantidade	INT,
    in _categoria	INT
)
BEGIN
	INSERT INTO venda (idVendedor, idComprador, quantidade, idCategoria)
    VALUES (_vendedor, _comprador, _quantidade, _categoria);
    
    SELECT valor INTO @valor FROM categoria WHERE idCategoria = _categoria;
    
    UPDATE usuario
    	SET saldo = saldo - (_quantidade * @valor)
    WHERE idUsuario = _comprador;
END //