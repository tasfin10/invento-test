<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ManageStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Rules\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class SettingController extends Controller
{
    function basic() {
        $pageTitle   = 'Basic Setting';
        $timeRegions = json_decode(file_get_contents(resource_path('views/admin/partials/timeRegion.json')));
    
        return view('admin.setting.basic', compact('pageTitle', 'timeRegions'));
    }

    function basicUpdate() {
        $this->validate(request(), [
            'site_name'      => 'required|string|max:40',
            'per_page_item'  => 'required|in:20,50,100',
            'time_region'    => 'required'
        ]);

        $setting                 = bs();
        $setting->site_name      = request('site_name');
        $setting->per_page_item  = request('per_page_item');
        $setting->save();

        $timeRegionFile = config_path('timeRegion.php');
        $setTimeRegion  = '<?php $timeRegion = '.request('time_region').' ?>';
        file_put_contents($timeRegionFile, $setTimeRegion);

        return toastBack('success', 'Basic setting update success');
    }

    function systemUpdate() {
        $setting               = bs();
        $setting->enforce_ssl  = request('enforce_ssl')  ? ManageStatus::ACTIVE : ManageStatus::INACTIVE;
        $setting->ea           = request('ea')           ? ManageStatus::ACTIVE : ManageStatus::INACTIVE;
        $setting->sa           = request('sa')           ? ManageStatus::ACTIVE : ManageStatus::INACTIVE;
        $setting->save();

        return toastBack('success', 'System setting update success');
    }

    function logoFaviconUpdate() {
        $this->validate(request(), [
            'logo_light' => [File::types(['png'])],
            'logo_dark'  => [File::types(['png'])],
            'favicon'    => [File::types(['png'])],
        ]);

        $path = getFilePath('logoFavicon');

        if (!file_exists($path)) mkdir($path, 0755, true);

        $manager = new ImageManager(new Driver());

        if (request()->hasFile('logo_light')) {
            try {
                $manager->read(request('logo_light'))->save($path . '/logo_light.png');
            } catch (\Exception $exp) {
                return toastBack('error', 'Unable to upload light logo');
            }
        }

        if (request()->hasFile('logo_dark')) {
            try {
                $manager->read(request('logo_dark'))->save($path . '/logo_dark.png');
            } catch (\Exception $exp) {
                return toastBack('error', 'Unable to upload dark logo');
            }
        }

        if (request()->hasFile('favicon')) {
            try {
                $size = explode('x', getFileSize('favicon'));
                $manager->read(request('favicon'))
                        ->resize($size[0], $size[1])
                        ->save($path . '/favicon.png');
            } catch (\Exception $exp) {
                return toastBack('error', 'Unable to upload the favicon');
            }
        }

        return toastBack('success', 'Logo and favicon update success');
    }

    function cacheClear() {
        Artisan::call('optimize:clear');
        return toastBack('success', 'Clearing cache success');
    }
}
