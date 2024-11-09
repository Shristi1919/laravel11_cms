<?php

namespace Modules\Gallery\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleriesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Galleries';

        // module name
        $this->module_name = 'galleries';

        // directory path of the module
        $this->module_path = 'gallery::backend';

        // module icon
        $this->module_icon = 'fa-solid fa-diagram-project';

        // module model name, path
        $this->module_model = "Modules\Gallery\Models\Gallery";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';
        $validated_request = $request->validate([
            'name' => 'required|max:191|unique:' . $module_model . ',name',
            'slug' => 'nullable|max:191|unique:' . $module_model . ',slug',
            'group_name' => 'nullable|max:191',
            'description' => 'nullable',
            'meta_title' => 'nullable|max:191',
            'meta_description' => 'nullable',
            'meta_keyword' => 'nullable',
            'order' => 'nullable|integer',
            'status' => 'nullable|max:191',
            'images.*' => 'image|max:2048' // Validate each image file
        ]);

        // Loop through the images and create a new record for each one
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Create a new record for each image, including the associated fields
                $$module_name_singular = $module_model::create([
                    'name' => $request->input('name'),
                    'slug' => $request->input('slug'),
                    'group_name' => $request->input('group_name'),
                    'description' => $request->input('description'),
                    'meta_title' => $request->input('meta_title'),
                    'meta_description' => $request->input('meta_description'),
                    'meta_keyword' => $request->input('meta_keyword'),
                    'order' => $request->input('order'),
                    'status' => $request->input('status'),
                ]);

                // Add the image to the media collection for this record
                $media = $$module_name_singular->addMedia($image)->toMediaCollection($module_name);

                // You can also store the image URL or other media-related information if needed
                $$module_name_singular->update([
                    'image' => $media->getUrl(), // Store the URL or any other image-related field
                ]);
            }
        }

        // Flash message after successful addition
        flash("New '" . Str::singular($module_title) . "' Added")->success()->important();

        // Log the user access
        logUserAccess($module_title . ' ' . $module_action);

        // Redirect back to the module page
        return redirect("admin/{$module_name}");
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';

        $$module_name_singular = $module_model::findOrFail($id);

        // $posts = $$module_name_singular->posts()->latest()->paginate();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return view(
            "{$module_path}.{$module_name}.show",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', "{$module_name_singular}")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        // Validate the incoming request
        $validated_request = $request->validate([
            'name' => 'required|max:191|unique:' . $module_model . ',name,' . $id,
            'slug' => 'nullable|max:191|unique:' . $module_model . ',slug,' . $id,
            'group_name' => 'nullable|max:191',
            'description' => 'nullable',
            'meta_title' => 'nullable|max:191',
            'meta_description' => 'nullable',
            'meta_keyword' => 'nullable',
            'order' => 'nullable|integer',
            'status' => 'required|max:191',
            'images.*' => 'image|max:2048',
            'images_remove' => 'nullable|array'  // Ensure we validate removal of images
        ]);

        // Find the model by ID
        $$module_name_singular = $module_model::findOrFail($id);

        // Update the fields except images and removed images
        $$module_name_singular->update($request->except('images', 'images_remove'));

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $$module_name_singular->addMedia($image)->toMediaCollection($module_name);
            }
        }

        // Handle removal of selected images
        if ($request->filled('images_remove')) {
            foreach ($request->images_remove as $mediaId) {
                $mediaItem = $$module_name_singular->getMedia($module_name)->where('id', $mediaId)->first();
                if ($mediaItem) {
                    $mediaItem->delete();
                }
            }
        }

        // Flash success message
        flash(Str::singular($module_title) . "' Updated Successfully")->success()->important();

        // Log the user access
        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        // Redirect back to the show page of the updated record
        return redirect()->route("backend.{$module_name}.show", $$module_name_singular->id);
    }


}
