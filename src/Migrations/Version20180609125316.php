<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180609125316 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE characters CHANGE age age INT DEFAULT 0 NOT NULL, CHANGE exp exp INT DEFAULT 0 NOT NULL, CHANGE energy energy INT DEFAULT 0 NOT NULL, CHANGE skillpoints skillpoints INT DEFAULT 0 NOT NULL, CHANGE gold gold INT DEFAULT 0 NOT NULL, CHANGE silver silver INT DEFAULT 0 NOT NULL, CHANGE copper copper INT DEFAULT 0 NOT NULL, CHANGE worked worked INT DEFAULT 0 NOT NULL, CHANGE work_start work_start DATETIME DEFAULT NULL, CHANGE work_finish work_finish DATETIME DEFAULT NULL, CHANGE fights fights INT DEFAULT 0 NOT NULL, CHANGE fights_won fights_won INT DEFAULT 0 NOT NULL, CHANGE last_fight last_fight DATETIME DEFAULT NULL, CHANGE last_forum last_forum DATETIME DEFAULT NULL, CHANGE last_msg last_msg DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE characters CHANGE age age INT NOT NULL, CHANGE exp exp INT NOT NULL, CHANGE energy energy INT NOT NULL, CHANGE skillpoints skillpoints INT NOT NULL, CHANGE gold gold INT NOT NULL, CHANGE silver silver INT NOT NULL, CHANGE copper copper INT NOT NULL, CHANGE worked worked INT NOT NULL, CHANGE work_start work_start DATETIME NOT NULL, CHANGE work_finish work_finish DATETIME NOT NULL, CHANGE fights fights INT NOT NULL, CHANGE fights_won fights_won INT NOT NULL, CHANGE last_fight last_fight DATETIME NOT NULL, CHANGE last_forum last_forum DATETIME NOT NULL, CHANGE last_msg last_msg DATETIME NOT NULL');
    }
}
