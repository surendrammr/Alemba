<?php

Route::get('/backend/alemba/alemba/emails/{id}/send', ['as' => 'send-email', 'uses' => 'Alemba\Alemba\Controllers\Emails@send', function ($id) {
    // Emails::send() function called
}]);

?>