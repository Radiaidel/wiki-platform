<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/messages.php'; ?>

<div class="grid grid-cols-12 col-span-12 mb-4 pb-10 px-8 bg-gray-100 gap-6 ">
    <div class="col-span-12 mt-8">
        <div class="grid grid-cols-12 gap-6 mt-5">
            <a class="shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white p-5" href="#">
                <div class="flex justify-end">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
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
    <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
        <canvas class="bg-white shadow-lg p-4 md:w-1/2 chart-container" id="ChartDoughnut"></canvas>
        <canvas class="bg-white shadow-lg p-4 md:w-1/2 chart-container" id="chartline"></canvas>
    </div>
</div>


</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // In your main script.js file or inline in dashboard/index.php
    document.addEventListener("DOMContentLoaded", function () {
        // Fetch data from PHP
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
                        backgroundColor: ['red', 'blue', 'green', 'yellow'],
                    }]
                },
            });
        } else {
            console.error("Canvas or its context is not available.");
        }




        const lineChartDataLabels = <?php echo json_encode($data['lineChartData']['labels']); ?>;
        const lineChartDataValues = <?php echo json_encode($data['lineChartData']['values']); ?>;
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
                        borderColor: 'blue',
                        borderWidth: 2,
                        fill: false,
                    }],
                },
            });
        } else {
            console.error("Line Canvas or its context is not available.");
        }
    });

</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>