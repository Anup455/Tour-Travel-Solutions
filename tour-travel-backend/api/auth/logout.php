<?php require_once __DIR__.'/../../middleware/bootstrap.php';$_SESSION=[];session_destroy();json_out(['message'=>'Signed out.']);
