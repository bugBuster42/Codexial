<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717200250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sale ADD store_id INT NOT NULL');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC005B092A811 FOREIGN KEY (store_id) REFERENCES store (id)');
        $this->addSql('CREATE INDEX IDX_E54BC005B092A811 ON sale (store_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC005B092A811');
        $this->addSql('DROP INDEX IDX_E54BC005B092A811 ON sale');
        $this->addSql('ALTER TABLE sale DROP store_id');
    }
}
