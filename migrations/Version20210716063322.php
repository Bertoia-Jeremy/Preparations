<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210716063322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quizz (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_questions (quizz_id INT NOT NULL, questions_id INT NOT NULL, INDEX IDX_79E4F161BA934BCD (quizz_id), INDEX IDX_79E4F161BCB134CE (questions_id), PRIMARY KEY(quizz_id, questions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_guests (quizz_id INT NOT NULL, guests_id INT NOT NULL, INDEX IDX_17EE9AA3BA934BCD (quizz_id), INDEX IDX_17EE9AA3825B2E45 (guests_id), PRIMARY KEY(quizz_id, guests_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quizz_questions ADD CONSTRAINT FK_79E4F161BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_questions ADD CONSTRAINT FK_79E4F161BCB134CE FOREIGN KEY (questions_id) REFERENCES questions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_guests ADD CONSTRAINT FK_17EE9AA3BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_guests ADD CONSTRAINT FK_17EE9AA3825B2E45 FOREIGN KEY (guests_id) REFERENCES guests (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz_questions DROP FOREIGN KEY FK_79E4F161BA934BCD');
        $this->addSql('ALTER TABLE quizz_guests DROP FOREIGN KEY FK_17EE9AA3BA934BCD');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('DROP TABLE quizz_questions');
        $this->addSql('DROP TABLE quizz_guests');
    }
}
