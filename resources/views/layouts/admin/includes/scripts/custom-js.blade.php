<script>
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    function fetch_data(page) {
        $('#loader').show();
        $.ajax({
            url: "{{url('admin/users/fetch-data')}}" + "?page=" + page,
            success: function (data) {
                $('#data-container').html(data);
                $('#loader').hide();
            },
            error: function () {
                $('#loader').hide();
            }
        });
    }
</script>

<script>
    var oTable;

    function showConfirmationAlert(elem) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Here you can handle what happens when the user confirms.

                callAjax(
                    $(elem).attr('data-href'),   // URL
                    $(elem).attr('data-method'),           // Method
                    {key: 'value'}, // Data
                    function (response) { // Success callback
                        Swal.fire(
                            'Deleted!',
                            'Your Record has been deleted.',
                            'success'
                        );
                        oTable.ajax.reload()
                    },
                    function (error) { // Error callback
                        Swal.fire(
                            'Warning!',
                            error,
                            'error'
                        );

                    },
                    function () { // Before send callback

                    }
                );


                // For instance, you could call a function here to handle the actual deletion.
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Handle the case when the user cancels the action
                Swal.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        });
    }

    // Function to initialize DataTables with ES6 features
    const initializeDataTable = (selector, url, columns, includeSwitchery = false , extraOptions = {}) => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const defaultOptions = {
            ajax: {
                url,
                type: 'POST'
            },
            columns,
            aLengthMenu: [
                [10, 30, 50, -1],
                [10, 30, 50, "All"]
            ],
            iDisplayLength: 10,
            language: {
                search: ""
            },
            processing: true,  // Enable the processing indicator
            serverSide: true,  // Enable server-side processing
        };

        const finalOptions = {...defaultOptions, ...extraOptions};
        oTable = $(selector).DataTable(finalOptions);

        if (includeSwitchery) {
            initializeSwitchery(oTable);
        }
    };

    const initializeSwitchery = dataTable => {
        dataTable.on('draw', function () {
            const elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            elems.forEach(elem => {
                if (!elem.switchery) {
                    new Switchery(elem);
                }
            });
        });
    };

    const switheryChange = (elem) => {
        var isChecked = $(elem).prop('checked');
        var checked = "active";
        if (isChecked) {

        } else {
            checked = "inactive"
        }
        callAjax(
            $(elem).attr('data-href'),   // URL
            $(elem).attr('data-method'),           // Method
            {id: $(elem).attr('data-id'), 'status': checked}, // Data
            function (response) { // Success callback
                Swal.fire(
                    'Updated!',
                    'Your Record has been updated.',
                    'success'
                );
                oTable.ajax.reload()
            },
            function (error) { // Error callback
                Swal.fire(
                    'Warning!',
                    error,
                    'error'
                );

            },
            function () { // Before send callback

            }
        );
    }

    const callAjax = (url, method, data, successCallback, errorCallback, beforeSendCallback) => {
        console.log(url , method)
        if(method == "DELETE"){
            data._method = "DELETE"
            method = "POST";
        }
        $.ajax({
            url: url,
            type: method,
            data: data,
            beforeSend: function() {
                if (typeof beforeSendCallback === 'function') {
                    beforeSendCallback();
                }
            },
            success: function(response, textStatus, jqXHR) {
                if (typeof successCallback === 'function') {
                    successCallback(response, textStatus, jqXHR);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (typeof errorCallback === 'function') {
                    errorCallback(jqXHR, textStatus, errorThrown);
                }
            }
        });
    };

    $(function() {
        'use strict';

        $('#formvalidation').validate({
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");

                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                    error.insertAfter(element.parent().parent());
                } else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                    error.appendTo(element.parent().parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            rules: {
                description: {
                    ckeditorRequired: true
                }
            }
        });
    });

</script>
