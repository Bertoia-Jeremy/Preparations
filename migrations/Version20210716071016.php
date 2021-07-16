<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210716071016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE quizz_guests');
        $this->addSql('ALTER TABLE quizz ADD guests_id INT NOT NULL');
        $this->addSql('ALTER TABLE quizz ADD CONSTRAINT FK_7C77973D825B2E45 FOREIGN KEY (guests_id) REFERENCES guests (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C77973D825B2E45 ON quizz (guests_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quizz_guests (quizz_id INT NOT NULL, guests_id INT NOT NULL, INDEX IDX_17EE9AA3825B2E45 (guests_id), INDEX IDX_17EE9AA3BA934BCD (quizz_id), PRIMARY KEY(quizz_id, guests_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE quizz_guests ADD CONSTRAINT FK_17EE9AA3825B2E45 FOREIGN KEY (guests_id) REFERENCES guests (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_guests ADD CONSTRAINT FK_17EE9AA3BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz DROP FOREIGN KEY FK_7C77973D825B2E45');
        $this->addSql('DROP INDEX UNIQ_7C77973D825B2E45 ON quizz');
        $this->addSql('ALTER TABLE quizz DROP guests_id');
    }
}
