<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180617190422 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE have_items DROP FOREIGN KEY FK_3F7E632ACB8B9A5');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D583EA51AAB7');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D5833291518');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE have_items');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE stat');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, statid_id INT NOT NULL, itemid_id INT NOT NULL, type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, subtype VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, hands INT DEFAULT 0 NOT NULL, class VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_D338D5833291518 (statid_id), UNIQUE INDEX UNIQ_D338D583EA51AAB7 (itemid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE have_items (id INT AUTO_INCREMENT NOT NULL, charac_id INT NOT NULL, iequipment_id INT NOT NULL, quantity INT DEFAULT 1 NOT NULL, inuse TINYINT(1) NOT NULL, INDEX IDX_3F7E632FF03E368 (charac_id), INDEX IDX_3F7E632ACB8B9A5 (iequipment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, img VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, purchaselvl INT DEFAULT 1 NOT NULL, foundlvl INT DEFAULT 1 NOT NULL, uselvl INT DEFAULT 1 NOT NULL, goldvalue INT DEFAULT 0 NOT NULL, silvervalue INT DEFAULT 0 NOT NULL, coppervalue INT DEFAULT 0 NOT NULL, exp INT DEFAULT 0 NOT NULL, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, uses INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stat (id INT AUTO_INCREMENT NOT NULL, ability INT DEFAULT 0 NOT NULL, hp INT DEFAULT 0 NOT NULL, ad INT DEFAULT 0 NOT NULL, md INT DEFAULT 0 NOT NULL, armor INT DEFAULT 0 NOT NULL, magicdef INT DEFAULT 0 NOT NULL, speed INT DEFAULT 0 NOT NULL, critic INT DEFAULT 0 NOT NULL, inte INT DEFAULT 0 NOT NULL, manna INT DEFAULT 0 NOT NULL, strength INT DEFAULT 0 NOT NULL, spirit INT DEFAULT 0 NOT NULL, agility INT DEFAULT 0 NOT NULL, fury INT DEFAULT 0 NOT NULL, firedmg INT DEFAULT 0 NOT NULL, fireres INT DEFAULT 0 NOT NULL, waterdmg INT DEFAULT 0 NOT NULL, waterres INT DEFAULT 0 NOT NULL, earthdmg INT DEFAULT 0 NOT NULL, earthres INT DEFAULT 0 NOT NULL, airdmg INT DEFAULT 0 NOT NULL, airres INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D5833291518 FOREIGN KEY (statid_id) REFERENCES stat (id)');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583EA51AAB7 FOREIGN KEY (itemid_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE have_items ADD CONSTRAINT FK_3F7E632ACB8B9A5 FOREIGN KEY (iequipment_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE have_items ADD CONSTRAINT FK_3F7E632FF03E368 FOREIGN KEY (charac_id) REFERENCES characters (id)');
    }
}
