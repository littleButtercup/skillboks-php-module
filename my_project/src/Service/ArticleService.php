<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\CommentRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ArticleService extends AbstractController
{
    protected
        $em,
        $markdownParser,
        $pasteWords,
        $arrayWordsBold,
        $paginator,
        $commentRepository,
        $tagRepository;

    public function __construct(
        EntityManagerInterface $em,
        MarkdownParser $markdownParser,
        PasteWords $pasteWords,
        ArticleContentProvider $arrayWordsBold,
        PaginatorInterface $paginator,
        CommentRepository $commentRepository,
        TagRepository $tagRepository
    )
    {
        $this->em = $em;
        $this->markdownParser = $markdownParser;
        $this->pasteWords = $pasteWords;
        $this->arrayWordsBold = $arrayWordsBold;
        $this->paginator = $paginator;
        $this->commentRepository = $commentRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * @return array
     */
    public function createWords(): array
    {
        $arrayWords = ['MEGAWORD', 'HYPERWORD', 'UBERWORD', 'COOLWORD', 'DUPERWORD'];
        $randon = rand(1, 10);
        $word = $arrayWords[rand(0, 4)];
        $randomWord = $randon <= 7 ? $word : "";
        $randomQuantity = $randon <= 7 ? $randon : 0;
        return [rand(1, 4), $randomWord, $randomQuantity];
    }

    public function getArticleHome()
    {
        $repository =  $this->em->getRepository(Article::class);
        $article = $repository->findLatestPublished();
        return $article;
    }

    /**
     * @param string $id
     * @return object
     */
    public function getArticleviewpage(string $id): object
    {
        $repository = $this->em->getRepository(Article::class);
        $article = $repository->findOneBy(['slug' => $id]);
        return $article;
    }

    /**
     * @param string $id
     * @return string
     */
    public function getArticleContent(string $id): string
    {
        $comand = $this->createWords();
        $article = $this->getArticleviewpage($id);
        $word_bold = $this->getParameter('$words_bold');
        $articleContent = $this->markdownParser->parse($this->pasteWords->
        paste(unserialize($article->getBody()), $word_bold .$comand[1] . $word_bold, $comand[2]));
        return $articleContent;
    }

    /**
     * @param string $type
     * @param string $id
     * @return object
     */
    public function vote(string $type, string $id): object
    {
        $article =$this->getArticleviewpage($id);
        if ($type == 'voteUp') {
            $article->setVoteCount($article->getVoteCount() + 1);
        } elseif ($type == 'voteDown') {
            $article->setVoteCount($article->getVoteCount() - 1);
        }
        $this->em->flush();

        return $article;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getReqwest(Request $request): string
    {
        $arrayWords = $this->createWords();
        $word_bold = $this->getParameter('$words_bold');
        $request->query->set('paragraphs', $arrayWords[0]);
        $request->query->set('word', $arrayWords[1]);
        $request->query->set('wordsCount', $arrayWords[2]);
        $divElement = $this->markdownParser->parse($this->arrayWordsBold->get($arrayWords[0], $word_bold . $arrayWords[1] . $word_bold, $arrayWords[2]));
        return $divElement;
    }

    /**
     * @param Request $request
     * @return PaginationInterface
     */
    public function showComments(Request $request): PaginationInterface
    {
       return $this->paginator->paginate(
            $this->commentRepository->findComment($request->query->get('q'), $request->query->has('showDeleted')),
           $request->query->getInt('page', 1), /*page number*/
           $request->query->getInt('limit', 20) /*limit per page*/
        );
    }

    /**
     * @param Request $request
     * @return PaginationInterface
     */
    public function showTag(Request $request): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->tagRepository->findTags($request->query->get('q'), $request->query->has('showDeleted')),
            $request->query->getInt('page', 1), /*page number*/
            $request->query->getInt('limit', 20) /*limit per page*/
        );
    }
}