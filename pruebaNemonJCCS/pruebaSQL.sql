-- 1- Obtindre els primers 15 clients ordenats pel camp idClient de forma ascendent.

SELECT * FROM Client ORDER BY idClient ASC LIMIT 15;

-- 2- Obtindre la suma de la baseImponible, i quàntes factures té el client amb CIF A7789118

SELECT SUM(baseImponible) AS SumaBaseImponible, COUNT(*) AS NumeroFactures
FROM factures
WHERE idClient = (SELECT idClient FROM clients WHERE CIF = 'A7789118');

-- 3- Obtindre totes les factures en les que apareix eel Producte amb idProducte = 35

SELECT factures.*
FROM factures
JOIN linies_factura ON factures.idFactura = linies_factura.idFactura
WHERE linies_factura.idProducte = 35;

-- 4- Eliminar totes les Factures dels clients amb CIF que comenci amb ‘C’ i que tinguin una baseImponible més gran de 1000€

DELETE factures
FROM factures
JOIN clients ON factures.idClient = clients.idClient
WHERE clients.CIF LIKE 'C%' AND factures.baseImponible > 1000;

-- 5- Actualitzar l’estatPagament de totes les Factures a l’estat ‘Pagat’ de totes les factures en les que apareguin Productes 
-- amb un preuVenda > preuCost

UPDATE factures
SET estatPagament = 'Pagat'
WHERE idFactura IN (
 SELECT DISTINCT f.idFactura
    FROM factures f
    JOIN linies_factura lf ON f.idFactura = lf.idFactura
    JOIN productes p ON lf.idProducte = p.idProducte
    WHERE p.preuVenda > p.preuCost
)