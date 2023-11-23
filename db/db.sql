CREATE TABLE venda
(
	idVenda			INT AUTO_INCREMENT PRIMARY KEY,
    dtVenda			DATETIME DEFAULT CURRENT_TIMESTAMP,
    quantidade		INT,
    idVendedor		INT,
    idComprador		INT,
    idCategoria		INT,
    CONSTRAINT fkVendaVendedor FOREIGN KEY (idVendedor) REFERENCES usuario (idUsuario),
    CONSTRAINT fkVendaComprador FOREIGN KEY (idComprador) REFERENCES usuario (idUsuario),
    CONSTRAINT fkVendaCategoria FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria)
)

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