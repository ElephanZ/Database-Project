DELIMITER $$  

DROP FUNCTION IF EXISTS calculateVAT $$
CREATE FUNCTION calculateVAT(cost DECIMAL(5, 2), labor INT(3), vat INT(2)) RETURNS DECIMAL(6, 2)
BEGIN
    DECLARE amount DECIMAL(6, 2) DEFAULT (labor + cost);
    DECLARE calculated_vat DECIMAL(6, 2) DEFAULT ((amount * vat) / 100);
    RETURN amount + calculated_vat;
END$$

DELIMITER ; 
