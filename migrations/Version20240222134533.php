<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222134533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE author 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(50) NOT NULL, 
                address VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id)
            ) 
            DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE book 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                editor_id INT NOT NULL, 
                author_id INT NOT NULL, 
                isbn VARCHAR(15) NOT NULL, 
                title VARCHAR(255) NOT NULL, 
                summary LONGTEXT NOT NULL, 
                description LONGTEXT NOT NULL, 
                price DOUBLE PRECISION NOT NULL, 
                INDEX IDX_CBE5A3316995AC4C (editor_id), 
                INDEX IDX_CBE5A331F675F31B (author_id), 
                PRIMARY KEY(id)
            ) 
        DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE editor 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(50) NOT NULL, 
                address VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id)
            ) 
            DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE user 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                email VARCHAR(180) NOT NULL, 
                roles JSON NOT NULL COMMENT \'(DC2Type:json)\', 
                password VARCHAR(255) NOT NULL, 
                UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), 
                PRIMARY KEY(id)
            ) 
            DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE book 
            ADD CONSTRAINT FK_CBE5A3316995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id)'
        );
        $this->addSql(
            'ALTER TABLE book 
            CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id)'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3316995AC4C');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE user');
    }
}
