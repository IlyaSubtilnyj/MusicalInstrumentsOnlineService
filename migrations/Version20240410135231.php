<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240410135231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE m2m_model_tags (model_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_71634A627975B7E7 (model_id), INDEX IDX_71634A62BAD26311 (tag_id), PRIMARY KEY(model_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE m2m_model_tags ADD CONSTRAINT FK_71634A627975B7E7 FOREIGN KEY (model_id) REFERENCES models (mdl_id)');
        $this->addSql('ALTER TABLE m2m_model_tags ADD CONSTRAINT FK_71634A62BAD26311 FOREIGN KEY (tag_id) REFERENCES tags (tg_id)');
        $this->addSql('ALTER TABLE m2m_category_tags DROP FOREIGN KEY FK_FAF08546BAD26311');
        $this->addSql('ALTER TABLE m2m_category_tags DROP FOREIGN KEY FK_FAF0854612469DE2');
        $this->addSql('DROP TABLE m2m_category_tags');
        $this->addSql('CREATE UNIQUE INDEX UNQ_brnd_name ON brands (brnd_name)');
        $this->addSql('ALTER TABLE categories CHANGE ctg_name ctg_name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE instances ADD inst_created_by INT NOT NULL');
        $this->addSql('ALTER TABLE instances ADD CONSTRAINT FK_7A2700695275CBC1 FOREIGN KEY (inst_created_by) REFERENCES users (usr_id)');
        $this->addSql('CREATE INDEX IDX_7A2700695275CBC1 ON instances (inst_created_by)');
        $this->addSql('ALTER TABLE models ADD mdl_is_in_stock TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE tags ADD tg_created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tags ADD CONSTRAINT FK_6FBC9426FF2D3FD5 FOREIGN KEY (tg_created_by) REFERENCES users (usr_id)');
        $this->addSql('CREATE INDEX IDX_6FBC9426FF2D3FD5 ON tags (tg_created_by)');
        $this->addSql('CREATE UNIQUE INDEX UNQ_tg_label ON tags (tg_label)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE m2m_category_tags (category_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_FAF08546BAD26311 (tag_id), INDEX IDX_FAF0854612469DE2 (category_id), PRIMARY KEY(category_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE m2m_category_tags ADD CONSTRAINT FK_FAF08546BAD26311 FOREIGN KEY (tag_id) REFERENCES tags (tg_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE m2m_category_tags ADD CONSTRAINT FK_FAF0854612469DE2 FOREIGN KEY (category_id) REFERENCES categories (ctg_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE m2m_model_tags DROP FOREIGN KEY FK_71634A627975B7E7');
        $this->addSql('ALTER TABLE m2m_model_tags DROP FOREIGN KEY FK_71634A62BAD26311');
        $this->addSql('DROP TABLE m2m_model_tags');
        $this->addSql('ALTER TABLE instances DROP FOREIGN KEY FK_7A2700695275CBC1');
        $this->addSql('DROP INDEX IDX_7A2700695275CBC1 ON instances');
        $this->addSql('ALTER TABLE instances DROP inst_created_by');
        $this->addSql('ALTER TABLE tags DROP FOREIGN KEY FK_6FBC9426FF2D3FD5');
        $this->addSql('DROP INDEX IDX_6FBC9426FF2D3FD5 ON tags');
        $this->addSql('DROP INDEX UNQ_tg_label ON tags');
        $this->addSql('ALTER TABLE tags DROP tg_created_by');
        $this->addSql('ALTER TABLE categories CHANGE ctg_name ctg_name VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNQ_brnd_name ON brands');
        $this->addSql('ALTER TABLE models DROP mdl_is_in_stock');
    }
}
