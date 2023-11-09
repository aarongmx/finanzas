<?php

use function Pest\Laravel\get;

test('Se muestra la ruta a la tabla de cuentas', function () {
    get('/cuentas')->assertSuccessful();
});
