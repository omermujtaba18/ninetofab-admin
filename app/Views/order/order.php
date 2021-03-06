<?php

$status = [
    'Pending' => '<div onload="sound()" class="badge badge-warning p-2 badge-pill">Pending</div>',
    'Confirmed' => '<div class="badge badge-secondary p-2 badge-pill">Confirmed</div>',
    'Ready' => '<div class="badge badge-primary p-2 badge-pill">Ready</div>',
    'Delivered' => '<div class="badge badge-success p-2 badge-pill">Delivered</div>',
    'Cancelled' => '<div class="badge badge-danger p-2 badge-pill">Cancelled</div>'
]

?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<div id="layoutSidenav_content">
    <main>

        <!-- <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
            <i class="fa fa-calendar"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down"></i>
        </div> -->

        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0"><?= esc(ucfirst($title)); ?></h1>
                    <div class="small"><span class="font-weight-500 text-primary text-right"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>

                <span id="start" style="display: none;"><?= $start ?></span>
                <span id="end" style="display: none;"><?= $end ?></span>

                <div class="dropdown">
                    <a class="btn btn-white btn-sm font-weight-500 line-height-normal p-3 dropdown-toggle" id="dateRangeSelector" href="#" role="button" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                        <i class="text-primary mr-2" data-feather="calendar"></i><span><span></a>
                </div>

            </div>

            <div class="row">
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-top-0 border-bottom-0 border-right-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small font-weight-bold text-dark mb-1">Total Orders</div>
                                    <div class="h1"> <?= $countOrders; ?> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-top-0 border-bottom-0 border-right-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small font-weight-bold text-yellow mb-1">Pending</div>
                                    <div class="h1"> <?= $pending; ?> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-top-0 border-bottom-0 border-right-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small font-weight-bold text-purple mb-1">Confirmed</div>
                                    <div class="h1"> <?= $confirmed; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-top-0 border-bottom-0 border-right-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small font-weight-bold text-blue mb-1">Ready</div>
                                    <div class="h1"><?= $ready; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-top-0 border-bottom-0 border-right-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small font-weight-bold text-green mb-1">Delivered</div>
                                    <div class="h1"><?= $delivered; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card border-top-0 border-bottom-0 border-right-0  h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small font-weight-bold text-red mb-1">Cancelled</div>
                                    <div class="h1"><?= $cancelled; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header"><?= esc(ucfirst($title)); ?>
                        </div>
                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTableOrder" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order#</th>
                                            <th>Customer Name</th>
                                            <th>Placed At</th>
                                            <th>Deliver At</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($orders)) : ?>

                                            <?php foreach ($orders as $order) :
                                                $placed_at = new DateTime($order->placed_at);
                                                $deliver_at = new DateTime($order->deliver_at);
                                            ?>
                                                <tr>
                                                    <td><?= esc($order->order_num); ?></td>
                                                    <td><?= esc($order->cus_name); ?></td>
                                                    <td><?= esc($placed_at->format('h:i A')); ?></td>
                                                    <td><?= esc($deliver_at->format('h:i A')); ?></td>
                                                    <td><?= esc("$" . $order->order_total); ?></td>
                                                    <td>


                                                        <?= $status[$order->order_status]; ?>

                                                        <?php if ($order->order_status == 'Pending') : ?>

                                                            <div id="sound"></div>


                                                        <?php endif; ?>

                                                        <!--<audio id="foobar" src="/assets/notification.mp3" preload="auto" autoplay> -->

                                                    </td>
                                                    <td>

                                                        <a class="btn btn-icon btn-sm btn-yellow ml-2 text-white" href="/order/view/<?= esc($order->order_num); ?>?rest_id=<?= $rest_id; ?>">
                                                            <i data-feather="eye"></i></a>

                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>

<script>
    function play1() {
        /* Audio link for notification */
        var mp3 = '<source src="/assets/notification_alert.mp3" type="audio/mpeg">';
        document.getElementById("sound").innerHTML =
            '<audio autoplay="autoplay">' + mp3 + "</audio>";
    }
    play1();
</script>


<script type="text/javascript">
    $(function() {
        var start = moment($('#start').text(), 'YYYY-MM-DD')
        var end = moment($('#end').text(), 'YYYY-MM-DD')

        function cb(start, end) {
            $('#dateRangeSelector span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#dateRangeSelector').daterangepicker({
            startDate: start,
            endDate: end,
            "opens": "left",
            "showDropdowns": true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
            }
        }, cb);

        cb(start, end);

        $('#dateRangeSelector').on('apply.daterangepicker', function(ev, picker) {
            let url = new URL(window.location.href);
            url.searchParams.set('start', picker.startDate.format('YYYY-MM-DD'));
            url.searchParams.set('end', picker.endDate.format('YYYY-MM-DD'))
            window.open(url.href, '_self');
        });
    });
</script>