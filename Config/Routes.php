<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/administration', 'AdminControllers::index');
$routes->get('/development', 'DevControllers::index');
$routes->get('/sig', 'SigControllers::index');
$routes->get('/smqe', 'SmqeControllers::index');
$routes->get('/technique', 'TechControllers::index');
$routes->get('/marketing-digital', 'MarketDControllers::index');
$routes->get('/direction', 'DirectionControllers::index');
$routes->get('/framework', 'FrameworkControllers::index');
$routes->get('/gpts', 'GptsControllers::index');
$routes->get('/prompts', 'PromptControllers::index');
$routes->get('/outilia', 'OutiliaControllers::index');
$routes->get('/listefaqs', 'ListeFaqsControllers::index');
// Appliquer le filtre à toutes les routes nécessitant une authentification
$routes->group('', ['filter' => 'auth'], function($routes) {
    //FAQs
    $routes->get('/faqs', 'FaqController::index');
    $routes->get('faqs/edit/(:num)', 'FaqController::editFaq/$1');
    $routes->match(['get', 'post'], 'faqs/update/(:num)', 'FaqController::updateFaq/$1');
    $routes->get('faqs/delete/(:num)', 'FaqController::deleteFaq/$1');
    $routes->get('faqs/create', 'FaqController::showCreateForm');
    //Projects
    $routes->get('/projects', 'ProjectsController::index');
    $routes->post('projects/delete/(:num)', 'ProjectsController::delete/$1');
    $routes->get('projects/create', 'ProjectsController::create');
    $routes->post('projects/store', 'ProjectsController::store');
    $routes->get('projects/edit/(:num)', 'ProjectsController::edit/$1');
    $routes->post('projects/update/(:num)', 'ProjectsController::update/$1');
    //Domains
    $routes->get('/domains', 'DomainsController::index');
    $routes->get('domains/create', 'DomainsController::create');
    $routes->post('domains/store', 'DomainsController::store');
    $routes->get('domains/edit/(:num)', 'DomainsController::edit/$1');
    $routes->post('domains/update/(:num)', 'DomainsController::update/$1');
    $routes->post('domains/delete/(:num)', 'DomainsController::delete/$1');
    //promptia
$routes->match(['get', 'post'], 'promptia/create', 'PromptControllers::create');
$routes->match(['get', 'post'], 'promptia/edit/(:segment)', 'PromptControllers::edit/$1');
$routes->get('promptia/delete/(:segment)', 'PromptControllers::delete/$1'); 
});
$routes->get('/login', 'Auth::login');
$routes->post('auth/login', 'Auth::login');        // Traite la soumission du formulaire
$routes->get('auth/logout', 'Auth::logout');
//aute
$routes->get('auth/register', 'Auth::showRegisterForm');  // Affiche le formulaire d'inscription
$routes->post('auth/register', 'Auth::initialRegistration'); 
$routes->get('/auth/confirm', 'Auth::showConfirmationForm');
$routes->post('auth/finalizeRegistration', 'Auth::finalizeRegistration'); 
$routes->add('(.*)', function($path) {
    echo "Le chemin demandé est : " . $path;
});
