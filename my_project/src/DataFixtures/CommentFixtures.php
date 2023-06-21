<?php

namespace App\DataFixtures;
use App\Entity\Article;
use App\Entity\Comment;
use App\Service\CommentContentProvider;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * фикстура заполняет таблицу comment
 */
class CommentFixtures extends BaseFixterus implements DependentFixtureInterface
{
    const ARTICLE_COMMENT_AUTHORS = [
        'Барон Сосискин',
        'Фронтенд Фулстков',
        'Вью j эс'
    ];

    const ARTICLE_COMMENT = [
        'Adipisci quia dolores non vel vero suscipit. Et voluptates aut alias consequatur.',
        'Nunquam transferre equiso. Amicitia, elevatus, et tumultumque. Cur extum tolerare? Ubi est rusticus domus?',
        'Yarr, ye jolly cannibal - set sails for death!'
    ];

//    устанавливает класс, для внесения в комментарии слова в случайном месте и случайное количество раз
    public function __construct(CommentContentProvider $content)
    {
        $this->commentsContent = $content;
    }

    /**
     * @param ObjectManager $manager
     * @return void
     */

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Comment::class, 100, function (Comment $comment) {
            $this->commentsContent->takeComment(self::ARTICLE_COMMENT);
            if (rand(1, 10) <= 7) {
                $text = $this->commentsContent->get('BIGWORD', 5);
            } else {
                $text = $this->faker->randomElement(self::ARTICLE_COMMENT);
            }

            $comment
                ->setAuthorName($this->faker->randomElement(self::ARTICLE_COMMENT_AUTHORS))
                ->setContent($text)
                ->setArticle($this->getRandomReference(Article::class))
                ->setCreatedAt($this->faker->dateTimeBetween('-100 day', '-1 day'));

            if ($this->faker->boolean) {
                $comment->setDeletedAt($this->faker->dateTimeThisMonth);
            }
        });

        $manager->flush();
    }

    /**
     * @return array
     */

    public function getDependencies(): array
    {
        return [
            ArticleFixtures::class,
        ];
    }

}
