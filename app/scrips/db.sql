alter table production."Company"
    add "Phone" varchar(30);

alter table production."Company"
    add "facebookUrl" varchar(150);

alter table production."Company"
    add "twitterUrl" varchar(150);

alter table production."Company"
    add "linkedinUrl" varchar(150);

alter table production."Company"
    add "youtubeUrl" varchar(150);

alter table production."Company"
    add "EstablishmentYear" int;

alter table "productImages" alter column "createdAt" set default current_timestamp;

alter table "productImages" alter column "updatedAt" drop not null;

alter table production."Manufacturer" alter column "CreatedAt" set not null;

alter table production."Manufacturer" alter column "CreatedAt" set default current_timestamp;

alter table production."Manufacturer" alter column "IsBand" set default false;

alter table production."Manufacturer" alter column "IsChanged" set default false;

alter table production."Distributor" alter column "CreatedBy" set default 'ONEX';

alter table production."Distributor" alter column "CreatedAt" set default current_timestamp;

alter table product_ranges
    add "productId" bigint;

truncate table onex."productCatalogue" cascade ;
truncate table onex.catalogue cascade ;

insert into onex.catalogue (url, "companyId", "createdAt", "deletedAt", "isEnabled", "legacyProductRangeId")
SELECT "catalogueUrl", "companyId", "createdAt", null, true, id
from public.product_ranges where ("Deleted" is null or "Deleted" = false) and "catalogueUrl" is not null and "companyId" is not null and "catalogueUrl" != 'NA'
ON CONFLICT DO NOTHING;

insert into onex."productCatalogue" ("productId", "catalogueId")
select p.id, c.id from onex.catalogue c
                           join public.products p on p."productrangeId" = c."legacyProductRangeId"


## START {Mubasher} {22-02-2021}

alter table onex.message add "actionStatus" int default 0 not null;

create function "getMessages"(id bigint DEFAULT NULL::bigint)
    returns TABLE("messageId" bigint, "senderCompany" character varying, "senderCountry" character varying, "senderType" character varying, "receiverCompany" character varying, "sentOnDate" timestamp without time zone, subject character varying, content text, "actionStatus" integer)
    language plpgsql
as
$$
BEGIN
    return query
        SELECT m.id             as "messageId",
               scom."Name"      AS "senderCompany",
               ct."Name"        AS "senderCountry",
               au."companyType" AS "senderType",
               rcom."Name"      AS "receiverCompany",
               m."createdAt"    AS "sentOnDate",
               m.subject,
               m.content,
               m."actionStatus"
        FROM onex.message m
                 JOIN production."Company" scom ON scom."ID" = m."fromCompanyId"
                 JOIN auth."user" au on au.id = m."fromUserId"
                 JOIN setup."Country" ct ON scom."CountryID" = ct."ID"
                 JOIN production."Company" rcom ON rcom."ID" = m."toCompanyId"
        WHERE CASE WHEN $1 NOTNULL THEN m.id = $1 ELSE 1=1 END
        ORDER BY m."createdAt" DESC;
END;
$$;

alter function onex."getMessages"(bigint) owner to aumet_user;

create function "getMessagesUser"(id bigint DEFAULT NULL::bigint)
    returns TABLE("messageUserId" bigint, "displayName" character varying, "authUserId" bigint, "userCompanyName" character varying, "userCompanyId" bigint, "companyType" character varying)
    language plpgsql
as
$$
BEGIN
    CASE WHEN $1 NOTNULL AND $1 == 1 THEN
        --get sender users
        return query select distinct m."fromUserId" "messageFromUserId",
                                     u."displayName",
                                     u.id           "authFromUserId",
                                     com."Name"     "fromUserCompanyName",
                                     com."ID"       "fromUserCompanyId",
                                     u."companyType"
                     from onex.message m
                              join auth."user" u on u.id = m."fromUserId"
                              join onex."companyUser" cu on cu."userId" = m."fromUserId"
                              join production."Company" com on com."ID" = cu."companyId";
        ELSE
            --get receiver users
            return query select distinct m."toUserId" "messageToUserId",
                                         u."displayName",
                                         u.id         "authToUserId",
                                         com."Name"   "toUserCompanyName",
                                         com."ID"     "toUserCompanyId",
                                         u."companyType"
                         from onex.message m
                                  join auth."user" u on u.id = m."toUserId"
                                  join onex."companyUser" cu on cu."userId" = m."toUserId"
                                  join production."Company" com on com."ID" = cu."companyId";
        END CASE;
END;
$$;

alter function onex."getMessagesUser"(bigint) owner to aumet_user;

create view onex."vwMessages"
            ("messageId", "senderCompany", "senderCountry", "senderType", "receiverType", "receiverCompany",
             "receiverCompanyId", "sentOnDate", subject, content, "actionStatus", "toUserId", "fromUserId",
             "noOfRcverUsers", subscription, "parentId", "repliedOnDate", "hasActiveBO")
as
SELECT m.id                                        AS "messageId",
       scom."Name"                                 AS "senderCompany",
       ct."Name"                                   AS "senderCountry",
       scom."Type"                                 AS "senderType",
       rcom."Type"                                 AS "receiverType",
       rcom."Name"                                 AS "receiverCompany",
       rcom."ID"                                   AS "receiverCompanyId",
       m."createdAt"                               AS "sentOnDate",
       m.subject,
       m.content,
       CASE
           WHEN ((SELECT count(*) AS count
                  FROM onex.subscription sub
                  WHERE sub."companyId" = m."toCompanyId")) < 0 AND rcom."Type"::text = 'manufacturer'::text AND
                m."actionStatus" = 1 THEN 3
           ELSE m."actionStatus"
           END                                     AS "actionStatus",
       m."toUserId",
       m."fromUserId",
       (SELECT count(ruser."ID") AS count
        FROM production."User" ruser
        WHERE ruser."CompanyID" = m."toCompanyId") AS "noOfRcverUsers",
       CASE
           WHEN ((SELECT count(*) AS count
                  FROM onex.subscription sub
                  WHERE sub."companyId" = m."toCompanyId")) > 0 THEN 1
           ELSE 0
           END                                     AS subscription,
       m."parentId",
       (SELECT message."createdAt"
        FROM onex.message
        WHERE message.id = m."parentId")           AS "repliedOnDate",
       CASE
           WHEN ((SELECT count(*) AS count
                  FROM onex."vwBusinessOpportunities"
                  WHERE "vwBusinessOpportunities"."fromCompanyId" = scom."ID"
                    AND "vwBusinessOpportunities"."companyId" = rcom."ID"
                    AND "vwBusinessOpportunities"."endDate" >= now())) > 0 AND
                scom."Type"::text = 'distributor'::text AND rcom."Type"::text = 'manufacturer'::text THEN 1
           ELSE 0
           END                                     AS "hasActiveBO"
FROM onex.message m
         JOIN production."Company" scom ON scom."ID" = m."fromCompanyId"
         JOIN setup."Country" ct ON scom."CountryID" = ct."ID"
         JOIN production."Company" rcom ON rcom."ID" = m."toCompanyId"
ORDER BY m."createdAt" DESC;

alter table onex."vwMessages" owner to aumet_user;

## END {Mubasher} {22-02-2021}

## START {Mubasher} {02-03-2021}

create view onex."vwMessages"
            ("messageId", "senderCompany", "senderCompanyId", "senderCountry", "senderType", "receiverType",
             "receiverCompany", "receiverCompanyId", "sentOnDate", subject, content, "actionStatus", "toUserId",
             "fromUserId", "noOfRcverUsers", subscription, "parentId", "repliedOnDate", "hasActiveBO")
as
SELECT m.id                                                               AS "messageId",
       scom."Name"                                                        AS "senderCompany",
       scom."ID"                                                          AS "senderCompanyId",
       ct."Name"                                                          AS "senderCountry",
       scom."Type"                                                        AS "senderType",
       rcom."Type"                                                        AS "receiverType",
       rcom."Name"                                                        AS "receiverCompany",
       rcom."ID"                                                          AS "receiverCompanyId",
       timezone('asia/amman'::text, timezone('utc'::text, m."createdAt")) AS "sentOnDate",
       m.subject,
       m.content,
       CASE
           WHEN ((SELECT count(*) AS count
                  FROM onex.subscription sub
                  WHERE sub."companyId" = m."toCompanyId")) <= 0 AND rcom."Type"::text = 'manufacturer'::text AND
                m."actionStatus" = 1 THEN 3
           ELSE m."actionStatus"
           END                                                            AS "actionStatus",
       m."toUserId",
       m."fromUserId",
       (SELECT count(ruser."ID") AS count
        FROM production."User" ruser
        WHERE ruser."CompanyID" = m."toCompanyId")                        AS "noOfRcverUsers",
       CASE
           WHEN ((SELECT count(*) AS count
                  FROM onex.subscription sub
                  WHERE sub."companyId" = m."fromCompanyId")) > 0 AND scom."Type"::text = 'manufacturer'::text OR
                ((SELECT count(*) AS count
                  FROM onex.subscription sub
                  WHERE sub."companyId" = m."toCompanyId")) > 0 AND rcom."Type"::text = 'manufacturer'::text THEN 1
           ELSE 0
           END                                                            AS subscription,
       m."parentId",
       (SELECT timezone('asia/amman'::text, timezone('utc'::text, message."createdAt"))
        FROM onex.message
        WHERE message.id = m."parentId")                                  AS "repliedOnDate",
       CASE
           WHEN ((SELECT count(*) AS count
                  FROM onex."vwBusinessOpportunities"
                  WHERE "vwBusinessOpportunities"."fromCompanyId" = rcom."ID"
                    AND "vwBusinessOpportunities"."companyId" = scom."ID"
                    AND "vwBusinessOpportunities"."endDate" >= now())) > 0 AND
                scom."Type"::text = 'distributor'::text AND rcom."Type"::text = 'manufacturer'::text THEN 1
           ELSE 0
           END                                                            AS "hasActiveBO"
FROM onex.message m
         JOIN production."Company" scom ON scom."ID" = m."fromCompanyId"
         JOIN setup."Country" ct ON scom."CountryID" = ct."ID"
         JOIN production."Company" rcom ON rcom."ID" = m."toCompanyId"
ORDER BY m."createdAt" DESC;

alter table onex."vwMessages" owner to aumet_user;

## END {Mubasher} {02-03-2021}

## START {Mubasher} {04-03-2021}

create view "vwMessages"
            ("messageId", "senderCompany", "senderCompanyId", "senderCountry", "senderType", "receiverType",
             "receiverCompany", "receiverCompanyId", "sentOnDate", subject, content, "actionStatus", "toUserId",
             "fromUserId", "noOfRcverUsers", subscription, "parentId", "repliedOnDate", "hasActiveBO")
as
SELECT m.id                                        AS "messageId",
       scom."Name"                                 AS "senderCompany",
       scom."ID"                                   AS "senderCompanyId",
       ct."Name"                                   AS "senderCountry",
       scom."Type"                                 AS "senderType",
       rcom."Type"                                 AS "receiverType",
       rcom."Name"                                 AS "receiverCompany",
       rcom."ID"                                   AS "receiverCompanyId",
       m."createdAt"                               AS "sentOnDate",
       m.subject,
       m.content,
       CASE
           WHEN ((SELECT count(*) AS count
                  FROM onex.subscription sub
                  WHERE sub."companyId" = m."toCompanyId")) <= 0 AND rcom."Type"::text = 'manufacturer'::text AND
                m."actionStatus" = 1 AND ((SELECT count(*) AS count
                                           FROM onex.message msgc
                                           WHERE msgc."toCompanyId" = m."toCompanyId"
                                             AND msgc."fromCompanyId" = m."fromCompanyId"
                                             AND msgc."parentId" = 0
                                             AND (msgc."actionStatus" <> ALL (ARRAY [0, 4])))) > 1 AND ((SELECT msg.id
                                                                                                         FROM onex.message msg
                                                                                                         WHERE msg."toCompanyId" = m."toCompanyId"
                                                                                                           AND msg."fromCompanyId" = m."fromCompanyId"
                                                                                                           AND msg."parentId" = 0
                                                                                                           AND (msg."actionStatus" <> ALL (ARRAY [0, 4]))
                                                                                                         ORDER BY msg.id
                                                                                                         LIMIT 1)) <>
                                                                                                       m.id THEN 3
           ELSE m."actionStatus"
           END                                     AS "actionStatus",
       m."toUserId",
       m."fromUserId",
       (SELECT count(ruser."ID") AS count
        FROM production."User" ruser
        WHERE ruser."CompanyID" = m."toCompanyId") AS "noOfRcverUsers",
       CASE
           WHEN ((SELECT count(*) AS count
                  FROM onex.subscription sub
                  WHERE sub."companyId" = m."fromCompanyId")) > 0 AND scom."Type"::text = 'manufacturer'::text OR
                ((SELECT count(*) AS count
                  FROM onex.subscription sub
                  WHERE sub."companyId" = m."toCompanyId")) > 0 AND rcom."Type"::text = 'manufacturer'::text THEN 1
           ELSE 0
           END                                     AS subscription,
       m."parentId",
       (SELECT message."createdAt" AS timezone
        FROM onex.message
        WHERE message.id = m."parentId")           AS "repliedOnDate",
       CASE
           WHEN ((SELECT count(*) AS count
                  FROM onex."vwBusinessOpportunities"
                  WHERE "vwBusinessOpportunities"."fromCompanyId" = rcom."ID"
                    AND "vwBusinessOpportunities"."companyId" = scom."ID"
                    AND "vwBusinessOpportunities"."endDate" >= now())) > 0 AND
                scom."Type"::text = 'distributor'::text AND rcom."Type"::text = 'manufacturer'::text THEN 1
           ELSE 0
           END                                     AS "hasActiveBO"
FROM onex.message m
         JOIN production."Company" scom ON scom."ID" = m."fromCompanyId"
         JOIN setup."Country" ct ON scom."CountryID" = ct."ID"
         JOIN production."Company" rcom ON rcom."ID" = m."toCompanyId"
ORDER BY m."createdAt" DESC;
alter table "vwMessages"
    owner to aumet_user;

## END {Mubasher} {04-03-2021}
