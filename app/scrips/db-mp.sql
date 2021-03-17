#######################
# Sajad Abbasi - 16-03-2021
# create entities daily metrics table

CREATE TABLE `marketplace`.`entityAnalytics`
(
    `id`          int(11)                                 NOT NULL AUTO_INCREMENT,
    `label`       varchar(100) COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `eventDate`   date                                    NOT NULL,
    `country`     varchar(50) COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `metricType`  varchar(50) COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `metricValue` int(11)                                 NOT NULL,
    PRIMARY KEY (`id`, `label`, `eventDate`, `country`, `metricType`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

#######################
# Sajad Abbasi - 16-03-2021
# create entities daily metrics table

DELIMITER //
drop procedure if exists `marketplace`.`spAddEntityAnalyticsAll`;
CREATE PROCEDURE `marketplace`.`spAddEntityAnalyticsAll`()
BEGIN
    ##############################
    # ALL LABEL
    delete
    from `marketplace`.`entityAnalytics`
    WHERE id IN (SELECT *
                 FROM (SELECT id
                       FROM `marketplace`.`entityAnalytics`
                       WHERE label = 'pharmacy'
                       ORDER BY id) X);
    ###############
    ## INSERT PHARMACY REGISTERED
    INSERT INTO `marketplace`.`entityAnalytics`
        (`label`, `eventDate`, `country`, `metricType`, `metricValue`)
    select 'pharmacy'                                         AS `label`,
           DATE_FORMAT(`entity`.`insertDateTime`, "%Y-%m-%d") AS `eventDate`,
           `country`.`name_en`                                AS `country`,
           'registered'                                       AS `metricType`,
           count(*)                                           AS `metricValue`
    from `marketplace`.`entity`
             Left Join `marketplace`.`country` ON `country`.`id` = `entity`.`countryId`
    where typeId = 20
    group by 1, 2, 3, 4;
    ###############
    ## INSERT PHARMACY DISTRIBUTOR
    INSERT INTO `marketplace`.`entityAnalytics`
        (`label`, `eventDate`, `country`, `metricType`, `metricValue`)
    select 'pharmacy'                                         AS `label`,
           DATE_FORMAT(`entity`.`insertDateTime`, "%Y-%m-%d") AS `eventDate`,
           `country`.`name_en`                                AS `country`,
           'distributor'                                      AS `metricType`,
           count(*)                                           AS `metricValue`
    from `marketplace`.`entity`
             Left Join `marketplace`.`country` ON `country`.`id` = `entity`.`countryId`
    where typeId = 10
    group by 1, 2, 3, 4;
END;
//
DELIMITER ;

#######################
# Sajad Abbasi - 16-03-2021
# create view entity analytics

CREATE OR REPLACE VIEW `marketplace`.`vwEntityAnalytics` AS
SELECT
    `metrics`.`label` AS `label`,
    `metrics`.`eventDate` AS `date`,
    `metrics`.`country` AS `country`,
    CAST(SUM(IF((`metrics`.`metricType` = 'registered'),
                `metrics`.`metricValue`,
                0))
        AS UNSIGNED) AS `registered`,
    CAST(SUM(IF((`metrics`.`metricType` = 'onboarded'),
                `metrics`.`metricValue`,
                0))
        AS UNSIGNED) AS `onboarded`

FROM `marketplace`.`entityAnalytics` `metrics`
WHERE (`metrics`.`metricType` IN ('registered' , 'onboarded'))
GROUP BY `metrics`.`label` , `metrics`.`eventDate`
