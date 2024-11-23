<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120134818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "users" (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, name VARCHAR(180) NOT NULL, lastname VARCHAR(180) NOT NULL, patronymic VARCHAR(180) NOT NULL, phone INTEGER NOT NULL, birth_date DATE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "users" (email)');
        $this->addSql('COMMENT ON COLUMN "users".birth_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE product_card DROP CONSTRAINT FK_9BFCBA7212469DE2');
        $this->addSql('ALTER TABLE product_card ADD CONSTRAINT FK_9BFCBA7212469DE2 FOREIGN KEY (category_id) REFERENCES product_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE "users"');
        $this->addSql('ALTER TABLE product_card DROP CONSTRAINT fk_9bfcba7212469de2');
        $this->addSql('ALTER TABLE product_card ADD CONSTRAINT fk_9bfcba7212469de2 FOREIGN KEY (category_id) REFERENCES product_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
