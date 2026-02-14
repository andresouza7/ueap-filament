<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Carrega rotas com prioridade para subdomínios
require __DIR__ . '/intranet.php';
require __DIR__ . '/transparencia.php';
require __DIR__ . '/site_antigo.php';

// Carrega rotas gerais
require __DIR__ . '/auth.php';
require __DIR__ . '/newsletter.php';
require __DIR__ . '/site.php';
