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
            ("messageId", "senderCompany", "senderCountry", "senderType", "receiverCompany", "sentOnDate", subject,
             content, "actionStatus")
as
SELECT m.id             AS "messageId",
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
         JOIN auth."user" au ON au.id = m."fromUserId"
         JOIN setup."Country" ct ON scom."CountryID" = ct."ID"
         JOIN production."Company" rcom ON rcom."ID" = m."toCompanyId"
ORDER BY m."createdAt" DESC;

alter table onex."vwMessages" owner to aumet_user;

## END {Mubasher} {22-02-2021}