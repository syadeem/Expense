<?php

require 'vendor/autoload.php';
use RedBean_Facade as R;

$app = new \Slim\Slim(
    array(
        'templates.path' => './public/templates'
    )
);



R::setup('mysql:host=localhost;
        dbname=chores','root','admin123');

$exp = R::findAll('expenses');

$app->get('/', function() use ($app) {

    $app->render('expenses_listing.php', array(
        'page_title' => 'Welcome to Chores Management',
        'expenses' => R::findAll('expenses')
    ));

});

$app->post('/create_expense', function() use ($app) {
    $form = $app->request()->params();
    $expense = R::dispense('expenses');
    $expense->desc = $form['desc'];
    $expense->amount = $form['amt'];
    $expense->created_on = time();
    $id = R::store($expense);
    if ( $id ) {
        $app->flash('success', 'Your expense has been created successfully!');
        $app->redirect('/');
    } else {
        $app->flash('error', 'Something went wrong..');
        $app->redirect('/');
    }
//    echo "<pre>"; print_r($form); exit;
});
// Singleton
$app->get('/expense/delete/:id', function($id) {
    $expense = R::load('expenses', $id);
    $done = R::trash($expense);
    $app = \Slim\Slim::getInstance();
    if ( $done) {
        $app->flash('success', 'Your expense has been deleted successfully!');
        $app->redirect('/   ');
    } else {
        $app->flash('error', 'Something went wrong to fix this problem! Report 500 to developers!');
        $app->redirect('/');
    }
});

$app->run();


//echo "<pre>"; print_r($app); exit;