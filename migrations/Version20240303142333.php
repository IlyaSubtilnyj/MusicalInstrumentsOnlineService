<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303142333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brands (brnd_id INT AUTO_INCREMENT NOT NULL, brnd_name VARCHAR(255) NOT NULL, PRIMARY KEY(brnd_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (ctg_id INT AUTO_INCREMENT NOT NULL, ctg_name VARCHAR(255) NOT NULL, ctg_description LONGTEXT DEFAULT NULL, PRIMARY KEY(ctg_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE m2m_category_tags (category_id INT NOT NULL, tag_id INT NOT NULL, /*INDEX IDX_FAF0854612469DE2 (category_id),*/ INDEX IDX_FAF08546BAD26311 (tag_id), PRIMARY KEY(category_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE m2m_default_category_tags (category_id INT NOT NULL, tag_id INT NOT NULL, /*INDEX IDX_78EF045612469DE2 (category_id),*/ INDEX IDX_78EF0456BAD26311 (tag_id), PRIMARY KEY(category_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instances (inst_id INT AUTO_INCREMENT NOT NULL, inst_model_id INT DEFAULT NULL, inst_manufacturer_id INT DEFAULT NULL, inst_description LONGTEXT DEFAULT NULL, inst_serial_number VARCHAR(50) DEFAULT NULL, inst_price NUMERIC(10, 2) DEFAULT NULL, INDEX IDX_inst_model_id (inst_model_id), INDEX IDX_inst_manufacturer_id (inst_manufacturer_id), PRIMARY KEY(inst_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE m2m_instance_tags (instance_id INT NOT NULL, tag_id INT NOT NULL, /*INDEX IDX_5961AFCA3A51721D (instance_id),*/ INDEX IDX_5961AFCABAD26311 (tag_id), PRIMARY KEY(instance_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manufacturers (mnf_id INT AUTO_INCREMENT NOT NULL, mnf_nation_id VARCHAR(2) NOT NULL, mnf_name VARCHAR(255) NOT NULL, mnf_website LONGTEXT DEFAULT NULL, INDEX mnf_nation_id (mnf_nation_id), PRIMARY KEY(mnf_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meta_category_specs (cs_id INT AUTO_INCREMENT NOT NULL, cs_category_id INT NOT NULL, cs_specs VARCHAR(64) DEFAULT NULL, INDEX IDX_cs_category_id (cs_category_id), PRIMARY KEY(cs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE models (mdl_id INT AUTO_INCREMENT NOT NULL, mdl_category_id INT NOT NULL, mdl_brand_id INT DEFAULT NULL, mdl_name VARCHAR(255) NOT NULL, mdl_description LONGTEXT DEFAULT NULL, INDEX IDX_mdl_category_id (mdl_category_id), INDEX IDX_mdl_brand_id (mdl_brand_id), PRIMARY KEY(mdl_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nations (ntn_ccTLD VARCHAR(2) NOT NULL, ntn_name VARCHAR(255) NOT NULL, ntn_type ENUM(\'country\', \'sovereign state\', \'dependent territory\', \'region\', \'other\') NOT NULL COMMENT \'(DC2Type:enumnation)\', PRIMARY KEY(ntn_ccTLD)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (tg_id INT AUTO_INCREMENT NOT NULL, tg_label VARCHAR(50) NOT NULL, tg_description VARCHAR(255) NOT NULL, PRIMARY KEY(tg_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE m2m_category_tags ADD CONSTRAINT FK_FAF0854612469DE2 FOREIGN KEY (category_id) REFERENCES categories (ctg_id)');
        $this->addSql('ALTER TABLE m2m_category_tags ADD CONSTRAINT FK_FAF08546BAD26311 FOREIGN KEY (tag_id) REFERENCES tags (tg_id)');
        $this->addSql('ALTER TABLE m2m_default_category_tags ADD CONSTRAINT FK_78EF045612469DE2 FOREIGN KEY (category_id) REFERENCES categories (ctg_id)');
        $this->addSql('ALTER TABLE m2m_default_category_tags ADD CONSTRAINT FK_78EF0456BAD26311 FOREIGN KEY (tag_id) REFERENCES tags (tg_id)');
        $this->addSql('ALTER TABLE instances ADD CONSTRAINT FK_7A2700696EAFDE1B FOREIGN KEY (inst_model_id) REFERENCES models (mdl_id)');
        $this->addSql('ALTER TABLE instances ADD CONSTRAINT FK_7A270069888DB2CC FOREIGN KEY (inst_manufacturer_id) REFERENCES manufacturers (mnf_id)');
        $this->addSql('ALTER TABLE m2m_instance_tags ADD CONSTRAINT FK_5961AFCA3A51721D FOREIGN KEY (instance_id) REFERENCES instances (inst_id)');
        $this->addSql('ALTER TABLE m2m_instance_tags ADD CONSTRAINT FK_5961AFCABAD26311 FOREIGN KEY (tag_id) REFERENCES tags (tg_id)');
        $this->addSql('ALTER TABLE manufacturers ADD CONSTRAINT FK_94565B129111EE3D FOREIGN KEY (mnf_nation_id) REFERENCES nations (ntn_ccTLD)');
        $this->addSql('ALTER TABLE meta_category_specs ADD CONSTRAINT FK_3C3D52E711172A0C FOREIGN KEY (cs_category_id) REFERENCES categories (ctg_id)');
        $this->addSql('ALTER TABLE models ADD CONSTRAINT FK_E4D630095FF5BEEC FOREIGN KEY (mdl_category_id) REFERENCES categories (ctg_id)');
        $this->addSql('ALTER TABLE models ADD CONSTRAINT FK_E4D630096AC22B0B FOREIGN KEY (mdl_brand_id) REFERENCES brands (brnd_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE m2m_category_tags DROP FOREIGN KEY FK_FAF0854612469DE2');
        $this->addSql('ALTER TABLE m2m_category_tags DROP FOREIGN KEY FK_FAF08546BAD26311');
        $this->addSql('ALTER TABLE m2m_default_category_tags DROP FOREIGN KEY FK_78EF045612469DE2');
        $this->addSql('ALTER TABLE m2m_default_category_tags DROP FOREIGN KEY FK_78EF0456BAD26311');
        $this->addSql('ALTER TABLE instances DROP FOREIGN KEY FK_7A2700696EAFDE1B');
        $this->addSql('ALTER TABLE instances DROP FOREIGN KEY FK_7A270069888DB2CC');
        $this->addSql('ALTER TABLE m2m_instance_tags DROP FOREIGN KEY FK_5961AFCA3A51721D');
        $this->addSql('ALTER TABLE m2m_instance_tags DROP FOREIGN KEY FK_5961AFCABAD26311');
        $this->addSql('ALTER TABLE manufacturers DROP FOREIGN KEY FK_94565B129111EE3D');
        $this->addSql('ALTER TABLE meta_category_specs DROP FOREIGN KEY FK_3C3D52E711172A0C');
        $this->addSql('ALTER TABLE models DROP FOREIGN KEY FK_E4D630095FF5BEEC');
        $this->addSql('ALTER TABLE models DROP FOREIGN KEY FK_E4D630096AC22B0B');
        $this->addSql('DROP TABLE brands');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE m2m_category_tags');
        $this->addSql('DROP TABLE m2m_default_category_tags');
        $this->addSql('DROP TABLE instances');
        $this->addSql('DROP TABLE m2m_instance_tags');
        $this->addSql('DROP TABLE manufacturers');
        $this->addSql('DROP TABLE meta_category_specs');
        $this->addSql('DROP TABLE models');
        $this->addSql('DROP TABLE nations');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
