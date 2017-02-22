<?php

namespace RichardPQ\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Yaml\Parser;

class DefaultController extends Controller
{

    /**
     * @Route("admin/menu")
     *
     */
    public function menuAction()
    {

        $yaml = new Parser();
        $value = $yaml->parse(file_get_contents($this->get('kernel')
                ->getRootDir().'/../src/RichardPQ/AdminBundle/Resources/views/menu.yml'));

        return $this->render('RichardPQAdminBundle::base.html.twig', ['menus' => $value]);
    }

    /**
     * @Route("admin/example_table_1")
     */
    public function table1Action()
    {
        $persona1 = new \stdClass();
        $persona1->Nombre = "Manuel";
        $persona1->Apellido = "ramirez";
        $persona1->edad = "34";
        $persona1->ciudad = "Bogota";
        $persona1->telefono = "123";

        $persona2 = new \stdClass();
        $persona2->Nombre = "Cristian";
        $persona2->Apellido = "Rocha";
        $persona2->edad = "25";
        $persona2->ciudad = "Bogota";
        $persona2->telefono = "456";

        $todos = [
            $persona1,
            $persona2,
        ];



        return $this->render('@Admin/Default/table.html.twig', ['mh_notifications' => 5,
                'headers' =>
                    [
                        "Nombre",
                        "Apellido",
                        "edad",
                        "ciudad",
                        "telefono"
                    ],
                'data' =>
                    $todos,


            'functionScript' =>
            [
                'paging' => "false",
                'lengthChange' => "true",
                'searching' => "true",
                "ordering"=> "true",
                "info" => "true",
                "autoWidth" => "true"
            ]
                ]
        );
    }

    /**
     * @Route("admin/example_table_2")
     */
    public function table2Action()
    {
        $persona1 = new \stdClass();
        $persona1->Nombre = "Manuel";
        $persona1->Apellido = "ramirez";
        $persona1->edad = "34";
        $persona1->ciudad = "Bogota";
        $persona1->telefono = "123";

        $persona2 = new \stdClass();
        $persona2->Nombre = "Cristian";
        $persona2->Apellido = "Rocha";
        $persona2->edad = "25";
        $persona2->ciudad = "Bogota";
        $persona2->telefono = "456";

        $todos = [
            $persona1,
            $persona2,
        ];



        return $this->render('@Admin/Default/example.table.2.html.twig', ['mh_notifications' => 5,
                'headers_1' =>
                    [
                        "Nombre",
                        "Apellido",
                        "edad",
                        "ciudad",
                        "telefono"
                    ],
                'data_1' =>
                    $todos,
                'functionScript_1' =>
                    [
                        'paging' => "false",
                        'lengthChange' => "true",
                        'searching' => "true",
                        "ordering"=> "true",
                        "info" => "true",
                        "autoWidth" => "true"
                    ],
                'headers_2' =>
                    [
                        "Nombre",
                        "Apellido",
                        "edad",
                        "ciudad",
                        "telefono"
                    ],
                'data_2' => $todos,
                'functionScript_2' =>
                    [
                        'paging' => "false",
                        'lengthChange' => "true",
                        'searching' => "true",
                        "ordering"=> "true",
                        "info" => "true",
                        "autoWidth" => "true"
                    ]
            ]
        );
    }
}
