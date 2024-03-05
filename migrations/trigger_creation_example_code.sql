-- Doctrine Migration File Generated on 2024-03-05 13:06:56

-- Version DoctrineMigrations\Version20240305120655
CREATE TRIGGER TR_before_meta_category_specs_insert BEFORE INSERT ON meta_category_specs FOR EACH ROW 
        BEGIN 
            DECLARE table_exists INT;
            DECLARE tablename VARCHAR(255);
            SET tablename = NEW.cs_specs;
            IF SUBSTRING(tablename, -6) != "_specs" THEN
                signal sqlstate '45000' set message_text = "TR_before_meta_category_specs_insert: Bad table name";
            END IF;
            SET table_exists = (SELECT COUNT(1) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = tablename);
            IF table_exists <= 0 THEN
                signal sqlstate '45000' set message_text = "TR_before_meta_category_specs_insert: Table doesn't exist";
            END IF;
        END
        ;
