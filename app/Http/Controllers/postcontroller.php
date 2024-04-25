<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\JobNature;
use App\Models\PostJob;
class postcontroller extends Controller
{
    public function posts(){
        $user_id=Auth::user()->id;
        $user=User::find($user_id);
        $categories=Category::all();
        $job_rolls=JobNature::all();
        $data=compact('user','categories','job_rolls');
        return view('frontpages.post-job',$data);
    }
    public function posts_process(Request $request){

        $validated=$request->validate([
            'title'=>'required',
            'category'=>'required',
            'job_roll'=>'required',
            'vacancy'=>'required|int',
            'location'=>'required',
            'description'=> 'required|min:100',
            'exprience'=>'required',
        ]);

        $post_job=new PostJob();
        $post_job->title= $request->title;
        $post_job->user_id=Auth::user()->id;
        $post_job->category_id= $request->category;
        $post_job->job_nature_id= $request->job_roll;
        $post_job->vacancy= $request->vacancy;
        $post_job->salary= $request->salary;
        $post_job->exprience= $request->exprience;
        $post_job->location= $request->location;
        $post_job->description= $request->description;
        $post_job->benefits= $request->benefits;
        $post_job->responsibility= $request->responsibility;
        $post_job->qualifications= $request->qualifications;
        $post_job->keywords= $request->keywords;
        $post_job->title= $request->title;
        $post_job->company_name= $request->company_name;
        $post_job->company_location= $request->company_location;
        $post_job->company_website= $request->company_website;
        $post_job->save();
        return redirect()->route('myposts')->with('success','successfully post....');

    }
    public function my_posts(){
        $user_id=Auth::user()->id;
        $user=User::find($user_id);
        $jobs=PostJob::where('user_id',$user_id)->with('jobNature')->orderBy('id','DESC')->paginate(10);
        $data=compact('user','jobs');
        return view('frontpages.my-job',$data);
    }
    public function update_post(Request $request,$id){
        $user_id=Auth::user()->id;
        $user=User::find($user_id);
        $job=PostJob::find($id);
        $categories=Category::all();
        $job_rolls=JobNature::all();
        $data=compact('categories','job_rolls','user','job');
        return view('frontpages.edit-job-post',$data);
    }
    public function update_post_process(Request $request,$id){
        $validated=$request->validate([
            'title'=>'required',
            'category'=>'required',
            'job_roll'=>'required',
            'vacancy'=>'required|int',
            'location'=>'required',
            'description'=> 'required|min:100',
            'exprience'=>'required',
        ]);

        $post_job=PostJob::find($id);
        $post_job->title= $request->title;
        $post_job->user_id=Auth::user()->id;
        $post_job->category_id= $request->category;
        $post_job->job_nature_id= $request->job_roll;
        $post_job->vacancy= $request->vacancy;
        $post_job->salary= $request->salary;
        $post_job->exprience= $request->exprience;
        $post_job->location= $request->location;
        $post_job->description= $request->description;
        $post_job->benefits= $request->benefits;
        $post_job->responsibility= $request->responsibility;
        $post_job->qualifications= $request->qualifications;
        $post_job->keywords= $request->keywords;
        $post_job->title= $request->title;
        $post_job->company_name= $request->company_name;
        $post_job->company_location= $request->company_location;
        $post_job->company_website= $request->company_website;
        $post_job->save();
        return redirect()->route('myposts')->with('success','successfully updated your post ....');
    }
    public function delete_post($id){
        $p=PostJob::find($id);
        $p->delete();
        return redirect()->route('myposts')->with('success','sucessfully delleted....');
    }
}
