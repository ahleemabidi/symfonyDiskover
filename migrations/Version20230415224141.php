<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230415224141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservationvehiculee DROP FOREIGN KEY fk_idEvent');
        $this->addSql('ALTER TABLE reservationvehiculee CHANGE IdEvent IdEvent INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservationvehiculee ADD CONSTRAINT FK_3F809E08E3D77026 FOREIGN KEY (IdEvent) REFERENCES colaborationevent (IdEvent)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservationvehiculee DROP FOREIGN KEY FK_3F809E08E3D77026');
        $this->addSql('ALTER TABLE reservationvehiculee CHANGE IdEvent IdEvent INT NOT NULL');
        $this->addSql('ALTER TABLE reservationvehiculee ADD CONSTRAINT fk_idEvent FOREIGN KEY (IdEvent) REFERENCES colaborationevent (IdEvent) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
