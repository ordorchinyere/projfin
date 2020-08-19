<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class SearchController extends Controller
{
    public function showSearchResult()
    {

    }

    public function search(Request $request)
    {
        

        $title = $request->query('title');
        $projects = Project::where('status', 'approved')->where('title', 'LIKE', '%'.$title.'%')->get();

        if($request->has('advance_search')){

            $projects = \DB::table('projects');

            if($request->has('title') && strlen($request->query('title')) != 0 ) {

                $title = $request->query('title');

                // $projects->where(function ($q) use($title) {
                    $projects->where('title', 'LIKE', '%'.$title.'%');
                // });
            }

            if($request->has('abstract') && strlen($request->query('abstract')) != 0 ) {
            
                $abstract = $request->query('abstract');

                // $projects->where(function ($q) use($abstract) {
                    $projects->orWhere('abstract', 'LIKE', '%'.$abstract.'%');
                // });

            }

            if($request->has('author') && strlen($request->query('author')) != 0 ) {

                $author = $request->query('author');

                // $projects->where(function ($q) use($author) {
                    $projects->orWhere('author', 'LIKE', '%'.$author.'%');
                // });

            }

            if($request->has('keywords') && strlen($request->query('keywords')) != 0 ) {

                $keywords = $request->query('keywords');

                // $projects->where(function ($q) use($keywords) {
                    $projects->orWhere('keywords', 'LIKE', '%'.$keywords.'%');
                // });
            }

            if($request->has('sdg') && strlen($request->query('sdg')) != 0) {

                $sdg = $request->query('sdg');

                // $projects->where(function ($q) use($sdg) {
                    $projects->orWhere('sdg', 'LIKE', '%'.$sdg.'%');
                // });
            }

            if($request->has('course') && strlen($request->query('course')) != 0){

                $course = $request->query('course');

                // $projects->where(function ($q) use($course) {
                    $projects->orWhere('course_id', 'LIKE', '%'.$course.'%');
                // });
            }

            if($request->has('department') && strlen($request->query('department')) != 0) {

                $department = $request->query('department');

                // $projects->where(function ($q) use($department) {
                    $projects->orWhere('department_id', 'LIKE', '%'.$department.'%');
                // });
            }

            if($request->has('supervisor') && strlen($request->query('supervisor')) != 0) {

                $supervisor = $request->query('supervisor');

                // $projects->where(function ($q) use($department) {
                    $projects->orWhere('supervisor_id', 'LIKE', '%'.$supervisor.'%');
                // });
            }

            if($request->has('year') && strlen($request->query('year')) != 0) {

                $year = $request->query('year');

                // $projects->where(function ($q) use($department) {
                    $projects->orWhere('issue_date', 'LIKE', '%'.$year.'%');
                // });
            }

            $res = $projects->get();

            $data['results'] = $res;

            return view('search.search-result', $data);
        }

        

        $data['results'] = $projects;

        return view('search.search-result', $data);
    }
}
