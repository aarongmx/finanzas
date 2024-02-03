<?php

use function Pest\Laravel\get;

test('Se muestra la ruta del componente correctamente', function () {
    get('/administracion/clientes')->assertSuccessful();
});
