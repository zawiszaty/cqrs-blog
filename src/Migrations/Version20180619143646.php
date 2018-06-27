<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180619143646 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE id id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE comment CHANGE id id VARCHAR(255) NOT NULL, CHANGE post post VARCHAR(255) DEFAULT NULL, CHANGE user user VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE post CHANGE id id VARCHAR(255) NOT NULL, CHANGE user user VARCHAR(255) DEFAULT NULL, CHANGE category category VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE id id VARCHAR(255) NOT NULL, CHANGE confirmed confirmed TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE id id VARCHAR(255) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE comment CHANGE id id VARCHAR(255) NOT NULL COLLATE utf8_general_ci, CHANGE post post VARCHAR(255) NOT NULL COLLATE utf8_general_ci, CHANGE user user VARCHAR(255) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE post CHANGE id id VARCHAR(255) NOT NULL COLLATE utf8_general_ci, CHANGE category category VARCHAR(255) NOT NULL COLLATE utf8_general_ci, CHANGE user user VARCHAR(255) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE user CHANGE id id VARCHAR(255) NOT NULL COLLATE utf8_general_ci, CHANGE confirmed confirmed TINYINT(1) DEFAULT \'0\' NOT NULL');
    }
}
