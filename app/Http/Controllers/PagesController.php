<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ashtray;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewAdNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Notifications\AdValidatedNotification;
use App\Notifications\AdRejectedNotification;
use App\Models\Category;
use App\Notifications\ClaimNotification;




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
    ->get();

    return view('publisher.cafeList', compact('cafe','notifications'));
}

    public function PublisherAds(){
        $notifications = auth()->user()->notifications()->paginate(10);
        $user= auth()->user();
        $ads=Advertisement::where('user_id',$user->id)->get();
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

    return view('publisher.filter', compact('cafe', 'notifications','categories','addresses'));
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

   
}
