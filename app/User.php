<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'national_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function masterfile(){
        return $this->belongsTo(MasterFile::class,'national_id','national_id')->orderBy('joining_date','DESC')->get()->first();
    }

    public function masterfile2(){
        return $this->hasMany(MasterFile::class,'national_id','national_id')->orderBy('joining_date','DESC') ;
    }

    public function employessAllHierarchy(){

        $query = DB::select(DB::raw("
        SELECT a.* 
        FROM( SELECT a.*,b.full_name full_name5, b.national_id national_id5 
                FROM (	SELECT a.*,b.full_name full_name4, b.national_id national_id4 
                        FROM(	SELECT a.*,b.full_name full_name3, b.national_id national_id3 
                                FROM (	SELECT a.*,b.full_name full_name2, b.national_id national_id2 
                                        FROM ( SELECT a.* FROM master_files AS a WHERE a.supervisor = :supervisor and a.STATUS = 'Active') a 
                                        LEFT JOIN (SELECT a.* FROM master_files AS a WHERE  a.STATUS = 'Active' ) B On a.full_name = b.supervisor
                                        ) a
                        Left Join (select a.* from master_files as a where  a.status = 'Active' ) B On a.full_name2 = b.supervisor
                        ) a
                Left Join (select a.* from master_files as a where  a.status = 'Active' ) B On a.full_name3 = b.supervisor
                ) a
            Left Join (select a.* from master_files as a where  a.status = 'Active' ) B On a.full_name4 = b.supervisor
            ) a

        "),array("supervisor"=>$this->masterfile()->full_name));



        $employess = $query;
        $nationalids = array_column($employess,'national_id');
        $nationalids = array_merge($nationalids, array_column($employess,'national_id2'));
        $nationalids = array_merge($nationalids, array_column($employess,'national_id3'));
        $nationalids = array_merge($nationalids, array_column($employess,'national_id4'));
        $nationalids = array_merge($nationalids, array_column($employess,'national_id5'));
        array_push($nationalids,$this->national_id);
        

        $campaigns = DB::table('master_files')
            ->select('campaign')
            ->whereNull('termination_date')
            ->whereNotIn('campaign',['Administrative','Aprendiz Sena'])
            ->groupBy('campaign')
            ->get()
            ->pluck('campaign') ;
        
        $permissionCampaign = [];
        foreach ($campaigns as $key => $campaign) {
            $permission = 'agentactivity.campaign.'.mb_strtolower(str_replace(' ','_',$campaign),'UTF-8');
            if($this->hasPermissionTo($permission)){
                $permissionCampaign[]=$campaign;
            }            
        }

        $national_ids = DB::table('master_files')->select('national_id')
        ->whereIn('campaign',$permissionCampaign)
        ->whereNull('termination_date')
        ->get()
        ->toArray();



        $nationalids = array_merge($nationalids,array_column($national_ids,'national_id'));
        $nationalids = array_unique($nationalids);
        $nationalids = array_filter($nationalids);

        

        $users = User::whereIn('national_id',$nationalids);

        return $users;

    }


    public function manager(){
        return $this->belongsTo(User::class,'manager_id');
    }
    
    // public function employess(){
    //     return $this->hasMany(User::class,'manager_id');
    // }

    public function latestactivity()
    {
        return $this->belongsToMany(Activity::class)->withTimestamps() ;
        //return $this->belongsToMany(Activity::class)->withPivot('created_at') ;
    }
}
