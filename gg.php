<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Exchange Rates</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            margin: 20px 0;
            color: #007BFF;
        }

        .exchange-container {
            background: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            width: 90%;
            max-width: 500px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .result {
            margin-top: 20px;
            text-align: center;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Currency Exchange Rates</h1>
    <div class="exchange-container">
        <div class="form-group">
            <label for="fromCurrency">From Currency:</label>
            <select id="fromCurrency">
                <option value="USD">USD - US Dollar</option>
                <option value="EUR">EUR - Euro</option>
                <option value="LAK">LAK - Lao Kip</option>
                <option value="THB">THB - Thai Baht</option>
            </select>
        </div>

        <div class="form-group">
            <label for="toCurrency">To Currency:</label>
            <select id="toCurrency">
                <option value="USD">USD - US Dollar</option>
                <option value="EUR">EUR - Euro</option>
                <option value="LAK">LAK - Lao Kip</option>
                <option value="THB">THB - Thai Baht</option>
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" id="amount" placeholder="Enter amount to convert" />
        </div>

        <button id="convertButton">Convert</button>
        <div class="result" id="result"></div>
    </div>

    <script>
        const apiKey = "YOUR_API_KEY"; // Replace with your real API key
        const apiUrl = "https://openexchangerates.org/api/latest.json?app_id=" + apiKey;

        document.getElementById("convertButton").addEventListener("click", async () => {
            const fromCurrency = document.getElementById("fromCurrency").value;
            const toCurrency = document.getElementById("toCurrency").value;
            const amount = document.getElementById("amount").value;

            if (amount === "") {
                document.getElementById("result").innerText = "Please enter an amount!";
                return;
            }

            try {
                const response = await fetch(apiUrl);
                const data = await response.json();

                const exchangeRate = data.rates[toCurrency] / data.rates[fromCurrency];
                const convertedAmount = (amount * exchangeRate).toFixed(2);

                document.getElementById("result").innerHTML = `
                    ${amount} ${fromCurrency} = ${convertedAmount} ${toCurrency}
                `;
            } catch (error) {
                document.getElementById("result").innerText = "Error fetching exchange rates.";
                console.error(error);
            }
        });
    </script>
</body>
</html>
