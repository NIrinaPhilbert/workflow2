<?php
 namespace App\Helpers;

 class Helper
 {
     public static function setOuiNon(int $val)
     { $res = 'Oui';
         if($val == 0) {
             $res = 'Non';
         }
         return $res;
     }
     public static function getNameIcon(string $znamefile, string $typefile){
        $zNameIcon = "";
        
        switch($typefile)
            {
                case "xls" ://table 'etats' interpretée
                    $zNameIcon = 'icon-xlsx.png' ;
                break ;
                case "xls" :
                    $zNameIcon  = 'icon-xls.png' ;
                break ;
                case "doc" :
                    $zNameIcon  = 'icon-doc.png' ;
                break ;
                case "docx" :
                    $zNameIcon  = 'icon-docx.png'; 
                break ;
                case "pdf" :
                    $zNameIcon  = 'icon-pdf.png';
                break ;
                default:
                $zNameIcon =  $znamefile;
            }

        return $zNameIcon;
     }

     public static function getLibelleSituationProcessusValidation(int $val)
     { 
         $res = 'En attente de mon validation';
         if($val == 2) {
             $res = 'Validé à  mon niveau';
         }
         if($val == 3){
            $res = 'rejeté à mon niveau';
         }
         return $res;
     }
     public static function getLibelleSituationTraitement(int $idsituation){
        $zLibstyle = '';
        if($idsituation == 0){
           $zLibstyle = '<span class="badge badge-danger">En attente traitement</span>';
        }
        if($idsituation == 1){
           $zLibstyle = '<span class="badge badge-info">Traitement finalise</span>';
        }
        if($idsituation == 2){
            $zLibstyle = '<span class="badge badge-warning">En cours traitement</span>';
         }
       
        return $zLibstyle;
    }
     public static function setLibstatusStyle(int $idstatus, string $libelle){
         $zLibstyle = '';
         if($idstatus == 1){
            $zLibstyle = '<span class="badge badge-info">'.$libelle.'</span>';
         }
         if($idstatus == 2){
            $zLibstyle = '<span class="badge badge-warning">'.$libelle.'</span>';
         }
         if($idstatus ==3){
            $zLibstyle = '<span class="badge badge-danger">'.$libelle.'</span>';
         }
         return $zLibstyle;
     }
     public static function convertDateTimeToCurrentDate($zstr){
        //->format('g:i A');
        $zDateCurrent = date("d/m/Y h:i:s A", strtotime($zstr));
        return $zDateCurrent;
        
     }
     public static function delTree($dir) {
        $files = glob( $dir . '*', GLOB_MARK );
        foreach( $files as $file ){
            if( substr( $file, -1 ) == '/' )
                delTree( $file );
            else
                unlink( $file );
        }
        rmdir( $dir );
    }
    public static function sendnotification($maildestinataire,$subject,$header,$Message){
        $login = 'notify-me';
        $password = 'ae0c1f53-c1cb-43b1-8511-1d0cdfdcd1a3';
        //$subject = "Notification soumission demande workflow";
        //$header = "workflow notification soumission système";
        //$Message = "Votre demande est soumis dans le système workflow du ministère";
        $post = '{"recipient": "'.$maildestinataire.'", "subject": "'.$subject.'", "header": "'.$header.'", "message": "'.$Message.'", "sender": "workflow"}';
        $url = 'https://mx.snis-sante.net/mail';
        $ch = curl_init('https://mx.snis-sante.net/mail');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
        curl_setopt($ch, CURLOPT_ENCODING,"");

        header('Content-Type: application/json');
        $data = curl_exec($ch);
        //echo $data;
    }

    
 }

 
?>