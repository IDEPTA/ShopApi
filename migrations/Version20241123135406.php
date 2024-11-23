<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241123135406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_review (id SERIAL NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, grade DOUBLE PRECISION NOT NULL, comment VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1C119AFB9D86650F ON user_review (user_id)');
        $this->addSql('CREATE INDEX IDX_1C119AFBDE18E50B ON user_review (product_id)');
        $this->addSql('COMMENT ON COLUMN user_review.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_review.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user_review ADD CONSTRAINT FK_1C119AFB9D86650F FOREIGN KEY (user_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_review ADD CONSTRAINT FK_1C119AFBDE18E50B FOREIGN KEY (product_id) REFERENCES product_card (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ALTER email TYPE VARCHAR(170)');
        $this->addSql('ALTER TABLE users ALTER phone TYPE INT');
        $this->addSql('ALTER TABLE users ALTER phone TYPE INT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_review DROP CONSTRAINT FK_1C119AFB9D86650F');
        $this->addSql('ALTER TABLE user_review DROP CONSTRAINT FK_1C119AFBDE18E50B');
        $this->addSql('DROP TABLE user_review');
        $this->addSql('ALTER TABLE "users" ALTER email TYPE VARCHAR(180)');
        $this->addSql('ALTER TABLE "users" ALTER phone TYPE VARCHAR(180)');
    }
}
