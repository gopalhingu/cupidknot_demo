@extends('layouts.layout')
<style type="text/css">
body {
  background: #f7f7f7;
}

.table {
  border-spacing: 0 0.85rem !important;
}

.table .dropdown {
  display: inline-block;
}

.table td,
.table th {
  vertical-align: middle;
  margin-bottom: 10px;
  border: none;
}

.table thead tr,
.table thead th {
  border: none;
  font-size: 12px;
  letter-spacing: 1px;
  text-transform: uppercase;
  background: transparent;
}

.table td {
  background: #fff;
}

.table td:first-child {
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
}

.table td:last-child {
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
}

.avatar {
  width: 2.75rem;
  height: 2.75rem;
  line-height: 3rem;
  border-radius: 50%;
  display: inline-block;
  background: transparent;
  position: relative;
  text-align: center;
  color: #868e96;
  font-weight: 700;
  vertical-align: bottom;
  font-size: 1rem;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.avatar-sm {
  width: 2.5rem;
  height: 2.5rem;
  font-size: 0.83333rem;
  line-height: 1.5;
}

.avatar-img {
  width: 100%;
  height: 100%;
  -o-object-fit: cover;
  object-fit: cover;
}

.avatar-blue {
  background-color: #c8d9f1;
  color: #467fcf;
}

table.dataTable.dtr-inline.collapsed
  > tbody
  > tr[role="row"]
  > td:first-child:before,
table.dataTable.dtr-inline.collapsed
  > tbody
  > tr[role="row"]
  > th:first-child:before {
  top: 28px;
  left: 14px;
  border: none;
  box-shadow: none;
}

table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > td:first-child,
table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > th:first-child {
  padding-left: 48px;
}

table.dataTable > tbody > tr.child ul.dtr-details {
  width: 100%;
}

table.dataTable > tbody > tr.child span.dtr-title {
  min-width: 50%;
}

table.dataTable.dtr-inline.collapsed > tbody > tr > td.child,
table.dataTable.dtr-inline.collapsed > tbody > tr > th.child,
table.dataTable.dtr-inline.collapsed > tbody > tr > td.dataTables_empty {
  padding: 0.75rem 1rem 0.125rem;
}

div.dataTables_wrapper div.dataTables_length label,
div.dataTables_wrapper div.dataTables_filter label {
  margin-bottom: 0;
}

@media (max-width: 767px) {
  div.dataTables_wrapper div.dataTables_paginate ul.pagination {
    -ms-flex-pack: center !important;
    justify-content: center !important;
    margin-top: 1rem;
  }
}

.btn-icon {
  background: #fff;
}
.btn-icon .bx {
  font-size: 20px;
}

.btn .bx {
  vertical-align: middle;
  font-size: 20px;
}

.dropdown-menu {
  padding: 0.25rem 0;
}

.dropdown-item {
  padding: 0.5rem 1rem;
}

.badge {
  padding: 0.5em 0.75em;
}

.badge-success-alt {
  background-color: #d7f2c2;
  color: #7bd235;
}

.table a {
  color: #212529;
}

.table a:hover,
.table a:focus {
  text-decoration: none;
}

table.dataTable {
  margin-top: 12px !important;
}

.icon > .bx {
  display: block;
  min-width: 1.5em;
  min-height: 1.5em;
  text-align: center;
  font-size: 1.0625rem;
}

.btn {
  font-size: 0.9375rem;
  font-weight: 500;
  padding: 0.5rem 0.75rem;
}

.avatar-blue {
      background-color: #c8d9f1;
      color: #467fcf;
    }

    .avatar-pink {
      background-color: #fcd3e1;
      color: #f66d9b;
    }

</style>
@section('content')
    <div class="container">
        <h4>Filters</h4>
        <div class="row">
            
            <div class="col-sm-3 mb-3">
                <select class="form-control" name="gender"
                        id="gender">
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="col-sm-3 mb-3">
                <select class="form-control" name="family_type"
                        id="family_type">
                    <option value="">Select family type</option>
                    <option value="1">Joint family</option>
                    <option value="2">Nuclear family</option>
                </select>
            </div>
            <div class="col-sm-3 mb-3">
                <select class="form-control" name="manglik" id="manglik">
                    <option value="">Select manglik</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>

            </div>
            <div class="col-sm-3 mb-3">
                    <input type="text" id="amount" name="preferred_income" readonly
                           style="border:0; color:#f6931f; font-weight:bold;">
                    <div id="slider-range"></div>
             
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover responsive nowrap" id="userslist">
                <thead class="utm-thead">
                <tr>
                    <th>#ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Income</th>
                    <th>Family Type</th>
                    <th>Manglik</th>
                </tr>
                
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 500,
            values: [50, 100],
            slide: function (event, ui) {
                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
            }
        });
        $("#amount").val($("#slider-range").slider("values", 0) +
            " - " + $("#slider-range").slider("values", 1));

        $(function () {
            var url = '{{asset('/admin/users')}}';
            var family_type = '';
            var manglik = '';
            var income_from = 0;
            var income_to = 0;
            var gender = '';
            var table = $('#userslist').DataTable({
                bProcessing: true,
                ordering: true,
                serverSide: true,
                paging: true,
                bRetrieve: true,
                autoWidth: false,
                ajax: {
                    url: url,
                    "type": "POST",
                    data: function (d) {
                        d.gender = gender;
                        d.family_type = family_type;
                        d.manglik = manglik;
                        d.income_from = income_from;
                        d.income_to = income_to;
                    }
                },
                aaSorting: [[0, 'asc']],
                columns: [
                    {"visible": false, data: "id"},
                    {
                        "sortable": true,
                        "name": 'first_name',
                        data: 'first_name'
                    },
                    {
                        "sortable": true,
                        "name": 'last_name',
                        data: 'last_name'
                    },
                    {
                        "sortable": true,
                        "name": 'gender',
                        data: 'gender'
                    },
                    {
                        "sortable": true,
                        "name": 'dob',
                        data: 'dob'
                    },
                    {
                        "sortable": true,
                        "name": 'income',
                        data: 'income'
                    },
                    {
                        "sortable": true,
                        "name": 'family_type',
                        "render": function (data, type, row) {
                            return row['family_type'] == 1 ? "Joint family" : "Nuclear family"
                        }
                    },
                    {
                        "sortable": true,
                        "name": 'manglik',
                        data: 'manglik'
                    },
                ],
                initComplete: function () {
                    $('#gender').change(function () {
                        gender = $(this).val();
                        $('#userslist').DataTable().ajax.reload();
                    });
                    $('#family_type').change(function () {
                        family_type = $(this).val();
                        $('#users-table').DataTable().ajax.reload();
                    });
                    $('#manglik').change(function () {
                        manglik = $(this).val();
                        $('#userslist').DataTable().ajax.reload();
                    });

                    $("#slider-range").slider({
                        range: true,
                        min: 0,
                        max: 500,
                        values: [50, 100],
                        slide: function (event, ui) {
                            $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                        },
                        stop: function (event, ui){
                            income_from = ui.values[0];
                            income_to = ui.values[1];
                            $('#userslist').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection
