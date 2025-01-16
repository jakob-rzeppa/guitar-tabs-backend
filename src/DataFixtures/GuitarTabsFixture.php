<?php

namespace App\DataFixtures;

use App\Entity\GuitarTab;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GuitarTabsFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $guitarTab = new GuitarTab();
        $guitarTab->setName('Hotel California');
        $guitarTab->setArtist('Eagles');
        $guitarTab->setCapo(7);
        $guitarTab->setUploadedAt(new \DateTimeImmutable('2021-01-01'));
        $guitarTab->setContent('\n[Verse]\nBm F# A E G D Em F#\nBm F# A E G D Em F#\nBm F# A E G D Em F#\nBm F# A E G D Em F#\n[Chorus]\nG D F# Bm G D Em F#\nG D F# Bm G D Em F#\nG D F# Bm G D Em F#\nG D F# Bm G D Em F#');
        $manager->persist($guitarTab);

        $manager->flush();
    }
}
