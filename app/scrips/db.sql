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