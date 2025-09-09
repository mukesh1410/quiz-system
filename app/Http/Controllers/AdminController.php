<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function login(Request $req){
        $validate = $req->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
      
        $admin = Admin::where([
            'name' => $req->name,
            'password' => $req->password
        ])->first();

        if(!$admin){
            $validate = $req->validate([
                'user' => 'required',
            ],[
                'user.required' => 'User does not exists'
            ]);
        }

        Session::put('admin',$admin);
        return redirect()->route('dashboard');
    }

    function signup(Request $req){
        $validate = $req->validate([
            'name' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $signup = Admin::insert([
            'name' => $req->name,
            'password' => Hash::make($req->password),
            'role' => $req->role
        ]);

        if($signup){
            return redirect()->route('login');
        }
    }
 
    function dashboard(){
        $admin = Session::get('admin');
        if($admin){
            $users = User::orderBy('id','desc')->paginate(5);
            return view('admin',['name' => $admin->name, 'users' => $users]);
        }else{
            return redirect('admin-login');
        }
    }

    function categories(){
        $categories = Category::paginate(5);
        $admin = Session::get('admin');
        if($admin){ 
            return view('categories',['name' => $admin->name, 'categories' => $categories]);
        }else{
            return redirect('admin-login');
        }
    }

    function logout(){
        Session::forget('admin');
        return redirect('admin-login');
    }
    
    function addCategory(Request $req){
        $validation = $req->validate([
            'category' => 'required | min:3 | unique:categories,name',
        ]);

        $admin = Session::get('admin');
        $category = Category::create([
            'name' => $req->category,
            'creator' => $admin->name
        ]);

        if($category){
            Session::flash('category','category'.$req->category.'Added');
        }

        return redirect('admin-categories');
    }

    function deleteCategory(String $id){
        $admin = Session::get('admin');
        $delete = Category::whereId($id)->delete();

        if($delete){
            Session::flash('category','Success : Category Deleted');
            return redirect('admin-categories');
        }else{
            Session::flash('category','Failed : Category not Deleted');
        }
    }

    function addQuiz(Request $request){
        $admin = Session::get('admin');
        $categories = Category::get();
        $totalMCQs = 0;
        
        if($admin){ 
            $quizName = $request->input('quiz');
            $category_id = $request->input('category_id');

            if($quizName && $category_id && !Session::has('quizDetails')){
                $quiz = new Quiz();
                $quiz->name = $quizName;
                $quiz->category_id = $category_id;
                if($quiz->save()){
                    Session::put('quizDetails',$quiz);
                }

            }else{
                $quiz = Session::get('quizDetails');
            if($quiz){
                $totalMCQs = Mcq::where('quiz_id', $quiz->id)->count();
            } else {
                $totalMCQs = 0;
            }
            }
            return view('add-quiz',['name' => $admin->name, 'categories' => $categories, 'totalMCQs' => $totalMCQs]);
        }else{
            return redirect('admin-login');
        }
    }

    function addMCQs(Request $request){
        $validation = $request->validate([
            'question' => 'required | min:5',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'correct_ans' => 'required'
        ]);
        $mcq = new Mcq();
        $quiz = Session::get('quizDetails');
        $admin = Session::get('admin');
        $mcq->question = $request->question;
        $mcq->a = $request->a;
        $mcq->b = $request->b;
        $mcq->c = $request->c;
        $mcq->d = $request->d;
        $mcq->correct_ans = $request->correct_ans;
        $mcq->admin_id = $admin->id;
        $mcq->quiz_id = $quiz->id;
        $mcq->category_id = $quiz->category_id;

        if($mcq->save()){
            if($request->submit=="add-more"){
                return redirect(url()->previous());
            }else{
                Session::forget('quizDetails');
                return redirect("/admin-categories");
            }
        }
    }

    function endQuiz(){
        Session::forget('quizDetails');
        return redirect("/admin-categories");
    }

    function showQuiz(String $id){
        $admin = Session::get('admin');
        $mcqs = Mcq::where('quiz_id',$id)->get();
        $totalMCQs = 0;

        if($admin){ 
            return view('show-quiz',['name'=>$admin->name,'mcqs'=>$mcqs]);
        }else{
            return redirect('admin-login');
        }
    }

    function quizList($id, $name){
        $admin = Session::get('admin');
        $totalMCQs = 0;

        if($admin){ 
            $quizData = Quiz::where('category_id',$id)->get();
            return view('quiz-list',['name'=>$admin->name,'quizData'=>$quizData,'category'=>$name]);
        }else{
            return redirect('admin-login');
        }   
    }

    function quizDelete($id){
        $user = Session::get('admin');
        
        if($user){
            $quiz = Quiz::whereId($id)->delete();
            return view('user-quiz-list');
        }
    }

    public function userView(int $id){
        $user = User::whereId($id)->get();
        return view('admin-users', compact('user'));
    }

    public function getUser(int $id){
        $user = User::find($id);
        return view('admin-user-update', compact('user'));
    }

    public function updateUser(Request $req, int $id){
      User::where('id', $id)->update([
        'name' => $req->name,
        'email' => $req->email,
      ]);
      return redirect()->route('dashboard')->with('success', 'User updated successfully.');
    }

    public function deleteUser(int $id){
        User::whereId($id)->delete();
        return redirect()->route('dashboard')->with('success', 'User delete successfully.');
    }
}