<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180616172206 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE have_items DROP FOREIGN KEY FK_3F7E632126F525E');
        $this->addSql('DROP INDEX UNIQ_3F7E632126F525E ON have_items');
        $this->addSql('ALTER TABLE have_items CHANGE item_id iequipment_id INT NOT NULL');
        $this->addSql('ALTER TABLE have_items ADD CONSTRAINT FK_3F7E632ACB8B9A5 FOREIGN KEY (iequipment_id) REFERENCES equipment (id)');
        $this->addSql('CREATE INDEX IDX_3F7E632ACB8B9A5 ON have_items (iequipment_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE have_items DROP FOREIGN KEY FK_3F7E632ACB8B9A5');
        $this->addSql('DROP INDEX IDX_3F7E632ACB8B9A5 ON have_items');
        $this->addSql('ALTER TABLE have_items CHANGE iequipment_id item_id INT NOT NULL');
        $this->addSql('ALTER TABLE have_items ADD CONSTRAINT FK_3F7E632126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3F7E632126F525E ON have_items (item_id)');
    }
}
