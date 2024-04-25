<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobApply;
use App\Models\JobNature;
use App\Models\PostJob;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Auth;
class jobcontroller extends Controller
{
    public function index(Request $request){

        $jobs = PostJob::orderBy("id","DESC")->paginate(9);
        $category=Category::all();
        $j_types=JobNature::all();
        
        if(!empty($request->Keywords)){
            $jobs = PostJob::where('title','LIKE','%'.$request->Keywords.'%')->orWhere('keywords','LIKE','%'.$request->Keywords.'%')->orderBy("id","DESC")->paginate(9);
            // $jobs = PostJob::where('keywords','LIKE','%'.$request->Keywords.'%')->orderBy("id","DESC")->paginate(9);
        }
        if(!empty($request->location)){
            $jobs = PostJob::where('location','LIKE','%'.$request->location.'%')->orderBy("id","DESC")->paginate(9);
            
        }
        if(!empty($request->category)){
            $jobs = PostJob::where('category_id','=',$request->category)->orderBy("id","DESC")->paginate(9);
            
        }
        if(!empty($request->job_type)){
            $l=explode(",",$request->job_type);
            $jobs=PostJob::whereIn('job_nature_id',$l)->orderBy("id","DESC")->paginate(9);;
            
        }
        if(!empty($request->experience)){
            
            $jobs=PostJob::where('exprience','=',$request->experience)->orderBy("id","DESC")->paginate(9);;
            
        }

        $data=compact('jobs','category','j_types');
        return view("frontpages.jobs",$data);
    }
    public function job_details($id){
        $job=PostJob::where('id',$id)->with(['jobNature','category'])->first();
        $saved_job_or_not=SavedJob::where(['job_id'=>$id,'user_id'=>Auth::user()->id])->first();
        $job_apply_users=JobApply::where('job_id',$id)->with('user')->get();
        
        if(empty($job)){
            abort(404);
        }
        $data=compact("job","saved_job_or_not","job_apply_users");
        return view("frontpages.job-details",$data);
    }
    public function job_applay_process(Request $request){
        
        $job_id=$request->job_id;
        $c_id=PostJob::where('id',$job_id)->first();
        $job_applay=new JobApply();
        $job_applay->job_id=$job_id;
        $job_applay->user_id=Auth::user()->id;
        $job_applay->company_user_id=$c_id->user_id;
        
        $job_applay_count=JobApply::where([
            'job_id'=>$job_id,
            'user_id'=>Auth::user()->id
        ])->count();
        $job_applay_id=PostJob::where('id',$job_id)->first();
        if($job_applay_count>0){
            return redirect()->route('job.details',$job_id)->with('warning','you have already applied...');
        }elseif($job_applay_id->user_id == Auth::user()->id){
            return redirect()->route('job.details',$job_id)->with('warning','you can not applied on your applied post...');
        }else{
            $job_applay->save();
            return redirect()->route('job.details',$job_id)->with('success','Sucessfully applied of this application...');
        }
         
        
    }
    public function job_apply(){
        $jobs=JobApply::where('user_id',Auth::user()->id)->with(['job','job.jobNature','job.jobapply'])->paginate(10);
        
        $data=compact('jobs');
        return view("frontpages.job-apply", $data);
    }
    public function delete_job_apply($id){
        $job=JobApply::find($id);
        $job->delete();
        return back()->with('success','sucessfully removed...');
    }

    public function saved_job(Request $request){
        $job_id=$request->job_id;
        $count_save_job=SavedJob::where(['job_id'=>$job_id,'user_id'=>Auth::user()->id])->count();
        if($count_save_job> 0){
            return back()->with('warning','This Job is already saved');
        }else{
            $save_job=new SavedJob();
            $save_job->job_id=$job_id;
            $save_job->user_id=Auth::user()->id;
            $save_job->save();
            return back()->with('success','Job has been  sucessfully saved');
        }

        
    }
    public function saved_job_page(){
        $saved_jobs=SavedJob::where('user_id',Auth::user()->id)->with(['job','job.jobNature','job.jobapply'])->paginate(10);
        
        $data=compact('saved_jobs');
        return view('frontpages.saved-job',$data);
    }
    public function delete_saved_job($id){
        $saved_jobs=SavedJob::find($id);
        $saved_jobs->delete();
        return back()->with('success','sucessfully deleted....');
    }
}
