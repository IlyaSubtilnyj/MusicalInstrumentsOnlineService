<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240311185734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        /** Oppressed */{
            $this->addSql('DROP USER IF EXISTS \'oppressed\'@\'localhost\';');
            $this->addSql('CREATE USER \'oppressed\'@\'localhost\' IDENTIFIED BY \'NZGWYUW98CQLUXAE\';');

            $this->addSql('REVOKE ALL PRIVILEGES ON *.* FROM \'oppressed\'@\'localhost\';');
            $this->addSql('GRANT SELECT, UPDATE ON `users` TO \'oppressed\'@\'localhost\';');
        }

        /** Customers */{
            $this->addSql('DROP USER IF EXISTS \'customer\'@\'localhost\';');
            $this->addSql('CREATE USER \'customer\'@\'localhost\' IDENTIFIED BY \'KNa8MWjnaukb8tcY\';');

            $this->addSql('GRANT SELECT ON `categories` TO \'customer\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `meta_category_specs` TO \'customer\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `tags` TO \'customer\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `m2m_default_category_tags` TO \'customer\'@\'localhost\';');

            $this->addSql('GRANT SELECT ON `models` TO \'customer\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `brands` TO \'customer\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `m2m_model_tags` TO \'customer\'@\'localhost\';');

            $this->addSql('GRANT SELECT ON `instances` TO \'customer\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `m2m_instance_tags` TO \'customer\'@\'localhost\';');

            $this->addSql('GRANT SELECT ON `manufacturers` TO \'customer\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `nations` TO \'customer\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `nations_types` TO \'customer\'@\'localhost\';');

            $this->addSql('GRANT INSERT, SELECT, UPDATE ON `users` TO \'customer\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `m2m_user_notices` TO \'customer\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `notices` TO \'customer\'@\'localhost\';');

            $this->addSql('GRANT INSERT, SELECT, UPDATE ON `bookings` TO \'customer\'@\'localhost\';'); /** User can't delete booking */
            $this->addSql('GRANT SELECT ON `booking_statuses` TO \'customer\'@\'localhost\';');

            $this->addSql('GRANT INSERT, SELECT, UPDATE, DELETE ON `orders` TO \'customer\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `order_statuses` TO \'customer\'@\'localhost\';');
        }

        /** Salepersons */{
            $this->addSql('DROP USER IF EXISTS \'salesperson\'@\'localhost\';');
            $this->addSql('CREATE USER \'salesperson\'@\'localhost\' IDENTIFIED BY \'dWCP3M6wPpCFwdEa\';');

            $this->addSql('GRANT SELECT ON `categories` TO \'salesperson\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `meta_category_specs` TO \'salesperson\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `tags` TO \'salesperson\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `m2m_default_category_tags` TO \'salesperson\'@\'localhost\';');

            $this->addSql('GRANT SELECT ON `models` TO \'salesperson\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `brands` TO \'salesperson\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `m2m_model_tags` TO \'salesperson\'@\'localhost\';');

            $this->addSql('GRANT INSERT, SELECT, UPDATE, DELETE ON `instances` TO \'salesperson\'@\'localhost\';');
            $this->addSql('GRANT INSERT, SELECT, UPDATE, DELETE ON `m2m_instance_tags` TO \'salesperson\'@\'localhost\';');

            $this->addSql('GRANT SELECT ON `manufacturers` TO \'salesperson\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `nations` TO \'salesperson\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `nations_types` TO \'salesperson\'@\'localhost\';');

            $this->addSql('GRANT INSERT, SELECT, UPDATE ON `users` TO \'salesperson\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `m2m_user_notices` TO \'salesperson\'@\'localhost\';');
            $this->addSql('GRANT INSERT, SELECT, UPDATE, DELETE ON `notices` TO \'salesperson\'@\'localhost\';');

            $this->addSql('GRANT SELECT ON `bookings` TO \'salesperson\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `booking_statuses` TO \'salesperson\'@\'localhost\';');

            $this->addSql('GRANT SELECT ON `orders` TO \'salesperson\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `order_statuses` TO \'salesperson\'@\'localhost\';');
        }

        /** Moderators */{
            $this->addSql('DROP USER IF EXISTS \'moderator\'@\'localhost\';');
            $this->addSql('CREATE USER \'moderator\'@\'localhost\' IDENTIFIED BY \'DNxnS2eRRkHe8nbY\';');

            $this->addSql('GRANT SELECT ON `categories` TO \'moderator\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `meta_category_specs` TO \'moderator\'@\'localhost\';');
            $this->addSql('GRANT INSERT, SELECT, UPDATE, DELETE ON `tags` TO \'moderator\'@\'localhost\';');
            $this->addSql('GRANT INSERT, SELECT, UPDATE, DELETE ON `m2m_default_category_tags` TO \'moderator\'@\'localhost\';');

            $this->addSql('GRANT SELECT ON `models` TO \'moderator\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `brands` TO \'moderator\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `m2m_model_tags` TO \'moderator\'@\'localhost\';');

            $this->addSql('GRANT INSERT, SELECT, UPDATE, DELETE ON `instances` TO \'moderator\'@\'localhost\';');
            $this->addSql('GRANT INSERT, SELECT, UPDATE, DELETE ON `m2m_instance_tags` TO \'moderator\'@\'localhost\';');

            $this->addSql('GRANT SELECT ON `manufacturers` TO \'moderator\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `nations` TO \'moderator\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `nations_types` TO \'moderator\'@\'localhost\';');

            $this->addSql('GRANT SELECT, UPDATE, DELETE ON `users` TO \'moderator\'@\'localhost\';');
            $this->addSql('GRANT INSERT, SELECT, UPDATE, DELETE ON `m2m_user_notices` TO \'moderator\'@\'localhost\';');
            $this->addSql('GRANT INSERT, SELECT, UPDATE, DELETE ON `notices` TO \'moderator\'@\'localhost\';');

            $this->addSql('GRANT INSERT, SELECT, UPDATE, DELETE ON `bookings` TO \'moderator\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `booking_statuses` TO \'moderator\'@\'localhost\';');

            $this->addSql('GRANT INSERT, SELECT, UPDATE ON `orders` TO \'moderator\'@\'localhost\';');
            $this->addSql('GRANT SELECT ON `order_statuses` TO \'moderator\'@\'localhost\';');
        }

        /** Admins */{
            $this->addSql('DROP USER IF EXISTS \'admin\'@\'localhost\';');
            $this->addSql('CREATE USER \'admin\'@\'localhost\' IDENTIFIED BY \'URhwXtwZ34FsB5Hs\';');
            $this->addSql('GRANT ALL PRIVILEGES ON *.* TO \'admin\'@\'localhost\' WITH GRANT OPTION;');
        }

        

    }

    public function down(Schema $schema): void
    {
        //$this->addSql('DROP USER IF EXISTS \'customer\'@\'localhost\';');
        //$this->addSql('DROP USER IF EXISTS \'salesperson\'@\'localhost\';');
        //$this->addSql('DROP USER IF EXISTS \'moderator\'@\'localhost\';');
        //$this->addSql('DROP USER IF EXISTS \'admin\'@\'localhost\';');
    }
}
