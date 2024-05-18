<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240518134557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE TournamentEncounter (id INT AUTO_INCREMENT NOT NULL, team1_id INT DEFAULT NULL, team2_id INT DEFAULT NULL, tournament_id INT DEFAULT NULL, chanceTeam1 INT DEFAULT NULL, chanceTeam2 INT DEFAULT NULL, pointsTeam1 INT DEFAULT NULL, pointsTeam2 INT DEFAULT NULL, report LONGTEXT DEFAULT NULL, injuryTeam1Leicht INT DEFAULT NULL, injuryTeam1Schwer INT DEFAULT NULL, injuryTeam1Kritisch INT DEFAULT NULL, injuryTeam1Tot INT DEFAULT NULL, injuryTeam2Leicht INT DEFAULT NULL, injuryTeam2Schwer INT DEFAULT NULL, injuryTeam2Kritisch INT DEFAULT NULL, injuryTeam2Tot INT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_3D97EF8E72BCFA4 (team1_id), INDEX IDX_3D97EF8F59E604A (team2_id), INDEX IDX_3D97EF833D1A3E7 (tournament_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE TournamentEncounter ADD CONSTRAINT FK_3D97EF8E72BCFA4 FOREIGN KEY (team1_id) REFERENCES Team (id)');
        $this->addSql('ALTER TABLE TournamentEncounter ADD CONSTRAINT FK_3D97EF8F59E604A FOREIGN KEY (team2_id) REFERENCES Team (id)');
        $this->addSql('ALTER TABLE TournamentEncounter ADD CONSTRAINT FK_3D97EF833D1A3E7 FOREIGN KEY (tournament_id) REFERENCES Tournament (id)');
        $this->addSql('ALTER TABLE tournament_team DROP FOREIGN KEY FK_F36D142133D1A3E7');
        $this->addSql('ALTER TABLE tournament_team DROP FOREIGN KEY FK_F36D1421296CD8AE');
        $this->addSql('DROP TABLE tournament_team');
        $this->addSql('ALTER TABLE Tournament ADD name VARCHAR(255) NOT NULL, ADD teamAmount INT NOT NULL, DROP date');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tournament_team (tournament_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_F36D142133D1A3E7 (tournament_id), INDEX IDX_F36D1421296CD8AE (team_id), PRIMARY KEY(tournament_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tournament_team ADD CONSTRAINT FK_F36D142133D1A3E7 FOREIGN KEY (tournament_id) REFERENCES Tournament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tournament_team ADD CONSTRAINT FK_F36D1421296CD8AE FOREIGN KEY (team_id) REFERENCES Team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE TournamentEncounter DROP FOREIGN KEY FK_3D97EF8E72BCFA4');
        $this->addSql('ALTER TABLE TournamentEncounter DROP FOREIGN KEY FK_3D97EF8F59E604A');
        $this->addSql('ALTER TABLE TournamentEncounter DROP FOREIGN KEY FK_3D97EF833D1A3E7');
        $this->addSql('DROP TABLE TournamentEncounter');
        $this->addSql('ALTER TABLE Tournament ADD date DATE NOT NULL, DROP name, DROP teamAmount');
    }
}
