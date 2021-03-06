<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class StudentsController extends Controller
{
    /**
     * @Route("/", name="students")
     */
    public function index()
    {
        return $this->render('students/index.html.twig', [
            'controller_name' => 'StudentsController',
        ]);
    }

    /**
     * @Route("/validate/{element}", name="validatePerson")
     * @Method({"POST"})
     */
    public function validate(Request $request, $element)
    {
        try {
            $input = json_decode($request->getContent(), true)['input'];
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }
        $students = $this->getStudents();

        switch ($element) {
            case 'name':
            case 'team':
                return new JsonResponse(['valid' => in_array(strtolower($input), $students[$element])]);
        }

        return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
    }
    private function getStorage()
    {
        return /** @lang json */
        '{
          "Po pamok\u0173": {
            "mentor": "Tomas",
            "members": [
              "Elena",
              "Just\u0117",
              "Deimantas"
            ]
          },
          "Tech Guide": {
            "mentor": "Sergej",
            "members": [
              "Matas",
              "Martynas"
            ]
          },
          "Kelion\u0117s draugas": {
            "mentor": "Rokas",
            "members": [
              "Zbignev",
              "Aist\u0117"
            ]
          },
          "Wish A Gift": {
            "mentor": "Aistis",
            "members": [
              "Nerijus",
              "Olga"
            ]
          },
          "Mums pakeliui": {
            "mentor": "Paulius",
            "members": [
              "Egl\u0117",
              "Svetlana"
            ]
          },
          "Motyvacin\u0117 platforma": {
            "mentor": "Audrius",
            "members": [
              "Viktoras",
              "Airidas"
            ]
          }
        }';
    }

    private function getStudents() {
        $students = [];
        $teams = [];
        $storage = json_decode($this->getStorage(), true);
        foreach ($storage as $team => $teamData) {
            $teams[] = strtolower($team);
            foreach ($teamData['members'] as $student) {
                $students[] = strtolower($student);
            }
        }
        return [
            'name' => $students,
            'team' => $teams
    ];
    }
}

