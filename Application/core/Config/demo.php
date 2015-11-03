<?php

return [
    
    'quotes' => json_decode( file_get_contents( __DIR__.'/../Storage/quotes.json' ) )
        
];