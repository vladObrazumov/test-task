<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190912200039 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE catalog ADD tree_root INT DEFAULT NULL, ADD parent_id INT DEFAULT NULL, ADD lft INT NOT NULL, ADD lvl INT NOT NULL, ADD rgt INT NOT NULL');
        $this->addSql('ALTER TABLE catalog ADD CONSTRAINT FK_1B2C3247A977936C FOREIGN KEY (tree_root) REFERENCES catalog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE catalog ADD CONSTRAINT FK_1B2C3247727ACA70 FOREIGN KEY (parent_id) REFERENCES catalog (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_1B2C3247A977936C ON catalog (tree_root)');
        $this->addSql('CREATE INDEX IDX_1B2C3247727ACA70 ON catalog (parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE catalog DROP FOREIGN KEY FK_1B2C3247A977936C');
        $this->addSql('ALTER TABLE catalog DROP FOREIGN KEY FK_1B2C3247727ACA70');
        $this->addSql('DROP INDEX IDX_1B2C3247A977936C ON catalog');
        $this->addSql('DROP INDEX IDX_1B2C3247727ACA70 ON catalog');
        $this->addSql('ALTER TABLE catalog DROP tree_root, DROP parent_id, DROP lft, DROP lvl, DROP rgt');
    }
}
