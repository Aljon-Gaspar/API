<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../src/vendor/autoload.php';
$app = new \Slim\App;

$app->get('/orgstructure', function (Request $request, Response $response, array $args) {

    $OrgStructure = array(
        'University' => 'Don Mariano Marcos Memorial State University (DMMMSU)',
        'ORGANIZATIONAL STRUCTURE' => array(
            'Board of Regents' => array(
                'President' => 'Dr. Jaime I. Manuel Jr.',
                'Board Secretary' => 'Dr. Antonio O. Obginar',
                'University Secretary' => 'Dr. Antonio O. Obginar',
                'Academic Affairs' => array(
                    'Vice President, Academic Affairs' => 'Dr. Elsie M. Pacho',
                    'OIC-Director, Instructor' => 'Prof. Laiza T. Astodillo',
                    'Director, Student Affairs and Services' => 'Dr. Shalimar L. Navalta',
                    'Director, Sports' => 'Dr. Paulo Jan F. Samson',
                    'Director, Cultural Affairs' => 'Prof. Irene N. Gomez',
                    'Director, Library Services & Development' => 'Dr. Sonia S. Isip',
                    'Director, Student Admission & Records' => 'Dr. Valoree M. Salamanca',
                    'Director, Alumni Affairs' => 'Dr. Lher Verell S. Palabay',
                    'Director, Internationalization, Linkages, & ETEEAP' => 'Dr. Jesus Rafael B. Jarata',
                ),
                'Research and Extension' => array(
                    'Vice President, Research and Extension' => 'Dr. Angelina T. Gonzales',
                    'Director, Research' => 'Prof. Keneth G. Bayani',
                    'Director, Extension' => 'Prof. Emerita D. Galiste',
                ),
                'Administration Office' => array(
                    'Vice President, Administration Office' => 'Dr. Estrella N. Perez',
                    'Director, Administrative Services' => 'Atty. Kristine Gay B. Balang',
                    'Director, Auxiliary Services' => 'Dr. Florendo Q. Damasco Jr.',
                    'Director, Finance Services' => 'Dr. Placida E. De Guzman',
                    'Director, Medical Services' => 'Dr. Ma. Consuelo W. Alcantara',
                    'Director, Internal Quality Assurance System' => 'Dr. Angelita J. Prado',
                ),
                'Planning & Resource Development' => array(
                    'Vice President, Planning & Resource Development' => 'Dr. Priscilo P. Fontanilla',
                    'Director, Management Information System' => 'Engr. Rufo A. Baro',
                    'Director, Business Affairs' => 'Prof. Melchor D. Salom',
                    'Director, Planning and Development' => 'Prof. Lilito D. Gavina',
                    'Director, Resource Development & GAD Focal Person' => 'Dr. Sherlyn Marie D. Nitura',
                ),
                'College Deans & Institute Directors' => array(
                    'Admin & Tech Support' => array(
                        'Chancellor, North La Union Campus' => 'Dr. Junifer Rey E. Tabafunda',
                        'Chancellor, Mid La Union Campus' => 'Dr. Eduardo C. Corpuz',
                        'Chancellor, South La Union Campus' => 'Dr. Joanne C. Rivera',
                    ),
                ),
                'Program Coordinator(s)' => array(
                    'Admin & Tech Support' => array(
                        'Executive Director, Open University System' => 'Dr. Cristina G. Guerra',
                    ),
                ),
                'R & E Implementers' => array(
                    'Admin & Tech Support' => array(
                        'Executive Director, Sericulture Research & Development Institute' => 'Dr. Cristeta F. Gapuz',
                        'Executive Director, National Apiculture Research Training & Development Institute' => 'Dr. Gregory B. Viste',
                    ),
                ),
            ),
        ),
    );

    $response = $response->withHeader('Content-Type', 'application/json');
    $response->getBody()->write(json_encode($OrgStructure, JSON_PRETTY_PRINT));

    return $response;
});

$app->run();
?>