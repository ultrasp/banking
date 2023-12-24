<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Highcharts library -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- Highcharts exporting module -->
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <!-- Highcharts exporting offline module (optional) -->
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Task</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <h5 class="card-title">Upload </h5>
                <form id="file-upload-form" action="/?upload" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Example file input</label>
                        <input type="file" class="form-control-file" name="fileInput" id="fileInput">
                    </div>
                    <div id="dropzone" class="dropzone"></div>
                </form>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Current FX rates</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Value in CHF</h6>
                        <table class="table rate-table">
                            <thead>
                                <tr>
                                    <th scope="col">Currency</th>
                                    <th scope="col">FX Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="d-none">
                                    <th class="symbol"></th>
                                    <td class="rate"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List of bank accounts</h5>

                        <table id="accountsTable" class="table">
                            <thead>
                                <tr>
                                    <th>Account</th>
                                    <th>Symbol</th>
                                    <th>Start Balance</th>
                                    <th>End Balance</th>
                                    <th>End Balance (CHF)</th>
                                    <!-- Add more columns as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table rows will be populated dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <!-- Chart container -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cash forecast</h5>
                        <div id="lineChartContainer"></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transactions</h5>

                        <table id="transactionsTable" class="table">
                            <thead>
                                <tr>
                                    <th>Account</th>
                                    <th>Transacion No</th>
                                    <th>Amount</th>
                                    <th>Currency</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
        <!-- Content here -->
    </div>

    <!-- Your JavaScript to create the Highcharts chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

    <!-- Dropzone.js CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.css">
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.js"></script>


    <!-- DataTables CSS and JS -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet">
    <link href="/Editor-2.2.2/css/editor.dataTables.min.css" rel="stylesheet" type="text/css">

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>

    <!-- DataTables Editor CSS and JS -->
    <script type="text/javascript" charset="utf8" src="/Editor-2.2.2/js/dataTables.editor.min.js"></script>

    <!-- DataTables Editor Inline JS -->
    <!-- <script type="text/javascript" charset="utf8"
        src="https://editor.datatables.net/extensions/Inline/js/dataTables.editor.inline.js"></script> -->
    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(function () {
            const BASE_CURRENCY = 'CHF';
            let rates = [];

            // Create Highcharts line chart
            var chart = Highcharts.chart('lineChartContainer', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: '' // Set the title text to an empty string
                },
                xAxis: {
                    type: 'datetime',
                    tickInterval: 24 * 3600 * 1000, // Set tick interval to 1 day
                    dateTimeLabelFormats: {
                        day: '%Y-%m-%d' // Define the date format to match your data
                    },
                    title: {
                        text: ''
                    }
                },
                yAxis: {
                    title: {
                        text: ''
                    }
                },
                series: []
            });


            var myDropzone = new Dropzone("#dropzone", {
                url: "?upload", // Specify the upload URL
                autoProcessQueue: true, // Do not process the queue automatically
                paramName: "fileInput", // Name of the file input field
                maxFiles: 1, // Maximum number of files
                maxFilesize: 5, // Maximum file size in MB
                acceptedFiles: ".csv", // Allowed file types
            });

            $('#fileInput').on('change', function () {
                var formData = new FormData($('#file-upload-form')[0]);

                // Make an Ajax request
                $.ajax({
                    type: 'POST',
                    url: $('#file-upload-form').attr('action'),
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting the content type
                    success: function (response) {
                        // afterFileUploaded();
                        // Handle the success response
                        afterFileUploaded();
                    },
                    error: function (error) {
                        // Handle the error response
                        console.error('Error submitting form:', error);
                    }
                });
            })

            function afterFileUploaded() {
                alert('Data uploaded');
                location.reload();
            }

            myDropzone.on("success", function (file, response) {
                afterFileUploaded();
            });


            // Submit form on button click
            // $("#file-upload-form").submit(function (e) {
            //     e.preventDefault();
            //     myDropzone.processQueue(); // Process the queued files
            // });


            function loadGraphics() {
                $.ajax({
                    url: "?graphic",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function (res) {
                        updateChartSeries(res);
                    }
                });
            }

            function loadRates(afterRateLoaded = null) {
                $.ajax({
                    url: "?loadCurrencies",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function (res) {
                        rates = res;
                        fillRateTable(res);
                        if (afterRateLoaded) {
                            afterRateLoaded();
                        }
                    }
                });
            }

            function fillRateTable(rates) {
                $('.rate-table tbody rate-row').remove();
                rates.forEach(rate => {
                    let newRow = $('.rate-table').find('tr.d-none').clone();
                    newRow.addClass('rate-row').removeClass('d-none');
                    newRow.find('.symbol').html(rate.symbol);
                    newRow.find('.rate').html(rate.rate);
                    $('.rate-table tbody').append(newRow);
                })
            }

            const editor = new $.fn.dataTable.Editor({
                ajax: '?post-param=account',
                table: "#accountsTable",
                idSrc: "id",
                fields: [
                    // Define your fields here
                    {
                        label: "Account:",
                        name: "account",
                    },
                    {
                        label: "Start Balance:",
                        name: "start_balance",
                        attr: { type: 'number' }
                    },
                ]
            });


            function loadAccountsTable() {
                const table = $('#accountsTable').DataTable({
                    dom: 'lrtip',
                    ajax: '?accounts',
                    columns: [
                        // Define your columns here
                        { data: 'account', className: 'editable' },
                        { data: 'symbol' },
                        { data: 'start_balance', className: 'editable' },
                        // { data: 'start_balance' },
                        {
                            data: 'end_balance',
                            render: function (data, type, row) {
                                return parseFloat(row.start_balance) + parseFloat(row.end_balance);
                            }
                        },
                        {
                            data: 'end_balance',
                            render: function (data, type, row) {
                                let total = parseFloat(row.start_balance) + parseFloat(row.end_balance);
                                return BASE_CURRENCY == row.symbol ? total : (total * (rates.find(v => v.symbol == row.symbol)?.rate || 0)).toFixed(2);
                            }
                        }
                    ],
                    select: true,
                    paging: false,
                    bFilter: false,
                });

                table.on('click', 'tbody td.editable', function (e) {
                    editor.inline(this, { onBlur: 'submit' });
                });
            }

            function loadData() {
                const afterRateLoaded = () => {
                    loadAccountsTable();
                }

                loadRates(afterRateLoaded);
                loadGraphics();
                loadTransactionTable();
            }

            loadData();



            function reloadTables() {
                $('#accountsTable').DataTable().ajax.reload();
                loadGraphics();
            }

            function formatData(data) {
                return data.map(function (dataPoint) {
                    // Assuming dataPoint.date is in 'Y-m-d' format
                    var dateComponents = dataPoint[0].split('-');
                    var jsDate = Date.UTC(dateComponents[0], dateComponents[1] - 1, dateComponents[2]);

                    return [jsDate, dataPoint[1]];
                });
            }

            function updateChartSeries(updatedSeriesData) {
                while (chart.series.length > 0)
                    chart.series[0].remove(true);

                updatedSeriesData.forEach(function (updatedSeries) {
                    // Check if the series exists in the chart
                    var existingSeries = chart.get(updatedSeries.name);
                    updatedSeries.data = formatData(updatedSeries.data);
                    if (existingSeries) {
                        // If the series exists, update its data
                        existingSeries.setData(updatedSeries.data, true);
                    } else {
                        // If the series does not exist, add a new series
                        chart.addSeries(updatedSeries, true);
                    }
                });

            }


            const transactionEditor = new $.fn.dataTable.Editor({
                ajax: '?post-param=transaction',
                table: "#transactionsTable",
                idSrc: "id",
                fields: [
                    // Define your fields here
                    {
                        label: "Transaction no:",
                        name: "transaction_no",
                    },
                    {
                        label: "Amount:",
                        name: "amount",
                        attr: { type: 'number' }
                    },
                    {
                        label: "Operation Date:",
                        name: "operation_date",
                        attr: {
                            type: 'datetime-local'
                        },
                    },
                ]
            });

            function loadTransactionTable() {
                const table = $('#transactionsTable').DataTable({
                    dom: 'Bfrtip',
                    serverSide: true,
                    ajax: '?transactions',
                    columns: [
                        // Define your columns here
                        { data: 'account', },
                        { data: 'transaction_no', className: 'editable' },
                        { data: 'amount', className: 'editable' },
                        { data: 'symbol' },
                        { data: 'operation_date', className: 'editable' },
                        {
                            // Add a delete button
                            data: null,
                            className: 'editor-delete',
                            defaultContent: '<button class="delete-btn">Delete</button>',
                        }

                    ],
                    select: true,
                    paging: true,
                    bFilter: false,
                    pageLength: 10, // Number of rows per page
                    buttons: [
                        {
                            text: 'Excel',
                            action: function (e, dt, node, config) {
                                window.open("/?export-excel", "_blank");
                            }
                        },
                        {
                            text: 'Pdf',
                            action: function (e, dt, node, config) {
                                window.open("/?export-pdf", "_blank");
                            }
                        },
                    ]
                });

                table.on('click', 'tbody td.editable', function (e) {
                    transactionEditor.inline(this, { onBlur: 'submit' });
                });

                table.on('click', 'td.editor-delete', function (e) {
                    e.preventDefault();

                    transactionEditor.remove(e.target.closest('tr'), {
                        title: 'Delete record',
                        message: 'Are you sure you wish to remove this record?',
                        buttons: 'Delete'
                    });
                });
            }

            transactionEditor.on('remove', function () {
                reloadTables();
            })


        })
    </script>
</body>

</html>