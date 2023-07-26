<?php

namespace App\DataFixtures;
use App\Entity\Article;
use App\Entity\Tag;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * фикстура заполняет таблицу article
 */
class ArticleFixtures extends BaseFixterus implements DependentFixtureInterface
{
    const ARTICLE_TITLES = [
        'Когда пролил кофе на клавиатуру',
        'Facebook ест твои данные',
        'Что делать, если надо верстать',
    ];

    const ARTICLE_AUTHORS = [
        'Флекс Абсолютович',
        'Хэтээьэль Цеэсесович',
        'Квертир',
    ];

    const ARTICLE_IMAGES = [
        'images/article-1.jpeg',
        'images/article-2.jpeg',
        'images/article-3.jpg',
    ];

    /**
     * @param ObjectManager $manager
     * @return void
     */

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Article::class, 6, function (Article $article) use ($manager) {

            $article
                ->setTitle($this->faker->randomElement(self::ARTICLE_TITLES))
                ->setDescription('какое-то описание')
                ->setBody(serialize([
                    "Lorem ipsum кофе dolor sit amet, consectetur adipiscing elit, sed
             do eiusmod tempor incididunt  Абсолютович ut labore et dolore magna aliqua.
             Purus viverra accumsan in nisl. Diam vulputate ut pharetra sit amet aliquam. Faucibus a
             pellentesque sit amet porttitor eget dolor morbi non. Est ultricies integer quis auctor
             elit sed. Tristique nulla aliquet enim tortor at. Tristique et egestas quis ipsum. Consequat semper viverra nam
             libero. Lectus quam id leo in vitae turpis. In eu mi bibendum neque egestas congue
             quisque egestas diam.кофе blandit turpis cursus in hac habitasse platea dictumst quisque.",

                    "Ullamcorper malesuada proin libero nunc consequat interdum varius sit amet. Odio pellentesque
             diam volutpat commodo sed egestas. Eget nunc lobortis mattis aliquam. Cursus vitae congue
             mauris rhoncus aenean vel. Pretium viverra suspendisse potenti nullam ac tortor vitae.
             A pellentesque sit amet porttitor eget dolor. Nisl nunc mi ipsum faucibus vitae. Purus sit amet
             luctus venenatis lectus magna fringilla urna. Sit amet tellus cras adipiscing enim. Euismod
             nisi porta lorem mollis aliquam ut porttitor leo.",

                    "Morbi blandit cursus risus at ultrices. Adipiscing vitae proin sagittis nisl rhoncus mattis
             rhoncus. Sit amet commodo nulla facilisi. In fermentum et sollicitudin ac orci phasellus
             egestas tellus. Sit amet risus nullam eget felis. Dapibus ultrices in iaculis nunc sed
             augue lacus viverra. Dictum non consectetur a erat nam at. Odio ut enim blandit volutpat
             maecenas. Turpis cursus in hac habitasse platea. Etiam erat velit scelerisque in. Auctor
             neque vitae tempus quam pellentesque nec nam aliquam. Odio pellentesque diam volutpat commodo
             sed egestas egestas. Egestas dui id ornare arcu odio ut."]))
                ->setAuthor($this->faker->randomElement(self::ARTICLE_AUTHORS))
                ->setKeywords('верстать')
                ->setVoteCount($this->faker->numberBetween(0, 10))
                ->setImageFilename($this->faker->randomElement(self::ARTICLE_IMAGES));

            if ($this->faker->boolean(60)) {
                $article->setPublishedAt(DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 day', '-1 day')));
            }

//            вытаскивает несколько тегов
            /** @var Tag[] $tags */
            $tags = [];
            for ($i = 0; $i < $this->faker->numberBetween(0, 5); $i++) {
                $tags[] = $this->getRandomReference(Tag::class);
            }

//            привязывает тег к статье
            foreach ($tags as $tag) {
                $article->addTag($tag);
            }
        });
    }

    /**
     * @return array
     */

    public function getDependencies(): array
    {
        return [
            TagFixtures::class,
        ];
    }
}
