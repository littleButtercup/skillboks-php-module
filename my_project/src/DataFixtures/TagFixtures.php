<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;

/**
 * фикстура создаёт установленное количество тегов
 */
class TagFixtures extends BaseFixterus
{
    /**
     * @param ObjectManager $manager
     * @return void
     */

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Tag::class, 50, function (Tag $tag) {
            $tag->setName($this->faker->realText(50));

            if ($this->faker->boolean) {
                $tag->setDeletedAt($this->faker->dateTimeThisMonth);
            }
        });
        $manager->flush();
    }
}
