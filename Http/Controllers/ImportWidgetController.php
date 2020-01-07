<?php

namespace Modules\ImportWidget\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ImportWidget\Services\SessionService;

class ImportWidgetController extends Controller
{

    public function upload(Request $request)
    {
        /*
        $path = $request->file->store('uploads');
        try {
            $headings = ValidationService::missHeadings($event_validation, $path);

        } catch (Exception $e) {
            return  response()->json(['errors' => ['file' => 'Este arquivo não pode ser lido. Tente salvar o arquivo em formato EXCEL 2007 - 2019']], 422);
        }       
        if(count($headings) > 0){
            $headings2 = [];
            foreach ($headings as $i => $heading) {
                $headings2["#".$i] = $heading;
            }
            return  response()->json(['errors' => $headings2], 422);

        } else {
            ValidationService::beforeStart($event_validation->id, $path);
            return  response()->json($headings, 200);
        }
        */

        $path = $request->file->store('uploads');
        return response()->json(['path' => $path, 'module' => $request->module, 'method' => $request->method], 200);
    }

    public function start(Request $request)
    {
        SessionService::clear($request->module, $request->method);
        $method = $request->method;
        $path_class = 'Modules\\'.$request->module.'\\Services\\ImportService';
        $import_service = new $path_class();
        $import_service->$method($request->path);
    }

    public function update(Request $request)
    {
        return view('importwidget::index', ['module' => $request->module, 'method' => $request->method]);
    }

    public function report(Request $request, $file_name)
    {
        return response()->download(storage_path('app/failures/'.$file_name));
    }

}
