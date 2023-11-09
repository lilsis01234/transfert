SET description = REPLACE(description, "&Eacute;", "É") i learned today 
SET description = CONCAT(description,"thing to concat")
UPDATE sb8_product_lang
SET name = CONCAT(UPPER(SUBSTRING_INDEX(name, ' ', 1)), ' ', LOWER(SUBSTRING(name, LENGTH(SUBSTRING_INDEX(name, ' ', 1)) + 2)))
