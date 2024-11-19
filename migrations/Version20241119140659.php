<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119140659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_category (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE product_card ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_card ADD CONSTRAINT FK_9BFCBA7212469DE2 FOREIGN KEY (category_id) REFERENCES product_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9BFCBA7212469DE2 ON product_card (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product_card DROP CONSTRAINT FK_9BFCBA7212469DE2');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP INDEX IDX_9BFCBA7212469DE2');
        $this->addSql('ALTER TABLE product_card DROP category_id');
    }
}
