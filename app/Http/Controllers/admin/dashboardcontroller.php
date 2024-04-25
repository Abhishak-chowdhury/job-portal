<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobApply;
use App\Models\PostJob;
use Illuminate\Http\Request;
use App\Models\User;

use Auth;
class dashboardcontroller extends Controller
{
    public function Home(){
        return view('frontpages.admin.index');
    }
    public function all_user(){
        $users=User::where('status','!=',Auth::user()->status)->orderBy('id','DESC')->paginate(10);
        $data=compact('users');
        return view('frontpages.admin.user',$data);
    }
    public function all_job(){
        $jobs=PostJob::orderBy('id','DESC')->with(['user','jobapply'])->paginate(10);
        $data=compact('jobs');
        return view('frontpages.admin.jobs',$data);
    }

    public function delete_job($id){
        $job=PostJob::find($id);
        $job->delete();
        return redirect()->route('all.job')->with('success','successfully delete..');
    }
    public function job_status(Request $request){
        $job=PostJob::where('id',$request->job_id)->first();
        if($job->status =='1'){
            $job->status='0';
            $job->save();
        }else{
            $job->status='1';
            $job->save();
        }
        
        return back();
    }
    public function job_application(){
        $job_apply=JobApply::with(['company_user','job'])->orderBy('id','DESC')->paginate(10);
        $data=compact('job_apply');
        return view('frontpages.admin.job-application',$data);
    }
}
