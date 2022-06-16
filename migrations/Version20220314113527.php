<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220314113527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create database mindbox and table export_products';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE DATABASE IF NOT EXISTS mindbox');
        $this->addSql('CREATE TABLE IF NOT EXISTS export_products (id VARCHAR (64) NOT NULL, products_ids JSON NOT NULL, date_insert DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE export_products');
        $this->addSql('DROP DATABASE mindbox');
    }
}
