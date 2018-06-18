<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180606180402 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE characters (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, sur_name VARCHAR(255) NOT NULL, sur_name2 VARCHAR(255) DEFAULT NULL, gender VARCHAR(6) NOT NULL, race VARCHAR(10) NOT NULL, age INT NOT NULL, birthdate DATETIME NOT NULL, class VARCHAR(20) NOT NULL, subclass VARCHAR(20) NOT NULL, exp INT NOT NULL, energy INT NOT NULL, skillpoints INT NOT NULL, gold INT NOT NULL, silver INT NOT NULL, copper INT NOT NULL, worked INT NOT NULL, work_start DATETIME NOT NULL, work_finish DATETIME NOT NULL, fights INT NOT NULL, fights_won INT NOT NULL, last_fight DATETIME NOT NULL, last_forum DATETIME NOT NULL, last_msg DATETIME NOT NULL, bot TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE characters');
    }
}
