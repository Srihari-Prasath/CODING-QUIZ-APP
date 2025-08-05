<?php

require_once __DIR__ . '/auth.php'; 


header('Content-Type: application/json');

require_role(['faculty']);
