<?php
namespace Volleyball\Bundle\AttendeeBundle\Controller;

class LevelController extends \Volleyball\Bundle\UtilityBundle\Controller\Controller
{
    /**
     * Index action
     * @inheritdoc
     */
    public function indexAction(array $levels)
    {
        return ['levels' => $this->getLevels()];
    }

    /**
     * New action
     * @inheritdoc
     */
    public function newAction()
    {
        $level = new \Volleyball\Bundle\AttendeeBundle\Entity\Level();
        $form = $this->createBoundObjectForm($level, 'new');

        if ($form->isBound() && $form->isValid()) {
            $this->persist($level, true);
            $this->addFlash('level created');

            return $this->redirectToRoute('volleyball_levels_index');
        }

        return ['form' => $form->createView()];
    }
    
    /**
     * Search action
     * @inheritdoc
     */
    public function searchAction(array $levels)
    {
        $level = new \Volleyball\Bundle\AttendeeBundle\Entity\Level();
        $form = $this->createBoundObjectForm($level, 'search');
        
        if ($form->isBound() && $form->isValid()) {
            /** @TODO finish level search, also restrict access */
            $levels = array();

            return ['levels' => $levels];
        }

        return ['form' => $form->createView()];
    }
    
    /**
     * Show action
     * @inheritdoc
     */
    public function showAction(\Volleyball\Bundle\AttendeeBundle\Entity\Level $level)
    {
        return ['level' => $level];
    }


}