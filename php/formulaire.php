<?php 
// recupreation des elements du formulaire


if(isset($_POST['name']) &&  isset($_POST['email']) && isset($_POST['message'])){

try{
  $mysqlClient = new PDO('mysql:host=localhost;dbname=bhaf2949_folio;charset=utf8', 'bhaf2949_zeufackvaldo', 'Demanou2@', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
}catch(Exception $exception){
   die('Erreur : '.$exception->getMessage());

}

if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $sqlQuery = 'INSERT INTO contact(name, email, message) VALUES (:name, :email, :message)';

    // Préparation
     $insertContact = $mysqlClient->prepare($sqlQuery);

   // Exécution ! La recette est maintenant en base de données
    $insertContact->execute([
    'name' => $_POST['name'],
     'email' => $_POST['email'],
      'message' => $_POST['message'],
    
     ]);

    imap_mail("zeufackheriol9@gmail.com","Confirmation de reception du message du message du visiteur sur le  site creation de site  ".$_POST['name'], "Monsieur ou Madamme ".$_POST['name']." t'ecris via le site livre voici son message: ". $_POST['message'], "From:".$_POST['email']);



     $headers[] = 'MIME-Version: 1.0';
     $headers[] = 'Content-type: text/html; charset=iso-8859-1';

     // En-têtes additionnels
     
     $headers[] = 'From: ne-pas-repondre@heriolvaldo.com';
     


 imap_mail($_POST['email'],
"Confirmation de reception du message",
"<html>
<body>
<p>Confirmation de réception<br/>

 Bonjour " .$_POST['name']." ,<br/>
 <p></p><br/>

  Merci pour votre confiance envers notre structure une equipe reviendra vers vous dans quelques instants.<br/>
  Cordialement heriol zeufack.
</p>
<body/>
<html/>
",

implode("\r\n", $headers) );
    
}
  else{
    
      echo "votre mail n'est pas correct veuillez inserer un autre";
  }


}

?>

