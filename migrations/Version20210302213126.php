<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210302213126 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE travel CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE program program LONGTEXT DEFAULT NULL, CHANGE is_liked is_liked TINYINT(1) DEFAULT NULL, CHANGE display_homepage display_homepage TINYINT(1) DEFAULT NULL, CHANGE price price INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE travel CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE program program LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE is_liked is_liked TINYINT(1) NOT NULL, CHANGE display_homepage display_homepage TINYINT(1) NOT NULL, CHANGE price price INT NOT NULL');
    }
}
