@extends('layouts.kostOwner.main')

@section('content')
<?php 
    $kosts = \App\Models\Kost::select('id')
                                ->where('kost_owner_id', Auth::user()->kostOwner->id)
                                ->where('status', 1)
                                ->get();
    $kost_id = collect([]);;
    foreach($kosts as $kost){
        $kost_id->push($kost->id);
    }

    $rooms = \App\Models\Room::select('id')
                                ->whereIn('kost_id', $kost_id)
                                ->get();

    $room_id = collect([]);;
    foreach($rooms as $room){
        $room_id->push($room->id);
    }
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-success float-right">Bulanan</span>
                    <h5>Pendapatan</h5>
                </div>
                <div class="ibox-content">
                    <?php 
                        $this_month_price = \App\Models\Rent::join('rent_details', 'rents.id', '=', 'rent_details.rent_id')
                                                    ->whereIn('rents.room_id', $room_id)
                                                    ->sum('rent_details.total_price');
                    ?>
                    <h1 class="no-margins">
                        {{Helper::rupiah($this_month_price)}}
                    </h1>
                    <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                    <small>Total pemasukan</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-info float-right">Tahunan</span>
                    <h5>Penyewaan</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">275,800</h1>
                    <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                    <small>Penyewaan kamar baru</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-info float-right">Tahunan</span>
                    <h5>Penyewa</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">106,120</h1>
                    <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                    <small>Penyewa baru</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-primary float-right">Hari ini</span>
                    <h5>Kamar disewa</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">80,600</h1>
                    <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i>
                    </div>
                    <small>Dari keseluruhan kamar</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <div>
                        <span class="float-right text-right">
                            <small>Transaksi terbanyak bulan ini terdapat pada: <strong>Kost Anma</strong></small>
                            <br />
                            Total transaksi: 162,862
                        </span>
                        <h1 class="m-b-xs">Rp. 100.468.000,00</h1>
                    </div>

                    <div>
                        <canvas id="lineChart" height="70"></canvas>
                    </div>

                    <div class="m-t-md">
                        <small class="float-right">
                            <i class="fa fa-clock-o"> </i>
                            Update on 16.07.2015
                        </small>
                        <small>
                            <strong>Analysis of sales:</strong> The value has been changed over time, and last month
                            reached a level over $50,000.
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Messages</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content ibox-heading">
                    <h3><i class="fa fa-envelope-o"></i> New messages</h3>
                    <small><i class="fa fa-tim"></i> You have 22 new messages and 16 waiting in draft
                        folder.</small>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list">

                        <div class="feed-element">
                            <div>
                                <small class="float-right text-navy">1m ago</small>
                                <strong>Monica Smith</strong>
                                <div>Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry. Lorem Ipsum</div>
                                <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div>
                                <small class="float-right">2m ago</small>
                                <strong>Jogn Angel</strong>
                                <div>There are many variations of passages of Lorem Ipsum available</div>
                                <small class="text-muted">Today 2:23 pm - 11.06.2014</small>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div>
                                <small class="float-right">5m ago</small>
                                <strong>Jesica Ocean</strong>
                                <div>Contrary to popular belief, Lorem Ipsum</div>
                                <small class="text-muted">Today 1:00 pm - 08.06.2014</small>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div>
                                <small class="float-right">5m ago</small>
                                <strong>Monica Jackson</strong>
                                <div>The generated Lorem Ipsum is therefore </div>
                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                            </div>
                        </div>


                        <div class="feed-element">
                            <div>
                                <small class="float-right">5m ago</small>
                                <strong>Anna Legend</strong>
                                <div>All the Lorem Ipsum generators on the Internet tend to repeat </div>
                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                            </div>
                        </div>
                        <div class="feed-element">
                            <div>
                                <small class="float-right">5m ago</small>
                                <strong>Damian Nowak</strong>
                                <div>The standard chunk of Lorem Ipsum used </div>
                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                            </div>
                        </div>
                        <div class="feed-element">
                            <div>
                                <small class="float-right">5m ago</small>
                                <strong>Gary Smith</strong>
                                <div>200 Latin words, combined with a handful</div>
                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">

            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>User project list</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content table-responsive">
                            <table class="table table-hover no-margins">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><small>Pending...</small></td>
                                        <td><i class="fa fa-clock-o"></i> 11:20pm</td>
                                        <td>Samantha</td>
                                        <td class="text-navy"> <i class="fa fa-level-up"></i> 24% </td>
                                    </tr>
                                    <tr>
                                        <td><span class="label label-warning">Canceled</span> </td>
                                        <td><i class="fa fa-clock-o"></i> 10:40am</td>
                                        <td>Monica</td>
                                        <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                    </tr>
                                    <tr>
                                        <td><small>Pending...</small> </td>
                                        <td><i class="fa fa-clock-o"></i> 01:30pm</td>
                                        <td>John</td>
                                        <td class="text-navy"> <i class="fa fa-level-up"></i> 54% </td>
                                    </tr>
                                    <tr>
                                        <td><small>Pending...</small> </td>
                                        <td><i class="fa fa-clock-o"></i> 02:20pm</td>
                                        <td>Agnes</td>
                                        <td class="text-navy"> <i class="fa fa-level-up"></i> 12% </td>
                                    </tr>
                                    <tr>
                                        <td><small>Pending...</small> </td>
                                        <td><i class="fa fa-clock-o"></i> 09:40pm</td>
                                        <td>Janet</td>
                                        <td class="text-navy"> <i class="fa fa-level-up"></i> 22% </td>
                                    </tr>
                                    <tr>
                                        <td><span class="label label-primary">Completed</span> </td>
                                        <td><i class="fa fa-clock-o"></i> 04:10am</td>
                                        <td>Amelia</td>
                                        <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                    </tr>
                                    <tr>
                                        <td><small>Pending...</small> </td>
                                        <td><i class="fa fa-clock-o"></i> 12:08am</td>
                                        <td>Damian</td>
                                        <td class="text-navy"> <i class="fa fa-level-up"></i> 23% </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Small todo list</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <ul class="todo-list m-t small-list">
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                                    <span class="m-l-xs todo-completed">Buy a milk</span>

                                </li>
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Go to shop and find some products.</span>

                                </li>
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Send documents to Mike</span>
                                    <small class="label label-primary"><i class="fa fa-clock-o"></i> 1
                                        mins</small>
                                </li>
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Go to the doctor dr Smith</span>
                                </li>
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                                    <span class="m-l-xs todo-completed">Plan vacation</span>
                                </li>
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Create new stuff</span>
                                </li>
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Call to Anna for dinner</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Transactions worldwide</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table table-hover margin bottom">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%" class="text-center">No.</th>
                                                <th>Transaction</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td> Security doors
                                                </td>
                                                <td class="text-center small">16 Jun 2014</td>
                                                <td class="text-center"><span class="label label-primary">$483.00</span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td> Wardrobes
                                                </td>
                                                <td class="text-center small">10 Jun 2014</td>
                                                <td class="text-center"><span class="label label-primary">$327.00</span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td> Set of tools
                                                </td>
                                                <td class="text-center small">12 Jun 2014</td>
                                                <td class="text-center"><span class="label label-warning">$125.00</span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>
                                                <td> Panoramic pictures</td>
                                                <td class="text-center small">22 Jun 2013</td>
                                                <td class="text-center"><span class="label label-primary">$344.00</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">5</td>
                                                <td>Phones</td>
                                                <td class="text-center small">24 Jun 2013</td>
                                                <td class="text-center"><span class="label label-primary">$235.00</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">6</td>
                                                <td>Monitors</td>
                                                <td class="text-center small">26 Jun 2013</td>
                                                <td class="text-center"><span class="label label-primary">$100.00</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <div id="world-map" style="height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>
</div>
@endsection

@section('script')
<!-- ChartJS-->
<script src="{{ asset('templates/js/plugins/chartJs/Chart.min.js') }}"></script>
<script>
    $(document).ready(function () {

        var lineData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                    label: "Example dataset",
                    backgroundColor: "rgba(26,179,148,0.5)",
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label: "Example dataset",
                    backgroundColor: "rgba(220,220,220,0.5)",
                    borderColor: "rgba(220,220,220,1)",
                    pointBackgroundColor: "rgba(220,220,220,1)",
                    pointBorderColor: "#fff",
                    data: [65, 59, 80, 81, 56, 55, 40]
                }
            ]
        };

        var lineOptions = {
            responsive: true
        };


        var ctx = document.getElementById("lineChart").getContext("2d");
        new Chart(ctx, {
            type: 'line',
            data: lineData,
            options: lineOptions
        });

    });

</script>
@endsection
