<?php
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['name'=>'Wanderly Tour & Travel API','status'=>'ready','api'=>['auth','packages','destinations','bookings','admin','contact']]);
