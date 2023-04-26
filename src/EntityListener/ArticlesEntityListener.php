<?php 

namespace App\EntityListener;

use App\Entity\Articles;
use DateTimeImmutable;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticlesEntityListener
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Articles $articles, LifecycleEventArgs $event)
    {
        $articles->computeSlug($this->slugger);
    }

    public function preUpdate(Articles $articles, LifecycleEventArgs $event)
    {
        $articles->computeSlug($this->slugger);
    }
}