<?php

namespace App\Controller\Admin\articles;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class createController extends AbstractController
{
    /**
     * @Route("/admin/articles/create", name="app_admin_articles_create")
     */
    public function create(EntityManagerInterface $em): Response
    {

        $article = new Article();

        $article
            ->setTitle('Что делать, если надо верстать')
            ->setSlug('slug3')
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
            ->setAuthor('Квертир')
            ->setKeywords('верстать')
            ->setVoteCount(0)
            ->setImageFilename('images/article-3.jpg');

            if (rand(1, 10) > 4){
                $article->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days',rand(0, 50))));
            }

            $em->persist($article);
            $em->flush();

        return new Response(sprintf( 'статья id: %d slug:%s',
        $article->getId(),
        $article->getSlug()
        ));
    }
}
