<!DOCTYPE html>
<html>
    <head>
        <title>Portal</title>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{url("assets/css/custom.css")}}">
    </head>
    <body>
        <div class="container">
            <table id="data-table" class="display">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Task</th>
                    <th>Description</th>
                    <th>ColorCode</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{$item->task}}</td>
                        <td>{{$item->description}}</td>
                        <td style="color: {{$item->colorCode}}">{{$item->colorCode}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div id="modal">
                <div class="d-flex justify-content-center mt-4">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#image-selector">
                            Choose Image
                        </button>
                </div>

                <!-- Modal -->
                <div class="modal fade text-left" id="image-selector" tabindex="-1" role="dialog" aria-labelledby="imageSelector" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="imageSelector">Image selector</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="font-italic">Please choose an image from your device.</p>
                                    </div>

                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image-upload" accept="image/*">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <div class="d-flex justify-content-center mt-4">
                                                    <img class="mt-3" id="preview-image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function() {

                //DataTable
                $('#data-table thead tr')
                    .clone(true)
                    .addClass('filters')
                    .appendTo('#data-table thead');

                $('#data-table').DataTable({
                    orderCellsTop: true,
                    fixedHeader: true,
                    initComplete: function () {
                        var api = this.api();
                    api.columns().eq(0)
                        .each(function (colIdx) {
                            if(colIdx !== 9 && colIdx !== 7){
                                var cell = $('.filters th').eq(
                                    $(api.column(colIdx).header()).index()
                                );
                                var title = $(cell).text();
                                $(cell).html('<input type="text" class="form-control form-control-sm" placeholder="' + title + '" />');
                            }
                            $(".filters .no_filter").text("")

                            $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                                .off('keyup change')
                                .on('change', function (e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})';
                                    var cursorPosition = this.selectionStart;

                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != ''
                                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                : '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function (e) {
                                    e.stopPropagation();
                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        })
                    },
                    "pageLength": 7,
                    "lengthChange": false,
                });

                //Refresh data every 60 minutes
                setInterval(function() {
                    $.get("{{route('refreshData')}}", function(data) {
                        $('#data-table tbody').html(data);
                    });
                }, 3600000);

                //Select & display an image
                $('#image-upload').change(function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#preview-image').attr('src', e.target.result);
                        $('#image-preview-modal').show();
                    };
                    reader.readAsDataURL(file);
                });

                $('#image-preview-modal').click(function() {
                    $(this).hide();
                });
            });
        </script>
    </body>
</html>
