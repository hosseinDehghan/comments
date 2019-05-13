<?php

namespace Hosein\Comments\Controllers;

use Hosein\Comments\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function index($id=null){
        $data=[];
        if(isset($id)){
            if(is_numeric($id)){
                $data["id"]=$id;
            }
        }
        return view("CommentsView::comment",$data);
    }
    public function createMessage(Request $request,$id=null){
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'message'=>'required|max:500'
        ]);
        if($validator->fails()){
            return redirect("comment")
                ->withErrors($validator,'ercomment')
                ->withInput();
        }
        $comment=new Comment();
        $comment->name=$request->all()["name"];
        $comment->email=$request->all()["email"];
        $comment->message=$request->all()["message"];
        $comment->like=0;
        $comment->dislike=0;
        $comment->parent=(!empty($id)?$id:0);
        $comment->status=0;
        $comment->save();
        return redirect("comment")->with("regsComment","با موفقیت ثبت شد");
    }
    public function commentLike($id){
        if(!empty($id)){
            if(is_numeric($id)){
                $comment=Comment::select("*")->where("id",$id)->first();
                $comment->like++;
                $comment->save();
            }
        }
        return redirect("comment");
    }
    public function commentDislike($id){
        if(!empty($id)){
            if(is_numeric($id)){
                $comment=Comment::select("*")->where("id",$id)->first();
                if($comment->like!=0) {
                    $comment->like--;
                }
                $comment->save();
            }
        }
        return redirect("comment");
    }
}
