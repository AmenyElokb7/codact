<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ashtray;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Notifications\NewAdNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Notifications\AdValidatedNotification;
use App\Notifications\AdRejectedNotification;
use App\Models\Category;
use App\Notifications\ClaimNotification;
use Dompdf\Dompdf;
use App\Models\FinancialSummary;
use App\Models\PasswordReset;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Vonage\SMS\Message\SMS;
use Illuminate\Support\Facades\Hash;
use App\Models\TransactionOffline;

use App\Mail\Forgetpassword;
use Mail;




class PagesController extends Controller
{
    public function index()
    {
        return view('admin.index');    
    }
    public function publisher()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        $publishers = User::whereHas('roles', function ($query) {
            $query->where('name', 'publisher');
        })->orderBy('name', 'asc')->get();
    
        return view('admin.publisher', compact('publishers', 'notifications'));    
    
    }
    public function subscriber()
    {
        $categories = Category::all();
        $notifications = auth()->user()->notifications()->paginate(10);
        $subscribers = User::whereHas('roles', function ($query) {
            $query->where('name', 'subscriber');
        })->orderBy('name', 'asc')->get();
    
        return view('admin.subscriber', compact('subscribers','notifications','categories'));
    }

    public function deleteUser(Request $request)
    {
    $email = $request->input( 'email' );
   
    PasswordReset ::where( 'email' , $email)->delete();
   
    return response()->json([ 'message' => 'done' ]);
   
    }


    public function PendingAd(){
        $notifications = auth()->user()->notifications()->paginate(10);
        $pendingAds = Advertisement::with('user')->where('status', 'pending')->get();
        return view('admin.PendingAd', compact('pendingAds','notifications'));
    }
        public function ApprovedAd(){
        $notifications = auth()->user()->notifications()->paginate(10);
        $approvedAds = Advertisement::with('user')->where('status', 'approved')->orWhere('status', 'paused')->get();
        return view('admin.ApprovedAd', compact('approvedAds', 'notifications'));
    }
        public function HistoryAd(){
        $notifications = auth()->user()->notifications()->paginate(10);
        $rejectededAds = Advertisement::with('user')->where('status', 'rejected')->get();
        return view('admin.HistoryAd', compact('rejectededAds', 'notifications'));
    }

    function NotificationsAdmin() {
        $notifications = auth()->user()->notifications()->paginate(5);
        return view('admin.notifications',compact('notifications'));     
    }   
public function PublisherCafe()
{
    $notifications = auth()->user()->notifications()->paginate(10);
    $user = auth()->user();
    $cafe = User::whereHas('roles', function ($query) {
        $query->where('name', 'subscriber');
    })
    ->orderByRaw("CASE WHEN address LIKE '%{$user->address}%' THEN 0 ELSE 1 END")
    ->orderBy('cafeName', 'asc')
    ->paginate(10);

    return view('publisher.cafeList', compact('cafe','notifications'));
}

    public function PublisherAds(){
        $notifications = auth()->user()->notifications()->paginate(10);
        $user= auth()->user();
        $ads = Advertisement::where('user_id', $user->id)
        ->orderBy('id', 'desc')
        ->get();
            return view('publisher.adsList',compact('ads','notifications'));
    }
    public function NewAd(){
        $notifications = auth()->user()->notifications()->paginate(10);
    $user = auth()->user();
    $categories = Category::all();
    $cafe = User::whereHas('roles', function ($query) {
        $query->where('name', 'subscriber');
    })
    ->orderByRaw("CASE WHEN address LIKE '%{$user->address}%' THEN 0 ELSE 1 END")
    ->orderBy('cafeName', 'asc')
    ->get();
    $addresses = User::select('address')
    ->groupBy('address')
    ->get();
    $professions = User::select('profession')
    ->groupBy('profession')
    ->get();

    return view('publisher.filter', compact('cafe', 'notifications','categories','addresses','professions'));
    }
    public function validateAd($id)
    {
        $ad = Advertisement::findOrFail($id);
        $ad->status = 'approved';
        $ad->save();
        $user = $ad->user;
        $user->notify(new AdValidatedNotification($ad));
        return redirect()->route('admin.advertisements.show', $ad->id)->with('success', 'Ad validated successfully.');
    }
    
    public function rejectAd($id)
{
    $ad = Advertisement::findOrFail($id);
    $ad->status = 'rejected';
    $ad->save();
    $user = $ad->user;
    $user->notify(new AdRejectedNotification($ad));
    return redirect()->route('admin.advertisements.show', $ad->id)->with('success', 'Ad rejected successfully.');
}


public function showAshtrays()
{
    $notifications = auth()->user()->notifications()->paginate(10);
    $user = Auth::user();
    $ashtrays = Ashtray::where('user_id', $user->id)->get();

    return view('subscriber.ashtrays_list', compact('ashtrays', 'user','notifications'));
}
public function adminCategories()
{
    $notifications = auth()->user()->notifications()->paginate(10);
    $categories = Category::get();
    return view('admin.category', compact('categories','notifications'));
}
public function subscriberAds()  {
    $notifications = auth()->user()->notifications()->paginate(10);
    $subscriberId = Auth::id(); 
    $ads = Advertisement::join('advertisement_cafe_owner', 'advertisements.id', '=', 'advertisement_cafe_owner.advertisement_id')
        ->select('advertisements.*')
        ->where('advertisement_cafe_owner.cafe_owner_id', $subscriberId)
        ->get();
    return view('subscriber.adsList', compact('ads','notifications'));
}
public function methodreset(Request $request)
    {
        $resetMethod = $request->input('flexRadioDefault');

        if ($resetMethod === 'sms') {
            return redirect('/forgetpasswordsms')->with('phone', '');

            
        } elseif ($resetMethod === 'email') {
            return redirect('/forgetpassword')->with('email', '');

        }
    }
    public function sendEmail(Request $request)
    {
        $randomCode = Str::random(10);
        $link = Str::random(15);
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
    
        if ($user) {
            $existingRecord = PasswordReset::where('user_id', $user->id)->first();
    
            if ($existingRecord) {
                PasswordReset::where('user_id', $user->id)
                    ->update([
                        'key' => $randomCode,
                        'link' => $link,
                        'created_at' => Carbon::now()
                    ]);
            } else {
                PasswordReset::create([
                    'user_id' => $user->id,
                    'email' => $email,
                    'phone'=>$user->phoneno,
                    'key' => $randomCode,
                    'link' => $link,
                    'created_at' => Carbon::now(),
                ]);
            }
    
            Mail::to($user->email)->send(new Forgetpassword($user->name, $randomCode));
    
            return redirect()->route('checkkey', ['email' => $email]);
        } else {
            $error = 'Invalide email';
            return view('auth.forgetpassword', compact(['error','email']));
        }
    }
    public function showCheckKey(Request $request)
    {
        $email = $request->input('email');
        return view('auth.checkkey', compact('email'));
    }
    public function checkKey(Request $request)
{
    $email = $request->input('email');
    $key = $request->input('key');
   
    $passwordReset = PasswordReset::where('email', $email)->where('key', $key)->first();

    if ($passwordReset) {
        return redirect('/setnewpassword/'.$passwordReset->link)->with(['id' => $passwordReset->user_id, 'link' => $passwordReset->link]);
    } else {
        $remainingTime = $request->input('remainingTime'); // Get the remaining time from the query parameter
        return redirect()->back()->withErrors(['error' => 'Key is wrong'])->withInput(['email' => $email, 'remainingTime' => $remainingTime]);
    }
}

public function sendsms(Request $request)
    {
     
        $randomCode = Str::random(10);
        $link = Str::random(15);
        $phone = $request->input('phone');
        $user = User::where('phoneno', $phone)->first();
    
        if ($user) {
            $existingRecord = PasswordReset::where('user_id', $user->id)->first();
    
            if ($existingRecord) {
                PasswordReset::where('user_id', $user->id)
                    ->update([
                        'key' => $randomCode,
                        'link' => $link,
                        'created_at' => Carbon::now()
                    ]);
            } else {
                PasswordReset::create([
                    'user_id' => $user->id,
                    'email'=>$user->email,
                    'phone' => $phone,
                    'key' => $randomCode,
                    'link' => $link,
                    'created_at' => Carbon::now(),
                ]);
            }
    

            $basic  = new \Vonage\Client\Credentials\Basic("75d0239c", "qFLeu8Kn9npuSNtR");
            $client = new \Vonage\Client($basic);
            $message = new SMS($phone, 'Codactsolution', "
Hello {$user->name}\n
We received a request to reset your password.\n
To reset your password, put the key below:\n
{$randomCode}\n
Codact Team\n
        ");
            
        $response = $client->sms()->send($message);
        if ($response->current()->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $response->current()->getStatus() . "\n";
        }
    
            return redirect()->route('checkkey', ['email' => $user->email]);
        } else {
            $error = 'Invalide phone number';
            return view('auth.forgetpasswordsms', compact(['error','phone']));
        }
    }
   

    public function Setnewpassword(Request $request)
    {
        $pass1 = $request->input('pass1');
        $pass2 = $request->input('pass2');
        $id = $request->input('id');
        $link = $request->input('link');
        $pattern = '/^.{8,}$/';
    
    
        $passwordReset = PasswordReset::where('link', $link)->where('user_id', $id)->first();
    
         if ($passwordReset) {
            if (preg_match($pattern, $pass1)) {
                if ($pass1 === $pass2) {
                    $user = User::find($id);
                    
                    $user->password = bcrypt($pass1);
                    $user->save();
                    return redirect('/login');
                    
                
            }
            else{
                $error = 'password is wrong.';
                return view('auth.setnewpassword', compact('error','id','link'));
            }
    
            } else {
                $error = 'password is not validate.';
                return view('auth.setnewpassword', compact('error','id','link'));        }
             
    }
    else{
       
        return redirect('/login');
    }
    }
    
    public function EditProfile(){
        $notifications = auth()->user()->notifications()->paginate(10);
    $cafe = auth()->user();
    return view('publisher.EditProfile', compact('cafe', 'notifications'));
    }


    public function updateprofile(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phoneno' => ['required', 'numeric', 'digits_between:8,8'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);


        $pass1 = $request->input('password');
        $pass2 = $request->input('password_confirmation');
    
        $pattern = '/^.{8,}$/';

        $user->name = $validatedData['name'];
        $user->address = $validatedData['address'];
        $user->phoneno = $validatedData['phoneno'];
        $user->email = $validatedData['email'];

        if ($request->filled('password')) {
            if (preg_match($pattern, $pass1)) {
                if ($pass1 === $pass2) {
                    $user->password = bcrypt($pass1);
            }
            else{
                $error = 'password is wrong.';
                return view('publisher.EditProfile', compact('error'));
            }
        }
    }
        $user->save();
        $notification= array(
            'message' => 'Profile updated successfully',
            'alert-type' => 'success'
        );
        return redirect('/EditProfile')->with($notification);

    }
         
        public function showsetnewpassword($link)
        {
            $passwordReset = PasswordReset::where('link', $link)->first();
            if ($passwordReset) {
                return view('auth.setnewpassword', ['link' => $link, 'id' => session('id')]);}
                else{
                    return view('auth.login');
    
                }
    
        }
        public function showpreview(Request $request)
{
    $id = $request->input('id');
  $cafe = User::find($id);

    return view('coffe', ['coffe' => $cafe]);

    }
    public function hisorictransaction(Request $request)
    {
        $userId = Auth::id();
        $notifications = auth()->user()->notifications()->paginate(10);
    
        $historicalTransactions = FinancialSummary::all();
        
        return view('admin.historictransaction', compact('historicalTransactions', 'notifications'));   
    }
    public function sendmoney(Request $request)
{
    $notifications = auth()->user()->notifications()->paginate(10);

    $users = User::whereHas('roles', function ($query) {
        $query->where('name', 'publisher');
    })->orWhereHas('roles', function ($query) {
        $query->where('name', 'subscriber');
    })->orderBy('name', 'asc')->get();
    

    return view('admin.sendmoney', compact('users', 'notifications'));   

}
public function sendtouser(Request $request)
{
    $request->validate([
        'montant' => 'required|numeric|min:0',
        'name' => 'required|string',
        'id' => 'required|integer',
        'password' => 'required|string',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->input('password'), $user->password)) {
        return redirect()->back()->withErrors('Incorrect password');
    }

    $montant = (float) $request->input('montant');

    $recipient = User::find($request->input('id'));

    if (!$recipient || $recipient->name !== $request->input('name')) {
        return redirect()->back()->withErrors('Recipient user not found');
    }
    $filename = 'transaction_' . $recipient->id . '_' . time() . '.pdf';

    DB::beginTransaction();

    try {
        $transaction=FinancialSummary::create([
            'user_id' => $recipient->id,
            'amount' => floatval($montant),
            'title' => 'Charge account',
            'description' => 'Admin',
            'Creator' => 'Manual',
            'pdf_path' => 'pdfs/' . $filename,

        ]);
        
$sender_name=User::find(auth()->id())->name;
$receiver_name=User::find($recipient->id)->name;

        
    $pdfView = view('pdf.transaction', compact('transaction', 'sender_name', 'receiver_name'));

    $dompdf = new Dompdf();

    $dompdf->loadHtml($pdfView->render());

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $pdfPath = public_path('pdfs/' . $filename);
    file_put_contents($pdfPath, $dompdf->output());

       
        $user->save();

        $recipient->balance += $montant;
        $recipient->save();

        DB::commit();

        return redirect()->back()->with('success', 'Amount sent successfully');
    } catch (\Exception $e) {
        DB::rollback();


        return redirect()->back()->withErrors('An error occurred while processing the transaction');
    }
}
public function pendingtransaction(Request $request)
{
    $userId = Auth::id();
    $notifications = auth()->user()->notifications()->paginate(10);

    $offlineTransactions = TransactionOffline::where('status', 'Waiting')->get();

    return view('admin.pendingtransaction', compact('offlineTransactions', 'notifications'));   
}

public function acceptedtransaction(Request $request)
{
    $userId = Auth::id();
    $notifications = auth()->user()->notifications()->paginate(10);

    $offlineTransactions = TransactionOffline::where('status', 'Accepted')->get();

    return view('admin.acceptedtransaction', compact('offlineTransactions', 'notifications'));   
}
public function approvedtransaction(Request $request)
{
    $userId = Auth::id();
    $notifications = auth()->user()->notifications()->paginate(10);

    $offlineTransactions = TransactionOffline::where('status', 'Rejected')->get();

    return view('admin.rejectedtransaction', compact('offlineTransactions', 'notifications'));   
}
public function sendtouserfromoffline(Request $request)
{
    $notifications = auth()->user()->notifications()->paginate(10);

    $montant = $request->input('montant');
    $id = $request->input('id');
    $user_id = $request->input('user_id');
    $recipient = User::find($user_id);

    $user = auth()->user();
    $filename = 'transaction_' . $user_id . '_' . time() . '.pdf';

    DB::beginTransaction();

    $transaction=FinancialSummary::create([
        'user_id' => $user_id,
        'amount' => floatval($montant),
        'title' => 'Charge account',
        'description' => 'Offline transaction approved',
        'Creator' => 'Automatic',
        'pdf_path' => 'pdfs/' . $filename,

    ]);
    
    

$receiver_name=User::find($user_id)->name;

        
    $pdfView = view('pdf.transaction', compact('transaction', 'receiver_name'));

    $dompdf = new Dompdf();

    $dompdf->loadHtml($pdfView->render());

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $pdfPath = public_path('pdfs/' . $filename);
    file_put_contents($pdfPath, $dompdf->output());

        $user->balance -= $montant;
        $user->save();

        $recipient->balance += $montant;
        $recipient->save();
        $transaction = TransactionOffline::find($id);
        $transaction->status = 'Accepted';
        $transaction->save();

        DB::commit();

        return redirect()->back()->with('success', 'Amount sent successfully');

    }
public function rejectofflinetransaction(Request $request)
{
    $notifications = auth()->user()->notifications()->paginate(10);

    $id = $request->input('id');
   

   
        $transaction = TransactionOffline::find($id);
        $transaction->status = 'Rejected';
        $transaction->save();

        DB::commit();

        return redirect()->back()->with('rejected', 'reject');

    }
    public function offlinet_transaction(Request $request)
{
    $userId = Auth::id();
    $notifications = auth()->user()->notifications()->paginate(10);

 $offlineTransactions = TransactionOffline::all();

    return view('admin.offlinet_transaction', compact('offlineTransactions', 'notifications'));   
}
public function adminTransactions(){
    $notifications = auth()->user()->notifications()->paginate(10);
$user = auth()->user();
return view('admin.Transaction', compact( 'notifications'));
}
public function payads()
{
    $notifications = auth()->user()->notifications()->paginate(10);

    $currentYear = date('Y');
    $userId = Auth::id();

    $offlineTransactions = TransactionOffline::where('user_id', $userId)->get();
    

    return view('publisher.payads',compact('currentYear','notifications','offlineTransactions'));   
}
public function Financalsummary(Request $request)
{
    $userId = Auth::id();
    $notifications = auth()->user()->notifications()->paginate(10);

    $walletHistoric = FinancialSummary::with('user')
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('publisher.Financalsummary', compact('walletHistoric', 'notifications'));   
}
public function transaction_offline(Request $request)
    {
        $userId = Auth::id();
    

            $validatedData = $request->validate([
                'Montant' => 'required|numeric',
                'compte' => 'required|string',
            'reference' => 'required|string',
            'date_heure' => 'required',
                'photo_paiement' => 'required|image|mimes:jpeg,png,jpg,gif'
               
            ], [
                'Montant.numeric' => 'The montant must be a numeric value.',
                'photo_paiement.image' => 'The photo paiement must be an image file.',
                'photo_paiement.mimes' => 'The photo paiement must be a file of type: jpeg, png, jpg, gif.',
            ]);
            $transaction = new TransactionOffline();
            $transaction->user_id = $userId;
            $transaction->montant = $validatedData['Montant'];
            $transaction->compte = $request['compte'];
            $transaction->reference = $validatedData['reference'];

            $formattedDatetime = str_replace('T', ' ', substr($validatedData['date_heure'], 0, 19));

           
            $transaction->date_heure = $formattedDatetime;
                     $file = $request->file('photo_paiement');
               $fileName = time() . '_' . $file->getClientOriginalName();
                 $filePath = 'photos/transaction/' . $fileName;
                 $file->move(public_path('photos/transaction'), $fileName);
                 $transaction->photo_paiement = $filePath;
            
    
            $transaction->save();
            $offlineTransactions = TransactionOffline::where('user_id', $userId)->get();
            $currentYear = date('Y');
            $notifications = auth()->user()->notifications()->paginate(10);
            $formId = 'rib';
           return back()->with([
            'offlineTransactions','currentYear','notifications',
            'successMessage' => 'Payment updated successfully.',
            'formId' => 'rib',
        ]);
    }
    public function sendpayment(Request $request)
{
    $notifications = auth()->user()->notifications()->paginate(10);
 
    $validatedData = $request->validate([
        'montant' => 'required|numeric',
        'cardName' => 'required|string',
        'cardNumber' => 'required|numeric',
        'cardCvv' => 'required|numeric',
    ], [
        'montant.numeric' => 'The montant must be a numeric value.',
        'cardNumber.numeric' => 'The cardNumber must be a numeric value.',
        'cardCvv.numeric' => 'The Cvv must be a numeric value.',
    ]);
    $montant = $request->input('montant');
    $cardName = $request->input('cardName');
    $cardNumber = $request->input('cardNumber');
    $Cvv = $request->input('cardCvv');
    $cardmonth = $request->input('cardMonth');
    $cardyear = $request->input('cardYear');
    if(($Cvv == '0000')&&($cardNumber == '0000')&&($cardName == '0000')&&($cardmonth == 'March')&&($cardyear == '2025')){

            $user = auth()->user();
            $user->balance +=floatval($validatedData['montant']);
            $user->save(); 

            $filename = 'wallet_' . auth()->id() . '_' . time() . '.pdf';
            $user_name=User::find(auth()->id())->name;
    
           
                $transaction=FinancialSummary::create([
                    'user_id' => $user->id,
                    'amount' => floatval($validatedData['montant']),
                    'title' => 'Charge account',
                    'description' => 'Bank',
                    'Creator' => 'Automatic',
                    'pdf_path' => 'pdfs/wallet/' . $filename,
    
                ]);
                
        $pdfView = view('pdf.wallet', compact('transaction', 'user_name'));
        $dompdf = new Dompdf();
        $dompdf->loadHtml($pdfView->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfPath = public_path('pdfs/wallet/' . $filename);
        file_put_contents($pdfPath, $dompdf->output());
    
    
if($user->hasRole('publisher')){
                return view('publisher.Transactions',compact('notifications'));

}
else if($user->hasRole('admin')){
    return view('admin.Transaction',compact('notifications'));

}
    }
    else{
        return back()->with('error', 'Invalid payment data. Please try again.')->with('formId', 'bank'); // For bank form

    }
    }
    public function Transactions(){
         $notifications = auth()->user()->notifications()->paginate(10);
     $user = auth()->user();
     $cafe = User::whereHas('roles', function ($query) {
         $query->where('name', 'subscriber');
     })
     ->orderByRaw("CASE WHEN address LIKE '%{$user->address}%' THEN 0 ELSE 1 END")
     ->orderBy('cafeName', 'asc')
     ->get();
     return view('publisher.Transactions', compact('cafe', 'notifications'));
     }


     public function editofflinetransaction($id)
     {
         $notifications = auth()->user()->notifications()->paginate(10);
     
         $currentYear = date('Y');
         $userId = Auth::id();
     
         $offlineTransactions = TransactionOffline::where('user_id', $userId)->get();
         $transaction = TransactionOffline::find($id);
         $formId = 'rib';
         $type = 'rib';
         return view('publisher.editofflinetransaction', compact('currentYear', 'notifications', 'offlineTransactions', 'transaction', 'formId','type','id'));
         
     }
     
     public function deleteofflinetransaction(Request $request)
    {
        $id = $request->input('id');
    
        $transaction = TransactionOffline::find($id);
    
        if ($transaction) {
            $transaction->delete();
            return redirect()->back()->with('successdelete', 'Offline Transaction deleted successfully.')->with('formId', 'rib');;
        } else {
            return redirect()->back()->with('error', 'Transaction not found.')->with('formId', 'rib');
        }
    }


    public function editing_transaction_offline(Request $request, $id)
{
    $userId = Auth::id();

    $validatedData = $request->validate([
        'Montant' => 'required|numeric',
        'compte' => 'required|string',
        'reference' => 'required|string',
        'date_heure' => 'required',
        'photo_paiement' => 'required|image|mimes:jpeg,png,jpg,gif'
    ], [
        'Montant.numeric' => 'The montant must be a numeric value.',
        'photo_paiement.image' => 'The photo paiement must be an image file.',
        'photo_paiement.mimes' => 'The photo paiement must be a file of type: jpeg, png, jpg, gif.',
    ]);

   
    $transaction = TransactionOffline::findOrFail($id);

    $transaction->user_id = $userId;
    $transaction->montant = $validatedData['Montant'];
    $transaction->compte = $request['compte'];
    $transaction->reference = $validatedData['reference'];

    $formattedDatetime = str_replace('T', ' ', substr($validatedData['date_heure'], 0, 19));
    $transaction->date_heure = $formattedDatetime;

    if ($request->hasFile('photo_paiement')) {
        $file = $request->file('photo_paiement');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = 'photos/transaction/' . $fileName;
        $file->move(public_path('photos/transaction'), $fileName);
        $transaction->photo_paiement = $filePath;
    }

    $transaction->save();
    
//  return back()->with([
//  
//     'formId' => 'rib',
// ]);
$notifications = auth()->user()->notifications()->paginate(10);

$currentYear = date('Y');
$userId = Auth::id();


$offlineTransactions = TransactionOffline::where('user_id', $userId)->get();
$formId='rib';
return redirect()->route('payads')->with([
    'currentYear' => $currentYear,
    'notifications' => $notifications,
    'offlineTransactions' => $offlineTransactions,
    'formId' => $formId,
    'successMessageupdate' => 'Payment updated successfully.',
]);

}
public function publisherpayads()
{
    $notifications = auth()->user()->notifications()->paginate(10);

    $montant = 900;

    return view('publisher.checkout',compact('montant','notifications'));   
}
public function processCheckout(Request $request)
{
    
    $adFormData = $request->session()->get('adFormData');
    $cost = $cost = $adFormData['cost'];

    $userBalance = Auth::user()->balance; 

    
    if ($userBalance >= $cost) {
     
        $ad = new Advertisement();
        $ad->user_id = Auth::user()->id;
        $ad->video = $adFormData['videoPath'];
        $ad->startdate = $adFormData['start'];
        $ad->enddate = $adFormData['end'];
        $ad->time = $adFormData['time'];
        $ad->period = $adFormData['period'];
        $ad->cost = $cost; 
        $ad->status = 'pending';
        $ad->save();

        $cafeOwnerIdsArray = array_map('intval', explode(',', $adFormData['cafeOwnerId']));

        $ad->cafeOwners()->sync($cafeOwnerIdsArray);

       
        $adminUser = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->first();

        $adminNotification = new NewAdNotification($ad);
        $adminUser->notify($adminNotification);

        
        $selectedSubscriberIds = array_unique($cafeOwnerIdsArray);
        $selectedSubscribers = User::whereIn('id', $selectedSubscriberIds)->get();

        $subscriberNotification = new NewAdNotification($ad);
        Notification::send($selectedSubscribers, $subscriberNotification);

        Auth::user()->deductBalance($cost);

        return redirect()->route('PublisherAds'); 
    } else {
        
        return redirect()->route('processCheckout')->with('error', 'Insufficient balance to create the ad.');
    }
}
public function destroy($id)
{
    
    $ad = Advertisement::findOrFail($id);

    $ad->delete();

    return redirect()->route('PublisherAds')->with('success', 'ad deleted successfully');
}


}
