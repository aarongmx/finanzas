<?php

use function Pest\Laravel\get;

test('Se muestr la ruta del componente correctamente', function () {
    get('/clientes')->assertSuccessful();
});
