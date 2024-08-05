<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\Setting\Store as StoreRequest;
use App\Http\Requests\Setting\Update as UpdateRequest;
use App\Models\Banner;
use App\Services\UploadService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.setting.manage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {

            $data = $request->validated();

            // Add Logo
            $this->addLogo($request, $data);
            $setting = Setting::create($data);

            // Add Banner
            $this->addBanner($request, $setting->id);

            toast('Berhasil Menambah Pengaturan', 'success');
            return back();
        } catch (Exception $e) {
            toast('Gagal Menambah Pengaturan', 'error');
            return back();
        } catch (QueryException $qe) {
            toast('Gagal Menambah Pengaturan', 'error');
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        $banner = Banner::where('setting_id', $setting->id)->get();
        return view('admin.setting.manage', compact('setting', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Setting $setting)
    {
        try {
            $data = $request->validated();

            if ($request->has('logo')) {
                $file = $request['logo'];
                $upload = UploadService::updateImage($file, $setting->logo, 'setting');
                $data['logo'] = $upload;
            } else {
                Storage::disk('public')->delete('setting/' . $data['logo']);
                $data['logo'] = null;
            }

            $this->updateBanner($request, $setting->id);

            Setting::findOrFail($setting->id)->update($data);
            toast('Berhasil Mengubah Pengaturan', 'success');
            return back();
        } catch (Exception $e) {
            toast('Gagal Mengubah Pengaturan', 'error');
            return back();
        } catch (QueryException $qe) {
            toast('Gagal Mengubah Pengaturan', 'error');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }


    public function uploadLogo(Request $request)
    {
        if ($request->file('logo')) {
            $path = $request->file('logo')->store('tmp', 'public');
        }
        return $path;
    }

    public function revertLogo(Request $request)
    {
        Storage::disk('public')->delete($request->getContent());
    }


    // Add Logo
    private function addLogo(Request $request, &$data)
    {
        if ($request->has('logo')) {
            $file = $request['logo'];
            $upload = UploadService::uploadImage($file, 'setting');
            $data['logo'] = $upload;
        }
    }

    // Add Banner
    private function addBanner(Request $request, $settingId)
    {
        if ($request->has('banner')) {
            $files = $request['banner'];
            foreach ($files as $file) {
                $uploadBanner = UploadService::uploadImage($file, 'banner');
                Banner::create([
                    'setting_id' => $settingId,
                    'image' => $uploadBanner,
                ]);
            }
        }
    }


    private function updateBanner(Request $request, $settingId)
    {
        $setting = Setting::findOrFail($settingId);
        // Update Banner
        if ($request->has('banner')) {
            $files = $request['banner'];
            $uploadBanners = [];

            // Hapus gambar yang sudah ada
            $existingBanners = $setting->banner->pluck('image')->toArray();
            foreach ($existingBanners as $banner) {
                if (!in_array($banner, $files)) {
                    Storage::disk('public')->delete('banner/' . $banner);
                    Banner::where('setting_id', $settingId)->where('image', $banner)->delete();
                }
            }

            // Tambah atau perbarui gambar
            foreach ($files as $file) {
                $uploadBanner = UploadService::updateImage($file, null, 'banner');
                Banner::updateOrCreate(
                    ['setting_id' => $settingId, 'image' => $uploadBanner],
                    ['image' => $uploadBanner]
                );
                $uploadBanners[] = $uploadBanner;
            }
        } else {
            // Hapus semua gambar jika tidak ada yang dikirimkan
            foreach ($setting->banner as $banner) {
                Storage::disk('public')->delete('banner/' . $banner->banner);
                $banner->delete();
            }
        }
    }
}
