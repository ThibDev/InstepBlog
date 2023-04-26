<?php 

namespace App\EntityListener;

use App\Entity\Themes;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class ThemesEntityListener
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Themes $themes, LifecycleEventArgs $event)
    {
        $themes->computeSlug($this->slugger); 
    }

    public function preUpdate(Themes $themes, LifecycleEventArgs $event)
    {
        $themes->computeSlug($this->slugger);
    }
}