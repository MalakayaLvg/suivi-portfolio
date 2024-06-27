<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240627081504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE skill_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE skill_category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE skill ADD skill_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477AC58042E FOREIGN KEY (skill_category_id) REFERENCES skill_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5E3DE477AC58042E ON skill (skill_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE skill DROP CONSTRAINT FK_5E3DE477AC58042E');
        $this->addSql('DROP SEQUENCE skill_category_id_seq CASCADE');
        $this->addSql('DROP TABLE skill_category');
        $this->addSql('DROP INDEX IDX_5E3DE477AC58042E');
        $this->addSql('ALTER TABLE skill DROP skill_category_id');
    }
}
