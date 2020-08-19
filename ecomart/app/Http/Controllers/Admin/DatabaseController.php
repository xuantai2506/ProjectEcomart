<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CorePrivilege;
use App\Models\CoreUser;
use DB;
use Alert;
use App\Http\Requests;
use Artisan;
use Log;
use Storage;
use Carbon\Carbon;
use App\Models\Constant;
use App\Http\Controllers\Functions;
class DatabaseController extends Controller
{
   

    public function index(Request $request)
    {

        // phân quyền
        $functions = new Functions();

        $check = $functions->loadPageAdmin('backup_data','backup');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $database_config = DB::connection()->getConfig();

        $database_pdo = DB::connection()->getPdo();

        $tables = \DB::select("SHOW TABLE STATUS");

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        $files = $disk->files(config('backup.backup.name'));

        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $this->getDate($disk->lastModified($f)),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

        return view("admin.database.backup")->with(compact('backups','tables','database_config','database_pdo'));
    }

    public function getDate($date_modify){
        return Carbon::createFromTimeStamp($date_modify)->formatLocalized('%d %B %Y %H:%M');
    }

    public function create()
    {
        try {

            $getEmailDatabase = Constant::where('constant','backup_email')->get('value')->toArray()[0]['value'];

            config(['backup.notifications.mail.to' => $getEmailDatabase]);
            
            // start the backup process
            Artisan::call('backup:run',['--only-db' => true]);
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            // Alert::success('New backup created');
            return redirect()->back();
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);

            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    // get backup-cònig
    public function getBackupConfig(){
        // phân quyền
        $functions = new Functions();

        $check = $functions->loadPageAdmin('backup_config','backup');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $getBackupEdit = Constant::where('constant','backup_email')->get()->toArray()[0];

        return view('admin.database.backup-config',compact('getBackupEdit'));
    }
    public function postBackupConfig(Request $request,$id_edit){
        $backup_email = $request->backup_email;
        $result = Constant::where('constant_id',$id_edit)->update(['value' => $backup_email]);
        if($result){
            return redirect()->back()->with('success','Thay đổi thành công');
        }else {
            return redirect()->back()->with('fail','Thay đổi thất bại');
        }
    }
}
