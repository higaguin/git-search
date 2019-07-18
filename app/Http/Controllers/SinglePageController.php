<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GitUser;
use App\GitDetail;
use App\HistoryTrack;

class SinglePageController extends Controller
{
    public function save_git_user(Request $request)
    {
        try{
            if(!GitUser::where('name', $request['name'])->exists()){
                $git_detail = new GitDetail();
                $git_detail->bio = $request['bio'];
                $git_detail->company = $request['company'];
                $git_detail->email = $request['email'];
                $git_detail->location = $request['location'];
                $git_detail->isHireable = $request['isHireable'];
                $git_detail->isEmployee = $request['isEmployee'];
                $git_detail->createdAt = $request['createdAt'];
                $git_detail->avatarUrl = $request['avatarUrl'];
                $git_detail->save();

                $git_user = new GitUser();
                $git_user->name = $request['name'];
                $git_user->git_detail_id = $git_detail->id;
                $git_user->save();

                $history = new HistoryTrack();
                $history->git_user_id = $git_user->id;
                $history->git_detail_id = $git_detail->id;
                $history->save();

                return ['response' => 'Usuario registrado'];
            }
            else{
                $searched_user = GitUser::where('name', $request['name'])->first();
                $exists_detail_current_user = $searched_user->whereHas('git_detail', function($query) use ($request) {
                    $query->where('bio', $request['bio'])
                            ->where('company', $request['company'])
                            ->where('email', $request['email'])
                            ->where('location', $request['location'])
                            ->where('isHireable', $request['isHireable'])
                            ->where('isEmployee', $request['isEmployee'])
                            ->where('createdAt', $request['createdAt'])
                            ->where('avatarUrl', $request['avatarUrl']);
                })->exists();
                
                if(!$exists_detail_current_user){
                    $git_detail = new GitDetail();
                    $git_detail->bio = $request['bio'];
                    $git_detail->company = $request['company'];
                    $git_detail->email = $request['email'];
                    $git_detail->location = $request['location'];
                    $git_detail->isHireable = $request['isHireable'];
                    $git_detail->isEmployee = $request['isEmployee'];
                    $git_detail->createdAt = $request['createdAt'];
                    $git_detail->avatarUrl = $request['avatarUrl'];
                    $git_detail->save();

                    $git_user = GitUser::find($searched_user['id']);
                    $git_user->git_detail_id = $git_detail->id;
                    $git_user->save();

                    $history = new HistoryTrack();
                    $history->git_user_id = $git_user->id;
                    $history->git_detail_id = $git_detail->id;
                    $history->save();

                    return ['response' => 'Cambios en el usuario registrados'];
                }
            }
            return ['response' => 'Búsqueda realizada con anterioridad'];
        }
        catch(\Exception $e){
            return ['response' => $e->getMessage()];
        }
    }

    public function get_history($username)
    {

        $user = GitUser::where('name', $username)->first();
        
        $history = HistoryTrack::with('git_detail')->where('git_user_id', $user['id'])->get()->map(function ($item, $key) {
            return $item->git_detail;
        });

        return ['response' => $history];
    }

    public function index() {
        return view('app');
    }
}
