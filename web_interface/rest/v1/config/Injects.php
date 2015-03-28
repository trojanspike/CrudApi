<?php

use App\Session;
/* Generate a new token */

Session::set('new_token', AuthTokenGenerate());
