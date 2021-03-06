<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 08/02/2017
 * Time: 17:07
 */

namespace BackBundle\DataFixtures\ORM;

use BackBundle\DBAL\ChallengeSubjectType;
use BackBundle\Entity\ChallengeSubject;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadChallengeSubjectData extends AbstractFixture implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $challenge = $this->getReference('challenge-monthly');
        for ($i = 1 ; $i <= 12 ; $i++) {
            $month = strtotime(date('Y').'-'.$i.'-01');
            $lastDayOfMonth = date('t', $month);
            $startDate = new \DateTime(date('Y-'.$i.'-01 00:00:00'));
            $endDate = new \DateTime(date('Y-'.$i.'-'.$lastDayOfMonth.' 23:59:50'));
            $challengeSubject = new ChallengeSubject($challenge);
            $challengeSubject->setStartSubmissionDate($startDate);
            $challengeSubject->setEndSubmissionDate($endDate);
            $challengeSubject->setName('Sujet ' . $i);
            $challengeSubject->setType(ChallengeSubjectType::LANDSCAPE);
            $challengeSubject->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
            $challengeSubject->setSubject('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');


            $manager->persist($challengeSubject);
//            $this->setReference('challenge-subject-', $challengeSubject);
        }
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }

    /**
     * Returns the environments the fixtures may be loaded in.
     *
     * @return array The name of the environments.
     */
    protected function getEnvironments()
    {
        return array('dev', 'test', 'preprod');
    }
}