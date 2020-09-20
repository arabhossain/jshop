@extends('layout')

@push('head')
    <style>
        .btn-details {
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Client List</div>
                <div class="card-body">
                    <form action="{{url('/')}}" class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                   value="{{request()->search ?request()->search : '' }}" name="search"
                                   placeholder="Search...">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Shop Name</th>
                                <th>Total Sales Items</th>
                                <th>Details</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($shops as $item)
                                <tr>
                                    <td>{{$item->shop_name}}</td>
                                    <td>{{$item->total}}</td>
                                    <td><i data-shop="{{$item->id}}" class="fa fa-arrow-down btn-details"></i></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('toScript')
    <script>

        $('body').on('click', '.btn-details', function (e) {
            e.preventDefault();

            if ($('.details-pop').length > 0)
                $('.details-pop').remove();

            if (!$(this).hasClass('fa-arrow-down')) {
                $(this).toggleClass('fa-arrow-up fa-arrow-down');
                return;
            }

            fetch(`/sale-details`, {
                method: 'POST',
                ...GLOBAL.HEADER_REQUEST,
                body: JSON.stringify({shop: $(this).attr('data-shop')})
            })
                .then(rs => rs.json())
                .then(rs => {
                    const thisTr = $(this).closest('tr');
                    $(this).toggleClass('fa-arrow-up fa-arrow-down');
                    if (rs.rows !== undefined)
                        thisTr.after(generateSubTable(rs.rows))

                })
        });

        function generateSubTable(rows) {
            let html = `<tr class="details-pop"><td colspan="3"><table class="table table-dark">
                    <tr>
                        <td> Product Name <td>
                        <td> Product Category <td>
                        <td> No of Sale <td>
                        <td> Total Price <td>
                    </tr>`;

            for (const row of rows) {
                html += `<tr>
                        <td>${row['product']}<td>
                        <td>${row['Category']}<td>
                        <td>${row['sale_count']}<td>
                        <td>${row['total_price']}<td>
                    </tr>`
            }

            html += `</table><td><tr>`
            return html
        }
    </script>
@endpush
