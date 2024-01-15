<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/messages.php'; ?>

<div class="grid grid-cols-12 col-span-12 mb-4 pb-10 px-8 bg-gray-100 gap-6 ">
    <div class="col-span-12 mt-8">
        <div class="grid grid-cols-12 gap-6 mt-5">
            <a class="shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white p-5" href="#">
                <div class="flex justify-end">
                    <img src="<?php echo URLROOT . '/public/upload/categorie.png' ?> " width="30" alt="">

                </div>

                <div class="ml-2 w-full flex-1">
                    <div>
                        <div class="mt-3 text-3xl font-bold ">
                            <?php echo $data['categoryCount']; ?>
                        </div>
                        <div class="mt-1 text-base text-gray-600">Total Categories</div>
                    </div>
                </div>
            </a>
            <a class="shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white p-5" href="#">
                <div class="flex justify-end">
                    <img src="<?php echo URLROOT . '/public/upload/wiki.png' ?> " width="30" alt="">

                </div>
                <div class="ml-2 w-full flex-1">
                    <div>
                        <div class="mt-3 text-3xl font-bold ">
                            <?php echo $data['wikiCount']; ?>
                        </div>
                        <div class="mt-1 text-base text-gray-600">Total wikis</div>
                    </div>
                </div>
            </a>
            <a class="shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white p-5" href="#">
                <div class="flex justify-end">
                    <img src="<?php echo URLROOT . '/public/upload/etiquette-detiquette.png' ?> " width="30" alt="">
                </div>
                <div class="ml-2 w-full flex-1">
                    <div>
                        <div class="mt-3 text-3xl font-bold ">
                            <?php echo $data['tagCount']; ?>
                        </div>
                        <div class="mt-1 text-base text-gray-600">Total tags</div>
                    </div>
                </div>
            </a>
            <a class="shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white p-5" href="#">
                <div class="flex justify-end">
                    <img src="<?php echo URLROOT . '/public/upload/users.png' ?> " width="60" alt="">

                </div>
                <div class="ml-2 w-full flex-1">
                    <div>
                        <div class="mt-3 text-3xl font-bold ">
                            <?php echo $data['userCount']; ?>
                        </div>
                        <div class="mt-1 text-base text-gray-600">Total users</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-span-12 mt-5">
        <div class="col-span-12 mt-5">
            <div class="col-span-12 mt-5">
                <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
                    <div class="bg-white shadow-lg p-4 chart-container w-full h-50">
                        <canvas id="ChartDoughnut" class="w-full h-full"></canvas>
                    </div>
                    <div class="bg-white shadow-lg p-4 chart-container w-full h-50">
                        <canvas id="chartline" class="w-full h-full"></canvas>
                    </div>
                </div>
            </div>




        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const chartDataLabels = <?php echo json_encode($data['chartData']['labels'] ?? []); ?>;
                const chartDataValues = <?php echo json_encode($data['chartData']['values'] ?? []); ?>;

                const canvas = document.getElementById('ChartDoughnut');
                if (canvas && canvas.getContext) {
                    const ctx = canvas.getContext('2d');

                    const myDoughnutChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: chartDataLabels,
                            datasets: [{
                                data: chartDataValues,
                                backgroundColor: ['#fde047', '#10b981', '#06b6d4', '#f43f5e'],
                            }]
                        },
                    });
                } else {
                    console.error("Canvas or its context is not available.");
                }

                const lineChartDataLabels = <?php echo json_encode($data['lineChartData']['labels']); ?>;
                const lineChartDataValues = <?php echo json_encode($data['lineChartData']['values']); ?>;


                function isInteger(value) {
                    return Number.isInteger(value);
                }

                const lineCanvas = document.getElementById('chartline');
                if (lineCanvas && lineCanvas.getContext) {
                    const lineCtx = lineCanvas.getContext('2d');

                    const myLineChart = new Chart(lineCtx, {
                        type: 'line',
                        data: {
                            labels: lineChartDataLabels,
                            datasets: [{
                                label: 'Number of Wikis',
                                data: lineChartDataValues,
                                borderColor: '#0284c7',
                                borderWidth: 2,
                                fill: false,
                            }],
                        },
                        options: {
                            scales: {
                                y: {
                                    ticks: {
                                        stepSize: 1, 
                                        callback: function (value) {
                                            if (Number.isInteger(value)) {
                                                return value;
                                            }
                                            return ''; 
                                        }
                                    }
                                }
                            }
                        }
                    });
                } else {
                    console.error("Line Canvas or its context is not available.");
                }
            });

        </script>
        <?php require APPROOT . '/views/inc/footer.php'; ?>