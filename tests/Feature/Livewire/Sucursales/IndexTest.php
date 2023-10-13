<?php

use function Pest\Laravel\get;

test('Se muestra la url de sucursales', function(){
   get('/sucursales')->assertSuccessful();
});
