<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ashtray;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewAdNotification; 
use Illuminate\Support\Facades\Notification;
use App\Models\Role;


class adminController extends Controller
{

public function createUser(Request $request)
{
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'address' => $request->input('address'),
        'phoneno' => $request->input('phoneno'),
        'password' => Hash::make($request->input('password')),
    ]);

    $role = Role::where('name', 'publisher')->first();

    if (!$role) {
        $role = Role::create(['name' => 'publisher']);
    }

    $user->roles()->attach($role);

    $notification = array(
        'message' => 'Publisher added successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);
}

    function VerifierExistance(Request $request)
    {
        if ($request->has("query")) {
            $query = $request->input("query");

            if ($query == "email") {
                $val = $request->input("em");
                return User::where("email", "LIKE", "$val")->first()->count();
            }else if ($query == "phoneno") {
                $val =  $request->input("phono");
                return User::where("phoneno", "LIKE", "$val")->first()->count();
            }
        }
    }

    public function deletePublisher($id)
    {
        try {
            $publisher = User::findOrFail($id);
            $publisher->delete();
            $notification= array(
                'message' => 'publisher deleted successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('publisher')->with($notification);
        } catch (\Throwable $th) {
            return Response($th->getMessage(), 500);
        }
    }
    public function createSubscriber(Request $request)
    {
        $imagePath = null;
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imagePath = $image->store('profile_images', 'public');
        }
    
        $role = Role::where('name', 'subscriber')->first();
    
        if (!$role) {
            $role = Role::create(['name' => 'subscriber']);
        }
    
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phoneno' => $request->input('phoneno'),
            'cafeName' => $request->input('cafeName'),
            'cafeCategory' => $request->input('cafeCategory'),
            'minAge' => $request->input('minAge'),
            'maxAge' => $request->input('maxAge'),
            'tablesno' => $request->input('tables'),
            'password' => Hash::make($request->input('password')),
            'image' => $imagePath,
        ]);
    
        $user->roles()->attach($role);
    
        $tableCount = $request->input('tables');
        for ($i = 1; $i <= $tableCount; $i++) {
            $table = new Ashtray();
            $table->user_id = $user->id;
            $table->reference =uniqid();
            $table->save();
        }
    
        $notification = array(
            'message' => 'Subscriber added successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
    }
    
   
    public function deleteSubscriber($id)
    {
        try {
            $subscriber = User::findOrFail($id);
            $subscriber->delete();
            $notification= array(
                'message' => 'subscriber deleted successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            return Response($th->getMessage(), 500);
        }
    }
    public function getCategory(Request $request)
{
    $cafeName = $request->input('cafeName');
    $cafe = User::where('cafeName', $cafeName)->first();
    $cafeCategory = $cafe ? $cafe->cafeCategory : null;
    return response()->json(['cafeCategory' => $cafeCategory]);
}
    public function createAd(Request $request)
    {
        $userId = Auth::user()->id; 
        $videoFile = $request->file('video');
        $cafeOwnerId = $request->input('cafeOwnerId');
        $startdate=$request->input('start');
        $enddate=$request->input('end');
        $time=$request->input('time');
        $period=$request->input('period');
        $cost=$request->input('cost');
       
            $videoPath = $videoFile->store('videos', 'public');
            $ad = new Advertisement();
            $ad->cafe_owner_id = $cafeOwnerId;
            $ad->user_id = $userId;
            $ad->video = $videoPath;
            $ad->startdate=$startdate;
            $ad->enddate=$enddate;
            $ad->time=$time;
            $ad->period=$period;
            $ad->cost=$cost;
            $ad->status='pending';
            $ad->save();
            $adminUser = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->first();
        
            $notification = new NewAdNotification($ad);
            Notification::sendNow($adminUser, $notification); 

            $notification= array(
            'message' => 'ad created successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function show($id)
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        $advertisement = Advertisement::findOrFail($id);
                return view('admin.advertisement_show', compact('advertisement','notifications'));
    }
}
