<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241204092700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_review DROP CONSTRAINT FK_1C119AFB9D86650F');
        $this->addSql('ALTER TABLE user_review DROP CONSTRAINT FK_1C119AFBDE18E50B');
        $this->addSql('DROP INDEX IDX_1C119AFBDE18E50B');
        $this->addSql('DROP INDEX IDX_1C119AFB9D86650F');
        $this->addSql('ALTER TABLE user_review ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_review ADD product_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_review DROP user_id');
        $this->addSql('ALTER TABLE user_review DROP product_id');
        $this->addSql('ALTER TABLE user_review ADD CONSTRAINT FK_1C119AFB9D86650F FOREIGN KEY (user_id_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_review ADD CONSTRAINT FK_1C119AFBDE18E50B FOREIGN KEY (product_id_id) REFERENCES product_card (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1C119AFBDE18E50B ON user_review (product_id_id)');
        $this->addSql('CREATE INDEX IDX_1C119AFB9D86650F ON user_review (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_review DROP CONSTRAINT fk_1c119afb9d86650f');
        $this->addSql('ALTER TABLE user_review DROP CONSTRAINT fk_1c119afbde18e50b');
        $this->addSql('DROP INDEX idx_1c119afb9d86650f');
        $this->addSql('DROP INDEX idx_1c119afbde18e50b');
        $this->addSql('ALTER TABLE user_review ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_review ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_review DROP user_id_id');
        $this->addSql('ALTER TABLE user_review DROP product_id_id');
        $this->addSql('ALTER TABLE user_review ADD CONSTRAINT fk_1c119afb9d86650f FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_review ADD CONSTRAINT fk_1c119afbde18e50b FOREIGN KEY (product_id) REFERENCES product_card (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1c119afb9d86650f ON user_review (user_id)');
        $this->addSql('CREATE INDEX idx_1c119afbde18e50b ON user_review (product_id)');
    }
}
