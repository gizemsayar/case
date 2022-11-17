<?php
header('Content-Type: text/xml; charset=utf-8', true); //set document header content type to be XML

$data = file_get_contents('./products.json',true); // json dosyasi icerisindeki verileri okuyorum
$data_JSON = json_decode($data); 

$domtree = new DOMDocument('1.0', 'UTF-8');
   
$xmlRoot = $domtree->createElement("xml");

$xmlRoot = $domtree->appendChild($xmlRoot);

foreach($data_JSON as $data) // json dosyasindan okunan verileri donguye alma islemi yapiyorum
{
    $currentTrack = $domtree->createElement("item"); // dongu yeniden basladiginde yeni item aciyorum
    $currentTrack = $xmlRoot->appendChild($currentTrack);
    // item icerisinde gostermek istedigim alanlari ekleme islemi yapiyorum
    $currentTrack->appendChild($domtree->createElement('id',$data->id)); 
    $currentTrack->appendChild($domtree->createElement('name',$data->name));
    $currentTrack->appendChild($domtree->createElement('price',"$data->price"));
    $currentTrack->appendChild($domtree->createElement('category',$data->category));
}
 
echo $domtree->saveXML();
    
?>