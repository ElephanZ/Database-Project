DELIMITER $$  

-- Update total_cost in Operation every time a material is inserted in Material among those useful for the repair. 

CREATE TRIGGER total_cost_update_i
AFTER INSERT ON material
FOR EACH ROW 
BEGIN
    UPDATE reparation r, operation o
    SET o.total_cost = o.total_cost + NEW.cost
    WHERE NEW.reparation_id = r.id AND r.operation_id = o.id;
END$$

-- Update total_cost in Operation every time a material useful for repair is deleted in Material.

CREATE TRIGGER total_cost_update_d
AFTER DELETE ON material
FOR EACH ROW 
BEGIN
    UPDATE reparation r, operation o
    SET o.total_cost = o.total_cost - OLD.cost
    WHERE OLD.reparation_id = r.id AND r.operation_id = o.id;
END$$

-- Prevents the insertion of a device into an already occupied slot.

CREATE TRIGGER check_slot_empty
BEFORE INSERT ON operation
FOR EACH ROW
BEGIN
    IF (NEW.slot_id IN ( 
        SELECT slot_id
        FROM operation
        WHERE date_delivery IS NULL
    )) 
    THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Slot already occupied';
    END IF;
END$$

DELIMITER ;
