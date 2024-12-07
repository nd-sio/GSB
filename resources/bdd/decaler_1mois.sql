
UPDATE fichefrais
SET datemodif = DATE_ADD(datemodif, INTERVAL 1 MONTH);


UPDATE fichefrais
SET mois = DATE_FORMAT(DATE_ADD(STR_TO_DATE(CONCAT(mois, '01'), '%Y%m%d'), INTERVAL 100 MONTH), '%Y%m')
WHERE mois IS NOT NULL;
UPDATE fichefrais
SET mois = DATE_FORMAT(DATE_ADD(STR_TO_DATE(CONCAT(mois, '01'), '%Y%m%d'), INTERVAL -99 MONTH), '%Y%m')
WHERE mois IS NOT NULL;

UPDATE lignefraisforfait
SET mois = DATE_FORMAT(DATE_ADD(STR_TO_DATE(CONCAT(mois, '01'), '%Y%m%d'), INTERVAL 100 MONTH), '%Y%m')
WHERE mois IS NOT NULL;
UPDATE lignefraisforfait
SET mois = DATE_FORMAT(DATE_ADD(STR_TO_DATE(CONCAT(mois, '01'), '%Y%m%d'), INTERVAL -99 MONTH), '%Y%m')
WHERE mois IS NOT NULL;

UPDATE lignefraishorsforfait
SET mois = DATE_FORMAT(DATE_ADD(STR_TO_DATE(CONCAT(mois, '01'), '%Y%m%d'), INTERVAL 100 MONTH), '%Y%m')
WHERE mois IS NOT NULL;
UPDATE lignefraishorsforfait
SET mois = DATE_FORMAT(DATE_ADD(STR_TO_DATE(CONCAT(mois, '01'), '%Y%m%d'), INTERVAL -99 MONTH), '%Y%m')
WHERE mois IS NOT NULL;