<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240410125238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking_statuses (bkst_id SMALLINT AUTO_INCREMENT NOT NULL, bkst_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNQ_bkst_name (bkst_name), PRIMARY KEY(bkst_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bookings (bkng_id INT AUTO_INCREMENT NOT NULL, bkng_made_by INT NOT NULL, bkng_status_id SMALLINT NOT NULL, opened_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', closed_at DATETIME NOT NULL, INDEX IDX_7A853C35E7129216 (bkng_made_by), INDEX IDX_7A853C35285FA2C5 (bkng_status_id), PRIMARY KEY(bkng_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notices (ntc_id BIGINT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ntc_title VARCHAR(50) NOT NULL, ntc_article LONGTEXT NOT NULL, PRIMARY KEY(ntc_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_statuses (rdst_id SMALLINT AUTO_INCREMENT NOT NULL, rdst_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNQ_rdst_name (rdst_name), PRIMARY KEY(rdst_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (rd_id BIGINT AUTO_INCREMENT NOT NULL, rd_instance_id INT NOT NULL, rd_status_id SMALLINT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E52FFDEEBC9B86B (rd_instance_id), INDEX IDX_E52FFDEE9648F568 (rd_status_id), PRIMARY KEY(rd_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE m2m_user_notices (user_id INT NOT NULL, notice_id BIGINT NOT NULL, INDEX IDX_E0B8304AA76ED395 (user_id), INDEX IDX_E0B8304A7D540AB (notice_id), PRIMARY KEY(user_id, notice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C35E7129216 FOREIGN KEY (bkng_made_by) REFERENCES users (usr_id)');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C35285FA2C5 FOREIGN KEY (bkng_status_id) REFERENCES booking_statuses (bkst_id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEBC9B86B FOREIGN KEY (rd_instance_id) REFERENCES instances (inst_id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9648F568 FOREIGN KEY (rd_status_id) REFERENCES order_statuses (rdst_id)');
        $this->addSql('ALTER TABLE m2m_user_notices ADD CONSTRAINT FK_E0B8304AA76ED395 FOREIGN KEY (user_id) REFERENCES users (usr_id)');
        $this->addSql('ALTER TABLE m2m_user_notices ADD CONSTRAINT FK_E0B8304A7D540AB FOREIGN KEY (notice_id) REFERENCES notices (ntc_id)');
        $this->addSql('ALTER TABLE users ADD usr_message LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C35E7129216');
        $this->addSql('ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C35285FA2C5');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEBC9B86B');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE9648F568');
        $this->addSql('ALTER TABLE m2m_user_notices DROP FOREIGN KEY FK_E0B8304AA76ED395');
        $this->addSql('ALTER TABLE m2m_user_notices DROP FOREIGN KEY FK_E0B8304A7D540AB');
        $this->addSql('DROP TABLE booking_statuses');
        $this->addSql('DROP TABLE bookings');
        $this->addSql('DROP TABLE notices');
        $this->addSql('DROP TABLE order_statuses');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE m2m_user_notices');
        $this->addSql('ALTER TABLE users DROP usr_message');
    }
}
