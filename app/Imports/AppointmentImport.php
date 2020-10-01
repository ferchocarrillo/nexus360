<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;

class AppointmentImport 
{
    
    public function import($csv_import){
        $moved_file = $this->moveFile($csv_import);
        $normalized_file = $this->normalize($moved_file);
        return $this->importFileContents($normalized_file);
    }

    private function moveFile($csv_import){
        if(is_dir($destination_directory = storage_path('imports/tmp'))){
            chmod($destination_directory, 0755);
        }else{
            mkdir($destination_directory, 0755,true);
        }
        $original_file_name = $csv_import->getClientOriginalName();
        return $csv_import->move($destination_directory,$original_file_name);
    }

    protected function normalize($file_path){
        $string = @file_get_contents($file_path);
        if(!$string){
            return $file_path;
        }
        $string = preg_replace('~\r\n?~',"\n",$string);
        file_put_contents($file_path,$string);
        return $file_path;
    }
    
    private function importFileContents($file_path){

        $name_file_upload = "LIST_".date('YmdHis');

        
        $query = sprintf("LOAD DATA LOCAL INFILE '%s' INTO TABLE cgm_appointment_lists 
        FIELDS TERMINATED BY ',' 
        OPTIONALLY ENCLOSED BY '".'"'."'
        LINES TERMINATED BY '\\n'
        IGNORE 1 LINES 
        (company_name,phone_number_combined,executive_first_name,executive_last_name,executive_title,professional_title,executive_gender,mailing_address,mailing_city,mailing_state,mailing_zip_code,mailing_zip_4,location_address,location_city,location_state,location_zip_code,location_zip_4,name_file_upload,created_at) 
        SET name_file_upload = '".'%2$s'."', created_at = NOW()", 
        addslashes($file_path),$name_file_upload);


        return DB::connection()->getpdo()->exec($query);
    }

}
