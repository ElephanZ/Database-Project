/* Op. 1 */

INSERT INTO client VALUES ('CSTDNL66B45C351T', 'Daniela', 'Castello', '1966-02-05');
INSERT INTO contact VALUES ('dani.castello@libero.it', 'email');
INSERT INTO own VALUES ('CSTDNL66B45C351T', 'dani.castello@libero.it');

/* Op. 2 */

INSERT INTO device VALUES ('XHG90RR', 'Apple', 'iPhone XR 64G', 'smartphone', 'CSTDNL66B45C351T');

/* Op. 3 */

INSERT INTO operation (vat, labor, slot_id, device_id, technician_id) VALUES (22, 27, 54, 'XHG90RR', 'DMNMSM84A02C351O');
INSERT INTO reparation (trouble, note, operation_id) VALUES ('vetro frantumato', 'in alcuni punti il touch funziona ancora', 7);

/* Op. 4 */

INSERT INTO material VALUES ('APPLVTR', 'schermo di ricambio', 51.5, '', 10);

/* Op. 5 */

SELECT o.technician_id, o.date_pickup, r.trouble, s.wall, s.rw, s.colmn, d.sn, d.brand, d.model, c.fc, c.name, c.surname, own.contact_id
FROM operation o JOIN reparation r ON r.operation_id = o.id JOIN device d ON d.sn = o.device_id JOIN client c ON c.fc = d.client_id JOIN own ON c.fc = own.client_id JOIN slot s ON s.id = o.slot_id
WHERE o.id = 7;

-- ----------------------------------------------------

DELIMITER $$  

DROP FUNCTION IF EXISTS calculateVAT $$
CREATE FUNCTION calculateVAT(cost DECIMAL(5, 2), labor INT(3), vat INT(2)) RETURNS DECIMAL(6, 2)
BEGIN
    DECLARE amount DECIMAL(6, 2) DEFAULT (labor + cost);
    DECLARE calculated_vat DECIMAL(6, 2) DEFAULT ((amount * vat) / 100);
    RETURN amount + calculated_vat;
END$$

DELIMITER ; 

-- ----------------------------------------------------

/* Op. 6 */

SELECT MONTH(CURRENT_DATE()) AS mese_corrente, SUM(calculateVAT(total_cost, labor, vat)) AS costo_mensile
FROM operation
WHERE date_delivery IS NOT NULL AND MONTH(date_delivery) = MONTH(CURRENT_DATE()) AND YEAR(date_delivery) = YEAR(CURRENT_DATE());

/* Op. 7 */

SELECT technician_id, MONTH(CURRENT_DATE()) AS mese_corrente, SUM(calculateVAT(total_cost, labor, vat)) AS costo_mensile
FROM operation
WHERE date_delivery IS NOT NULL AND MONTH(date_delivery) = MONTH(CURRENT_DATE()) AND YEAR(date_delivery) = YEAR(CURRENT_DATE());
GROUP BY technician_id;

/* Op. 8 */

SELECT technician_id
FROM operation
GROUP BY technician_id
HAVING COUNT(id) = (
    SELECT MAX(counting)
    FROM (
        SELECT COUNT(id) AS counting
        FROM operation
        WHERE date_delivery IS NOT NULL AND MONTH(date_delivery) = MONTH(CURRENT_DATE()) AND YEAR(date_delivery) = YEAR(CURRENT_DATE());
        GROUP BY technician_id
    ) AS counting
);

/* Op. 9 */

SELECT id 
FROM operation 
WHERE (calculateVAT(total_cost, labor, vat)) = (
    SELECT MAX(total)
    FROM (
        SELECT (calculateVAT(total_cost, labor, vat)) AS total
        FROM operation
        WHERE date_delivery IS NOT NULL AND MONTH(date_delivery) = MONTH(CURRENT_DATE()) AND YEAR(date_delivery) = YEAR(CURRENT_DATE());
    ) AS costs
);