<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your App Name</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="antialiased">
    <section class="py-5">
        <div class="container">
            <div class="container">
                <h1 class="mb-4">Problem #1 : Cumulative Sum of Array Elements</h1>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">
                            This PHP code defines an array and a function, calcCumulativeSum, which iteratively computes
                            cumulative sums and removes the first array element until none remain. The output displays
                            cumulative sums in reverse order from the total to individual elements.
                        </p>
                    </div>
                </div>

                <iframe class="mt-4" src="https://pastecode.dev/iframe/mR059TxM?theme=light"
                    style="border:none; width:100%; height: 400px;"></iframe>

                <div class="container d-flex justify-content-center align-items-center flex-column">
                    <h3 class="mt-3">Output</h3>
                    <hr>
                    <p>Array Given : [0, 1, 3, 6, 10]</p>
                    <div>
                        @php
                            /**
                             * Given list.
                             */
                            $arr = [0, 1, 3, 6, 10];

                            /**
                             * @param array $array
                             * 
                             * @return array $result
                             */
                            function calcCumulatliveSum(array $array): array
                            {
                            for($i = count($array); $i >= 0; $i--)
                            {
                                    $result[] = array_sum($array);
                                    array_shift($array);  
                            }
                            return $result;
                            }

                            echo "<pre>";
                            print_r(calcCumulatliveSum($arr));
                            echo "</pre>";
                        @endphp
                    </div>
                </div>

                <div class="mt-4">
                    <p class="mb-0"></p>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class="py-5">
        <div class="container">
            <div class="container">
                <h1 class="mb-4">Problem #2 : Bottle Collector</h1>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">
                            This PHP script manages expedition finances, calculating earnings for each day based on
                            paths
                            and times. It generates a detailed HTML summary table, showcasing daily earnings, total
                            earnings, average earnings, and financial status (profit, loss, or break-even).
                        </p>
                    </div>
                </div>

                <iframe class="mt-4" src="https://pastecode.dev/iframe/Lw2IZyic?theme=light"
                    style="border:none;width:100%; height: 400px;"></iframe>

                <div class="container d-flex justify-content-center align-items-center flex-column">
                    <h3 class="mt-3">Output</h3>
                    <hr>
                    <div class="">
                        @php
                        /**
                         * The daily expenses for the expedition.
                         *
                         * @var float
                         */
                        $dailyExpenses = 50.00;

                        /**
                         * Details of the expeditions, including time, path, and price.
                         *
                         * @var array
                         */
                        $expeditions = [
                            "8 ABRAAA 25.00",
                            "8 ABMMMR 25.00",
                            "8 ABMMRA 25.00"
                        ];

                        /**
                         * Calculates earnings for each expedition based on the path and time.
                         *
                         * @param array $expeditions Details of the expeditions.
                         *
                         * @return array Earnings for each expedition.
                         */
                        function calcExpeditionEarnings(array $expeditions): array
                        {
                            $earnings = [];
                            foreach ($expeditions as $expedition) {
                                list($time, $path, $price) = explode(" ", $expedition);
                                $pathLength = strlen($path);
                                $bottleCount = 0;

                                for ($i = 0; $i < $time; $i++) {
                                    $char = $path[$i % $pathLength];
                                    if ($char == "B" || $char == "b") {
                                        $bottleCount++;
                                    }
                                }
                                $earnings[] = number_format(($bottleCount * $price), 2, '.', ',');
                            }
                            return $earnings;
                        }

                        /**
                         * Evaluates overall earnings, generates a summary table, and outputs the result.
                         *
                         * @param float $dailyExpenses The daily expenses for the expedition.
                         * @param array $expeditions Details of the expeditions.
                         */
                        function evaluateEarnings(float $dailyExpenses, array $expeditions): void
                        {
                            $earnings = calcExpeditionEarnings($expeditions);
                            $totalEarnings = number_format(array_sum($earnings), 2, '.', ',');
                            $totalDailyExpenses = number_format(($dailyExpenses * count($expeditions)), 2, '.', ',');
                            $averageEarnings = number_format(($totalEarnings / count($expeditions)), 2, '.', ',');

                            $data = [
                                "earnings" => $earnings,
                                "totalEarnings" => $totalEarnings,
                                "totalDailyExpenses" => $totalDailyExpenses,
                                "averageEarnings" => $averageEarnings,
                                "dailyExpenses" => $dailyExpenses,
                                "expeditions" => $expeditions
                            ];

                            formatData($data);
                        }

                        /**
                         * Formats and displays the summary table in HTML.
                         *
                         * @param array $data The data to be displayed in the summary table.
                         */
                        function formatData(array $data): void
                        {
                            $tabletop = <<<EOF
                            <table style="border: 1px solid black; border-collapse:collapse;">
                            <thead>
                            <th style='border: 1px solid black; border-collapse:collapse; text-align: center;' colspan='3'>Daily Summary</th>
                            <tr>
                            <th style="border: 1px solid black; border-collapse:collapse;">Day</th>
                            <th style="border: 1px solid black; border-collapse:collapse;">Earnings</th>
                            <th style="border: 1px solid black; border-collapse:collapse;">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            EOF;

                            $tablebot = <<<EOF
                            </tbody>
                            </table>
                            EOF;

                            echo $tabletop;
                            foreach ($data["earnings"] as $day => $earning) {
                                echo "<tr>";
                                echo "<td style='border: 1px solid black; border-collapse:collapse;'>" . ($day + 1) . "</td>";
                                echo "<td style='border: 1px solid black; border-collapse:collapse;'>" . $earning . "</td>";
                                if($earning == $data['dailyExpenses']) {
                                    echo "<td style='border: 1px solid black; border-collapse:collapse;'>Break Even</td>";
                                } else {
                                    echo "<td style='border: 1px solid black; border-collapse:collapse;'>" . ($earning > $data["dailyExpenses"] ? "Profit" : "Loss") . "</td>";
                                }
                                echo "</tr>";
                            }
                            echo "<tr><th style='border: 1px solid black; border-collapse:collapse; text-align: center;' colspan='3'>Overall Summary</th></tr>";
                            echo "<tr><td style='border: 1px solid black; border-collapse:collapse;'>Total Earnings</td><td style='border: 1px solid black; border-collapse:collapse;' colspan='2'>" . $data["totalEarnings"] . "</td></tr>";
                            echo "<tr><td style='border: 1px solid black; border-collapse:collapse;'>Average Earnings</td><td style='border: 1px solid black; border-collapse:collapse;' colspan='2'>" . $data["averageEarnings"] . "</td></tr>";
                            echo "<tr><td style='border: 1px solid black; border-collapse:collapse;'>Total Daily Expenses</td><td style='border: 1px solid black; border-collapse:collapse;' colspan='2'>" . $data["totalDailyExpenses"] . "</td></tr>";
                            if ($data['averageEarnings'] > $data['dailyExpenses']) {
                                echo "<tr><td style='border: 1px solid black; border-collapse:collapse;' colspan='3'>Good Earnings. Extra money per day : " . ($data['averageEarnings'] - $data['dailyExpenses']) . " </td></tr>";
                            } else if ($data['averageEarnings'] < $data['dailyExpenses']) {
                                echo "<tr><td style='border: 1px solid black; border-collapse:collapse;' colspan='3'>Hard Times. Money needed : " . ($data['totalDailyExpenses'] - $data['totalEarnings']) . " </td></tr>";
                            } else {
                                echo "<tr><td style='border: 1px solid black; border-collapse:collapse;' colspan='3'>No profit or loss. Break Even</td></tr>";
                            }
                            echo $tablebot;
                        }

                        // Output the formatted summary table
                        echo "<pre>";
                        evaluateEarnings($dailyExpenses, $expeditions);
                        echo "</pre>";

                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class="py-5">
        <div class="container">
            <h1 class="mb-4">Mini Project</h1>
            <p class="lead mb-4">Employee records app with login, CRUD operations, and simple analytics.</p>
            <p class="mb-4">Please run following commands on the terminal before logging in.</p>
            <iframe src="https://pastecode.dev/iframe/RRlP3MTx?theme=light" style="border:none;width:100%"></iframe>
            <p class="mb-4">Use the following credentials to login to the app.</p>
            <p class="my-4">Username : user1</p>
            <p class="my-4">Password : user1</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Go to Mini Project</a>
        </div>
    </section>
</body>

</html>
