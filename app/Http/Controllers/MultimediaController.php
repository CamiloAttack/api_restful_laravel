<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Multimedia;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use App\Transformers\MultimediaTransformer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class MultimediaController extends Controller
{
   
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $multimedia = Multimedia::all();


        $rules = [
            'per_page' => 'integer|min:2|max:50'
        ];

        Validator::validate(request()->all(), $rules);

        $page = LengthAwarePaginator::resolveCurrentPage();

        $perPage = 5;
        if (request()->has('per_page')) {
            $perPage = (int) request()->per_page;
        }

        $results = $multimedia->slice(($page - 1) * $perPage, $perPage)->values();


        $manager = new Manager();

        $resource = new Collection($multimedia, new MultimediaTransformer());

        $manager->parseIncludes('characters');

        $results =  $manager->createData($resource)->toArray();
     

       // $paginated = new LengthAwarePaginator([], $multimedia->count(), $perPage, $page, [
        $paginated = new LengthAwarePaginator([$results], $multimedia->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);
        //array_push($results,$paginated);
  
    //   return $paginated['data'];


      // array_push($results,$paginated);

        return $paginated ;
     
    }


}