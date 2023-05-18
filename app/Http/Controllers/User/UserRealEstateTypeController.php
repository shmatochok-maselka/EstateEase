<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRealEstateTypeRequest;
use App\Http\Requests\StoreRealEstateTypeRequest;
use App\Http\Requests\UpdateRealEstateTypeRequest;
use App\Models\RealEstateType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UserRealEstateTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('real_estate_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realEstateTypes = RealEstateType::with(['media'])->get();

        return view('user.realEstateTypes.index', compact('realEstateTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('real_estate_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('user.realEstateTypes.create');
    }

    public function store(StoreRealEstateTypeRequest $request)
    {
        $realEstateType = RealEstateType::create($request->all());

        if ($request->input('photo', false)) {
            $realEstateType->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $realEstateType->id]);
        }

        return redirect()->route('user.real-estate-types.index');
    }

    public function edit(RealEstateType $realEstateType)
    {
        abort_if(Gate::denies('real_estate_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('user.realEstateTypes.edit', compact('realEstateType'));
    }

    public function update(UpdateRealEstateTypeRequest $request, RealEstateType $realEstateType)
    {
        $realEstateType->update($request->all());

        if ($request->input('photo', false)) {
            if (! $realEstateType->photo || $request->input('photo') !== $realEstateType->photo->file_name) {
                if ($realEstateType->photo) {
                    $realEstateType->photo->delete();
                }
                $realEstateType->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($realEstateType->photo) {
            $realEstateType->photo->delete();
        }

        return redirect()->route('user.real-estate-types.index');
    }

    public function show(RealEstateType $realEstateType)
    {
        abort_if(Gate::denies('real_estate_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('user.realEstateTypes.show', compact('realEstateType'));
    }

    public function destroy(RealEstateType $realEstateType)
    {
        abort_if(Gate::denies('real_estate_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realEstateType->delete();

        return back();
    }

    public function massDestroy(MassDestroyRealEstateTypeRequest $request)
    {
        $realEstateTypes = RealEstateType::find(request('ids'));

        foreach ($realEstateTypes as $realEstateType) {
            $realEstateType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('real_estate_type_create') && Gate::denies('real_estate_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new RealEstateType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
