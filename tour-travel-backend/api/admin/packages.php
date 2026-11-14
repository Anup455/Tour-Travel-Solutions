<?php
require_once __DIR__.'/../../middleware/bootstrap.php';require_once __DIR__.'/../../config/database.php';require_admin();$d=body();
if($_SERVER['REQUEST_METHOD']==='GET')json_out(['packages'=>$pdo->query('SELECT p.*,d.destination_name FROM packages p JOIN destinations d ON d.id=p.destination_id ORDER BY p.created_at DESC')->fetchAll()]);
if($_SERVER['REQUEST_METHOD']==='DELETE'){$s=$pdo->prepare('DELETE FROM packages WHERE id=?');try{$s->execute([(int)($d['id']??0)]);}catch(PDOException $e){json_out(['message'=>'Package is referenced by bookings and cannot be deleted.'],409);}json_out(['message'=>'Package deleted.']);}
foreach(['destination_id','package_name','description','duration','price']as$k)if(!isset($d[$k])||$d[$k]==='')json_out(['message'=>"$k is required."],422);
$status=($d['status']??'active')==='inactive'?'inactive':'active';$details=[$d['itinerary']??'',$d['accommodation']??'',$d['transportation']??''];
if(!empty($d['id'])){$s=$pdo->prepare('UPDATE packages SET destination_id=?,package_name=?,description=?,duration=?,itinerary=?,accommodation=?,transportation=?,price=?,image=?,status=? WHERE id=?');$s->execute([$d['destination_id'],$d['package_name'],$d['description'],$d['duration'],$details[0],$details[1],$details[2],$d['price'],$d['image']??'',$status,$d['id']]);}
else{$s=$pdo->prepare('INSERT INTO packages(destination_id,package_name,description,duration,itinerary,accommodation,transportation,price,image,status) VALUES(?,?,?,?,?,?,?,?,?,?)');$s->execute([$d['destination_id'],$d['package_name'],$d['description'],$d['duration'],$details[0],$details[1],$details[2],$d['price'],$d['image']??'',$status]);}
json_out(['message'=>'Package saved.']);
