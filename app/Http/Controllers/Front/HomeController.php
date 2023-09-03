<?php

namespace App\Http\Controllers\Front;

use App\Mail\EmailVerification;
use App\Mail\NewMail;
use App\Models\Realestate;
use App\Models\ContactRequest;
use App\Models\MaintenanceRequest;
use App\Models\Status;
use App\Models\ApartmentStatus;
use App\Models\Floor;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\sendContact;
use App\Models\Apartment;
use App\Models\Award;
use App\Models\Location;
use App\Models\BusinessProject;
use App\Models\ApartmentRequest;
use App\Models\Blog;
use App\Models\VillaRequest;
use App\Models\OfficeRequest;
use App\Models\PlotRequest;
use App\Models\ProjectCategory;
use App\Models\SalesStatus;
use App\Models\About;
use App\Models\BusinessCategory;
use App\Models\SocialService;
use App\Models\ServiceCategory;
use App\Models\Manager;
use App\Models\Service;
use App\Models\Setting;
use App\Models\AboutInfo;
use App\Models\OurValue;
use App\Models\OurGoal;
use App\Models\Banner;
use App\Models\Team;
use App;
use Stichoza\GoogleTranslate\GoogleTranslate;
class HomeController extends Controller

{
    public $translat;
    function __construct(){
       
      $this->translat=  'Stichoza\GoogleTranslate\GoogleTranslate';
    }

    public function indexPge(){
        $local=App::getLocale();
        return redirect("/home/$local");

    }
    public function index($local)
     {  App::setLocale($local);
        \LaravelLocalization::setLocale($local);
        $tr =$this->translat;
     
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $businessCategories = BusinessCategory::query()->where('status_id',$active)->get();
        $realestates = Realestate::query()->where('status_id',$active)->limit(5)->get();
        $services = Service::query()->where('status_id',$active)->limit(8)->get();
        $about = About::query()->first();
        $banners = Banner::query()->where('status_id',$active)->where('location','home-page')->get();
        return view('home',compact('about','businessCategories','realestates','banners','services','tr'));
    }

    public function about($local)
    {   App::setLocale($local);
        \LaravelLocalization::setLocale($local);
         $tr =$this->translat;
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $about = About::query()->first();
        $aboutInfos = AboutInfo::query()->get();
        $ourValues = OurValue::query()->get();
        $ourGoals = OurGoal::query()->get();
        $teams = Team::query()->where('status_id',$active)->get();
        $managers = Manager::query()->where('status_id',$active)->get();
        return view('about',compact('about','aboutInfos','ourValues','ourGoals','teams','managers','tr'));
    }

    public function awards($local)
    {  App::setLocale($local);
       \LaravelLocalization::setLocale($local);
        $tr =$this->translat;
        $active = Status::query()->where('slug', 'active')->first()->_id;
        
        $socialServices = SocialService::query()->where('status_id',$active)->get();
        $awards = Award::query()->where('status_id',$active)->get();
        return view('awards',compact('socialServices','awards','tr'));
    }
    public function blogDetails(Request $request,$slug,$local)
    {  App::setLocale($local);
       \LaravelLocalization::setLocale($local);
       $tr =$this->translat;
        
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $blog = Blog::query()->where('slug',$slug)->where('status_id',$active)->first();
        $blogs = Blog::query()->where('slug','!=',$slug)->where('status_id',$active)->orderBy('date','acs')->limit(5)->get();
        return view('blog-details',compact('blog','blogs','tr'));
    }
    public function blog($local)
    {  App::setLocale($local);
       \LaravelLocalization::setLocale($local);
       $tr =$this->translat;
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $blogs = Blog::query()->where('status_id',$active)->orderBy('date','acs')->get();
        return view('blog',compact('blogs','tr'));
    }

    public function contactUs($local)
    {  App::setLocale($local);
       \LaravelLocalization::setLocale($local);
       $tr =$this->translat;
        $setting = Setting::query()->first();
        $locations = Location::query()->get();
        return view('contact-us',compact('locations','setting','tr'));
    }

    public function deem($local)
    {  App::setLocale($local);
       \LaravelLocalization::setLocale($local);
       $tr =$this->translat;
        
        return view('deem','tr');
    }
    public function maintenance($local)
    {  App::setLocale($local);
       \LaravelLocalization::setLocale($local);
       $tr =$this->translat;
        
        return view('maintenance',compact('tr'));
    }
    public function projects($local,Request $request,$slug)
    {  App::setLocale($local);
       \LaravelLocalization::setLocale($local);
       $tr =$this->translat;
        
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $businessCategory = BusinessCategory::query()->where('slug',$slug)->first();
        $businesses = BusinessProject::query()->where('businessCategory_id',$businessCategory->_id)->where('status_id',$active)->get();
        return view('projects',compact('businesses','businessCategory','tr'));
    }
    public function projectsDetails($local,Request $request,$slug)
    {   
        App::setLocale($local);
        \LaravelLocalization::setLocale($local);
        $tr =$this->translat;
        
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $business = BusinessProject::query()->where('slug',$slug)->where('status_id',$active)->first();
        return view('projects-details',compact('business','tr'));
    }
    public function realestate($local)
    {  App::setLocale($local);
       \LaravelLocalization::setLocale($local);
       $tr =$this->translat;
        //6373557113ed34531901b69c
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $projectCategories = ProjectCategory::query()->where('status_id',$active)->get();
        $salesStatuses = SalesStatus::query()->where('status_id',$active)->get();
        $realestates = Realestate::query()->where('status_id',$active)->get();
        $apartmentStatus = ApartmentStatus::query()->where('status_id',$active)->get();
        // dd($active);
        return view('realestate',compact('realestates','salesStatuses','projectCategories','active','tr'));
    }
    public function projectSearch(Request $request)
    {
        
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $projectCategories = ProjectCategory::query()->where('status_id',$active)->get();
        $salesStatuses = SalesStatus::query()->where('status_id',$active)->get();
        $apartmentStatus = ApartmentStatus::query()->where('status_id',$active)->get();
        
        $keywords = $request->input('keywords');
        $projectCategory_id = $request->input('projectCategory_id');
        $salesStatus_id = $request->input('salesStatus_id');
        $buildingsCount = $request->input('salesStatus_id');
        $query = Realestate::query()->where('status_id',$active);
        // dd($request);
        if($request->has('keywords') and $request->input('keywords') != null ){
            $keywords = $request->input('keywords');
            $query = $query->where('description','like', '%'.$request->input('keywords').'%');
        }
        if($request->has('projectCategory_id') and $request->input('projectCategory_id') != null ){
            $query = $query->where('projectCategory_id',$request->input('projectCategory_id'));
        }
        if($request->has('salesStatus_id') and $request->input('salesStatus_id') != null){
            $query = $query->where('salesStatus_id',$request->input('salesStatus_id'));
        }
        $fRealestates = $query->get();
    
        $keywords = $request->input('keywords');
        $projectCategory_id = $request->input('projectCategory_id');
        $salesStatus_id = $request->input('salesStatus_id');
        $buildingsCount = $request->input('buildingsCount');
        foreach($fRealestates as $key => $realestate){
            
            if($realestate->buildings_count != $buildingsCount and $buildingsCount != null){
                unset($fRealestates[$key]);
                // $realestates = array_values($realestates);
            }
        }
        $realestates = array();
        foreach ($fRealestates as $key => $val) {
            array_push($realestates,$val);   
        }
        return view('realestate-search',compact('realestates','salesStatuses','projectCategories','keywords','projectCategory_id','salesStatus_id','buildingsCount'));
    }
    public function realestateDetails($local,Request $request, $slug)
    {  App::setLocale($local);
       \LaravelLocalization::setLocale($local);
       $tr =$this->translat;
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $realestate = Realestate::query()->where('slug',$slug)->where('status_id',$active)->first();
        
        
        $apartmentStatuses = ApartmentStatus::query()->where('status_id',$active)->get();
        return view('realestate-details',compact('realestate','apartmentStatuses','tr'));
    }

    public function services(Request $request,$local,$slug, $activeService = null)
    {  App::setLocale($local);
       \LaravelLocalization::setLocale($local);
       $tr =$this->translat;
        
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $serviceCategory = ServiceCategory::query()->where('status_id',$active)->where('slug',$slug)->first();
        $serviceCategories = ServiceCategory::query()->where('_id','!=',$serviceCategory->_id)->where('status_id',$active)->get();
        
        $services = Service::query()->where('status_id',$active)->get();

        return view('services',compact('serviceCategories','serviceCategory','services','activeService','tr'));
    }
    public function serviceDetails()
    {
        return view('service-details');
    }
    public function business($local)
    {  App::setLocale($local);
       \LaravelLocalization::setLocale($local);
       $tr =$this->translat;
        
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $businessCategories = BusinessCategory::query()->where('status_id',$active)->get();
        
        $banner = Banner::query()->where('status_id',$active)->where('location','business-page')->first();
        
        $blogs = Blog::query()->where('status_id',$active)->limit(3)->get();
        return view('business',compact('businessCategories','banner','blogs','tr'));
    }
    public function requestApartment(Request $request)
    {
        $name = $request->name??null;
        $phone = $request->phone??null;
        $email = $request->email??null;
        $payment = $request->payment??null;
        $apartment_id = $request->apartment;
        $floor_id = $request->floor;
        $building_id = $request->building;
        $realestate_id = $request->realestate;
        if($email != null and $name != null and $phone != null and $apartment_id != null){
            $req = ApartmentRequest::query()->where('apartment_id',$apartment_id)->where('email',$email)->first();
            if($req != null){
                return response()->json(['succes'=>false, 'message'=>'لقد طلبت هذه الشقة بالفعل' ],200);
            }else{
                $m = new ApartmentRequest();
                $m->name = $name;
                $m->phone = $phone;
                $m->email = $email;
                $m->payment = $payment;
                $m->apartment_id = $apartment_id;
                $m->floor_id = $floor_id;
                $m->building_id = $building_id;
                $m->realestate_id = $realestate_id;
                $m->save();
                return response()->json(['succes'=>true,'message' =>'تم تقديم طلبك' ],200);

            }

        }

    }
    public function requestVilla(Request $request)
    {
        $name = $request->name??null;
        $phone = $request->phone??null;
        $email = $request->email??null;
        $payment = $request->payment??null;
        $villa_id = $request->villa;

        $realestate_id = $request->realestate;
        if($email != null and $name != null and $phone != null and $villa_id != null){
            $req = VillaRequest::query()->where('villa_id',$villa_id)->where('email',$email)->first();
            if($req != null){
                return response()->json(['succes'=>false, 'message'=>'لقد طلبت هذه الشقة بالفعل' ],200);
            }else{
                $m = new VillaRequest();
                $m->name = $name;
                $m->phone = $phone;
                $m->email = $email;
                $m->villa_id = $villa_id;
                $m->payment = $payment;
                $m->realestate_id = $realestate_id;
                $m->save();
                return response()->json(['succes'=>true,'message' =>'تم تقديم طلبك' ],200);

            }

        }

    }
    public function requestPlot(Request $request)
    {
        $name = $request->name??null;
        $phone = $request->phone??null;
        $email = $request->email??null;
        $payment = $request->payment??null;
        $plot = $request->plot??null;
        $land_id = $request->land;
        $realestate_id=$request->realestate;
        if($email != null and $name != null and $phone != null and $land_id != null and $realestate_id != null){
            $req = PlotRequest::query()->where('land_id',$land_id)->where('email',$email)->first();
            if($req != null){
                return response()->json(['succes'=>false, 'message'=>'لقد طلبت هذه الشقة بالفعل' ],200);
            }else{
                $m = new PlotRequest();
                $m->name = $name;
                $m->phone = $phone;
                $m->email = $email;
                $m->payment = $payment;
                $m->realestate_id = $realestate_id;
                $m->land_id = $land_id;
                
                $m->plot_id = $plot;
               
                $m->save();
                return response()->json(['succes'=>true,'message' =>'تم تقديم طلبك' ],200);

            }

        }

    }
    public function submitContact(Request $request)
    {
    //    dd($request);
        $name = $request->name??null;
        $phone = $request->phone_number??null;
        $email = $request->email??null;
        $comment=$request->comment??null;
        if($email != null and $name != null and $phone != null){
                $m = new ContactRequest();
                $m->name = $name;
                $m->phone = $phone;
                $m->email = $email;
                $m->comment = $comment;
               
                
                
                $m->save();
                return response()->json(['succes'=>true,'message' =>'تم تقديم طلبك' ],200);

            }

        }
        public function submitMaintenance(Request $request)
        {
        //    dd($request);
            $name = $request->name??null;
            $phone = $request->phone_number??null;
            $email = $request->email??null;
            $company_name=$request->company_name??null;
            $company_email=$request->company_email??null;
            $company_type=$request->company_type??null;
            $country=$request->country??null;
            $neighborhood=$request->neighborhood??null;
            $maintenance_reason=$request->maintenance_reason??null;
            $city=$request->city??null;
            $comment=$request->comment??null;
            
            if($email != null and $name != null and $phone != null){
                    $m = new MaintenanceRequest();
                    $m->name = $name;
                    $m->phone = $phone;
                    $m->email = $email;
                    $m->comment = $comment;
                    $m->company_name = $company_name;
                    $m->company_email = $company_email;
                    $m->company_type = $company_type;
                    $m->country = $country;
                    $m->neighborhood = $neighborhood;
                    $m->maintenance_reason = $maintenance_reason;
                    $m->city = $city;
                    $m->save();
                    return response()->json(['succes'=>true,'message' =>'تم تقديم طلبك' ],200);
    
                }
    
            }
    
    


    public function requestOffice(Request $request)
    {
        // dd($request);
        $name = $request->name??null;
        $phone = $request->phone??null;
        $email = $request->email??null;
        $payment = $request->payment??null;
        $office = $request->office??null;
        $showroom_id = $request->floor;
        // dd($office);
        $realestate_id=$request->realestate;
        if($email != null and $name != null and $phone != null and $showroom_id != null and $realestate_id != null){
            $req = OfficeRequest::query()->where('floor',$showroom_id)->where('email',$email)->first();
            if($req != null){
                return response()->json(['succes'=>false, 'message'=>'لقد طلبت هذه الشقة بالفعل' ],200);
            }else{
                $m = new OfficeRequest();
                $m->name = $name;
                $m->phone = $phone;
                $m->email = $email;
                $m->payment = $payment;
                $m->realestate_id = $realestate_id;
                $m->showroom_id= $showroom_id;
                
                $m->office_id = $office;
               
                $m->save();
                return response()->json(['succes'=>true,'message' =>'تم تقديم طلبك' ],200);

            }

        }

    }
    public function ajaxSearch (Request $request)
    {
        $filterKeywords = $request->keywords??null;
        $filterSearchRooms = $request->searchRooms.''??null;
        $filterSearchFloor_id = $request->searchFloor_id??null;
        $filterApartmentStatus_id = $request->apartmentStatus_id??null;
        $building_id = $request->building_id??null;
        $realestate_id = $request->realestate_id??null;
        $realestate = Realestate::query()->where('_id',$realestate_id)->first();
        $floorQuery = Floor::query();
        if($filterSearchFloor_id != null)
        $floorQuery = $floorQuery->where('_id',$filterSearchFloor_id);
        if($building_id != null)
        $floorQuery = $floorQuery->where('building_id',$building_id);

        $floors = $floorQuery->get()->pluck('_id');
        //rooms
        
        $apartmentQuery = Apartment::query();
        // foreach($floors as $floor){
        $apartmentQuery = $apartmentQuery->whereIn('floor_id',$floors);
        // }
        if($filterSearchRooms != null)
        $apartmentQuery = $apartmentQuery->where('rooms',$filterSearchRooms);
        if($filterApartmentStatus_id != null){
            $apartmentQuery = $apartmentQuery->where('apartmentStatus_id',$filterApartmentStatus_id);
            $apartmentStatus = ApartmentStatus::query()->where('_id',$filterApartmentStatus_id)->first();
        }else{
            $apartmentStatus = null;
        }
        if($filterKeywords != null)
        $apartmentQuery = $apartmentQuery->where('description','like', '%'.$filterKeywords.'%');

        $apartmentsFiltered = $apartmentQuery->get();
        
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $apartmentStatuses = ApartmentStatus::query()->where('status_id',$active)->get();
        return response()->json(['view' => view('realestate-details.floor-info-search', compact('realestate','apartmentStatuses','building_id','apartmentsFiltered','apartmentStatus','filterApartmentStatus_id'))->render()]);

    }
    

}
