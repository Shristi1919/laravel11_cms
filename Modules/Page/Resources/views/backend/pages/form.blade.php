<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "name";
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "required";
            ?>

            {{ html()->label($field_lable, $field_name)->class("form-label") }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "slug";
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>

            {{ html()->label($field_lable, $field_name)->class("form-label") }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "group_name";
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>

            {{ html()->label($field_lable, $field_name)->class("form-label") }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-8">
        <div class="form-group">
            <?php
            $field_name = "image";
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>

            {{ html()->label($field_lable, $field_name)->class("form-label") }} {!! field_required($required) !!}
            {{ html()->input("file", $field_name)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
    @if (isset($$module_name_singular) && $$module_name_singular->getMedia($module_name)->first())
        <div class="col-4">
            <div class="float-end">
                <figure class="figure">
                    <a
                        href="{{ asset($$module_name_singular->$field_name) }}"
                        data-lightbox="image-set"
                        data-title="Path: {{ asset($$module_name_singular->$field_name) }}"
                    >
                        <img
                            src="{{ asset($$module_name_singular->getMedia($module_name)->first()->getUrl("thumb300"),) }}"
                            class="figure-img img-fluid img-thumbnail rounded"
                            alt=""
                        />
                    </a>
                    <!-- <figcaption class="figure-caption">Path: </figcaption> -->
                </figure>
            </div>
        </div>
        <x-library.lightbox />
    @endif
</div>

<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = "description";
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>

            {{ html()->label($field_lable, $field_name)->class("form-label") }} {!! field_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
</div>

<hr />

<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "meta_title";
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>

            {{ html()->label($field_lable, $field_name)->class("form-label") }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "meta_keyword";
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>

            {{ html()->label($field_lable, $field_name)->class("form-label") }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "meta_description";
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>

            {{ html()->label($field_lable, $field_name)->class("form-label") }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class("form-control")->attributes(["$required"]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = "status";
            $field_lable = label_case($field_name);
            $field_placeholder = "-- Select an option --";
            $required = "required";
            $select_options = \Modules\Page\Enums\PageStatus::toArray();
            ?>

            {{ html()->label($field_lable, $field_name)->class("form-label") }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->class("form-select")->attributes(["$required"]) }}
        </div>
    </div>
</div>
@push("after-styles")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet" />
    <style>
        .note-editor.note-frame :after {
            display: none;
        }

        .note-editor .note-toolbar .note-dropdown-menu,
        .note-popover .popover-content .note-dropdown-menu {
            min-width: 180px;
        }
    </style>
@endpush
@push("after-scripts")
    <script
        type="module"
        src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"
    ></script>
    <script type="module">
  var lfm = function (options, cb) {
            var route_prefix = options && options.prefix ? options.prefix : '/laravel-filemanager';
            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = cb;
        };

        // Define LFM summernote button
        var LFMButton = function (context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="note-icon-picture"></i> ',
                tooltip: 'Insert image with filemanager',
                click: function () {
                    lfm(
                        {
                            type: 'image',
                            prefix: '/laravel-filemanager',
                        },
                        function (lfmItems, path) {
                            lfmItems.forEach(function (lfmItem) {
                                context.invoke('insertImage', lfmItem.url);
                            });
                        },
                    );
                },
            });
            return button.render();
        };


        $('#description').summernote({
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['fontname', 'fontsize', 'bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'lfm', 'video']],
                ['view', ['codeview', 'undo', 'redo', 'help']],
            ],
            buttons: {
                lfm: LFMButton,
            },
        });
    </script>


@endpush
