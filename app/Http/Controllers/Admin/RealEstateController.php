<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRealEstateRequest;
use App\Http\Requests\StoreRealEstateRequest;
use App\Http\Requests\UpdateRealEstateRequest;
use App\Models\Location;
use App\Models\RealEstate;
use App\Models\RealEstateType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RealEstateController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('real_estate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = Auth::user();
        if($user -> role -> title == "Admin"){
            $realEstates = RealEstate::with(['location', 'types', 'user', 'media'])->get();
            return view('admin.realEstates.index', compact('realEstates'));
        }

        $realEstates = RealEstate::with(['location', 'types', 'user', 'media'])
            ->whereHas('user', function ($query) use ($user) {
                $query->where('id', $user->id);
            })
            ->get();
        return view('user.realEstates.index', compact('realEstates'));
    }

    public function create()
    {
        abort_if(Gate::denies('real_estate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = RealEstateType::pluck('name', 'id');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.realEstates.create', compact('locations', 'types', 'users'));
    }

    public function store(StoreRealEstateRequest $request)
    {
        $realEstate = RealEstate::create($request->all());

        $realEstate->types()->sync($request->input('types', []));
        if ($request->input('main_photo', false)) {
            $realEstate->addMedia(storage_path('tmp/uploads/' . basename($request->input('main_photo'))))->toMediaCollection('main_photo');
        }

        foreach ($request->input('gallery', []) as $file) {
            $realEstate->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $realEstate->id]);
        }

        return redirect()->route('admin.real-estates.index');
    }

    public function edit(RealEstate $realEstate)
    {
        abort_if(Gate::denies('real_estate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = RealEstateType::pluck('name', 'id');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $realEstate->load('location', 'types', 'user');

        return view('admin.realEstates.edit', compact('locations', 'realEstate', 'types', 'users'));
    }

    public function update(UpdateRealEstateRequest $request, RealEstate $realEstate)
    {
        $realEstate->update($request->all());
        $realEstate->types()->sync($request->input('types', []));
        if ($request->input('main_photo', false)) {
            if (! $realEstate->main_photo || $request->input('main_photo') !== $realEstate->main_photo->file_name) {
                if ($realEstate->main_photo) {
                    $realEstate->main_photo->delete();
                }
                $realEstate->addMedia(storage_path('tmp/uploads/' . basename($request->input('main_photo'))))->toMediaCollection('main_photo');
            }
        } elseif ($realEstate->main_photo) {
            $realEstate->main_photo->delete();
        }

        if (count($realEstate->gallery) > 0) {
            foreach ($realEstate->gallery as $media) {
                if (! in_array($media->file_name, $request->input('gallery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $realEstate->gallery->pluck('file_name')->toArray();
        foreach ($request->input('gallery', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $realEstate->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
            }
        }

        return redirect()->route('admin.real-estates.index');
    }

    public function show(RealEstate $realEstate)
    {
        abort_if(Gate::denies('real_estate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realEstate->load('location', 'types', 'user');

        return view('admin.realEstates.show', compact('realEstate'));
    }

    public function destroy(RealEstate $realEstate)
    {
        abort_if(Gate::denies('real_estate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realEstate->delete();

        return back();
    }

    public function massDestroy(MassDestroyRealEstateRequest $request)
    {
        $realEstates = RealEstate::find(request('ids'));

        foreach ($realEstates as $realEstate) {
            $realEstate->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('real_estate_create') && Gate::denies('real_estate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new RealEstate();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
