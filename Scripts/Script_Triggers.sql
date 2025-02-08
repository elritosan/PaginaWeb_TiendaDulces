DELIMITER $$

CREATE TRIGGER actualizar_estado_entrega
AFTER UPDATE ON pedidos
FOR EACH ROW
BEGIN
    IF NEW.estado = 'enviado' THEN
        UPDATE entregas 
        SET estado = 'en camino' 
        WHERE id_pedido = NEW.id;
        
    ELSEIF NEW.estado = 'entregado' THEN
        UPDATE entregas 
        SET estado = 'entregado' 
        WHERE id_pedido = NEW.id;

    ELSEIF NEW.estado = 'cancelado' THEN
        UPDATE entregas 
        SET estado = 'cancelado' 
        WHERE id_pedido = NEW.id;
    END IF;
END $$

DELIMITER ;