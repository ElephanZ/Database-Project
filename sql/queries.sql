-- Get data correlate to operation

SELECT o.technician_id, o.date_pickup, r.trouble, s.wall, s.rw, s.colmn, d.sn, d.brand, d.model, c.fc, c.name, c.surname, own.contact_id
FROM operation o JOIN reparation r ON r.operation_id = o.id JOIN device d ON d.sn = o.device_id JOIN client c ON c.fc = d.client_id JOIN own ON c.fc = own.client_id JOIN slot s ON s.id = o.slot_id
WHERE o.id = 7;

-- Calculation of the total monthly profit

SELECT MONTH(CURRENT_DATE()) AS mese_corrente, SUM(calculateVAT(total_cost, labor, vat)) AS costo_mensile
FROM operation
WHERE date_delivery IS NOT NULL AND MONTH(date_delivery) = MONTH(CURRENT_DATE()) AND YEAR(date_delivery) = YEAR(CURRENT_DATE());

-- Calculation of the total monthly profit for each employee

SELECT technician_id, MONTH(CURRENT_DATE()) AS mese_corrente, SUM(calculateVAT(total_cost, labor, vat)) AS costo_mensile
FROM operation
WHERE date_delivery IS NOT NULL AND MONTH(date_delivery) = MONTH(CURRENT_DATE()) AND YEAR(date_delivery) = YEAR(CURRENT_DATE());
GROUP BY technician_id;

-- Find the employee who recorded the most visits in the current month

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

-- Find the most expensive surgery of the current month

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
