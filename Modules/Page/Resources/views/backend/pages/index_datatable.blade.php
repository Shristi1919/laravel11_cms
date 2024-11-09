@extends("backend.layouts.app")

@section("title")
    {{ __($module_action) }} {{ __($module_title) }}
@endsection

@section("breadcrumbs")
    <x-backend.breadcrumbs>
        <x-backend.breadcrumb-item type="active" icon="{{ $module_icon }}">
            {{ __($module_title) }}
        </x-backend.breadcrumb-item>
    </x-backend.breadcrumbs>
@endsection

@section("content")
    <div class="card">
        <div class="card-body">
            <x-backend.section-header
                :module_name="$module_name"
                :module_title="$module_title"
                :module_icon="$module_icon"
                :module_action="$module_action"
            />

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table-bordered table-hover table" id="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                        @lang("page::text.name")
                                    </th>
                                    <th>
                                        @lang("page::text.updated_at")
                                    </th>
                                    <th class="text-end">
                                        @lang("page::text.action")
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="data-table-body">
                                <!-- Data will be injected here by JavaScript -->
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-7">
                    <div class="float-left"></div>
                </div>
                <div class="col-5">
                    <div class="float-end"></div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push("after-scripts")

    <script type="module">
        // Function to fetch and render data
        async function fetchData() {
            try {
                const response = await fetch('{{ route("api.pages") }}');
                const result = await response.json();

                if (result.status === 'success') {
                    renderTable(result.data);
                } else {
                    console.error("Error fetching data");
                }
            } catch (error) {
                console.error("An error occurred:", error);
            }
        }

        // Function to render data into a table
        function renderTable(data) {
            const tableBody = document.querySelector('#data-table-body');
            tableBody.innerHTML = ''; // Clear previous data

             // Base edit route URL with a placeholder for ID
             const editUrlTemplate = '{{ route("backend.$module_name.edit", ":id") }}';
             const showUrlTemplate = '{{ route("backend.$module_name.show", ":id") }}';


            data.forEach(row => {
                // Replace ":id" in the URL with the actual ID
                const editUrl = editUrlTemplate.replace(':id', row.id);
                const showUrl = showUrlTemplate.replace(':id', row.id);


                const tableRow = `
                    <tr>
                        <td>${row.id}</td>
                        <td>${row.name}</td>
                        <td>${row.updated_at}</td>
                        <td>
                            <!-- Define any actions you want here, such as edit or delete buttons -->
                            <a href="${editUrl}" small="true">Edit</a> ||
                            <a href="${showUrl}" small="true">Show</a>
                        </td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', tableRow);
            });
        }

        // Call fetchData on page load
        document.addEventListener('DOMContentLoaded', fetchData);
    </script>

@endpush
