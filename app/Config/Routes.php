<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('inocio', 'Home::index');
$routes->get('services', 'Home::services');
$routes->get('sobree', 'Home::sobrees');
$routes->get('contactos', 'Home::contactos');
$routes->get('Loggin', 'Home::login');
$routes->post('Signin', 'Home::signine');
$routes->get('Deconnected', 'Home::logouted');
$routes->get('terms', 'Home::downloadTerms');
$routes->get('politics', 'Home::downloadPolitics');

/***********************************************My Routes begin */

$routes->get('Case_study1', 'Lawboss::casestudy1');
$routes->get('Case_study2', 'Lawboss::casestudy2');
$routes->get('Case_study3', 'Lawboss::casestudy3');

/*****About us ************** */
$routes->get('About_us', 'Lawboss::about_us');
$routes->get('Contact', 'Lawboss::contacte');

/*********************Pages*********** */
$routes->get('Team', 'Lawboss::teams');
$routes->get('services', 'Lawboss::services');
$routes->get('Portfolio', 'Lawboss::portfolios');
$routes->get('Faq', 'Lawboss::faq');

/*****************************Blog*********************** */
$routes->get('Blog_liste', 'Lawboss::blog_list');
$routes->get('Blog_column', 'Lawboss::blog_columns');
$routes->get('Blog_detail', 'Lawboss::blog_details');

/**********************Index********************** */
$routes->get('Index', 'Lawboss::index');
$routes->get('Index2', 'Lawboss::index2');



/******************************Client Routes******************* */
$routes->get('Client', 'Client::index');
$routes->get('Newclient', 'Client::newclient');
$routes->post('Valider', 'Client::save_newclient');
$routes->get('Client_alter/(:any)/(:any)', 'Client::infoclient/$1/$2'); // modification
$routes->post('upatedclient', 'Client::updateclient');

/*********************************Personnel Routes******************************/
$routes->get('Liste_personnel', 'Personnel::index');
$routes->get('Personnel_alter/(:any)/(:any)', 'Personnel::infoemployer/$1/$2');
$routes->post('upatedemployer', 'Personnel::upateemployer');

$routes->get('Employer_alter/(:any)/(:any)', 'Personnel::infoemployer/$1/$2');

$routes->get('Fiche_salaire', 'Personnel::fiche_salaire');






