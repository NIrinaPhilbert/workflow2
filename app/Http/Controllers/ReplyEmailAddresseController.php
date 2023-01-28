<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply_email_address;
use Illuminate\Support\Facades\DB;


class ReplyEmailAddresseController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showorinsertaddresseemail()
    {
        if (isset($_GET['got']) && !empty($_GET['got']))
	    {
            if ($_GET['got'] == "list")
            {
                if(!isset($_POST['searchTerm']) || empty($_POST['searchTerm'])){ 
                    $zQueryListeMail = DB::table('reply_email_addresses')
                                        ->limit(10)
                                        ->get();
                    
                }else{
                    $search = $_POST['searchTerm'];
                    $zQueryListeMail = DB::table('reply_email_addresses')
                                        ->where('reply_email_addresses.rea_email','LIKE',"%$search%")
                                        ->limit(10)
                                        ->get();
                }
                $iSizeOfQueryListeMail = $zQueryListeMail->count();
                $data = array();
                if ($iSizeOfQueryListeMail > 0)
                {
                // output data of each row
                    
                    foreach($zQueryListeMail as $oMailAddresse){
                        $data[] = array(
                            'id' => $oMailAddresse->id,
                            'icon' => $oMailAddresse->rea_icon,
                            'text' => $oMailAddresse->rea_name,
                            'label' => $oMailAddresse->rea_email
                        );
                    }
                }
                
                echo json_encode($data);
                exit();
            }
            else if ($_GET['got'] == "add")
            {
                $name = $_POST['name'];
                $email = $_POST['email'];
                
                $idmail = DB::table('reply_email_addresses')->insertGetId(
                ['rea_email' => $email,
                'rea_name' => $name]
                );

                $data = array();
                if ($idmail > 0) {
                    $data['success'] = true;
                    $data['addedID'] = $idmail;
                } else {
                    $data['success'] = false;
                }
                echo json_encode($data);
                exit();
            }
            die("********** NOTHING **********");
	    }
	
    }
}
