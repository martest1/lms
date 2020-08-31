<?php

declare(strict_types=1);

namespace App\Controller;

use App\BusinessCase\BusinessCaseInterface;
use App\Entity\User;
use App\Entity\Word;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController {

    public function index(Request $request, BusinessCaseInterface $businessCase, EntityManagerInterface $em)
    {
        $text = $request->get('lms_text');
        $calculated = [];
        if (!empty($text)) {
            $user = new User($request->getClientIp());
            $em->persist($user);

            // solve the business case (calculate number of words)
            $calculated = $businessCase
                ->getBusinessCase('calculate_number_of_words_in_text')
                ->setData($text)
                ->solve()
                ->returnResult();

            if (!empty($calculated)) {
                foreach ($calculated as $word => $count) {
                    $wordEntity = new Word();
                    $wordEntity->setWord($word);
                    $wordEntity->setUserId($user);
                    $wordEntity->setCount($count);

                    $em->persist($wordEntity);
                }
            }
            $em->flush();
        }

        return $this->render('main.html.twig', [
            'text' => $text,
            'calculated' => $calculated,
            'rating' => ['***', '**', '*'],
            'default' => '-',
        ]);
    }
}
