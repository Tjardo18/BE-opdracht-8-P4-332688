DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllergien`(IN p_id INT)
BEGIN
                    SELECT
                        a.naam AS ANaam,
                        a.omschrijving
                    FROM
                        allergeen a
                    INNER JOIN
                        productperallergeen ppa ON ppa.allergeenId = a.id
                    INNER JOIN
                        product p ON p.id = ppa.productId
                    WHERE
                        p.id = p_id
                    ORDER BY
                        ANaam ASC;
                END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getLeverancier`(IN p_id INT)
BEGIN
                        SELECT
                            l.naam AS LNaam,
                            l.contactPersoon,
                            l.leverancierNummer,
                            l.mobiel,
                            p.naam AS PNaam,
                            IFNULL(m.aantalAanwezig, 0) AS AantalAanwezig,
                            ppl.datumLevering,
                            ppl.aantal,
                            ppl.datumEerstVolgendeLevering AS DatumEVL
                        FROM
                            leverancier l
                        INNER JOIN
                            productperleverancier ppl ON l.id = ppl.leverancierId
                        INNER JOIN
                            product p ON ppl.productId = p.id
                        LEFT JOIN
                            magazijn m ON p.id = m.productId
                        WHERE
                            p.id = p_id
                        ORDER BY
                            ppl.datumLevering ASC;
                    END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getLeverancierById`(IN l_id INT)
BEGIN
                        SELECT
                            id,
                            Naam,
                            ContactPersoon,
                            leverancierNummer,
                            mobiel
                        FROM
                            leverancier
                        WHERE
                            id = l_id;
                    END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getLeverancierByProductId`(IN p_id INT)
BEGIN
                        SELECT
                            leverancierId
                        FROM
                            productperleverancier
                        WHERE
                            productId = p_id;
                    END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getLeverancierIndividual`()
BEGIN
                        SELECT
                            l.id,
                            l.naam AS Naam,
                            l.contactPersoon AS ContactPersoon,
                            l.leverancierNummer AS LeverancierNummer,
                            l.mobiel AS Mobiel,
                            COUNT(DISTINCT ppl.productId) AS ProductCount
                        FROM
                            leverancier l
                        LEFT JOIN
                            productperleverancier ppl ON l.id = ppl.leverancierId
                        GROUP BY
                            l.id, l.naam, l.contactPersoon, l.leverancierNummer, l.mobiel
                        ORDER BY
                            ProductCount DESC;
                    END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getLeverancierInfo`(IN l_id INT)
BEGIN
                        SELECT
                            l.naam AS Lnaam,
                            l.contactPersoon,
                            l.leverancierNummer,
                            l.mobiel,
                            c.id AS contactId,
                            c.straat,
                            c.huisnummer,
                            c.postcode,
                            c.stad
                        FROM
                            leverancier l
                        LEFT JOIN
                            contact c ON l.contactId = c.id
                        WHERE
                            l.id = l_id;
                    END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getLeveringen`(IN l_id INT)
BEGIN
                        SELECT
                            p.id AS Pid,
                            p.naam AS PNaam,
                            m.VerpakkingsEenheid AS VerpakkingsEenheid,
                            ppl.datumLevering AS DatumLevering,
                            IFNULL(m.AantalAanwezig, 0) AS AantalAanwezig
                        FROM
                            leverancier l
                        JOIN
                            productperleverancier ppl ON l.id = ppl.LeverancierId
                        JOIN
                            product p ON ppl.productId = p.id
                        JOIN
                            magazijn m ON p.id = m.productId
                        JOIN
                            (SELECT productId, MAX(datumLevering) as maxDatumLevering
                             FROM productperleverancier
                             GROUP BY productId) as sub
                        ON
                            ppl.productId = sub.productId AND
                            ppl.datumLevering = sub.maxDatumLevering
                        WHERE
                            l.id = l_id
                        ORDER BY
                            AantalAanwezig DESC;
                    END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOverzicht`()
BEGIN
                        SELECT
                            p.Id,
                            p.Barcode,
                            p.Naam,
                            m.VerpakkingsEenheid,
                            IFNULL(m.AantalAanwezig, 0) AS AantalAanwezig
                        FROM
                            product p
                        LEFT JOIN
                            magazijn m ON p.Id = m.ProductId
                        ORDER BY
                            p.Barcode ASC;
                    END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProduct`(IN p_id INT)
BEGIN
                        SELECT
                            p.naam AS PNaam,
                            p.barcode
                        FROM
                            product p
                        WHERE
                            p.id = p_id;
                    END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductAllergenenInfo`()
BEGIN
                        SELECT DISTINCT
                            p.naam AS 'pNaam',
                            a.naam AS 'aNaam',
                            a.omschrijving AS 'aOmschrijving',
                            COALESCE(m.aantalAanwezig, 0) AS 'mAantalAanwezig',
                            ppl.leverancierId as 'lId'
                        FROM
                            productperallergeen pa
                        INNER JOIN
                            product p ON pa.productId = p.id
                        INNER JOIN
                            allergeen a ON pa.allergeenId = a.id
                        INNER JOIN
                            magazijn m ON p.id = m.productId
                        INNER JOIN
                            productperleverancier ppl ON p.Id = ppl.productId
                        ORDER BY
                            p.naam ASC;
                    END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductAllergenenInfoByAllergen`(IN allergie VARCHAR(255))
BEGIN
                        SELECT DISTINCT
                            p.naam AS 'pNaam',
                            a.naam AS 'aNaam',
                            a.omschrijving AS 'aOmschrijving',
                            COALESCE(m.aantalAanwezig, 0) AS 'mAantalAanwezig',
                            ppl.leverancierId as 'lId'
                        FROM
                            productperallergeen pa
                        INNER JOIN
                            product p ON pa.productId = p.id
                        INNER JOIN
                            allergeen a ON pa.allergeenId = a.id
                        INNER JOIN
                            magazijn m ON p.id = m.productId
                        INNER JOIN
                            productperleverancier ppl ON p.Id = ppl.productId
                        WHERE
                            a.naam COLLATE utf8mb4_unicode_ci = allergie COLLATE utf8mb4_unicode_ci
                        ORDER BY
                            p.naam ASC;
                    END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateLeverancierAndContact`(
                    IN l_leverancierId INT,
                    IN l_naam VARCHAR(250),
                    IN l_contactPersoon VARCHAR(250),
                    IN l_leverancierNummer VARCHAR(250),
                    IN l_mobiel VARCHAR(11),
                    IN c_straat VARCHAR(250),
                    IN c_huisnummer VARCHAR(10),
                    IN c_postcode VARCHAR(6),
                    IN c_stad VARCHAR(250)
                )
BEGIN
                    UPDATE Leverancier
                    SET
                        naam = l_naam,
                        contactPersoon = l_contactPersoon,
                        leverancierNummer = l_leverancierNummer,
                        mobiel = l_mobiel,
                        updated_at = NOW()
                    WHERE
                        id = l_leverancierId;

                    UPDATE Contact
                    SET
                        straat = c_straat,
                        huisnummer = c_huisnummer,
                        postcode = c_postcode,
                        stad = c_stad,
                        updated_at = NOW()
                    WHERE
                        id = l_leverancierId;
                END$$
DELIMITER ;
