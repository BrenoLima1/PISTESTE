```php
use Utils\RequestHelper;
use Utils\Response;
use Utils\Route;

require_once __DIR__ . '/globals.php';

$router = new Route();

/**
 * Método HTTP aceitos
 *
 * GET
 * POST
 * PUT
 * PATCH
 * DELETE
 */

$router->match(['get', 'post'], 'sua/rota', function () { /* Sua logica */});
$router->route(['get', 'post'], 'sua/rota', function () { /* Sua logica */});
$router->route('get', 'sua/rota', function () { /* Sua logica */});
$router->post('sua/rota', function () { /* Sua logica */});
$router->get('sua/rota', function () { /* Sua logica */});
$router->get('sua/rota', function () { /* Sua logica */});
$router->post('sua/rota', function () { /* Sua logica */});
$router->put('sua/rota', function () { /* Sua logica */});
$router->patch('sua/rota', function () { /* Sua logica */});
$router->delete('sua/rota', function () { /* Sua logica */});

// Exemplo
$router->get('detalhe', function () {
    $login = RequestHelper::input('login');

    return Response::json([
        'id' => 12,
        'login' => $login,
    ]);
});
// Fim do Exemplo

$router->listen();
```
