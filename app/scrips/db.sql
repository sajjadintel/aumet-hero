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
                 LEFT JOIN production."Company" scom ON scom."ID" = m."fromCompanyId"
                 LEFT JOIN auth."user" au on au.id = m."fromUserId"
                 LEFT JOIN setup."Country" ct ON scom."CountryID" = ct."ID"
                 LEFT JOIN production."Company" rcom ON rcom."ID" = m."toCompanyId"
        WHERE CASE WHEN $1 NOTNULL THEN m.id = $1 ELSE 1=1 END
        ORDER BY m."createdAt" DESC;
END;
$$;

alter function "getMessages"(bigint) owner to aumet_user;

/*create view onex."vwAllMessages"
            ("messageId", "senderCompany", "senderCountry", "senderType", "receiverCompany", "sentOnDate")
as
SELECT m.id             as "messageId",
       scom."Name"      AS "senderCompany",
       ct."Name"        AS "senderCountry",
       au."companyType" AS "senderType",
       rcom."Name"      AS "receiverCompany",
       m."createdAt"    AS "sentOnDate"
FROM onex.message m
         LEFT JOIN production."Company" scom ON scom."ID" = m."fromCompanyId"
         LEFT JOIN auth."user" au on au.id = m."fromUserId"
         LEFT JOIN setup."Country" ct ON scom."CountryID" = ct."ID"
         LEFT JOIN production."Company" rcom ON rcom."ID" = m."toCompanyId"
ORDER BY m."createdAt" DESC;

alter table onex."vwAllMessages" owner to aumet_user;*/

## END {Mubasher} {22-02-2021}