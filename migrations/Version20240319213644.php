<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319213644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_affiliation (team_id INT NOT NULL, affiliation_id INT NOT NULL, INDEX IDX_142FA7D296CD8AE (team_id), INDEX IDX_142FA7DCB94D64E (affiliation_id), PRIMARY KEY(team_id, affiliation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_affiliation_audit (team_id INT NOT NULL, affiliation_id INT NOT NULL, rev INT NOT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_bafc714da8adfedfc1852cce81d096d2_idx (rev), PRIMARY KEY(team_id, affiliation_id, rev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team_affiliation ADD CONSTRAINT FK_142FA7D296CD8AE FOREIGN KEY (team_id) REFERENCES Team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_affiliation ADD CONSTRAINT FK_142FA7DCB94D64E FOREIGN KEY (affiliation_id) REFERENCES Affiliation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Team DROP FOREIGN KEY FK_64D20921CB94D64E');
        $this->addSql('DROP INDEX IDX_64D20921CB94D64E ON Team');
        $this->addSql('ALTER TABLE Team DROP affiliation_id');
        $this->addSql('ALTER TABLE Team_audit DROP affiliation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_affiliation DROP FOREIGN KEY FK_142FA7D296CD8AE');
        $this->addSql('ALTER TABLE team_affiliation DROP FOREIGN KEY FK_142FA7DCB94D64E');
        $this->addSql('DROP TABLE team_affiliation');
        $this->addSql('DROP TABLE team_affiliation_audit');
        $this->addSql('ALTER TABLE Team ADD affiliation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Team ADD CONSTRAINT FK_64D20921CB94D64E FOREIGN KEY (affiliation_id) REFERENCES Affiliation (id)');
        $this->addSql('CREATE INDEX IDX_64D20921CB94D64E ON Team (affiliation_id)');
        $this->addSql('ALTER TABLE Team_audit ADD affiliation_id INT DEFAULT NULL');
    }
}
