<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;
use App\Models\Record;
use App\Models\MCQ_Record;
use App\Models\EmailOtp;
use App\Mail\VerifyUser;
use App\Mail\EmailOtpMail;
use App\Mail\userForgotPassword;
use Spatie\Browsershot\Browsershot;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;

 
class UserController
{
     function userSignup(Request $req){
        $users = $req->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|confirmed'
        ]);

        $otp = rand(100000, 999999);

        EmailOtp::updateOrCreate([
            'email' => $req->email
        ],[
            'email' => $req->email,
            'otp' => $otp,
            'expired_at' => now()->addMinute(10),
        ]);

        Mail::to($req->email)->send(new EmailOtpMail($otp));

        Session::put('users',$users);

        // $req->session()->put('register_email', $req->email);
        // $req->session()->put('register_name', $req->name);
        // $req->session()->put('register_password', Hash::make($req->password));

        return redirect()->route('verify.otp');

        // $validate = $req->validate([
        //     'name' => 'required|min:3',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:3|confirmed'
        // ]);

        // $user = User::create([
        //     'name' => $req->name,
        //     'email' => $req->email,
        //     'password' => Hash::make($req->password)
        // ]);

        // $link = Crypt::encryptString($user->email);
        // $link = url('/verify-user/'.$link);
        // Mail::to($user->email)->send(new VerifyUser($link));

        // if($user){
        //     Session::put('user',$user);
        //     if(Session::has('quiz-url')){
        //         $url = Session::get('quiz-url');
        //         Session::forget('quiz-url');
        //         return redirect($url)->with('message-success','User Registered Successfully, Please check email to verify account');
        //     }else{
        //         return redirect('/')->with('message-success','User Registered Successfully, Please check email to verify account');
        //     }
        // }
    }

public function welcome()
{
    $user = Auth::user();  // Laravel ka authenticated user la rahe hain
    if ($user && $user->google2fa_secret && !session('2fa_verified')) {
        return redirect()->route('2fa.verify');
    }

    $categories = Category::withCount('quizzes')->orderBy('quizzes_count', 'desc')->paginate(5, ['*'], 'category_page');
    $quizData = Quiz::withCount('Records')->orderBy('records_count', 'desc')->paginate(5, ['*'], 'quiz_page');

    return view('welcome', [
        'categories' => $categories,
        'quizData' => $quizData
    ]);
}


    function categories(){
        Session::get('users');
        $categories = Category::withCount('quizzes')->orderBy('quizzes_count','desc')->paginate(5);
        return view('categories-list',['categories' => $categories]);
    }

    function userQuizList($id, $category){
        Session::get('users');
        $quizData = Quiz::withCount('Mcq')->where('category_id',$id)->get();
        return view('user-quiz-list', ['quizData' => $quizData, 'category' => $category]);
    }

    function verifyOtp(){
        return view('email_otp_verify');
    }

    function verifyOtpStore(Request $req){
        $req->validate([
            'otp' => ['required','string','size:6']
        ]);

        $email = Session::get('users')['email'];
        $name = Session::get('users')['name'];
        $password = Session::get('users')['password'];

        $emailOtp = EmailOtp::where('email',$email)->where('otp',$req->otp)->where('expired_at','>=',now())->first();

        if(!$emailOtp){
            return redirect()->back()->withInput()->with(['message' => 'Invalid OTP']);
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $emailOtp->delete();
 
        Session::forget('users');

        if($user){
            Session::put('user',$user);
            if(Session::has('quiz-url')){
                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect($url)->with('message-success','User Registered Successfully');
            }else{
                return redirect('/')->with('message-success','User Registered Successfully');
            }
        }
    }

    function userLogout(){
        Session::get('users');
        Session::forget('user');
        return redirect('/');
    }

    function userSignupQuiz(){
        Session::get('users');
        Session::put('quiz-url',url()->previous());
        return view('user-signup');
    }

    function userLogin(Request $req){
        $validate = $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);

        $user = User::where('email', $req->email)->first();
        if(!$user || !Hash::check($req->password, $user->password)){
            return redirect('user-login')->with('message-error','User not valid, please check email and password again');
        }

        
        if($user){
            Session::put('user',$user);
            if(Session::has('quiz-url')){
                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect($url)->with('message', 'User Login Successfully');
            }else{
                return redirect('/');
            }
        }
    }

    function userLoginQuiz(){
        Session::put('quiz-url', url()->previous());
        return view('user-login');
    }

    function mcq($id, $name){
        $record = new Record();
        $record->user_id = Session::get('user')->id;
        $record->quiz_id = Session::get('firstMCQ')->quiz_id;
        $record->status = 1;
        if($record->save()){
            $currentQuiz = [];
            $currentQuiz['totalMcq'] = MCQ::where('quiz_id', Session::get('firstMCQ')->quiz_id)->count();
            $currentQuiz['currentMcq'] = 1;
            $currentQuiz['quizName'] = $name;
            $currentQuiz['quizId'] = Session::get('firstMCQ')->quiz_id;
            $currentQuiz['recordId'] = $record->id;
            Session::put('currentQuiz', $currentQuiz);
            $mcqData = MCQ::find($id);
            return view('mcq-page', ['quizName' => $name,'mcqData' => $mcqData]);
        }else{
            return "Something went wrong";
        }
    }   

    function submitAndNext(Request $req, $id){
        Session::get('users');
        $currentQuiz = Session::get('currentQuiz');
        $currentQuiz['currentMcq']+=1;
        $mcqData = MCQ::where([
            ['id','>',$id],
            ['quiz_id','=',$currentQuiz['quizId']]
        ])->first();

        $isExist = MCQ_Record::where([
            ['record_id','=',$currentQuiz['recordId']],
            ['mcq_id','=',$req->id]
        ])->count();

        if($isExist<1){
            $mcq_record = new MCQ_Record;
            $mcq_record->record_id = $currentQuiz['recordId'];
            $mcq_record->user_id = Session::get('user')->id;
            $mcq_record->mcq_id = $req->id;
            $mcq_record->select_answer = $req->option;
            if($req->option == MCQ::find($req->id)->correct_ans)
            {
                $mcq_record->is_correct = 1;
            }else{
                $mcq_record->is_correct = 0;
            }

            if(!$mcq_record->save()){
                return "Something went wrong";
            }
        }


        Session::put('currentQuiz', $currentQuiz);
        if($mcqData){
           return view('mcq-page', ['quizName' => $currentQuiz['quizName'],'mcqData' => $mcqData]);
        }else{
           $resultData = MCQ_record::WithMCQ()->where('record_id',$currentQuiz['recordId'])->get();
           $correctAnswers = MCQ_record::where([
           ['record_id','=',$currentQuiz['recordId']],
           ['is_correct','=',1],
           ])->count();

           $record = Record::find($currentQuiz['recordId']);
           if($record){
            $record->status=2;
            $record->update();
           }

           return view('quiz-result', ['resultData' => $resultData, 'correctAnswers' => $correctAnswers]);
        }
    }

    function userDetails(){
        Session::get('users');
        $quizRecord = Record::WithQuiz()->where('user_id', Session::get('user')->id)->get();
        return view('user-details', ['quizRecord' => $quizRecord]);
    }
 
    function searchQuiz(Request $request){
        Session::get('users');
        $quizData = Quiz::withCount('Mcq')->where('name','Like','%'.$request->search.'%')->get();
        return view('quiz-search',['quizData' => $quizData, 'quiz' => $request->search]);
    }

    function startQuiz($id, $name){
        Session::get('users');
        $quizCount =  Mcq::where('quiz_id',$id)->count();
        $mcqs =  Mcq::where('quiz_id',$id)->get();
        Session::put('firstMCQ',$mcqs[0]);
        $quizName = $name;
        return view('start-quiz',['quizName' => $quizName, 'quizCount' => $quizCount]);
    }

    function verifyUser($email){
        Session::get('users');
        $orgEmail = Crypt::decryptString($email);
        $user = User::where('email', $orgEmail)->first();
        if($user){
            $user->active=2;
            if($user->save()){
                return redirect('/')->with('message-success','User Verified Successfully');
            }
        }
    }

    function userForgotPassword(Request $req){
        $link = Crypt::encryptString($req->email);
        $link = url('/user-forgot-password/'.$link);
        Mail::to($req->email)->send(new UserForgotPassword($link));
        return redirect('/')->with('message-success','Please check email to set new password');
    }

    function userResetForgotPassword($email){
        $orgEmail = Crypt::decryptString($email);
        return view('user-set-forgot-password',['email' => $orgEmail]);
    }

    function userSetForgotPassword(Request $req){
        $validate = $req->validate([
            'email' => 'required | email',
            'password' => 'required | min:3 | confirmed'
        ]);

        $user = User::where('email', $req->email)->first();

        if($user){
            $user->password = Hash::make($req->password);
            if($user->save()){
                return redirect('user-login')->with('message-success','New password is set, Please login with new password');
            }
        }
    }

    function certificate(){
        $data = [];
        $data['quiz'] = str_replace('-',' ',Session::get('currentQuiz')['quizName']);
        $data['name'] = Session::get('user')['name'];
        return view('certificate',['data' => $data]);
    }

    
    public function downloadCertificate(){
        
        $data = [
            'quiz' => str_replace('-', ' ', Session::get('currentQuiz')['quizName'] ?? ''),
            'name' => Session::get('user')['name'] ?? 'Guest',
            'date' => date('Y-m-d'),
        ];

        $html = view('download-certificate', ['data' => $data])->render();

        try {
            return response(
                Browsershot::html($html)
                    ->setChromeExecutablePath('C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe')
                    ->setOption('args', ['--no-sandbox', '--disable-setuid-sandbox'])
                    ->pdf()
            )->withHeaders([
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="certificate.pdf"',
            ]);
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to generate PDF',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}